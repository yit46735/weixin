<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/6
 * Time: 13:09
 */

namespace Admin\Controller;


class SaleController extends AdminController
{

    public function index(){
        $sale=M('Sale');
        $count=$sale->count();
        $page=new \Think\Page($count,3);
        $show=$page->show();
        $list = $sale->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('_list', $list);
        $this->assign('page',$show);
        $this->meta_title = '物业管理';
        $this->display();
    }

    public function add(){

    if(IS_POST){
        $sale=D('Sale');
        $data=$sale->create();
        if($data){
            $deadline=$data['deadline'];
            $data['deadline']=strtotime($deadline);
            $id=$sale->add($data);
            if($id){
                $this->success('新增成功', U('index'));
            } else { $this->error('新增失败');

            }
        }else {
            $this->error($sale->getError());
        }
    }


        $this->display('add');
    }

    public function edit($id=0){

        if(IS_POST){

            $sale=D('Sale');
            $data=$sale->create();


            if($data){
                $deadline=$data['deadline'];
                $data['deadline']=strtotime($deadline);
                $sale->save($data);
                $this->success('修改成功',U('index'));

            }else{
                $this->error($sale->getError());
            }

        }else{

            $info = array();
            /* 获取数据 */
            $info = M('Sale')->find($id);

            if(false === $info){
                $this->error('获取配置信息错误');
            }
            $this->assign('info', $info);

            $this->display();
        }
    }

    public function delete(){
        $id = array_unique((array)I('id',0));


        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(D('Sale')->where($map)->delete()){
            //记录行为

            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    public function changeStatus($method=null){
        $id = array_unique((array)I('id',0));
//        if( in_array(C('USER_ADMINISTRATOR'), $id)){
//            $this->error("不允许对超级管理员执行该操作!");
//        }
        $id = is_array($id) ? implode(',',$id) : $id;
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map['id'] =   array('in',$id);
        $sale=D('Sale');
        switch ( strtolower($method) ){
            case 'forbidsale':
                $sale->status=1;
                $sale->where($map)->save();
                $this->success('禁用成功');
                break;
            case 'resumesale':
                $sale->status=0;
                $sale->where($map)->save();
                $this->success('开启成功');
                break;
            case 'deletesale':
//                $this->delete('Member', $map );
                break;
            default:
                $this->error('参数非法');
        }
    }

}