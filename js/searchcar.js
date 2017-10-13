/**
 * Created by chenxiaojun on 2017/1/9.
 */

window.onload = start;


function start() {

    var searchKey = document.getElementById('searchKey');
    // searchKey.addEventListener('keyDown',stopEnter(event));

    var searchSubmit = document.getElementById('searchSubmit');
    var searchMessage = document.getElementById('searchMessage');

    searchSubmit.addEventListener('click',function(){
        searchMessage.innerHTML = '';
        var searchResult = document.getElementsByClassName('searchResult');
                        searchResult[0].innerHTML = '';
                        searchResult[1].innerHTML = '';
                        searchResult[2].innerHTML = '';
                        searchResult[3].innerHTML = '';

        if( searchKey.value != '' && searchKey.value.length == 11 && checkElements(searchKey, 2) ) {


            var xmlHttp = getAjaxHttp();
            var url = 'support/checkcar.php';

            xmlHttp.onreadystatechange = function() {

                if( xmlHttp.readyState == 4 && xmlHttp.status == 200 ) {

                    var responseText = eval('(' + xmlHttp.responseText + ')').showapi_res_body;

                    if( responseText.prov === undefined ) {

                        searchMessage.innerHTML = '不能查明这个号码。';

                    }
                    else {

                        var searchResult = document.getElementsByClassName('searchResult');

                        searchResult[0].innerHTML = responseText.prov;
                        searchResult[1].innerHTML = responseText.city;
                        searchResult[2].innerHTML = responseText.num;
                        searchResult[3].innerHTML = responseText.name;

                    }

                }

            };
            xmlHttp.open( 'POST', url, true );
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send( 'num=3&phoneNumber=' + searchKey.value );


        }

        else if( searchKey.value != '' && checkElements(searchKey, 3) ) {
            
            var xmlHttp = getAjaxHttp();
            var url = 'support/checkcar.php';

            xmlHttp.onreadystatechange = function() {

                if( xmlHttp.readyState == 4 && xmlHttp.status == 200 ) {

                    var responseText = eval('(' + xmlHttp.responseText + ')').showapi_res_body;

                    if( responseText.region === undefined ) {

                        searchMessage.innerHTML = '不能查明这个IP。';

                    }
                    else {

                        var searchResult = document.getElementsByClassName('searchResult');

                        searchResult[0].innerHTML = responseText.region;
                        searchResult[1].innerHTML = responseText.city;
                        searchResult[2].innerHTML = responseText.ip;
                        searchResult[3].innerHTML = responseText.isp;

                    }

                }

            };
            xmlHttp.open( 'POST', url, true );
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send( 'num=8&IPAddress=' + searchKey.value );


        }
        else {

            searchMessage.innerHTML = '不能查询这条信息。';

        }


    });





    searchKey.onkeydown = function( event ) {


        event = event || window.event || arguments.callee.caller.arguments[0];

        if( event.keyCode == 13 ) {

            document.getElementById('searchSubmit').click();
            return false;

        }

    };


    /*searchKey.addEventListener( 'keyDown',function( event ){

        event = event || window.event || arguments.callee.caller.arguments[0];

        if( event.keyCode == 13 ) {

            document.getElementById('searchSubmit').click();
            return false;

        }

    } );*/



}
function btn_post_click(){//searchSubmit.addEventListener('click',function(){


        {//if( searchKey.value != '') {
            

            var xmlHttp = getAjaxHttp();
            var url = 'support/checkcar.php';


            xmlHttp.onreadystatechange = function() {

                if( xmlHttp.readyState == 4 && xmlHttp.status == 200 ) {

                    //alert(xmlHttp.responseText);
                    var responseText = eval('(' + xmlHttp.responseText + ')').result;
                    //alert(responseText[0].name);
                    
                    var searchResult = document.getElementsByClassName('searchResult');
                    var grand = document.getElementById ("grand");
                    // alert(responseText[0].logo);
                    //循环取出品牌和LOGO
                    for (var i = 0; i <= responseText.length - 1; i++) {
                        var opt = document.createElement ("option");
                        opt.value = i + 1;
                        opt.id = i + 1;
                        opt.setAttribute("logo", responseText[i].logo);
                        //opt.id = responseText[i + 1].logo;
                        opt.innerText = responseText[i].name;
                        grand.appendChild (opt);
                    };

                }

            };

            xmlHttp.open( 'POST', url, true );
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send( 'num=9');


        }  


    };//});




    function showtype(parentid){//根据品牌取出LOGO和类型
    
            //根据品牌取出LOGO 
            //设置ID的值等于VALUE的值
            var logo = document.getElementById(parentid).getAttribute('logo');
            var searchResult = document.getElementsByClassName('searchResult');
            searchResult[0].innerHTML = "<img src='" + logo + "'>";

            var xmlHttp = getAjaxHttp();
            var url = 'support/checkcar.php';


            xmlHttp.onreadystatechange = function() {

                if( xmlHttp.readyState == 4 && xmlHttp.status == 200 ) {

                    //alert(xmlHttp.responseText);
                    var responseText = eval('(' + xmlHttp.responseText + ')').result;
                    //alert(responseText[0].carlist[0].list[0].id);
                    var searchResult = document.getElementsByClassName('searchResult');
                    var type = document.getElementById ("type");

                    //根据品牌循环取出类型
                    type.options.length = 0;//清空旧的类型
                    var opt = document.createElement ("option");
                    opt.innerText = "-选择类型查看详细信息-";
                    type.appendChild (opt);
                
                    for (var i = 0; i <= responseText.length - 1; i++) {
                        for (var j = 0; j<= responseText[i].carlist.length - 1; j++ ){
                            for (var k = 0; k<= responseText[i] .carlist[k] .list.length - 1; k++ ){
                                var opt = document.createElement ("option");
                                opt.value = responseText[i].carlist[j].list[k].id;
                                opt.innerText = responseText[i].carlist[j].list[k].name;
                                type.appendChild (opt);
                            };
                        };
                    };
                 
                    

                }

            };

            xmlHttp.open( 'POST', url, true );
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send( 'num=11&parentid=' + parentid);

 
    }



    function showcar(parentid){//根据类型取出车的详细信息
            //alert(parentid);
            var searchResult = document.getElementsByClassName('searchResult');

            var xmlHttp = getAjaxHttp();
            var url = 'support/checkcar.php';


            xmlHttp.onreadystatechange = function() {

                if( xmlHttp.readyState == 4 && xmlHttp.status == 200 ) {
                    //alert(xmlHttp.responseText);
                    var responseText = eval('(' + xmlHttp.responseText + ')').result;
                    //alert(responseText.basic.price);
                    var searchResult = document.getElementsByClassName('searchResult');
                    var popDetail = document.getElementById ("popDetail");
                    var detail = "官方价：&nbsp;&nbsp;" + responseText.basic.price + "</br>市场价：&nbsp;&nbsp;" + responseText.basic.saleprice + 
                        "</br>大小型：&nbsp;&nbsp;" + responseText.sizetype + "</br>生产年份：&nbsp;&nbsp;" +responseText.yeartype + "</br>是否生产：&nbsp;&nbsp;" + responseText.productionstate +
                        "</br>保修期：&nbsp;&nbsp;" + responseText.basic.warrantypolicy + "</br>变速箱：&nbsp;&nbsp;" + responseText.basic.gearbox +
                        "</br>最大时速：&nbsp;&nbsp;" + responseText.basic.maxspeed ;
                    
                    //选中选项自动弹出详细信息窗口    
                    new DivWindow('popup','popup_drag','popup_exit','exitButton','500','700',4);
                    popDetail.innerHTML = detail;
                    

                }

            };

            xmlHttp.open( 'POST', url, true );
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send( 'num=12&carid=' + parentid)




    }
    
   





