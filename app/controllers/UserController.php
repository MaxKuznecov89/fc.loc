<?php


namespace app\controllers;


use app\model\User;

class UserController extends AppController
{
    public function logoutAction(){

    }

    public function loginAction(){
        $this->layout = 'defaultMain';
        if(!empty($_POST)){
            $instModelUser = new User();

            if($instModelUser->login()){
                echo "you are login";
                return;
            }
            echo "pizda!!!";
        }



    }

    public function signupAction(){
        $this->layout = 'defaultMain';

        if(!empty($_POST)){


            $instModelUser = new User();
            $instModelUser->load($_POST);

            if(!($instModelUser->validate($_POST)) ||!($instModelUser->checkUnique())){
                $instModelUser->getErrors();
                $_SESSION['from_date'] = $_POST;
                redirect();

            }

            $instModelUser->attributes["password"] =  password_hash($instModelUser->attributes["password"], PASSWORD_BCRYPT);

            if($instModelUser->save("users"))
            {
                $_SESSION['success'] = "Все заебок 12345";

            }else{
                $_SESSION['error'] = "Все бесполезно - ты лох!! База - сдох!!))";
            }
            redirect();

        }
    }
}