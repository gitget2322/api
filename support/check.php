<?php

session_start();
include_once( 'connect.php' );


switch( $_POST['num'] ) {

    case 1:


        $sql = "SELECT * FROM ".$db_prefix."user WHERE email ='". $_POST['email']."' AND password='". $_POST['password'] ."'";
        $result = $PDO -> query( $sql );

        if( $result -> rowCount() ) {

            foreach( $result as $val ) {

                switch( $val['admin'] ) {

                    case 1: // 账号正常 管理员

                    case 2: // 普通账号

                        $_SESSION['user'] = $val;
                        echo $val['admin'];
                        break;

                    case 3: // 账号审核还没有通过。

                        echo $val['admin'];
                        break;

                    default:// something wrong

                        echo '错误';
                        break;

                }

            }

        }
        else {

            echo 0; // 账号不存在或表单输入有错误。

        }


        exit;
        break;



    case 2:

        $sql = "SELECT * FROM ".$db_prefix."user WHERE email='".$_POST['email']."'";
        $result = $PDO -> query( $sql );

        if( $result -> rowCount() ) {

            echo 0; // 邮箱已被注册

        }
        else {

            $sql = "INSERT INTO api_user VALUES(null,'".md5($_POST['password'])."','".$_POST['email']."',3,'general')"; // 默认 admin 为 3，表示还没有通过审核。
            $result = $PDO -> exec( $sql );
            $id = $PDO->lastInsertId ();
            $sql = "INSERT INTO user_function VALUES($id,1,1,1,1,1)";
            $result = $PDO -> exec( $sql );

            if( $result ) {
                echo 1; // 注册成功，等待审核。
            }
            else {
                echo 2; // 注册失败
            }
            

        }


        exit;
        break;



    case 3: // 电话查询 请求api接口
        
        
        $host = "http://showphone.market.alicloudapi.com";
        $path = "/6-1";
        $method = "GET";
        $appcode = "a0a9ecfc19fa4a1696a269dfa77ff1cb";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "num=".$_POST['phoneNumber'];
        $bodys = "";
        $url = $host . $path . "?" . $querys;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false); //不返回头信息
        if (1 == strpos("$".$host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        //var_dump(curl_exec($curl));//这个语句是excel中的，如果加上这条语句就会让api返回值报错，
        echo curl_exec( $curl );
        curl_close( $curl );


        exit;
        break;
        


    case 4: // admin.php 审核账号


        // 查找有没有这个账号
        $sql = "SELECT * FROM api_user WHERE email='".$_POST['email']."'";
        $result = $PDO -> query( $sql );
        // var_dump($sql);
        if( $result -> rowCount() ) {

            $user = '';

            foreach( $result as $val ) {

                $user = $val;

            }

            $admin = ($user['admin'] == 2) ? 3 : 2;
            $sql = "UPDATE api_user SET admin = ".$admin." WHERE id = ".$user['id'];
            $updateResult = $PDO -> query( $sql );

            if( $updateResult -> rowCount() ) {

                echo '操作成功。';

            }
            else {

                echo '审核操作失败。';

            }

        }
        else {

            echo '没有找到这个账号。';

        }


        exit;
        break;



    case 5: // admin.php 设置账号权限


        // 检验传输的 position 是正确。
        $position = $_POST['position'];
        if( !(($position=='supperAdmin') || ($position=='admin') || ($position=='general')) ){

            echo '更改的权限不正确。';

            exit;
            break;

        }
        else {

            /*echo $_POST['email'].$_POST['num'].$_POST['position'];

            exit;
            break;*/

        }


        // 查找有没有这个账号
        $sql = "SELECT * FROM api_user WHERE email='".$_POST['email']."'";
        $result = $PDO -> query( $sql );

        if( $result -> rowCount() ) {

            $user = '';

            foreach( $result as $val ) {

                $user = $val;

            }


            $sql = "UPDATE api_user SET position = '".$_POST['position']."' WHERE id=".$user['id'];
            $updateResult = $PDO -> query( $sql );

            if( $updateResult -> rowCount() ) {

                echo '操作成功。';
//                echo $position;
            }
            else {

                echo '更改权限操作失败。';

            }



        }
        else{

            echo '没有找到这个账号。';

        }

        exit;
        break;



    case 6: // 设置 电话号码查询 权限。


        // 查找有没有这个账号
        $sql = "SELECT * FROM user_function WHERE user_id=".$_POST['id'];
        $result = $PDO -> query( $sql );

        if( $result -> rowCount() ) {

            $user = '';

            foreach( $result as $val ) {

                $user = $val;

            }

            // 改变权限
            $user['search_phoneNumber'] = $user['search_phoneNumber'] ? 0 : 1;

            $sql = "UPDATE user_function SET search_phoneNumber =".$user['search_phoneNumber']." WHERE user_id=".$user['user_id'];
            $updateResult = $PDO -> query( $sql );

            if( $updateResult -> rowCount() ) {

                echo '权限修改成功。';

            }
            else {

                echo '权限修改失败。';

            }

        }
        else {

            echo '没有找到这个账号。';

        }


        exit;
        break;



    case 7: // 设置 ip查询 权限。


        // 查找有没有这个账号
        $sql = "SELECT * FROM user_function WHERE user_id=".$_POST['id'];
        $result = $PDO -> query( $sql );

        if( $result -> rowCount() ) {

            $user = '';

            foreach( $result as $val ) {

                $user = $val;

            }

            // 改变权限
            $user['search_IPAddress'] = $user['search_IPAddress'] ? 0 : 1;

            $sql = "UPDATE user_function SET search_IPAddress =".$user['search_IPAddress']." WHERE user_id=".$user['user_id'];
            $updateResult = $PDO -> query( $sql );

            if( $updateResult -> rowCount() ) {

                echo '权限修改成功。';

            }
            else {

                echo '权限修改失败。';

            }

        }
        else {

            echo '没有找到这个账号。';

        }


        exit;
        break;


    case 8://查询ip地址，请求api
        $host = "http://saip.market.alicloudapi.com"; 
        $path = "/ip"; 
        $method = "GET"; 
        $appcode = "a0a9ecfc19fa4a1696a269dfa77ff1cb";
        $headers = array(); 
        array_push($headers, "Authorization:APPCODE " . $appcode); 
        $querys = "ip=".$_POST['IPAddress'];//此处我修改了代码，没有理解api，造成了错误。 
        $bodys = ""; 
        $url = $host . $path . "?" . $querys; 
        $curl = curl_init(); 
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method); 
        curl_setopt($curl, CURLOPT_URL, $url); 
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt($curl, CURLOPT_FAILONERROR, false); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($curl, CURLOPT_HEADER, false); 
        if (1 == strpos("$".$host, "https://")) 
        { 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
        } 
        //var_dump(curl_exec($curl));
        echo curl_exec( $curl );
        curl_close( $curl );
        exit;
        break;

    case 9:
        $host = "http://stock.market.alicloudapi.com"; 
        $path = "/sz-sh-stock-history"; 
        $method = "GET"; 
        $appcode = "a0a9ecfc19fa4a1696a269dfa77ff1cb"; 
        $headers = array(); 
        array_push($headers, "Authorization:APPCODE " . $appcode);
        // $tdate = date("Y-m-d"); 
        // $yydate=strtotime($tdate)-3600*24;
        // $date=date("Y-m-d",$yydate);
        $date=date("Y-m-d",strtotime("last Monday"));
        $querys ="begin=".$date."&code=".$_POST['code']."&end=".$date; //这里我曾经有问题，不知道如何连接日期和股票编号，现在已经解决，用符号.就可以
        $bodys = ""; 
        $url = $host . $path . "?" . $querys; 
        $curl = curl_init(); curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method); 
        curl_setopt($curl, CURLOPT_URL, $url); 
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt($curl, CURLOPT_FAILONERROR, false); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($curl, CURLOPT_HEADER, false); 
        if (1 == strpos("$".$host, "https://")) 
            { curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);}
        echo curl_exec( $curl );
        curl_close( $curl );
        exit;
        break;
    case 10:
    $host = "http://netdisk.market.alicloudapi.com";//https好像需要更多的东西，GET api测试的时候返回不正确； 
    $path = "/search"; 
    $method = "GET"; 
    $appcode = "a0a9ecfc19fa4a1696a269dfa77ff1cb"; 
    $headers = array(); 
    array_push($headers, "Authorization:APPCODE " . $appcode); 
    $querys = "page=".$_POST['p']."&q=".$_POST['q']; 
    $bodys = ""; 
    $url = $host . $path . "?" . $querys; 
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method); 
    curl_setopt($curl, CURLOPT_URL, $url); 
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
    curl_setopt($curl, CURLOPT_FAILONERROR, false); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($curl, CURLOPT_HEADER, false); 
    if (1 == strpos("$".$host, "https://")) 
        { curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
        }
    echo curl_exec( $curl );
    curl_close( $curl );
    exit;
    break;
    

    default:

        return false;

    case 11: // 设置 盘搜索查询 权限。


        // 查找有没有这个账号
        $sql = "SELECT * FROM user_function WHERE user_id=".$_POST['id'];
        $result = $PDO -> query( $sql );

        if( $result -> rowCount() ) {

            $user = '';

            foreach( $result as $val ) {

                $user = $val;

            }

            // 改变权限
            $user['search_pan'] = $user['search_pan'] ? 0 : 1;

            $sql = "UPDATE user_function SET search_pan =".$user['search_pan']." WHERE user_id=".$user['user_id'];
            $updateResult = $PDO -> query( $sql );

            if( $updateResult -> rowCount() ) {

                echo '权限修改成功。';

            }
            else {

                echo '权限修改失败。';

            }

        }
        else {

            echo '没有找到这个账号。';

        }


        exit;
        break;
    case 12: // 设置 车型查询 权限。


        // 查找有没有这个账号
        $sql = "SELECT * FROM user_function WHERE user_id=".$_POST['id'];
        $result = $PDO -> query( $sql );

        if( $result -> rowCount() ) {

            $user = '';

            foreach( $result as $val ) {

                $user = $val;

            }

            // 改变权限
            $user['search_car'] = $user['search_car'] ? 0 : 1;

            $sql = "UPDATE user_function SET search_car =".$user['search_car']." WHERE user_id=".$user['user_id'];
            $updateResult = $PDO -> query( $sql );

            if( $updateResult -> rowCount() ) {

                echo '权限修改成功。';

            }
            else {

                echo '权限修改失败。';

            }

        }
        else {

            echo '没有找到这个账号。';

        }


        exit;
        break;
 
    case 13: // 设置股票查询 权限。


        // 查找有没有这个账号
        $sql = "SELECT * FROM user_function WHERE user_id=".$_POST['id'];
        $result = $PDO -> query( $sql );

        if( $result -> rowCount() ) {

            $user = '';

            foreach( $result as $val ) {

                $user = $val;

            }

            // 改变权限
            $user['search_stock'] = $user['search_stock'] ? 0 : 1;

            $sql = "UPDATE user_function SET search_stock =".$user['search_stock']." WHERE user_id=".$user['user_id'];
            $updateResult = $PDO -> query( $sql );

            if( $updateResult -> rowCount() ) {

                echo '权限修改成功。';

            }
            else {

                echo '权限修改失败。';

            }

        }
        else {

            echo '没有找到这个账号。';

        }


        exit;
        break;
    



}

