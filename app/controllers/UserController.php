<?php


namespace app\controllers;


use app\model\User;

class UserController extends AppController
{
    public function logoutAction(){
        if(isset($_SESSION["user"])){
            unset($_SESSION["user"]);
        }
        redirect();
    }

    public function loginAction(){
        $this->layout = 'defaultMain';
        if(!empty($_POST)){
            $instModelUser = new User();

            if($instModelUser->login()){
                $_SESSION["success"]= "you are login";

            }else{
                $_SESSION["error"]= "log/pass is error";
            }
            redirect();
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