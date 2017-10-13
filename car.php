<?php

include_once( 'index.php' );

?>

<script src="js/support.js"></script>
<script src="js/searchcar.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>搜索</title>

    <link href="css/support.css" type="text/css" rel="stylesheet"/>
    <link href="css/search.css" type="text/css" rel="stylesheet"/>


</head>

<body onload = btn_post_click()>  

<form id="searchForm">
    <div id="formContent">
    </div>
</form>
<!--<form id="searchForm">
    <div id="formContent">
      
        <input id="searchKey" name="searchKey" type="text" placeholder="IP 地址"/>
        <input id="searchSubmit" type="button" value="查询"/>
    </div>
    <p id="searchMessage">&nbsp;</p>
</form>-->
<table id="searchResult">

    <tr>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>LOGO</th>
        <th>品牌</th>
        <th>类型</th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
     </tr>
    
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <td>&nbsp;</th>
        <td>&nbsp;</th>
        <td>&nbsp;</th>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    </tr>


    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <td class="searchResult logo"></td>
        <td class="searchResult grand">
            <select id="grand" onchange="showtype(this.value,getAttribute(this.name))">
                <option value="0" >-请选择品牌-</option>
            </select>&nbsp;&nbsp;
        </td>
        
        <td class="searchResult type"> 
            <select id="type" onchange="showcar(this.value)">
                <option value="0">-请选择类型-</option>
            </select>&nbsp;&nbsp;
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
           
        <td class="searchResult car"> 
            <!-- <div>
                <input type="button"  id="show" onclick="javascript:new DivWindow('popup','popup_drag','popup_exit','exitButton','500','700',4);"  value='点击查看详情...'   />
            </div> -->
              <!-- 遮罩层 -->
            <div id="mask"  class="mask"></div>
            <!-- 弹出基本资料详细DIV层 -->
            <div class="sample_popup"     id="popup" style="visibility: hidden; display: none;">
                <div class="menu_form_header" id="popup_drag">
                    <input type="button"  id="popup_exit" value="退出"/>
                    详细信息：
            </div>
                <div class="menu_form_body" >
                    <div id="popDetail">

                    </div>
                </div>
            </div>

        </td>

    </tr>

</table>


</body>


</html>