<html>
<head>
<title>contacts data</title>
</head>

<body>

<?php

$link = mysql_connect('localhost', 'root', 'daich1');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}

print('<p>接続に成功しました。</p>');

$db_selected = mysql_select_db('blog', $link);
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}

print('<p>blogデータベースを選択しました。</p>');

mysql_set_charset('utf8');

$result = mysql_query('SELECT created_at, name FROM contacts');
if (!$result) {
    die('SELECTクエリーが失敗しました。'.mysql_error());
}

while ($row = mysql_fetch_assoc($result)) {
    print('<p>');
    print('created_at='.$row['created_at']);
    print(',name='.$row['name']);
    print('</p>');
}

print('<p>データを追加します。</p>');

$sql = "INSERT INTO contacts (created_at,name) VALUES (4, 'プリンター')";
$result_flag = mysql_query($sql);

if (!$result_flag) {
    die('INSERTクエリーが失敗しました。'.mysql_error());
}

print('<p>追加後のデータを取得します。</p>');

$result = mysql_query('SELECT created_at,name FROM contacts');
if (!$result) {
    die('SELECTクエリーが失敗しました。'.mysql_error());
}

while ($row = mysql_fetch_assoc($result)) {
    print('<p>');
    print('created_at='.$row['created_at']);
    print(',name='.$row['name']);
    print('</p>');
}

$close_flag = mysql_close($link);

if ($close_flag){
    print('<p>切断に成功しました。</p>');
}

?>
</body>
</html>