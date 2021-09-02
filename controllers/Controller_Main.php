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


        if($_GET['search_id'] && $_GET['search_data']){

        }else {

            $data = $this->model->getFilms();
        }


        return $this->view->render('main_view.php', 'template_view.php', $data);
    }
    public function action_film_deleted(){

        $id = $_GET['id'];
        $this->model->deletedFilm($id);
        return $this->action_index();
    }
    public function action_add_film(){


        if($_POST){

            $this->model->name = $_POST['name'];
            $this->model->format = $_POST['format'];
            $this->model->list_authors = $_POST['list_authors'];
            $this->model->graduation_year = $_POST['graduation_year'];


            $this->model->addFilm();
        }
        return $this->view->render('add_view.php', 'template_view.php');
    }

    public function action_detail(){

        $data =  $this->model->getById(2);
        echo "<pre>";
        print_r($data->name);
        echo "<pre>";
        die();

        return $this->view->render('detail_view.php', 'template_view.php',$data);
    }

    public function action_search(){

         $this->model->search("name", "Casablanca");

    }

    public function action_import(){
        $import_data = array();

        if($_FILES){

            $res = file_get_contents($_FILES['file_import']['tmp_name']);
            //Разбиваем на массив использую
            //как разделитель символы переноса строки
            $lines = explode("\r\n", $res);
            $import_data = array_diff($lines, array(''));
            $import_data = array_chunk($import_data, 4);
            
            echo "<pre>";
            print_r($import_data);
            echo "<pre>";
            die();

            foreach ($lines as $key=>$val)
            {
                if($val) {
                    echo "Строка $key:" . $val . "<br/>";
                }
            }
        }

        return $this->view->render('import_view.php', 'template_view.php');

    }


}