<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{

    protected $userModel;

    public function __construct()
    {

        $this->userModel=new UserModel();

    }

    public function index()
    {

        if(session()->get('logged_in')){

            return redirect()->to('/dashboard');

        }

        return view('auth/login');

    }

    public function auth()
    {

        $rules=[
            'role'=>'required',

            'username'=>'required',

            'password'=>'required'

        ];

        if(!$this->validate($rules)){

            return redirect()
                    ->back()
                    ->withInput();

        }

        $role=$this->request->getPost('role');
        $username=$this->request->getPost('username');

        $password=$this->request->getPost('password');

        $user=$this->userModel
                    ->where('username',$username)
                    ->where('role',$role)
                    ->first();

        if(!$user){

            return redirect()
                    ->back()
                    ->with('error','Username tidak ditemukan.');

        }

        if(!password_verify($password,$user['password'])){

            return redirect()
                    ->back()
                    ->with('error','Password salah.');

        }


        session()->set([

            'id_user'=>$user['id_user'],

            'username'=>$user['username'],

            'role'=>$user['role'],

            'logged_in'=>true

        ]);
            return redirect()->to(base_url('dashboard'));


    }

    public function logout()
    {

        session()->destroy();

        return redirect()->to(base_url('login'));

    }

}