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

            if(!($instModelUser->validate($_POST)) ||!($instModelUser->checkUnique())){
                $instModelUser->getErrors();
                redirect();

            }

            $instModelUser->attributes["password"] =  md5($instModelUser->attributes["password"]);

            if($instModelUser->save("users"))
            {
                $_SESSION['success'] = "Все заебок 12345";

            }else{
                $_SESSION['error'] = "Все бесполезно - ты лох!! База - сдох!!))";
            }
//            redirect();

        }
    }
}