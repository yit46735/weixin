<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/10
 * Time: 8:48
 */

namespace Admin\Controller;


class ActivityController extends AdminController
{
    public function index(){
        $sale=M('Activity');
        $count=$sale->count();
        $page=new \Think\Page($count,3);
        $show=$page->show();
        $list = $sale->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('_list', $list);
        $this->assign('page',$show);
        $this->meta_title = '活动管理';
        $this->display();
    }
}