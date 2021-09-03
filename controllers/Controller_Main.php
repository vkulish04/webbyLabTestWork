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
        $this->model->tableExists('film');

        if($_GET['search_id'] && $_GET['search_data']){
            // порблем
            $data = $this->model->search($_GET['search_id'], $_GET['search_data']);
        }else {
            $data = $this->model->getFilms();
        }
        return $this->view->render('main_view.php', 'template_view.php', $data);
    }
    public function action_film_deleted(){
        if($_GET['id']) {
            $id = $_GET['id'];
           $res = $this->model->deletedFilm($id);
            if($res == true){
                return $this->action_index();
            }
        }
        return $this->action_index();
    }
    public function action_add_film(){


        if($_POST['name'] && $_POST['format'] && $_POST['list_authors'] && $_POST['graduation_year']){
            $this->model->name = $_POST['name'];
            $this->model->format = $_POST['format'];
            $this->model->list_authors = $_POST['list_authors'];
            $this->model->graduation_year = $_POST['graduation_year'];
            $this->model->addFilm();
            return $this->action_index();
        }else{
            return $this->view->render('add_view.php', 'template_view.php');
        }
        return $this->view->render('add_view.php', 'template_view.php');
    }

    public function action_detail(){
        if($_GET['id']){
            $data =  $this->model->getById($_GET['id']);
        }
        return $this->view->render('detail_view.php', 'template_view.php',$data);
    }


    // считуем построчно дание с txt
    // вирезаем пустие строки
    // груперуем по 4 елемента
    // обрезаем  начало
    // добавляем в бд
    public function action_import(){
        if($_FILES){
            $res = file_get_contents($_FILES['file_import']['tmp_name']);
            $lines = explode("\r\n", $res);
            $import_data = array_diff($lines, array(''));
            $import_data = array_chunk($import_data, 4);
            foreach ($import_data as $datum){
                $this->model->name = str_replace('Title: ', "", $datum[0]);
                $this->model->format = str_replace('Format: ', "", $datum[2]);
                $this->model->graduation_year = str_replace('Release Year: ', "", $datum[1]);
                $this->model->list_authors = str_replace('Stars: ', "", $datum[3]);
                $this->model->addFilm();
            }
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: http://testwork/");
            exit();
        }
        return $this->view->render('import_view.php', 'template_view.php');

    }


}