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

        $this->view->render('main_view.php', 'template_view.php', $data);
    }
    public function action_film_deleted(){

        $id = $_GET['id'];
        $this->model->deletedFilm($id);
        return $this->action_index();
    }
    public function action_add_film(){

        return 1;
    }

}