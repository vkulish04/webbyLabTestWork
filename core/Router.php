<?php


class Router
{

    static function start(){

        $controller_name = "Main";
        $action_name = "index";

        $rout = explode('/', $_SERVER['REQUEST_URI']);

        if( $rout[1]){
            $controller_name = $rout[1];
        }
        if( $rout[2]){
            $action_url =  explode( "?", $rout[2]);
            $action_name = $action_url[0];
        }
//        echo "<pre>";
//        print_r($action_name);
//        echo "<pre>";
//        die();

        $model_name = 'Model_' . $controller_name;
        $controller_name = 'Controller_' . $controller_name;
        $action_name = 'action_' . $action_name;


        $model_file = $model_name . '.php';
        $model_path = 'models/' . $model_file;


        if(file_exists($model_path)){
            include 'models/'. $model_file;
        }


        $controller_file = $controller_name . '.php';
        $controller_path = "controllers/" . $controller_file;

        if(file_exists($controller_path))
        {
            include "controllers/" . $controller_file;
        }
        else
        {
            Router::Error404();
        }




        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action)){

            $controller->$action();
        }
    }

   static  function Error404(){
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }

}