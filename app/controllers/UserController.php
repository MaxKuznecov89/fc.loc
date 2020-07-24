<?php


namespace app\controllers;


use app\model\User;

class UserController extends AppController
{
    public function logoutAction(){

    }

    public function loginAction(){

    }

    public function signupAction(){
        $this->layout = 'defaultMain';

        if(!empty($_POST)){
            $this->layout = 'mainTest';
            $this->view = "successSignin";

            $instModelUser = new User();
            $instModelUser->load($_POST);

        }
    }
}