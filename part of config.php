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

    

$dbh =null;

$url = 'http://';
$admin_url = '';