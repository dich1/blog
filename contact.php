<?php

require_once('config.php');
require_once('functions.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    // 投稿前
    
    // CSRF対策
    setToken();
    
} else {
    // 投稿後
    checkToken();
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $memo = $_POST['message'];

    $error = array();
    
    // エラー処理
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'メールアドレスの形式が正しくありません';
    }
    if ($email == '') {
        $error['email'] = 'メールアドレスを入力してください。';
    }
    if ($memo == '') {
        $error['message'] = '内容を入力してください。';
    }
    
    if (empty($error)) {
        // DBに格納
        $dbh = connectDb();
        
        $sql = "insert into contacts 
                (name, email, message, created_at) 
                values 
                (:name, :email, :message, now())";
        $stmt = $dbh->prepare($sql);
        $params = array(
            ":name" => $name,
            ":email" => $email,
            ":message" => $message
        );
        $stmt->execute($params);

    }

}

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="ひたちなか市,Ruby,skate">
        <title>伊藤 大智</title>
        <link rel="stylesheet" href="contact.css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div id="wrap">
            <div class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Daichi Itoh | Contact</a>
                    </div>    
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About</a></li>
                            <li class="active"><a href="#contact">Contact</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" date-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"></li>
                                    <li><a href="#">Separated link</a></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <header>
            <div id="logo">
                <img src="profile.jpg" alt="" />
                <h1>伊藤 大智</h1>
            </div>
        </header>
        <div class="center-container">
            <div class="content col-sm-11">
                <form class="form-horizontal" action="contact.php" method="post">
                    <div class="form-group">
                        <label for="inputName" class="col-md-2 control-label">Name</label>
                        <div class="col-md-10">                
                            <input type="text" class="form-control" id="inputName" name="name" placeholder="名前">                           
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-md-2 control-label">Email</label>
                        <div class="col-md-10">                            
                            <input type="email" class="form-control" id="Email" name="email" placeholder="example@gmail.com">   
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContent" class="col-md-2 control-label">お問合せ内容</label>
                        <div class="col-md-10">                             
                            <textarea class="form-control" id="inputContent" name="message" placeholder="内容をお書きください。" rows="8" ></textarea>                         
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-11">
                            <input type="submit" class="btn btn-success" value="Send">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <footer>
            <p><a href="">daich125912@gmail.com</a></p>
            <p>&copy; 2015 Daichi Itoh.</p>
        </footer>
        </div>
    </body>
</html>