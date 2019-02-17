<?php

namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'username' => 'require|max:12',
        'password' => 'require'
    ];

    protected $message = [
        'username.require' => '管理员名称不能为空',
        'username.max' => '管理员名称长度不能大于12位',
        'password.require' => '管理员密码不能为空'
    ];

    protected $scene = [
      'add'  =>  ['username' => 'require' , 'password'],        // add场景只验证username    //或者只验证某个规则
      'edit' =>  ['username' => 'require' ],        // add场景只验证username    //或者只验证某个规则
    ];


}
