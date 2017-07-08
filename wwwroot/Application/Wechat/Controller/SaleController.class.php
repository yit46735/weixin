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

        $list=M('document')->select();
        $this->assign('list',$list);
        $this->display();
    }

    public function notice_detail($id=0){
        $id=I('id');
        if($id){
//            $doc=D('document');
//            dump($doc->view);exit;
//            $doc->view+=1;
//            $doc->save();
            $article=D('document_article')->where('id='.$id)->find();
           if($article){

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
}