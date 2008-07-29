function postTabs_show(tab,post){
		
		for(x=0;x<30;x++){
			if(document.getElementById("postTabs_"+x+"_"+post)){
				document.getElementById("postTabs_"+x+"_"+post).style.display="none";
				document.getElementById("postTabs_li_"+x+"_"+post).className="";
			}else{
				break;	
			}
		}
		document.getElementById("postTabs_"+tab+"_"+post).style.display="block";
		document.getElementById("postTabs_li_"+tab+"_"+post).className="postTabs_curr";
		self.focus();

		//Cookies
		var expire = new Date();
		var today = new Date();
		expire.setTime(today.getTime() + 3600000*24);
		
		document.cookie = "postTabs_"+post+"="+tab+";expires="+expire.toGMTString();


		//alert(postTabs_getCookie("postTabs_"+post));

}


function posTabsShowLinks(tab){

	if (tab) window.status=tab;
	else window.status="";
	

}

function postTabs_getCookie(name) {
			var nameEQ = name + "=";
			var ca = document.cookie.split(';');
			for(var i=0;i < ca.length;i++) {
				var c = ca[i];
				while (c.charAt(0)==' ') c = c.substring(1,c.length);
				if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
			}
			return null;
		}
