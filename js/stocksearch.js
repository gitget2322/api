window.onload=start;

function start()
{var searchKey=document.getElementById("searchKey");
	var searchSumit=document.getElementById("searchSubmit");
	var searchMessage=document.getElementById("searchMessage");
	
	searchSubmit.addEventListener('click',function()
	{searchMessage.innerHTML = '';
        var searchResult = document.getElementsByClassName('searchResult');
                        searchResult[0].innerHTML = '';
                        searchResult[1].innerHTML = '';
                        searchResult[2].innerHTML = '';
                        searchResult[3].innerHTML = '';
		if (searchKey.value != '')
			
		{

			var xmlHttp = getAjaxHttp();
			var url='support/check.php';
			xmlHttp.onreadystatechange = function()
			{
				if( xmlHttp.readyState == 4 && xmlHttp.status == 200 )
				{
				
					var responseText=eval('('+ xmlHttp.responseText + ')').showapi_res_body.list[0];
					var searchResult=document.getElementsByClassName("searchResult");
					searchResult[1].innerHTML=responseText.trade_money;
					searchResult[2].innerHTML=responseText.diff_money;
					searchResult[3].innerHTML=responseText.open_price;
					searchResult[0].innerHTML=responseText.market;
				}
               
				
					

				
			}
			xmlHttp.open('POST',url,true);
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlHttp.send('num=9&code=' + searchKey.value);
		}
	else
		{
				searchMessage.innerHTML="不能查询此股票";
		}			
	}
	
	)
		



	searchKey.onkeydown=function(event)
	{
		event=event||window.event||arguments.callee.caller.arguments[0];
		if(event.keyCode==13)
		{
			document.getElementById('searchSubmit').click();
			return false;
		}
	}


    searchKey.addEventListener( 'keyDown',function( event ){

        event = event || window.event || arguments.callee.caller.arguments[0];

        if( event.keyCode == 13 ) {

            document.getElementById('searchSubmit').click();
            return false;

        }

    });} 
	


function stopEnter() 
{

    var event = event || window.event || arguments.callee.caller.arguments[0];

    if( event.keyCode == 13 ) 
    {

        document.getElementById('searchSubmit').click();
        return false;

    }
}
