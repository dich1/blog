header("Conten-Type: text/html;charset=utf-8");
mb_language('ja');
mb_internal_encoding( "utf-8" );

$name = htmlspecialchars($_POST[name], ENT_QUOTES);
$email = htmlspecialchars($_POST[email], ENT_QUOTES);
$message = htmlspecialchars($_POST[message], ENT_QUOTES);

function funcManagerAddress($name,$email,$message){
	$mailto = $email;
	$content = \n"." 【名前】： ".$name."\n"." 【内容】： ".$message."
	$mailfrom = "From:" .mb_encode_mineheader($name) ."<".$email.">";
	if(mb_send_mail($mailto,$content,$mailform) == true){
		$managerFlag = "○"};
	}else{
		$managerFlag = "×"};
	}
	return $managerFlag;
};
