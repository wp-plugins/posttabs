<?php

if (isset($_POST['submit_postTab'])) {

	$options["active_font"] = $_POST['active_font'];
	$options["active_bg"] = $_POST['active_bg'];
	$options["inactive_font"] = $_POST['inactive_font'];
	$options["inactive_bg"] = $_POST['inactive_bg'];
	$options["over_font"] = $_POST['over_font'];
	$options["over_bg"] = $_POST['over_bg'];
	$options["line"] = $_POST['line'];
	update_option("postTabs", $options);
				
	echo "<div class=\"updated\"><p><strong> postTabs Options Updated!</strong></p></div>";
}

$options=get_option("postTabs");
?>
<script>
function postTabs_preview(){
	
	tabs = new Array("active","inactive","over");
	
	document.getElementById("postTabs_admin").style.borderBottom="1px solid "+document.postTabsOptions.line.value;	
	document.getElementById("postTabs_admin_active").style.border="1px solid "+document.postTabsOptions.line.value;	
	document.getElementById("postTabs_admin_inactive").style.border="1px solid "+document.postTabsOptions.line.value;	
	document.getElementById("postTabs_admin_over").style.border="1px solid "+document.postTabsOptions.line.value;

	for(y=0;y<tabs.length;y++){
		document.getElementById("postTabs_admin_"+tabs[y]).style.backgroundColor=document.postTabsOptions.elements[tabs[y]+"_bg"].value;
	}
	for(y=0;y<tabs.length;y++){
		document.getElementById("postTabs_admin_"+tabs[y]).style.color=document.postTabsOptions.elements[tabs[y]+"_font"].value;
	}
	
	document.getElementById("postTabs_admin_preview").style.backgroundColor=document.postTabsOptions.active_bg.value;	
	document.getElementById("postTabs_admin_active").style.borderBottom="1px solid "+document.postTabsOptions.active_bg.value;		
}

</script>

<div class="wrap">

	


	<form name="postTabsOptions" method="post">
		<h2>postTab options</h2>


		<div id="postTabs_admin_preview">
		
		
			<ul id='postTabs_admin' >
			<li ><a id='postTabs_admin_active' href='#'>Active Tab</a></li>
			<li ><a id='postTabs_admin_inactive' href='#'>Inactive Tab</a></li>
			<li ><a id='postTabs_admin_over' href='#'>Mouse Over</a></li>
			
			</ul>
	
		</div>

		<div id="colorpicker301" class="colorpicker301" onClick="setTimeout('postTabs_preview()',100)"></div>
		
		<BR>
		Enter the color in the fields bellow, or use the buttons to pick it. 
		<br>
		<b>Dont forget to Save the changes after you are done.</b>
		
		
		<h3>Line Color</h3>
		<input type="button" onclick="showColorGrid3('line','none');" value="..." >&nbsp;
		<input type="text" id="line" name="line" value="<?= $options["line"] ?>" onKeyUp="postTabs_preview()"> 
		<BR />

		<h3>Active Tab</h3>
		Text color:<BR />
		<input type="button" onclick="showColorGrid3('active_font','none');" value="..." >&nbsp;
		<input type="text" id="active_font" name="active_font" value="<?= $options["active_font"] ?>" onKeyUp="postTabs_preview()"> <BR />
		Background color:<BR />
		<input type="button" onclick="showColorGrid3('active_bg','none');" value="..." >&nbsp;
		<input type="text" id="active_bg" name="active_bg" value="<?= $options["active_bg"] ?>" onKeyUp="postTabs_preview()"> <BR /><BR />

		<h3>Mouse Over Tab</h3>
		Text color:<BR />
		<input type="button" onclick="showColorGrid3('over_font','none');" value="..." >&nbsp;
		<input type="text" id="over_font" name="over_font" value="<?= $options["over_font"] ?>" onKeyUp="postTabs_preview()"> <BR />
		Background color:<BR />
		<input type="button" onclick="showColorGrid3('over_bg','none');" value="..." >&nbsp;
		<input type="text" id="over_bg" name="over_bg" value="<?= $options["over_bg"] ?>" onKeyUp="postTabs_preview()"> <BR /><BR />

		<h3>Inactive Tab</h3>
		Text color:<BR />
		<input type="button" onclick="showColorGrid3('inactive_font','none');" value="..." >&nbsp;
		<input type="text" id="inactive_font" name="inactive_font" value="<?= $options["inactive_font"] ?>" onKeyUp="postTabs_preview()"> <BR />
		Background color:<BR />
		<input type="button" onclick="showColorGrid3('inactive_bg','none');" value="..." >&nbsp;
		<input type="text" id="inactive_bg" name="inactive_bg" value="<?= $options["inactive_bg"] ?>" onKeyUp="postTabs_preview()"> <BR /><BR />

		<div class="submit">
		<input type="submit" name="submit_postTab" value="<?php _e('Update Settings', '') ?> &raquo;">
		</div>
		
	</form>	
	
	<?php if (isset($_POST['submit_postTab'])) echo '<script>postTabs_preview();</script>'; ?>
</div>
