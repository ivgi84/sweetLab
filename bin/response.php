<?php
class Response{
    private $result;
    private $error;
    private $errorMsg;
    private $userMsg;

    function __construct(){
        $this->error = false;
        $this->errorMsg = null;
        $this->userMsg = null;
        $this->result = null;
    }
    //SETTERS
    function setResult($val=null){
        $this->result = $val;
    }
    function setError($val){
        $this->error = $val;
    }
    function setUserMsg($val){
        $this->userMsg = $val;
    }
    function setErrorMsg($val){
        $this->errorMsg = $val;
    }
    //GETTERS
    function getResult(){
        return $this->result;
    }
    function getError(){
        return $this->error;
    }
    function getErrorMsg(){
        return $this->errorMsg;
    }
    function getUserMsg(){
        return $this->userMsg;
    }
    function setAjaxResponce(){
        $response = array('error'=>$this->getError(),'errorMsg'=>$this->getErrorMsg(),'result'=>$this->getResult(),'userMsg'=>$this->getUserMsg());
        echo json_encode($response);
    }
}