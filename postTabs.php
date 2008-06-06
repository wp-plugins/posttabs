<?php
/*
Plugin Name: Post Tabs
Plugin URI: http://pirex.com.br/wordpress-plugins/post-tabs
Description: postTabs allows you to easily split your post/page content into Tabs that will be shown to your visitors
Author: Leo Germani
Version: 1.0
Author URI: http://pirex.com.br/wordpress-plugins

    PostTabs is released under the GNU General Public License (GPL)
    http://www.gnu.org/licenses/gpl.txt

    
*/

if(!get_option("postTabs")){

	$options["active_font"] = "#000000";
	$options["active_bg"] = "#fff";
	$options["inactive_font"] = "#666";
	$options["inactive_bg"] = "#f3f3f3";
	$options["over_font"] = "#666";
	$options["over_bg"] = "#fff";
	update_option("postTabs", $options);
}

$postTabs_options=get_option("postTabs");

function postTabs_filter($a){
	
	
	$b = "[tab:";
	$c = 0;
	if(is_int(strpos($a, $b, $c))){
		
		$vai = true;
		$results_i = array();
		$results_f = array();
		$results_t = array();
		$post = get_the_ID();


		 while ($vai)  {
			
			$r = strpos($a, $b, $c);
			
			if (is_int($r)){
				array_push($results_i, $r);
				$c=$r+1;
				$f = strpos($a, "]", $c);
				if($f){
					array_push($results_f, $f);
					array_push($results_t, substr($a, $r+5, $f-($r+5)));
				}
				
			}else $vai = false;	

			
		};

		If ($results_i[0] > 0) $op .= substr($a, 0, $results_i[0]);

		$op .= "<ul id='postTabs_ul_$post' class='postTabs'>\n";
		$x=0;
		for ($x==0; $x<sizeof($results_t); $x++){

			if($results_t[$x]!="END"){
				$op .= "<li id='postTabs_li_".$x."_$post' ";
				if ($x==0) $op .= "class='postTabs_curr'";
				$op .= "><a href='javascript:postTabs_show($x,$post)'>".$results_t[$x]."</a></li>\n";
			}
					
		}
		$op .= "</ul>\n\n";

		$x=0;
		for ($x==0; $x<sizeof($results_t); $x++){

			if ($results_t[$x]=="END") {
				$op .= substr($a, $results_f[$x]+1);
				break;	
			}
			
			$op .= "<div class='postTabs_divs";
			if ($x==0) $op .= " postTabs_curr_div";
			$op .= "' id='postTabs_".$x."_$post'>\n";
			
			$ini = $results_f[$x]+1;
			if (sizeof($results_t)-$x==1){
				$op .= substr($a, $results_f[$x]+1);
			}else{
				$op .= substr($a, $results_f[$x]+1, $results_i[$x+1]-$results_f[$x]-1);
			}
			$op .= "</div>\n\n";
			
			
		}
		return $op;
	}else{
		return $a;	
	}

}


function postTabs_addStyles(){
	global $postTabs_options;
?>
<!--[if IE 6]>
<style>
ul.postTabs li{
	display: block;
	float: left;
	
	}
</style>
<![endif]-->
<style>

.postTabs_divs{
display: none;
padding: 4px;
clear: both;
	
}

.postTabs_curr_div{
	display: block;
	clear: both;
}



ul.postTabs
	{
		position: relative;
		height: 16px;
		padding-left: 10px;
		background: url(<?php bloginfo('url'); ?>/wp-content/plugins/posttabs/tab_bottom.gif) repeat-x bottom;
		display: block;
		font-family: verdana, sans-serif;
		font-size: 11px;
		line-height: 1em;
		
	}



ul.postTabs li
	{
		margin-top: 5;
		
  		display: inline;
  		list-style-type: none;
  		line-height: 1em;
  		
  		background: <?php echo $postTabs_options["inactive_bg"]; ?>;
		font-size: 10px;
		
		font-weight: bold;
		padding: 2px 10px 2px 10px;
		margin-right: 4px;
		border: 1px solid #ccc;
		text-decoration: none;
		
		
  		
  	}
  	


	
ul.postTabs li a:link, .ulpostTabs li a:visited
	{
		text-decoration: none;
		color: <?php echo $postTabs_options["inactive_font"]; ?>;
		border: 0px;
		
	}

ul.postTabs li.postTabs_curr
	{
		border-bottom: 1px solid <?php echo $postTabs_options["active_bg"]; ?>;
		background: <?php echo $postTabs_options["active_bg"]; ?>;
		
	}
	
ul.postTabs li.postTabs_curr a:link, ul.postTabs li.postTabs_curr a:visited{
	color: <?php echo $postTabs_options["active_font"]; ?>;
	text-decoration: none;
	border: 0px;
	}

ul.postTabs li:hover
	{
		background: <?php echo $postTabs_options["over_bg"]; ?>;
	}

ul.postTabs li a:hover
	{
		color: <?php echo $postTabs_options["over_font"]; ?>;
		text-decoration: none;
		border: 0px;
	}



</style>
<script>

function postTabs_show(tab,post){
	
	
	x=0;
	for(x==0;x<30;x++){
		
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


</script>

<?php

}


function postTabs_admin() {
	if (function_exists('add_options_page')) {
		add_options_page('postTabs Options', 'postTabs', 8, basename(__FILE__), 'postTabs_admin_page');
	}
}

function postTabs_admin_page() {
	

	if (isset($_POST['submit_postTab'])) {


		echo "<div class=\"updated\"><p><strong> postTabs Options Updated!";
		
		$options["active_font"] = $_POST['active_font'];
		$options["active_bg"] = $_POST['active_bg'];
		$options["inactive_font"] = $_POST['inactive_font'];
		$options["inactive_bg"] = $_POST['inactive_bg'];
		$options["over_font"] = $_POST['over_font'];
		$options["over_bg"] = $_POST['over_bg'];
		update_option("postTabs", $options);
			
		
		
		echo "</strong></p></div>";
	}
	
	$options=get_option("postTabs");
	?>



	<div class=wrap>
	  <form name="qsoptions" method="post">
	    <h2>postTab options</h2>

		
			<h3>Active Tab</h3>
			Text color:<BR />
			<input type="text" name="active_font" value="<?= $options["active_font"] ?>"> <BR />
			Background color:<BR />
			<input type="text" name="active_bg" value="<?= $options["active_bg"] ?>"> <BR /><BR />
			
			<h3>Mouse Over Tab</h3>
			Text color:<BR />
			<input type="text" name="over_font" value="<?= $options["over_font"] ?>"> <BR />
			Background color:<BR />
			<input type="text" name="over_bg" value="<?= $options["over_bg"] ?>"> <BR /><BR />
			
			<h3>Inactive Tab</h3>
			Text color:<BR />
			<input type="text" name="inactive_font" value="<?= $options["inactive_font"] ?>"> <BR />
			Background color:<BR />
			<input type="text" name="inactive_bg" value="<?= $options["inactive_bg"] ?>"> <BR /><BR />
			
			

	
	
	<div class="submit">
	<input type="submit" name="submit_postTab" value="<?php _e('Update Settings', '') ?> &raquo;">
	
	
	
	  </form>
	</div>

	<?php

}

add_filter('the_content', 'postTabs_filter');
add_action('wp_head','postTabs_addStyles');

add_action('admin_menu','postTabs_admin');
?>
