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
	}
