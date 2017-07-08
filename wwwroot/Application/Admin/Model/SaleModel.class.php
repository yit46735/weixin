<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/6
 * Time: 14:14
 */

namespace Admin\Model;


use Think\Model;

class SaleModel extends Model
{

    protected $_validate = array(
        array('title', 'require', '标题不能为空', 1 , 'regex', self::MODEL_BOTH),
        array('tel', '/^1[3|4|5|8]\d{9}$/', '手机号不合法', 1, 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
        array('pub_time', NOW_TIME, self::MODEL_INSERT),
        array('name', 'getName',1,'callback'),

    );

    protected function getName(){
        return session('user_auth')['username'];
    }
}