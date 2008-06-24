<?php
/*
Plugin Name: Post Tabs
Plugin URI: http://pirex.com.br/wordpress-plugins/post-tabs
Description: postTabs allows you to easily split your post/page content into Tabs that will be shown to your visitors
Author: Leo Germani
Version: 2.0
Author URI: http://pirex.com.br/wordpress-plugins

    PostTabs is released under the GNU General Public License (GPL)
    http://www.gnu.org/licenses/gpl.txt

    
*/
function postTabs_init(){
	if(!get_option("postTabs")){

		$options["active_font"] = "#000000";
		$options["active_bg"] = "#fff";
		$options["inactive_font"] = "#666";
		$options["inactive_bg"] = "#f3f3f3";
		$options["over_font"] = "#666";
		$options["over_bg"] = "#fff";
		$options["line"] = "#ccc";
		update_option("postTabs", $options);
	}

}



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
		
		for ($x=0; $x<sizeof($results_t); $x++){

			if($results_t[$x]!="END"){
				$op .= "<li id='postTabs_li_".$x."_$post' ";
				if ($x==0) $op .= "class='postTabs_curr'";
				$op .= "><a href='javascript:postTabs_show($x,$post)'>".$results_t[$x]."</a></li>\n";
			}
					
		}
		$op .= "</ul>\n\n";

		
		for ($x=0; $x<sizeof($results_t); $x++){

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


function postTabs_addHeader(){
	$postTabs_options=get_option("postTabs");
	?>
	
	<style>
	<?php require_once("style.php"); ?>
	</style>
	
	<script type="text/javascript" src="<?php bloginfo('siteurl'); ?>/wp-content/plugins/posttabs/postTabs.js"></script>

	
	<?php

}


function postTabs_admin_addHeader(){
	$postTabs_options=get_option("postTabs");
	?>
	<style>
	<?php require_once("style_admin.php"); ?>
	</style>
	<script type="text/javascript" src="<?php bloginfo('siteurl'); ?>/wp-content/plugins/posttabs/301a.js"></script>
	<?php

}

function postTabs_admin() {
	if (function_exists('add_options_page')) {
		add_options_page('postTabs Options', 'postTabs', 8, basename(__FILE__), 'postTabs_admin_page');
	}
}

function postTabs_admin_page() {
	
	require_once("postTabs_admin.php");

}

register_activation_hook( __FILE__, 'postTabs_init' );

add_filter('the_content', 'postTabs_filter');
add_action('wp_head','postTabs_addHeader');
add_action('admin_head','postTabs_admin_addHeader');

add_action('admin_menu','postTabs_admin');
?>
