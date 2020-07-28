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


            $instModelUser = new User();
            $instModelUser->load($_POST);

            if(!($instModelUser->validate($_POST))){
                $instModelUser->getErrors();
                redirect();

            }

            if($instModelUser->save("users"))
            {
                $_SESSION['success'] = "Все заебок";

            }else{
                $_SESSION['error'] = "Все бесполезно - ты лох!! База - сдох!!))";
            }
            redirect();

        }
    }
}