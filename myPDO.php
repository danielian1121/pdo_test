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
}