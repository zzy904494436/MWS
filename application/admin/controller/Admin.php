<?php

namespace app\admin\controller;

use think\Controller;

class Admin extends Controller
{
    public function lst()
    {
        return $this->fetch();
    }


    public function add()
    {
        return $this->fetch();
    }

}
