/**
 * Created by chenxiaojun on 2017/1/9.
 */

window.onload = start;


function start() {

    var searchKey = document.getElementById('searchKey');
    searchKey.addEventListener('keyDown',stopEnter(event));

    var searchSubmit = document.getElementById('searchSubmit');
    var searchMessage = document.getElementById('searchMessage');

    searchSubmit.addEventListener('click',function(){
        // searchMessage.innerHTML = '';没有效果，无法去除已经返回的错误信息
            searchMessage.innerHTML = '';// searchMessage.innerHTML = '';没有效果，无法去除已经返回的错误信息
            var searchResult = document.getElementsByClassName('searchResult');
                        searchResult[0].innerHTML = '';
                        searchResult[1].innerHTML = '';
                        searchResult[2].innerHTML = '';
                        searchResult[3].innerHTML = '';
        if( searchKey.value != '' && searchKey.value.length == 11 && checkElements(searchKey, 2) ) {


            var xmlHttp = getAjaxHttp();
            var url = 'support/check.php';

            xmlHttp.onreadystatechange = function() {
                 if( xmlHttp.readyState == 4 && xmlHttp.status == 200 ) {


                     var responseText = eval('(' + xmlHttp.responseText + ')').showapi_res_body; 

                    if( responseText.prov === undefined ) {
                        searchMessage.innerHTML = '不能查明这个号码。';
                    }
                    else {
                        searchMessage.innerHTML = '';// 
                        

                        searchResult[0].innerHTML = responseText.prov;
                        searchResult[1].innerHTML = responseText.city;
                        searchResult[2].innerHTML = responseText.name;
                        searchResult[3].innerHTML = responseText.num;

                    }   


                 }

            };
            xmlHttp.open( 'POST', url, true);
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send('num=3&phoneNumber=' + searchKey.value);


        }
        else {

            searchMessage.innerHTML = '不能查询这条信息123。';

        }


    });



    searchKey.onkeydown = function( event ) {


        event = event || window.event || arguments.callee.caller.arguments[0];

        if( event.keyCode == 13 ) {

            document.getElementById('searchSubmit').click();
            return false;

        }

    };


    searchKey.addEventListener( 'keyDown',function( event ){

        event = event || window.event || arguments.callee.caller.arguments[0];

        if( event.keyCode == 13 ) {

            document.getElementById('searchSubmit').click();
            return false;

        }

    } );



}


function stopEnter() {

    var event = event || window.event || arguments.callee.caller.arguments[0];

    if( event.keyCode == 13 ) {

        document.getElementById('searchSubmit').click();
        return false;

    }

}