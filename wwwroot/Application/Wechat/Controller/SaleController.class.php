<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/7
 * Time: 15:50
 */

namespace Wechat\Controller;


class SaleController extends WechatController
{
    public function index(){
        $map=['unit'=>1,'status'=>0];
        $condition=['unit'=>2,'status'=>0];
        $list= $sale=D('Sale')->where($map)->select();
        $_list=$sale=D('Sale')->where($condition)->select();
        $this->assign('list',$list);
        $this->assign('_list',$_list);
        $this->display();
    }

    public function detail($id=0){
        $id=I('id');
        if($id){
            if($list=D('Sale')->where('id='.$id)->select()){
                $this->assign('list',$list);
                $this->display();
            }else{
                $this->error('租房信息有误');
            }

        }else{
            $this->error('参数错误');
        }
    }

    public function notice(){

        $p=I('p');
        $list=M('document');
        $pagesize=1;
        $page=0;
        if($p){
            $lists = $list->where('category_id=2')->limit($pagesize*($p-1).','.$pagesize)->select();

            $list=[];
            foreach($lists as $info){
                $info['create_time']=date('Y-m-d H:i:s',$info['create_time']);
                $id=$info['cover_id'];
                $path=D('picture')->where('id='.$id)->find();
                $img=$path['path'];
                $info['img']=$img;
                $list[]=$info;
            }
            if($list){
                $data=[
                    'status'=>1,
                    'data'=>$list,
                ];
                $this->ajaxReturn($data);
            }

        }else{
            $list=  $list->where('category_id=2')->limit($page.','.$pagesize)->select();
        }
        $this->assign('list',$list);


        $this->display();
    }

    public function notice_detail($id=0){
        $id=I('id');
        if($id){

            $article=D('document_article')->where('id='.$id)->find();
           if($article){
               M('Document')->where('id='.$id)->setInc('view');
               $list=D('document')->where('id='.$id)->find();
               $this->assign('list',$article);
               $this->assign('_list',$list);
               $this->display('notice_detail');
           }else{
               $this->error('信息有误');
           }
        }else{
            $this->error('参数错误');
        }
    }

    public function shop(){
        $p=I('p');
        $list=M('document');
        $pagesize=1;
        $page=0;
        if($p){
            $lists = $list->where('category_id=40')->limit($pagesize*($p-1).','.$pagesize)->select();
            $list=[];
            foreach($lists as $info){
                $info['create_time']=date('Y-m-d H:i:s',$info['create_time']);
                $id=$info['cover_id'];
                $path=D('picture')->where('id='.$id)->find();
                $img=$path['path'];
                $info['img']=$img;
                $list[]=$info;
            }
            if($list){
                $data=[
                    'status'=>1,
                    'data'=>$list,
                ];
                $this->ajaxReturn($data);
            }

        }else{
            $list=  $list->where('category_id=40')->limit($page.','.$pagesize)->select();
        }
        $this->assign('list',$list);
        $this->display();
    }



    public function activity(){
        $p=I('p');
        $list=M('document');
        $pagesize=1;
        $page=0;
        if($p){
            $lists = $list->where('category_id=41')->limit($pagesize*($p-1).','.$pagesize)->select();
            $list=[];
            foreach($lists as $info){
                $info['create_time']=date('Y-m-d H:i:s',$info['create_time']);
                $id=$info['cover_id'];
                $path=D('picture')->where('id='.$id)->find();
                $img=$path['path'];
                $info['img']=$img;
                $list[]=$info;
            }
            if($list){
                $data=[
                    'status'=>1,
                    'data'=>$list,
                ];
                $this->ajaxReturn($data);
            }

        }else{
            $list=  $list->where('category_id=41')->limit($page.','.$pagesize)->select();
        }
        $this->assign('list',$list);
        $this->display();
    }

    public function activity_detail($id=0){
        $id=I('id');
        if($id){

            $article=D('document_article')->where('id='.$id)->find();
            if($article){
                M('Document')->where('id='.$id)->setInc('view');
                $list=D('document')->where('id='.$id)->find();
                $this->assign('list',$article);
                $this->assign('_list',$list);
                $this->display();
            }else{
                $this->error('信息有误');
            }
        }else{
            $this->error('参数错误');
        }
    }

    public function apply($id=0){
        $id=I('id');
        if(!is_login()){
            $this->error('未登录,请先登录',U('Wechat/User/login'));
        }
        $data=[];
        $activity=M('Activity');
        $name=session('user_auth')['username'];
        $result=$activity->where("name='$name'")->find();
        if($result){
            $this->error('您已经申请过该活动了');exit;
        }
        $document=M('Document');
        $data['name']=session('user_auth')['username'];
        $data['activity']=$document->find($id)['title'];
        $data['description']=$document->find($id)['description'];
        $data['deadline']=$document->find($id)['deadline'];
        $data['apply_time']=time();
        $data['status']=1;
        $activity->add($data);
        $this->success('申请成功');

    }


}