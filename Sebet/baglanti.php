<?php

class baglanti
{
    public $db;
    function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=sebet;charset=utf8", "root","2352ceka20");
    }
}