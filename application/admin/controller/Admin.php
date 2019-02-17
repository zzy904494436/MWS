<?php

namespace app\admin\controller;

use think\Controller;
use think\Loader;
use app\admin\model\Admin as AdminModel;

class Admin extends Controller
{
    public function lst()
    {
        $list = AdminModel::paginate(3);
        $this->assign('list', $list);
        return $this->fetch();
    }


    public function add()
    {
        if (request()->isPost()) {

//            $validate = new Validate([
//                'username' => 'require|max:25',
//                'password' => 'require|max:25'
//            ]);

            $data = [
                'username' => input('username'),
                'password' => md5(input('password'))
            ];

//            if (!$validate->check($data)) {
//                $this->error($validate->getError());
//                die;
//            }

            $validate = Loader::validate('Admin');

            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
                die;
            }

//            if (Db::name('admin')-> insert($data)){
            if (\db('admin')->insert($data)) {
                return $this->success("添加管理员成功", 'lst');
            } else {
                return $this->error("添加管理员失败");
            }

            return;
        }
        return $this->fetch();
    }


    public function edit()
    {
        $id = input('id');
        $admins = db('admin')->find($id);

        if (request()->isPost()) {
            $data = [
                'id' => input('id'),
                'username' => input('username'),
//                'password' => input('password'),
            ];

            if (input('password')) {
                $data['password'] = md5(input('password'));
            } else {
                $data['password'] = $admins['password'];
            }

            $validate = Loader::validate('Admin');

            if (!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError());
                die;
            }


            if (db('admin')->update($data)) {
                $this->success('修改信息成功', 'lst');
            } else {
                $this->error('修改信息失败');
            }
            return;
        }


        $this->assign('admins', $admins);
        return $this->fetch();
    }

    public function del()
    {

        echo (input('id'));
        $id = input('id');
        if ($id != 2) {
            if (db('admin')->delete(input('id'))) {
                $this->success('删除管理员成功');
            } else {
                $this->error('删除管理员失败');
            }
        } else {
            $this->error('初始化管理员不能删除');
        }
    }
}
