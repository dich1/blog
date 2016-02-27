<?php

function connectDb() {
    
    try {
        $dbh = new PDO($dsn, $user, $password);
    }catch (PDOException $e){
      print('Connection failed:'.$e->getMessage());
      die();
    } 
}

function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

function setToken() {
    if (!isset($_SESSION['token'])) {
        $_SESSION['token'] = sha1(uniqid(mt_rand(), true));
    }
}

function checkToken() {
    if (empty($_POST['token']) || $_POST['token'] != $_SESSION['token']){
        echo "不正な処理です！";
        exit;
    }
}

?>