//详细信息弹出框

var DivWindow= function(popup/*最外层div id*/,popup_drag/*拖动div id*/,popup_exit/*退出按钮id*/ ,exitButton/*触发服务器端退出按钮id*/,varwidth,varheight,zindex){
 this.popup =popup ; //窗口名称
  this.popup_drag=popup_drag;
 this.height =varheight ; //窗口高度，并没用来设置窗口高度宽度，用来定位在屏幕的位置
 this.width =varwidth ; //窗口宽度
        this.popup_exit=popup_exit;
        this.exitButton=exitButton;
        this.zindex=zindex;
 this.init = function(){ //初始化窗口
  this.popupShow();
  this.startDrag(); //设置拖动
  this.setCommond(); //设置关闭
  DivWindow.ArrayW.push(document.getElementById(this.popup)); //存储窗口到数组
 };this.init();
};
//存储窗口到数组
DivWindow.ArrayW = new Array();
//字符串连接类
DivWindow.StringBuild = function(){
 this.arr = new Array();
 this.push = function(str){
  this.arr.push(str);
 };
 this.toString = function(){
  return this.arr.join("");
 };
};
//拖动类
DivWindow.Drag = function(o ,oRoot){
 var _self = this;
 //拖动对象
 this.obj = (typeof oRoot != "undefined") ?oRoot : o;
 this.relLeft = 0; //记录横坐标
 this.relTop = 0; //记录纵坐标
 o.onselectstart = function(){
  return false;
 };
 o.onmousedown = function(e){ //鼠标按下
  e = _self.fixE(e);
  _self.relLeft = e.clientX - _self.fixU(_self.obj.style.left);
  _self.relTop = e.clientY - _self.fixU(_self.obj.style.top);
  document.onmousemove = function(e){
   _self.drag(e);
   //_self.obj.style.border = "1px dashed #000000";
   //_self.obj.style.filter = "alpha(opacity=30)";
   //_self.obj.style.opacity = "0.3";
  };
  document.onmouseup  = function(){
   _self.end();
   //_self.obj.style.border = "1px solid #cccccc";
   //_self.obj.style.borderBottom = "2px solid #E0E0E0";
   //_self.obj.style.borderRight = "2px solid #E0E0E0";
   //_self.obj.style.filter = "alpha(opacity=100)";
   //_self.obj.style.opacity = "1";
  };
 };
 this.drag = function(e){ //拖动
  e = this.fixE(e);
  var l = e.clientX - this.relLeft;
  var t = e.clientY - this.relTop;
  if (t < 0)
  {
   t = 0; //防止头部消失
  }
  this.obj.style.left = l +"px";
  this.obj.style.top = t +"px";
 };
 this.end = function(){ //结束拖动
  document.onmousemove = null;
  document.onmouseup = null;
 };
 this.fixE = function(e){ //修复事件
  if (typeof e == "undefined") e = window.event;
  return e;
 };
 this.fixU = function(u){ //处理px单位
  return parseInt(u.split("p")[0]);
 };
};
DivWindow.prototype.startDrag = function(){
 var obj = document.getElementById(this.popup);
        var drag = document.getElementById(this.popup_drag);
 new DivWindow.Drag(drag,obj);
};
//设定窗口优先级
DivWindow.prototype.setTop = function(){
 document.getElementById(this.popup).onclick =
 document.getElementById(this.popup).onmousedown =
 function(){
  for(var i=0;i<DivWindow.ArrayW.length;i++)
  {
   DivWindow.ArrayW[i].style.zIndex = 1;
  }
  this.style.zIndex = 100;
 };
};
//显示
DivWindow.prototype.popupShow=function()
{       document.getElementById('mask').style.display="block";
        document.getElementById('mask').style.width=window.screen.width +20;
        document.getElementById('mask').style.height=window.screen.width +20;
        var  element      = document.getElementById(this.popup);
        element.style.position   = "absolute";
        element.style.visibility = "visible";
        element.style.display    = "block";
        element.style.width=this.width;
        element.style.height='auto';
        element.style.left = (window.screen.width - this.width)/2+"px";
        //element.style.top  =(window.screen.height-this.height-100)/2+"px";
         element.style.top  =20+"px";
        element.style.zIndex=this.zindex;
}
//设置关闭
DivWindow.prototype.setCommond = function(){
    var _self = this;
    //根对象
    var obj = document.getElementById(this.popup);
    var exit = document.getElementById(this.popup_exit);
    var triggServerEvent=document.getElementById(this.exitButton);

    exit.onclick = function(){
        obj.style.display = "none";
        obj.style.visibility = 'hidden';
        document.all.mask.style.display='none'//关闭遮罩层
        triggServerEvent.click();//触发服务器端退出事件
     };
};

