<?php
class Config_Db
{
    static $DB_HOST = "127.0.0.1";
    static $DB_PORT = "3889"; 
    static $DB_NAME = "111";
    static $DB_USER = "222";
    static $DB_PASS = "";
    static $DB_OPT = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',);
}