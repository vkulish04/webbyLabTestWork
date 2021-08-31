<?php
include 'core/Db.php';

class Model_Film extends Controller
{

    public function getFilms(){
        $db = Db::conect();
        $sql = 'SELECT * FROM `film` ORDER BY `film`.`name` ASC';
        $result = $db->query($sql);
        $data = array();
        $i=0;
        while($row=$result->fetch()) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['name'] = $row['name'];
            $data[$i]['graduation_year'] = $row['graduation_year'];
            $data[$i]['format'] =$row['format'];
            $data[$i]['list_authors'] = $row['list_authors'];

            $i++;
        }
        return $data;
    }

}