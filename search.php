<?php

include_once( 'index.php' );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>搜索</title>

    <link href="css/support.css" type="text/css" rel="stylesheet"/>
    <link href="css/search.css" type="text/css" rel="stylesheet"/>


</head>

<body>


<form id="searchForm">
    <div id="formContent">
      
        <input id="searchKey" name="searchKey" type="text" placeholder="电话号码"/>
        <input id="searchSubmit" type="button" value="查询"/>
    </div>
    <p id="searchMessage">&nbsp;</p>
    <p id="is" name="phoneNumber" ></p>
</form>

<table id="searchResult">

    <tr>
        <th>省份</th>
        <th>城市</th>
        <th>号码</th>
        <th>运营商</th>
    </tr>

    <tr>
        <td class="searchResult prov"></td>
        <td class="searchResult city"></td>
        <td class="searchResult num"></td>
        <td class="searchResult name"></td>
    </tr>

</table>


</body>


<script src="js/support.js"></script>
<script src="js/search.js"></script>


</html>