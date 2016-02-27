

<?php

$dsn = 'mysql:dbname=blog;host=localhost';
$user = 'root';
$password = 'daich1';

try {
     $dbh = new PDO($dsn, $user, $password);

     print('<br>');

    if ($dbh == null){
        print('接続に失敗しました。<br>');
    }else{
        print('接続に成功しました。<br>');
    }

    $dbh->query('SET NAMES utf8');

    print('追加前のデータ一覧：<br>');

    $sql = 'select name, email, message, created_at from contacts';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        print($result['name']);
        print($result['email']);
        print($result['message']);
        print($result['created_at'].'<br>');
    }

    $sql = 'insert into contacts (name, email, message, created_at) values (?, ?, ?, ?)';
    $stmt = $dbh->prepare($sql);
    $flag = $stmt->execute(array('itou', 'itou@gmail.com', 'データを追加したい', 'mysql_timestamp'));

    if ($flag){
        print('データの追加に成功しました<br>');
    }else{
        print('データの追加に失敗しました<br>');
    }

    print('追加後のデータ一覧：<br>');

    $sql = 'name, email, message, created_at from contacts';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

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

$dbh =null;

$url = 'http://';
$admin_url = '';

error_reporting(E_ALL & ~E_NOTICE);

session_set_cookie_params(0, '/contacts_php/');

?>

</body>
</html>

