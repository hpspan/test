<?php
class Action_Base
{
    public $login = false;
    public function run_before()
    {
        if($this->login)
        {
            User_Auth::check();
        }
        
    }
    public function echoApi($view)
    {
        if(isset($_REQUEST['q']) && $_REQUEST['q']) 
        {
            $encode = Common_Encrypt::encode(json_encode($view)); 
            echo $encode;
            //file_put_contents('/tmp/app_encode.log',print_r(array(__METHOD__,__LINE__,$view,$encode),1)."\n",FILE_APPEND);
        }
        else
        {
            echo json_encode($view);
        }
        exit;
    }

}