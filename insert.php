<?php

require_once('config.php');
require_once('functions.php');


try{

	$dbh = connectDb();

		

	$name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
	// DBに格納
	$sql = "insert into contacts 
                (name, email, message, created_at) 
                values 
                (:name, :email, :message, now())";
        $stmt = $dbh->prepare($sql);
        $params = array(
            ':name' => $name,
            ':email' => $email,
            ':message' => $message
        );
    $flag = $stmt->execute($params);

    // ありがとうページヘ
        // header('Location: '.SITE_URL.'thanks.html');
        // exit;

    if ($flag){
        print('データの追加に成功しました<br>');
    }else{
        print('データの追加に失敗しました<br>');
    }

    print('追加後のデータ一覧：<br>');

    $sql = 'select id, name, email, message, created_at from contacts';
    $stmt = $dbh->prepare($sql);
    $stmt->execute($parms);

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        print($result['id']);
        print($result['name']);
        print($result['email']);
        print($result['message']);
        print($result['created_at'].'<br>');
    }


	$sql = 'update contacts set name = ? where id = ?';    
	$stmt = $dbh->prepare($sql);
	$flag = $stmt->execute(array('updateで編集', 1));

	if ($flag){
        print('データの更新に成功しました<br>');
    }else{
        print('データの更新に失敗しました<br>');
    }

    print('更新後のデータ一覧：<br>');

    $sql = 'select id, name, email, message, created_at from contacts';
    $stmt = $dbh->prepare($sql);
    $stmt->execute($parms);

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        print($result['id']);
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