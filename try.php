<?php
    $sSelect=isset($_POST['sel'])?$_POST['sel']:'';     //  这里接收选择的值
    //  然后把它保存到 session 
    $_SESSION['sel']=$sSelect;
    $sSel=isset($_SESSION['sel'])?$_SESSION['sel']:'';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>搜索</title>
</head>

<body>
<!-- html 部分 -->
<select name="sel">
    <option value="30" <?php if($sSel==30){ ?>selected="selected"<?php } ?>>30</option>
    <option value="20" <?php if($sSel==20){ ?>selected="selected"<?php } ?>>20</option>
    <option value="10" <?php if($sSel==10){ ?>selected="selected"<?php } ?>>10</option>
</select>
</body>
</html>