function stopEnter() {

    var event = event || window.event || arguments.callee.caller.arguments[0];

    if( event.keyCode == 13 ) {

        document.getElementById('searchSubmit').click();
        return false;

    }

}
function btn_post_click(){//searchSubmit.addEventListener('click',function(){

        {//if( searchKey.value != '') {
            

            var xmlHttp = getAjaxHttp();
            var url = 'support/checkcar.php';


            xmlHttp.onreadystatechange = function() {

                if( xmlHttp.readyState == 4 && xmlHttp.status == 200 ) {

                    //alert(xmlHttp.responseText);
                    var responseText = eval('(' + xmlHttp.responseText + ')').result;
                    //alert(responseText[0].name);
                    
                    var searchResult = document.getElementsByClassName('searchResult');
                    var grand = document.getElementById ("grand");
                    // alert(responseText[0].logo);
                    //循环取出品牌和LOGO
                    for (var i = 0; i <= responseText.length - 1; i++) {
                        var opt = document.createElement ("option");
                        opt.value = i + 1;
                        opt.id = i + 1;
                        opt.setAttribute("logo", responseText[i].logo);
                        //opt.id = responseText[i + 1].logo;
                        opt.innerText = responseText[i].name;
                        grand.appendChild (opt);
                    };

                }

            };

            xmlHttp.open( 'POST', url, true );
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send( 'num=9');


        }  


    };//});