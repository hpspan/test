<?php
class AutoLoad
{
    public static function auto_load($class) {

        if (trim($class, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz1234567890')) {
            header("HTTP/1.1 204 No Content");
            exit;
            return false;
        }
        $file = str_replace('_', '/', strtolower($class));
        $path = CLASSPATH . DIRECTORY_SEPARATOR . $file . '.php';

        if(file_exists($path)){
            require $path;
        }
        else
        {
            header("HTTP/1.1 204 No Content");
            exit;
        }
        return class_exists($class, false);
    }

    public static function get_uri()
    {
        if (isset ( $_SERVER ['REQUEST_URI'] )) {
            $uri = parse_url ( $_SERVER ['REQUEST_URI'], PHP_URL_PATH );
            $uri = rawurldecode ( $uri );
        } elseif (isset ( $_SERVER ['PHP_SELF'] )) {
            $uri = $_SERVER ['PHP_SELF'];
        } elseif (isset ( $_SERVER ['REDIRECT_URL'] )) {
            $uri = $_SERVER ['REDIRECT_URL'];
        } else {
            throw new Exception( 'can not detect uri' );
        }
        $uri = 'Action_'.str_replace('/','_',trim($uri, DS));
        return $uri;
    }
    public static function decrypt()
    {
        if (isset($_REQUEST['q']))
        {
            //var_dump($_REQUEST['q']);
            //$_REQUEST['q'] = str_replace(' ','+',$_REQUEST['q']);
            $decode = Common_Encrypt::decode($_REQUEST['q']);                             
            if (empty($decode)) 
            {
                echo json_encode(array('code' => '-99'));
                exit;
            }
            else
            {
                $decode = ltrim($decode,'&');
                $params = explode('&',$decode);
                foreach($params as $param)
                {
                    $param_kv = explode('=',$param);
                    $_REQUEST[$param_kv[0]] = $param_kv[1];
                    $_GET[$param_kv[0]] = $param_kv[1];
                    $_POST[$param_kv[0]] = $param_kv[1];
                }
            }
            file_put_contents('/tmp/app_encode.log',print_r(array(__METHOD__,__LINE__,$_REQUEST),1)."\n",FILE_APPEND);
        }
    }

}