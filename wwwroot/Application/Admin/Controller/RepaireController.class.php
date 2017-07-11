<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/10
 * Time: 10:46
 */

namespace Admin\Controller;


class RepaireController extends AdminController
{
    public function index(){
        $sale=M('Repaire');
        $count=$sale->count();
        $page=new \Think\Page($count,3);
        $show=$page->show();
        $list = $sale->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('_list', $list);
        $status=[1=>'未处理',2=>'处理中',3=>'处理完成'];
        $this->assign('status',$status);
        $txt=[1=>'接受处理',2=>'处理完成',3=>''];
        $this->assign('txt',$txt);
        $this->assign('page',$show);
        $this->meta_title = '报修管理';
        $this->display();
    }

    public function check(){
        $id=I('id');
        if($id){
            $model=M('Repaire');
            $status=$model->find($id)['status'];
            if($status==1){
                $model->status=2;
                $model->where('id='.$id)->save();
                $this->success('接受处理成功');
            }elseif($status==2){
                $model->status=3;
                $model->where('id='.$id)->save();
                $this->success('处理完成成功');
            }
        }else{
            $this->error('参数错误');
        }
    }



}