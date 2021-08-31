<?php
include 'models/Model_Film.php';

class Controller_Main extends Controller
{
    function __construct()
    {
        $this->model = new Model_Film();
        $this->view = new View();
    }

    function action_index()
    {

        $data = $this->model->getFilms();
echo "<pre>";
print_r($data);
echo "<pre>";
die();
        $this->view->render('main_view.php', 'template_view.php');
    }
}