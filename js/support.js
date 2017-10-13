/**
 * Created by chenxiaojun on 2017/1/9.
 */

// 获取 AjaxHttp
function getAjaxHttp() {
    var xmlHttp;

    try{
        xmlHttp = new XMLHttpRequest();
    }
    catch( e ){

        try{
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch( e ){
            try{
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch( e ){
                alert("您的浏览器不支持 AJAX !");
                return false;
            }
        }

    }

    return xmlHttp;
}


// 各种验证
function checkElements( ele, num ) {

    switch( num ) {

        case 1: //邮箱格式验

            var regEmail = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;

            return regEmail.test(ele.value);

            break;


        case 2: // 电话号码验证

            var regNumber = /^\d+$/;

            return ele.value.match( regNumber );

            break;


        default:

            return false;

    }

}


function useAjax( url, urlParameters, callback ){

    var xmlHttp = getAjaxHttp();

    xmlHttp.onreadystatechange = function() {

        if( xmlHttp.readyState == 4 && xmlHttp.status == 200 ) {

            callback( xmlHttp );

        }

    };
    xmlHttp.open( 'POST', url, true );
    xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlHttp.send( urlParameters );


}






































