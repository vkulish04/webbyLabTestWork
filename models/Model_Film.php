<?php
include 'core/Db.php';

class Model_Film extends Controller
{
    public $id_film;
    public $name;
    public $graduation_year;
    public $format;
    public $list_authors;





    public function  __construct($id_film = null, $name = null, $format = null, $graduation_year = null, $list_authors = null){
        $this->id_film = $id_film;
        $this->name = $name;
        $this->format = $format;
        $this->graduation_year = $graduation_year;
        $this->list_authors = $list_authors;
    }
    public function getFilms(){
        $db = Db::conect();
        $sql = 'SELECT * FROM `film` ORDER BY `film`.`name` ASC';
        $result = $db->query($sql);
        $data = array();
        $i=0;
        while($row=$result->fetch()) {
            $data [] = new Model_Film($row['id_film'], $row['name'], $row['format'], $row['graduation_year'], $row['list_authors']);
            $i++;
        }
        return $data;
    }

    public function deletedFilm($id){
        $db = Db::conect();
        $sql = 'DELETE FROM `film` WHERE `film`.`id_film` = ' . $id;
        $result = $db->query($sql);
    }

    public function addFilm(){

        $db = Db::conect();
        $param = [
            'name' => $this->name,
            'graduation_year' => $this->graduation_year,
            'format' => $this->format,
            'list_authors' => $this->list_authors
        ];
        $sql = 'INSERT INTO `film` (`name`, `graduation_year`, `format`, `list_authors`) VALUES ( :name, :graduation_year, :format, :list_authors)';
        $stmt = $db->prepare($sql);
        $stmt->execute($param);

    }

    public function getById($id){

        $db = Db::conect();
        $sql = "SELECT * FROM `film` WHERE `id_film` = ?";
        $sth = $db->prepare($sql);
        $sth->execute([$id]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        $this->id_film = $result['id_film'];
        $this->name = $result['name'];
        $this->graduation_year = $result['graduation_year'];
        $this->format = $result['format'];
        $this->list_authors = $result['list_authors'];

        return $this;


    }

    public function search($search_id, $search_data){
        $param = [
            'collum' => $search_id,
            'search_name' => $search_data,
        ];

        $db = Db::conect();
        $query = "SELECT * FROM film WHERE `:collum` = :search_name";
        $params = ["%$search_id", "%$search_data%"];
        $stmt = $db->prepare($query);
        $stmt->execute($param);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $i = 1;
        foreach ($data as $category){
            echo $i++ . '. ' . $category['name'].'<br>';
        }
        die();


    }

}