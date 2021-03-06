<?php
include 'core/Db.php';

class   Model_Film extends Controller
{
    public $id_film;
    public $name;
    public $graduation_year;
    public $format;
    public $list_authors;


    public function __construct($id_film = null, $name = null, $format = null, $graduation_year = null, $list_authors = null)
    {
        $this->id_film = $id_film;
        $this->name = $name;
        $this->format = $format;
        $this->graduation_year = $graduation_year;
        $this->list_authors = $list_authors;
    }

    function tableExists($tableName)
    {
        $pdo = Db::conect();
        $Tsql = "SHOW TABLES LIKE :table_name";
        $mrStmt = $pdo->prepare($Tsql);
        $mrStmt->bindParam(":table_name", $tableName, PDO::PARAM_STR);

        $sqlResult = $mrStmt->execute();
        if ($sqlResult) {
            $row = $mrStmt->fetch(PDO::FETCH_NUM);
            if ($row[0]) {
                return true;
            } else {
                $db = Db::conect();
                $sql = "CREATE TABLE film (
id_film INT(6)  AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
graduation_year YEAR(4) NOT NULL,
format VARCHAR(10),
list_authors VARCHAR(255)
)";
                $db->exec($sql);
            }
        } else {
            echo("Could not check if table exists, Error: " . var_export($pdo->errorInfo(), true));
            return false;
        }
    }

    public function getFilms($id_page)
    {
        $start = $id_page == 1 ? 0 : $id_page;
        if ($start == 0) {
            $start = 0;
        } else {
            $start = ($start-1) * 10;
        }
        $db = Db::conect();
        $sql = 'SELECT * FROM `film` ORDER BY `film`.`name` ASC LIMIT ' . $start . ',' . 10;





        $result = $db->query($sql);
        $data = array();
        while ($row = $result->fetch()) {
            $film = new Model_Film();
            $film->id_film = $row['id_film'];
            $film->name = $row['name'];
            $film->format = $row['format'];
            $film->graduation_year = $row['graduation_year'];
            $film->list_authors = $row['graduation_year'];
            $data [] = $film;
        }
        return $data;
    }

    public function deletedFilm($id)
    {
        try {
            $db = Db::conect();
            $sql = 'DELETE FROM `film` WHERE `film`.`id_film` = ' . $id;
            $result = $db->query($sql);
            return true;
        } catch (Error $e) {
            return $e;
        }
    }

    public function addFilm()
    {

//        $validate = $this->validate();
//        echo "<pre>";
//        print_r($validate);
//        echo "<pre>";
//        die();
        if ($this->validate()) {
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
            return true;
        }
        return false;
    }

    public function getById($id)
    {

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


    public function search($search_id, $search_data)
    {
        $db = Db::conect();
        if ($search_id == "name") {
            $sql = "SELECT * FROM film WHERE name LIKE ?";
        } else if ($search_id == "list_authors") {
            $sql = "SELECT * FROM film WHERE list_authors LIKE ?";
        }
        $params = ["%$search_data%"];
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $data = array();
        $i = 0;
        while ($row = $stmt->fetch()) {
            $data [] = new Model_Film($row['id_film'], $row['name'], $row['format'], $row['graduation_year'], $row['list_authors']);
            $i++;
        }
        return $data;
    }

    public function count_film()
    {
        $db = Db::conect();

        $sql = "SELECT COUNT(*) AS count FROM film";

        $stmt = $db->query($sql);

        return $stmt->fetch(PDO::FETCH_OBJ)->count;
    }

    public function validate()
    {
        $db = Db::conect();
        $sql = "SELECT * FROM `film` WHERE `name` = ?";
        $sth = $db->prepare($sql);
        $sth->execute([$this->name]);
        $results = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $result){
            if($result['graduation_year'] == $this->graduation_year){
                return false;
            }
            $list_auth1 = $result['list_authors'];
            $list_auth1 = explode(',', $list_auth1);
            $list_auth1 = sort($list_auth1);

            $list_auth2 = explode(',', $this->list_authors);
            $list_auth2 = sort($list_auth2);
            if($list_auth1 == $list_auth2){
                return false;
            }
        }
        $list_author = explode(',', $this->list_authors);
        for ($i = 0; $i<count($list_author); $i++){
            $list_author[$i] = trim($list_author[$i]);
        }
        $list_author_count = array_count_values($list_author);

        foreach ($list_author_count as $key => $value){
            if($value > 1 ){
                return false;
            }
        }
        if (preg_match("/[^??-????-??????????????a-zA-Z\-, ]/mui", $this->list_authors)){
            return false;
        }

        return true;
    }
}