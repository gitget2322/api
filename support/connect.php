<?php

try{
    //$PDO = new PDO("mysql:host=cnerstudio.xyz;dbname=cnercc","cnercc","fee0bd");
    $PDO = new PDO("mysql:host=localhost;dbname=test","root","root");
}
catch( PDOException $e ){
    die( "连接到数据库时出现问题：".$e -> getMessage() );
}

$PDO -> query("set character set 'utf8'");

$salt = '4d65f7qefjka;sdfjiqwejfnaksjdflkasjdfhaskjdfhnkjasdhfjkashdufyhejkfahsdjfnasdf';//MD5盐加密
$db_prefix = 'api_';





