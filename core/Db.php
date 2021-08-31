<?php


class Db
{
    public static function conect(){
        $config_db = include 'config/config_bd.php';

        $dsn = "mysql:host={$config_db['hostname']};dbname={$config_db['dbname']}";
        $db = new PDO($dsn, $config_db['username'], $config_db['password']);
        //кодировка
        $db->exec("set names utf8");
        return $db;
    }

}