<?php

class myPDO extends PDO{
    private $_dsn = 'mysql:host=localhost;dbname=test';
    private $_user = 'sukamo';
    private $_password = 'toloveru1121';
    private $_encode = 'utf8';
    private $_stmt;

    function __construct(){
        try{
            parent::__construct($this->_dsn,$this->_user,$this->_password);
            $this->_setEncode();
        }catch(Exception $ex){
            print_r($ex);
        }
        
    }

    private function _setEncode(){
        $this->query("SET NAMES '{$this->_encode}");
    }

    function bindQuery($sql,array $bind = []){
        $this->_stmt = $this->prepare($sql);
        $this->_bind($bind);
        $this->_stmt->execute();
        return $this->_stmt->fetchall();
    }

    private function _bind($bind){
        foreach($bind as $key => $value){
            $this->_stmt->bindValue($key, $value, is_numeric($value)?PDO::PARAM_INT:PDO::PARAM_STR);
        }
    }
    function error(){
        $error = $this->_stmt->errorInfo();
        echo 'errorCode:'.$error[0].'<br>';
        echo 'errorString:'.$error[2].'<br>';
    }
}