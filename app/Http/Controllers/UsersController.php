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
        //表单验证
        $this->validate($request, [
            'name'      =>      'required|max:50',
            'email'     =>      'required|email|unique:users|max:255',      //unique:users 验证users表中email的唯一性
            'password'  =>      'required|confirmed|min:6'                 //confirmed 验证两次输入的密码是否一致
        ]);

        //获取表单数据
        $user = User::create([
            'name'  =>  $request->name,
            'email'  =>  $request->email,
            'password'  =>  bcrypt($request->password),
        ]);
        session()->flash('success','欢迎！您将在这里开启一段新的旅程~');
        return redirect()->route('users.show',[$user]); //->with('success','欢迎！您将在这里开启一段新的旅程~')
    }
}
