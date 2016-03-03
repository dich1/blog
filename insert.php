<?php

require_once('config.php');
require_once('functions.php');

$dsn = 'mysql:dbname=blog;host=localhost';
$user = 'root';
$password = 'daich1';

try{
	$dbh = new PDO($dsn, $user, $password);

	$dbh->query('SET NAMES utf8');

	$sql = "insert into contacts 
			(name, email, message, created_at) 
			values 
			(:name, :email, :message, now())";
    $stmt = $dbh->prepare($sql);
    $parms = array( 
    	'name' => $name,
    	'email' => $email,
    	'message' => $message,
	);
    $flag = $stmt->execute($parms);

    if ($flag){
        print('データの追加に成功しました<br>');
    }else{
        print('データの追加に失敗しました<br>');
    }

    print('追加後のデータ一覧：<br>');

    $sql = 'name, email, message, created_at from contacts';
    $stmt = $dbh->prepare($sql);
    $stmt->execute($parms);

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        print($result['name']);
        print($result['email']);
        print($result['message']);
        print($result['created_at'].'<br>');
    }
}catch (PDOException $e){
  print('Connection failed:'.$e->getMessage());
  die();
} 

$dbh = null;


?>