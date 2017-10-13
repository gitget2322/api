<?php

session_start();
include_once( 'connect.php' );


switch( $_POST['num'] ) {



    case 1:


        $sql = "SELECT * FROM users WHERE email ='". $_POST['email']."' AND password='". md5($_POST['password']) ."'";
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

        $sql = "SELECT * FROM users WHERE email='".$_POST['email']."'";
        $result = $PDO -> query( $sql );

        if( $result -> rowCount() ) {

            echo 0; // 邮箱已被注册

        }
        else {

            $sql = "INSERT INTO users VALUE(null,'".$_POST['email']."','".md5($_POST['password'])."',3)"; // 默认 admin 为 3，表示还没有通过审核。
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



    case 3: // 电话号码查询



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

        echo curl_exec( $curl );
        curl_close( $curl );


        exit;
        break;



    case 4: // admin.php 审核账号


        // 查找有没有这个账号
        $sql = "SELECT * FROM users WHERE email='".$_POST['email']."'";
        $result = $PDO -> query( $sql );

        if( $result -> rowCount() ) {

            $user = '';

            foreach( $result as $val ) {

                $user = $val;

            }

            $admin = ($user['admin'] == 2) ? 3 : 2;
            $sql = "UPDATE users SET admin = ".$admin." WHERE id = ".$user['id'];
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
        $sql = "SELECT * FROM users WHERE email='".$_POST['email']."'";
        $result = $PDO -> query( $sql );

        if( $result -> rowCount() ) {

            $user = '';

            foreach( $result as $val ) {

                $user = $val;

            }


            $sql = "UPDATE users SET position = '".$_POST['position']."' WHERE id=".$user['id'];
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



    case 7: // 设置 电话号码查询 权限。


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






case 8: // IP地址查询

        
        $host = "http://saip.market.alicloudapi.com"; 
        $path = "/ip"; 
        $method = "GET"; 
        $appcode = "a0a9ecfc19fa4a1696a269dfa77ff1cb"; 
        $headers = array(); 
        array_push($headers, "Authorization:APPCODE " . $appcode); 
        $querys = "ip=".$_POST['IPAddress'];
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
        echo curl_exec( $curl );
        curl_close( $curl );


        exit;
        break;
        



case 9://查询车的品牌
        $host = "http://jisucxdq.market.alicloudapi.com"; 
        $path = "/car/brand"; 
        $method = "GET"; 
        $appcode = "a0a9ecfc19fa4a1696a269dfa77ff1cb"; 
        $headers = array(); 
        array_push($headers, "Authorization:APPCODE " . $appcode); 
        $querys = ""; 
        $bodys = ""; 
        $url = $host . $path; 
        $curl = curl_init(); 
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method); 
        curl_setopt($curl, CURLOPT_URL, $url); 
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt($curl, CURLOPT_FAILONERROR, false); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($curl, CURLOPT_HEADER, false); 
        if (1 == strpos("$".$host, "https://")) { 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); } 
        echo curl_exec( $curl );
        curl_close( $curl );


        exit;
        break;




case 10://查询驾考题库
        
        $host = "http://jisujiakao.market.alicloudapi.com"; 
        $path = "/driverexam/query"; 
        $method = "GET"; 
        $appcode = "a0a9ecfc19fa4a1696a269dfa77ff1cb"; 
        $headers = array(); 
        array_push($headers, "Authorization:APPCODE " . $appcode); 
        $querys = "pagenum=1&pagesize=10&sort=normal&subject=1&type=C1"; 
        $bodys = ""; 
        $url = $host . $path . "?" . $querys; 
        $curl = curl_init(); 
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method); 
        curl_setopt($curl, CURLOPT_URL, $url); 
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt($curl, CURLOPT_FAILONERROR, false); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($curl, CURLOPT_HEADER, false); 
        if (1 == strpos("$".$host, "https://")) { 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); }
        echo curl_exec( $curl );
        curl_close( $curl ); 



        exit;
        break;




case 11://查询车的类型

        $host = "http://jisucxdq.market.alicloudapi.com";
        $path = "/car/carlist";
        $method = "GET";
        $appcode = "a0a9ecfc19fa4a1696a269dfa77ff1cb";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "parentid=".$_POST['parentid'];
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
        echo curl_exec( $curl );
        curl_close( $curl );

        exit;
        break;

case 12://查询车的详情
        
        $host = "http://jisucxdq.market.alicloudapi.com";
        $path = "/car/detail";
        $method = "GET";
        $appcode = "a0a9ecfc19fa4a1696a269dfa77ff1cb";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "carid=".$_POST['carid'];
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
        echo curl_exec( $curl );
        curl_close( $curl );

        exit;
        break;

     
        default:
        return false;

}
