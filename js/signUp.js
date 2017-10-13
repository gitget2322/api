/**
 * Created by chenxiaojun on 2017/1/9.
 */

window.onload = start;


function start() {


    var email = document.getElementById('signUpEmail');
    var password = document.getElementById('signUpPassword');
    var signUpSubmit = document.getElementById('signUpSubmit');
    var signUpMessage = document.getElementById('signUpMessage');

    signUpSubmit.addEventListener( 'click',function(){

        if( email.value != '' && password.value != '' && checkElements(email,1) ) {

            var xmlHttp = getAjaxHttp();
            var url = 'support/check.php';

            xmlHttp.onreadystatechange = function() {

                if( xmlHttp.readyState == 4 && xmlHttp.status == 200 ) {

                    switch( xmlHttp.responseText ) {

                        case '0':
                            signUpMessage.innerHTML = '邮箱已被注册。';
                            break;
                        case '1':
                            signUpMessage.innerHTML = '注册成功，等待审核。';
                            break;
                        case '2':
                            signUpMessage.innerHTML = '注册失败。';
                            break;
                        default:
                            signUpMessage.innerHTML = '发生了什么奇怪的错误。';

                    }

                }

            };
            xmlHttp.open( 'POST', url, true );
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send( 'num=2&email=' + email.value + '&password=' + password.value );


        }
        else {

            signUpMessage.innerHTML = '表单填写有错误。';

        }

    } );

}