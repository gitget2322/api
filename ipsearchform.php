<?php

include_once( 'index.php' );

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title="ip查询"></title>
	<link href="css/support.css" type="text/css" rel="stylesheet"/>
    <link href="css/search.css" type="text/css" rel="stylesheet"/>
    

</head>

<body>

<form id="searchForm">
	<div id="formContent">
		<input id="searchKey" name="searchKey" type="text" placeholder="ip查询"/>
		<input id="searchSubmit" type="button" value="查询" />
	</div>
	<p id="searchMessage">&nbsp;</p>
</form>

<table id="searchResult">

	<tr>
		<th>地区</th>
		<th>城市</th>
		<th>区县</th>
		<th>运营商</th>
	</tr>

	<tr>
		<td class="searchResult region"></td>
		<td class="searchResult city"></td>
		<td class="searchResult county"></td>
		<td class="searchResult isp"></td>
	</tr>

</table>

</body>

<script src="js/ipsearch.js"></script>
<script src="js/support.js"></script>

</html>