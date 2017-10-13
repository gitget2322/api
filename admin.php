<?php

session_start();
include_once( 'support/connect.php' );


if( $_SESSION['user']['admin'] == 3){

    // 不是管理员
    header( "location:signIn.html" );

}


if ($_SESSION['user']['position'] == 'supperAdmin') {//position是什么意思
    $sql_generalUsers = "SELECT * FROM api_user WHERE admin = 2";//
    $sql_lockedUsers = "SELECT * FROM api_user WHERE admin = 3";//lockeduser是未审核的账号
}else{
    $sql_generalUsers = "SELECT * FROM api_user WHERE admin = 2 and position = 'general'";
    $sql_lockedUsers = "SELECT * FROM api_user WHERE admin = 3 and position = 'general'";
}


$result_generalUsers = $PDO -> query( $sql_generalUsers );
$result_lockedUsers = $PDO -> query( $sql_lockedUsers );


?>
<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <title>管理员界面</title>

    <link href="css/support.css" type="text/css" rel="stylesheet"/>
    <link href="css/search.css" type="text/css" rel="stylesheet"/>


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
        <a href="index.php">进入前台</a>&nbsp;&nbsp;&nbsp;
        <a href="signIn.html">退出登录</a>
</div>




<div id="usersTable">
    <table id="users" style="width: 100%; text-align: center;">


        <tr>
            <th>用户</th>
            <th>审核状态</th>
            <?php

            if( $_SESSION['user']['position'] == "supperAdmin" || $_SESSION['user']['position'] == "admin" ) {

                ?>
                <th>账号权限</th>
                <?php
            }
            ?>
            <th>电话号码查询</th>
            <th>IP地址查询</th>
            <th>股票查询</th>
            <th>网盘搜索</th>
            <th>车型查询</th>
        </tr>



            <!--             审核过和未审核的账号分开输出       -->

                 <!-- 输出审核过的账号 -->
        <?php

        foreach( $result_generalUsers as $val ) {

            ?>
            <tr>
                <td><?php echo $val['email'] ?></td>
                
                <td>
                <?php $shenhe="SELECT admin FROM user_function WHERE user_id=".$val['id'];
                $result_shenhe = $PDO -> query( $shenhe );
                ?>
                
<!--                    审核过和未审核的账号分开输出-->
                    <input class="checkUser" type="checkbox" <?php if($result_shenhe!=3 ) { echo "checked='checked'"; } echo "value='".$val['email']."'" ?>/>
                   

                </td>
                <?php

                if( $_SESSION['user']['position'] == 'supperAdmin' || $_SESSION['user']['position'] == 'admin' ) {

                    ?>
                    <td>

                        <select class="userPosition" name="userPosition">
                            <?php

                            $select = array();
                            $select[0]= '';
                            $select[1]= '';
                            $select[2]= '';

                            switch( $val['position'] ) {

                                case 'supperAdmin':
                                    $select[0] = "selected='selected'";
                                    break;

                                case 'admin':
                                    $select[1] = "selected='selected'";
                                    break;

                                case 'general':
                                    $select[2] = "selected='selected'";
                                    break;

                                default:
                                    $select[3] = true; // users.position 中出现不正常的值。
                            }
                            ?>
                            <?php if ( $_SESSION['user']['position'] == 'supperAdmin') {
                                ?>
                                <option <option <?php echo $select[1]." value='admin&email=".$val['email']."'" ?> >管理员</option>
                            <?php  } ?> 
                            <option <?php echo $select[2]." value='general&email=".$val['email']."'" ?> >普通用户</option>
                            <?php
                            if( $select[3] ){

                                echo "<option selected='selected'>".$val['position']."</option>";

                            }
                            ?>
                        </select>

                    </td>
                    <?php
                }

                $sql = "SELECT * FROM user_function WHERE user_id=".$val['id'];
                $result_userFunction = $PDO -> query( $sql );
                foreach( $result_userFunction as $val_userFunction ) {

                    ?>
                    <td>
                        <input class="searchPhoneNumber" name="searchPhoneNumber" type="checkbox" <?php if( $val_userFunction['search_phoneNumber'] ) { echo "checked='checked'"; } echo "value='".$val['id']."'" ?>/>
                    </td>
                    <td>
                        <input class="searchIPAddress" name="searchIPAddress" type="checkbox" <?php if( $val_userFunction['search_IPAddress'] ) { echo "checked='checked'"; } echo "value='".$val['id']."'" ?>/>
                    </td>
                     <td>
                        <input class="searchStock" name="searchStock" type="checkbox" <?php if( $val_userFunction['search_stock'] ) { echo "checked='checked'"; } echo "value='".$val['id']."'" ?>/>
                    </td>
                    <td>
                        <input class="searchpan" name="searchpan" type="checkbox" <?php if( $val_userFunction['search_pan'] ) { echo "checked='checked'"; } echo "value='".$val['id']."'" ?>/>
                    </td>
                    <td>
                        <input class="searchcar" name="searchcar" type="checkbox" <?php if( $val_userFunction['search_car'] ) { echo "checked='checked'"; } echo "value='".$val['id']."'" ?>/>
                    </td>
                    
                    <?php

                }

                ?>

            </tr>
            <?php

        }

        ?>




                    <!-- 输出未审核的账号 -->
        <?php

        foreach( $result_lockedUsers as $val ) {

            ?>
            <tr>
                <td><?php echo $val['email'] ?></td>
                <td>
<!--                    审核过和未审核的账号分开输出-->
                    <input class="checkUser" type="checkbox"  value="<?php echo $val['email'] ?>"/>
                </td>
                <?php

                if( $_SESSION['user']['position'] == 'supperAdmin' || $_SESSION['user']['position'] == 'admin' ) {

                    ?>
                    <td>

                        <select class="userPosition" name="userPosition">
                            <?php
                            $select = array();
                            $select[0]= '';
                            $select[1]= '';
                            $select[2]= '';

                            switch( $val['position'] ) {

                                case 'supperAdmin':
                                    $select[0] = "selected='selected'";
                                    break;

                                case 'admin':
                                    $select[1] = "selected='selected'";
                                    break;

                                case 'general':
                                    $select[2] = "selected='selected'";
                                    break;

                                default:
                                    $select[3] = true; // users.position 中出现不正常的值。
                            }
                            ?>
                              <?php if ( $_SESSION['user']['position'] == 'supperAdmin') {
                                ?>
                                <option <option <?php echo $select[1]." value='admin&email=".$val['email']."'" ?> >管理员</option>
                            <?php  } ?> 
                            <option <?php echo $select[2]." value='general&email=".$val['email']."'" ?> >普通用户</option>
                            <?php
                            if( $select[3] ){

                                echo "<option selected='selected'>".$val['position']."</option>";

                            }
                            ?>
                        </select>

                    </td>
                    <?php
                }

                $sql = "SELECT * FROM user_function WHERE user_id=".$val['id'];
                $result_userFunction = $PDO -> query( $sql );
                foreach( $result_userFunction as $val_userFunction ) {

                    ?>
                    <td>
                        <input class="searchPhoneNumber" name="searchPhoneNumber" type="checkbox" <?php if( $val_userFunction['search_phoneNumber'] ) { echo "checked='checked'"; } echo "value='".$val['id']."'" ?>/>
                    </td>
                    <td>
                        <input class="searchIPAddress" name="searchIPAddress" type="checkbox" <?php if( $val_userFunction['search_IPAddress'] ) { echo "checked='checked'"; } echo "value='".$val['id']."'" ?>/>
                    </td>
                     <td>
                        <input class="searchStock" name="searchStock" type="checkbox" <?php if( $val_userFunction['search_stock'] ) { echo "checked='checked'"; } echo "value='".$val['id']."'" ?>/>
                    </td>
                    <td>
                        <input class="searchpan" name="searchpan" type="checkbox" <?php if( $val_userFunction['search_pan'] ) { echo "checked='checked'"; } echo "value='".$val['id']."'" ?>/>
                    </td>
                    <td>
                        <input class="searchcar" name="searchcar" type="checkbox" <?php if( $val_userFunction['search_car'] ) { echo "checked='checked'"; } echo "value='".$val['id']."'" ?>/>
                    </td>
                    
                    <?php


                }

                ?>

            </tr>
            <?php

        }

        ?>



    </table>
</div>




</body>

<script src="js/support.js"></script>
<script src="js/admin.js"></script>

</html>