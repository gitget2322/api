<?php

include_once( 'index.php' );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>网盘搜索</title>

    <link href="css/support.css" type="text/css" rel="stylesheet"/>
    <link href="css/search.css" type="text/css" rel="stylesheet"/>

</head>
<style type="text/css">
    #pagination
    { text-align: center;}
    #first {
    padding:3px;
    border:1px solid gray;
    margin:2px;
    color:black;
    text-decoration:none
    }
    #list{padding:3px;
    border:1px solid gray;
    margin:2px;
    color:black;
    text-decoration:none
    }
    #last{padding:3px;
    border:1px solid gray;
    margin:2px;
    color:black;
    text-decoration:none
    }
    #goSubmit{padding:3px;
    border:1px solid gray;
    margin:2px;
    color:black;
    text-decoration:none
    }
</style>
<body>

<form id="searchForm">
    <div id="formContent">
        <input id="searchKey" name="searchKey" type="text" placeholder="网盘查询"/>
        <input id="searchSubmit" type="button" onclick="start(1)" value="查询"/>
    </div>
    <p id="searchMessage">&nbsp;</p>
</form>

<table id="searchResult">

    <tr>
        <th>标题</th>
        <th>分类</th>
        <th>用户名</th>
        <th>来源</th>
        <th>链接</th>
        <th>文件类型</th>
    </tr>


</table>

 

</body>
<div id="pagination">
</div>

<script src="js/support.js"></script>
<script src="js/panpan.js"></script>

</html>