<?php

class myPDO extends PDO{
    private $_dsn = 'mysql:host=localhost;dbname=test';
    private $_user = 'sukamo';
    private $_password = 'toloveru1121';
    private $_encode = 'utf8';
    private $_stmt;
    private $_data = [];

    //__set __get用法要了解一下
    function __set($name,$value){
        $this->_data[$name] = $value;
    }

    function __get($name){
        if(isset($this->_data[$name])){
            return $this->_data[$name];
        }
        return false;
    }

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

    //搜尋功能＋bindValue
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

    function getData(){
        return $this->_data;
    }

    //insert功能整合（包括bind）
    function insert($table, array $param = []){
        $data = array_merge($this->_data,$param);//若value是post進來，便和原本的data做合併
        $colume = array_keys($data);//設定欄位
        $values = [];
        $bind_data = [];
        //為bind做準備
        foreach($data as $key => $value){
            $values[] = ":{$key}";//sql上的語法
            $bind_data[":{$key}"] = $value;//sql上的語法對應其value
        }
        $sql = "INSERT INTO {$table} (".implode(',',$colume).") VALUE (".implode(',',$values).")";
        $this->_stmt = $this->prepare($sql);
        $this->_bind($bind_data);
        $this->_stmt->execute();
        return $this->lastInsertId();//回傳insert後的id
    }
}