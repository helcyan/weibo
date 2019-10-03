<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //注册
    public function create()
    {
        return view('users.create');
    }

    //展示用户个人信息
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    //表单数据
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>      'required|max:50',
            'password'  =>      'required|email|unique:users|max:255',      //unique:users 验证users表中email的唯一性
            'email'     =>      'required|confirmed|min:6'                 //confirmed 验证两次输入的密码是否一致
        ]);
    }
}
