/**
 * Created by chenxiaojun on 2017/1/10.
 */

window.onload = function() {


    // 审核账号
    var checkUser = document.getElementsByClassName('checkUser');
    for( var i=0;i<checkUser.length;i++ ){

        checkUser[i].addEventListener( 'change',function(){

            useAjax( 'support/check.php', 'num=4&email='+this.value, function( xmlHttp ) {

                alert( xmlHttp.responseText );

            } );

        } );

    }


    // 设置账号权限
    var userPosition = document.getElementsByClassName('userPosition');
    for( var j=0;j<userPosition.length;j++ ) {

        userPosition[j].addEventListener( 'change',function(){

            useAjax( 'support/check.php', 'num=5&position='+this.value, function( xmlHttp ){

                alert( xmlHttp.responseText );

            } );

        } );

    }


    // 设置 电话号码查询 权限。
    var searchPhoneNumber = document.getElementsByClassName('searchPhoneNumber');
    for( var k=0;k<searchPhoneNumber.length;k++ ) {

        searchPhoneNumber[k].addEventListener( 'change',function() {

            useAjax( 'support/check.php', 'num=6&id='+this.value, function( xmlHttp ) {

                alert( xmlHttp.responseText );

            } );
            // alert('hello');

        } );

    }


    // 设置 IP地址查询 权限。
    var searchIPAddress = document.getElementsByClassName('searchIPAddress');
    for( var m=0;m<searchPhoneNumber.length;m++ ) {

        searchIPAddress[m].addEventListener( 'change',function() {

            useAjax( 'support/check.php', 'num=7&id='+this.value, function( xmlHttp ) {

                alert( xmlHttp.responseText );

            } );
            // alert('hello');

        } );

    }
    var searchStock = document.getElementsByClassName('searchStock');  
    //alert('hello');

    for( var l=0;l<searchStock.length;l++ ) {
        searchStock[l].addEventListener( 'change',function() {

            useAjax( 'support/check.php', 'num=13&id='+this.value, function( xmlHttp ) {

                alert( xmlHttp.responseText );

            } );
          

        } );

    }

    var searchpan = document.getElementsByClassName('searchpan');
    for( var k=0;k<searchpan.length;k++ ) {

        searchpan[k].addEventListener( 'change',function() {

            useAjax( 'support/check.php', 'num=11&id='+this.value, function( xmlHttp ) {

                alert( xmlHttp.responseText );

            } );
            // alert('hello');

        } );

    }
    var searchcar = document.getElementsByClassName('searchcar');
    for( var k=0;k<searchcar.length;k++ ) {

        searchcar[k].addEventListener( 'change',function() {

            useAjax( 'support/check.php', 'num=12&id='+this.value, function( xmlHttp ) {

                alert( xmlHttp.responseText );

            } );
            // alert('hello');

        } );

    }

};