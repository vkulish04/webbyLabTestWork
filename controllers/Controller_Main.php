<?php
include 'models/Model_Film.php';

class Controller_Main extends Controller
{
    function __construct()
    {
        $this->model = new Model_Film();
        $this->view = new View();
    }

    public function action_index()
    {

        $data = $this->model->getFilms();

        return $this->view->render('main_view.php', 'template_view.php', $data);
    }
    public function action_film_deleted(){

        $id = $_GET['id'];
        $this->model->deletedFilm($id);
        return $this->action_index();
    }
    public function action_add_film(){


        if($_POST){
            echo "<pre>";
            print_r($_POST['name']);
            echo "<pre>";
            die();
        }
        return $this->view->render('add_view.php', 'template_view.php');
    }

}