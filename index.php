<?php

session_start();
include_once( 'support/connect.php' );


// 判断是否登录
if( isset($_SESSION['user']) ) {


    // header( 'location:index.php' );
    $sql = "SELECT * FROM user_function WHERE user_id='".$_SESSION['user']['id']."'";
    $result = $PDO -> query( $sql );
    $res = $result -> fetch(PDO::FETCH_NUM);
    // exit;//此语句退出
    // 已经登录

}
else {

    header( "location:signIn.html" );
    // 未登录。

}

$sSelect=isset($_POST['searchSelect'])?$_POST['searchSelect']:'';     //  这里接收选择的值
    //  然后把它保存到 session 
$_SESSION['searchSelect']=$sSelect;
$sSel=isset($_SESSION['searchSelect'])?$_SESSION['searchSelect']:'';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>搜索</title>

    <link href="css/support.css" type="text/css" rel="stylesheet"/>
    <link href="css/search.css" type="text/css" rel="stylesheet"/>
    <!-- <link href="css/selectstyle.css" type="text/css" rel="stylesheet"/> -->

</head>

<body>

<div id="menuBar" align="center" style="font-size:24px";>
        当前用户：
        <?php 
           
            if($_SESSION['user']['position'] == 'supperAdmin' ) {
                echo "超级管理员-".$_SESSION['user']['email'];
            } 
            elseif ($_SESSION['user']['position'] == 'admin') {
                echo "管理员-".$_SESSION['user']['email'];
            } 
            else { echo "普通用户-".$_SESSION['user']['email'];}
        
        ?>&nbsp;&nbsp;&nbsp;
        查询方式：
        
        <select id="searchSelect" name="searchSelect" onchange="window.location=this.value">
            <option value="index.php">-选择要查询的内容-</option> 
            <?php
            // $Z=$_GET[''] 
            //echo $_SERVER['QUERY_STRING'];
            
                if( $res['1'] == 1){
                echo "<option value='search.php'"; if($sSel=='search.php'){ echo"selected='selected'";  } 
                echo">电话号码</option>";
                } 
                if( $res['2'] == 1){
                echo "<option value='ipsearchform.php'>IP 地址</option>";
                }
                if( $res['3'] == 1){
                echo "<option value='stocksearch.php'>股票查询</option>";
                }
                if( $res['4'] == 1){
                echo "<option value='pansearchform.php'>网盘查询</option>";
            	} 
                if( $res['5'] == 1){
                echo "<option value='car.php'>车型大全</option>";
            	}
           ?>
            <option disabled="disabled">天气</option>
            <option disabled="disabled">QQ音乐排行榜</option>
            <option disabled="disabled">酒店</option>
            <option disabled="disabled">医院</option>
            <option disabled="disabled">空气质量</option>
            <option disabled="disabled">新闻头条</option>
            <option disabled="disabled">星座运势</option>
            <option disabled="disabled">网络热搜词排行</option>
            <option disabled="disabled">智能问答</option>


        </select>
        &nbsp;&nbsp;&nbsp;
        <?php if ($_SESSION['user']['position'] == "supperAdmin" || $_SESSION['user']['position'] == "admin") {
            echo "<a href='admin.php'>进入后台</a> ";
        } ?>
        <a href="signIn.html" >退出登陆</a>&nbsp;&nbsp;&nbsp;
</div>

</body>

</html>