<?php
class Common_Db
{
    static $conn = null;
    public static function getConn()
    {
        if(self::$conn)
        {
            return self::$conn;
        }
        $dsn = 'mysql:host='.Config_Db::$DB_HOST.';port='.Config_Db::$DB_PORT.';dbname='.Config_Db::$DB_NAME;
        self::$conn = new PDO(
            $dsn,
            Config_Db::$DB_USER,
            Config_Db::$DB_PASS,
            Config_Db::$DB_OPT
        );
        self::$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return self::$conn;
    }

    public static function read($sql,$param = array())
    {
        $db = self::getConn();
        $stmt = $db->prepare($sql);
        $stmt->execute($param);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function write($sql,$param = array())
    {
        $db = self::getConn();
        $stmt = $db->prepare($sql);
        $stmt->execute($param);
        return $stmt->rowCount();
    }
    public static function lastinsertid()
    {
        $db = self::getConn();
        return $db->lastinsertid();
    }
}