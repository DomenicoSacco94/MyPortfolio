<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DB {
    private $servername = "localhost";
    private $username = "newuser";
    private $password = "Lifeisnow123?";
    private $dbname = "mydb";
    private $charset = "UTF8"; 
    
    function connect() {
        $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname;charset=$this->charset", $this->username, $this->password);
        return $conn;
    }
    
    
    
} 

