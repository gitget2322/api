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
        <input id="searchKey" name="searchKey" type="text" placeholder="股票查询"/>
        <input id="searchSubmit" type="button" value="查询"/>
    </div>
    <p id="searchMessage">&nbsp;</p>
</form>

<table id="searchResult">

    <tr>
        <th>总交易额</th>
        <th>短线交易额</th>
        <th>公开价格</th>
        <th>交易市场</th>
    </tr>

    <tr>
        <td class="searchResult trade_money"></td>
        <td class="searchResult diff_money"></td>
        <td class="searchResult open_price"></td> 
        <td class="searchResult market"></td>
    </tr>

</table>


</body>


<script src="js/support.js"></script>
<script src="js/stocksearch.js"></script>

</html>