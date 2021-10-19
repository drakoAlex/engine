<?php

if($_SERVER["REQUEST_URI"] =='/'){
    $page='home';
}else{
    $page=substr($_SERVER["REQUEST_URI"],1);
    if(!preg_match('/^[A-z0-9]{3,15}$/',$page)){
        exit('error url');
    }
}

session_start();


if(file_exists('all/'.$page.'.php')){
    include 'all/'.$page.'.php';
}elseif ($_SESSION['ulogin'] == 1 && file_exists('auth/'.$page.'.php')){
    include 'auth/'.$page.'.php';
}elseif ($_SESSION['ulogin'] != 1 && file_exists('guest/'.$page.'.php')) {
    include 'guest/'.$page.'.php';
}else{
    exit('Страница 404');
}

function top($title){
    echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>".$title."</title>
            <link rel='preconnect' href='https://fonts.googleapis.com'>
            <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
            <link href='https://fonts.googleapis.com/css2?family=Roboto:ital@1&display=swap' rel='stylesheet'>
            <link rel='stylesheet' href='style.css'>
        </head>
        <body>
            <div class='wrapper'>
            <div class='menu'>
                <a href='/'>Главная</a>
                <a href='/login'>Вход</a>
                <a href='/register'>Регистрация</a>
            </div>
            <div class='content'>
                <div class='block'>
                
    ";
}

function bottom(){
    echo "
                </div>
            </div>
            </div>
	 		<script src='script.js'></script>
        </body>
        </html>
    ";
}
?>
