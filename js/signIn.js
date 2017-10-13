/**
 * Created by chenxiaojun on 2017/1/9.
 */

window.onload = start;


function start() {


    var email = document.getElementById('signInEmail');
    var password = document.getElementById('signInPassword');
    var signInButton = document.getElementById('signInButton');
    var signInMessage = document.getElementById( 'signInMessage' );

    signInButton.addEventListener( 'click',function(){

        if( email.value != '' && password.value != '' && checkElements(email,1) ){

            var xmlHttp = getAjaxHttp();
            var url = 'support/check.php';

            xmlHttp.onreadystatechange = function() {

                if( xmlHttp.readyState == 4 && xmlHttp.status == 200 ) {


                    // alert( xmlHttp.responseText );
                    // 通过返回 user.admin 来判断账号的状态。

                    switch( xmlHttp.responseText ) {

                        case '0':
                            signInMessage.innerHTML = '账号或密码错误。';
                            break;

                        case '1': // 账号正常 管理员
                        case '2': // 普通账号

                            window.location.href = 'index.php';
                            break;

                        case '3':
                            signInMessage.innerHTML = '你的账号还没有通过审核。';
                            break;

                        default:

                            signInMessage.innerHTML = '发生了什么奇怪的错误。'+xmlHttp.responseText;

                    }

                }

            };
            xmlHttp.open( 'POST', url, true );
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send( 'num=1&email=' + email.value + '&password=' + password.value );

        }
        else {

            signInMessage.innerHTML = '表单填写有错误。';

        }

    } );

}