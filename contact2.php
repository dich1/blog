<?php 
session_start();

@$title= "お問合せ";
@$url= "blog/contact.php";
list($urlbe,$urlaf)=explode("/",$url,2); //explodeで2つに分割し、listで2つの変数に格納する。

mysql_connect('localhost','root','daich1') or die(mysql_error());
mysql_select_db('blog');
mysql_query('set names utf8');

function newstring($string) {
    if(get_magic_quotes_gpc()){ //php.iniのget_magic_quotesがtrueなら
    $string = stripslashes($string); //シングル、ダブルクオートのバックスラッシュを取り除く
    }
$string = htmlspecialchars($string,ENT_QUOTES,'utf-8'); //htmlの特定のタグ無効化
$string = str_replace(",","，",$string); //半角カンマを全角に変換
$string = str_replace(array("\r\n","\n","\r"),"<br>",$string); //改行タグをbrに変換→この行は掲示板の場合htmlspecialcharsでタグを無効化するので要らない。
return $string;
}
?>

	echo htmlspecialchars($_POST['name']);
	echo htmlspecialchars($_POST['email']);
	echo htmlspecialchars($_POST['message']);
?>