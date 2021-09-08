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

        $page_id = 1;
        if ($_GET['page_id'])
            $page_id = $_GET['page_id'];

        $count_page = $this->model->count_film();

        $count_page = ceil($count_page / 10);
        $data['count_page'] = $count_page;
        $data['active_page'] = $page_id;

        $data['selected'] = [
            'name' => [
                'value' => 'По названию',
                'atr' => 'selected'
            ],
            'list_authors' => [
                'value' => 'По имени актера',
                'atr' => ""
            ]
        ];
        $this->model->tableExists('film');

        if ($_GET['search_id'] && $_GET['search_data']) {
            $data['film'] = $this->model->search($_GET['search_id'], $_GET['search_data']);
            switch ($_GET['search_id']) {
                case 'name':
                    $data['selected']['name']['atr'] = "selected";
                    break;
                case 'list_authors':
                    $data['selected']['list_authors']['atr'] = "selected";
                    break;
            }
            $data['search_data'] = $_GET['search_data'];
        } else {
            $data['film'] = $this->model->getFilms($page_id);
        }
        return $this->view->render('main_view.php', 'template_view.php', $data);
    }

    public function action_film_deleted()
    {
        if ($_GET['id']) {
            $id = $_GET['id'];
            $res = $this->model->deletedFilm($id);
            if ($res == true) {
                return $this->action_index();
            }
        }
        return $this->action_index();
    }

    public function action_add_film()
    {
        $data['text'] = "Введите дание";
        $data['check'] = true;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (trim($_POST['name']) !== "" && trim($_POST['format']) != "" && trim($_POST['list_authors']) != "" && trim($_POST['graduation_year']) != "") {
                $this->model->name = $_POST['name'];
                $this->model->format = $_POST['format'];
                $this->model->list_authors = $_POST['list_authors'];
                $this->model->graduation_year = $_POST['graduation_year'];
                $res = $this->model->addFilm();
                if ($res) {
                    $data['text'] = "Данные успешо добалени !!";
                    $data['check'] = true;
                }else{
                    $data['name'] = $this->model->name;
                    $data['format'] = $this->model->format;
                    $data['list_authors'] = $this->model->list_authors;

                    $data['text'] = "Ошибки валидации";
                    $data['check'] = false;
                }
            }
        }
        return $this->view->render('add_view.php', 'template_view.php', $data);
    }

    public function action_detail()
    {
        if ($_GET['id']) {
            $data = $this->model->getById($_GET['id']);
        }
        return $this->view->render('detail_view.php', 'template_view.php', $data);
    }
    

    // считуем построчно дание с txt
    // вирезаем пустие строки
    // груперуем по 4 елемента
    // обрезаем  начало
    // добавляем в бд
    public function action_import()
    {
        $data['executed'] = 0;
        $data['notexecude'] = 0;
        if ($_FILES) {
            $res = file_get_contents($_FILES['file_import']['tmp_name']);
            $lines = explode("\r\n", $res);
            $import_data = array_diff($lines, array(''));
            $import_data = array_chunk($import_data, 4);
            foreach ($import_data as $datum) {
                $this->model->name = str_replace('Title: ', "", $datum[0]);
                $this->model->format = str_replace('Format: ', "", $datum[2]);
                $this->model->graduation_year = str_replace('Release Year: ', "", $datum[1]);
                $this->model->list_authors = str_replace('Stars: ', "", $datum[3]);
                $res = $this->model->addFilm();
                if($res == true){
                    $data['executed']++;
                }
                else{
                    $data['notexecude']++;
                }
            }

        }
        return $this->view->render('import_view.php', 'template_view.php', $data);

    }


}