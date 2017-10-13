

// window.onload = start;

function start(p) {
    var searchKey = document.getElementById('searchKey');
    searchKey.addEventListener('keyDown',stopEnter(event));
    
    var searchSubmit = document.getElementById('searchSubmit');
    var searchMessage = document.getElementById('searchMessage');
    var pagination=document.getElementById('pagination');
    searchMessage.innerHTML = '';


    // searchSubmit.addEventListener('click',function(){
            
            var destpage=p; 

        if( searchKey.value != '') {


            var xmlHttp = getAjaxHttp();
            var url = 'support/check.php';

            xmlHttp.onreadystatechange = function() {
                if( xmlHttp.readyState == 4 && xmlHttp.status == 200 ) {

                        var result = '';

                        result += "<tr><th>标题</th><th>分类</th><th>用户名</th><th>来源</th><th>链接</th><th>文件类型</th></tr>";
                        var len=eval('(' + xmlHttp.responseText + ')').showapi_res_body.pagebean.contentlist.length;
                        for (var i = 0; i <=len-1; i++) {
                        var responseText = eval('(' + xmlHttp.responseText + ')').showapi_res_body.pagebean.contentlist[i];
                            result += "<tr><td>"+responseText.title+"</td><td>"+responseText.category+"</td><td>"+responseText.uname+"</td><td>"+responseText.domain+"</td><td>"+responseText.url+"</td><td>"+responseText.file_type+"</td></tr>";

                        }
                        searchResult.innerHTML = result;
                    
                        var totalpage = eval('(' + xmlHttp.responseText + ')').showapi_res_body.pagebean.allPages;
                        var currentpage = eval('(' + xmlHttp.responseText + ')').showapi_res_body.pagebean.currentPage;  
                        
                        var str = "<div class='pagination'>";
                        str += "<span >总共:" + totalpage + "页</span>";
                        str += "<span id='first' type='button' onclick='start(1)'>首页</span>";

                        var currentpage=p;
                        for(var i = currentpage - 4; i < currentpage + 4; i++) {
                            if(i >= 1 && i <= totalpage) {
                                if(i == currentpage) {
                                    str += "<span id='dangqian' type='button' bs='" + i + "' onclick='start("+i+")'>" + i + "</span>";
                                    } else {
                                    str += "<span id='list' type='button' bs='" + i + "' onclick='start("+i+")'>" + i + "</span>";
                                            }   
 
                            }
                        }
 
                        str += "<span id='last' class='demo' type='button' onclick='start("+totalpage+")'>尾页</span>";
                        str +="<input id='page' name='page' type='text' /><input id='goSubmit' type='button' value='转到'/></div>";
                        pagination.innerHTML = str;
                        
                        goSubmit.addEventListener('click',function(){
                            var goSubmit=document.getElementById("goSubmit");//这行和下面一行需要放在括号里面，不然逻辑不对
                            var page= parseInt(document.getElementById("page").value);
                            start(page);
                        }) //这段代码曾让页面无法返回

 

                       

                }

            }//这里应该有分号吗？
 

            xmlHttp.open( 'POST', url, true);
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send('num=10&p=' + destpage +'&q=' + searchKey.value);


        }
        else {

            searchMessage.innerHTML = '不能查询这条信息。';

        }

    // });


    



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

    } );}



function stopEnter() {

    var event = event || window.event || arguments.callee.caller.arguments[0];

    if( event.keyCode == 13 ) {

        document.getElementById('searchSubmit').click();
        return false;

    }

}