<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/10
 * Time: 11:10
 */

namespace Wechat\Controller;


class RepaireController extends WechatController
{
    public function index(){
        $this->display();
    }

    public function add($verify = ''){
        if(IS_POST) { //登录验证
            /* 检测验证码 */
            if (!check_verify($verify)) {
                $this->error('验证码输入错误！');
            }
            $model=M('Repaire');
            $data=$model->create();
            if($data){
                $data['num']=uniqid().date('Ymd',time());
                $data['repaire_time']=time();
                $data['status']=1;
                $result=$model->add($data);
                if($result){
                    $this->success('提交成功','wechat.php?s=/Wechat/User/my.html');
                }else{
                    $this->error('提交失败');
                }
            }else{
                $this->error('参数错误');
            }

        }
    }

    public function my(){
        dump ($_SERVER['HTTP_REFERER']);
    }

}