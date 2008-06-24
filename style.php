.postTabs_divs{
	display: none;
	padding: 4px;	
}

.postTabs_curr_div{
	display: block;
}


ul.postTabs
	{
	margin:0px 0px 1em;
	padding: 0.2em 1em 0.2em 30px;
	border-bottom: 1px solid <?php echo $postTabs_options["line"]; ?>;
	font-size: 11px;
	list-style-type: none;
	
	}

ul.postTabs li
	{	
	display: inline;
	font-size: 11px;
	line-height:normal;
	}
  	
ul.postTabs li a
	{
	text-decoration: none;
	background: <?php echo $postTabs_options["inactive_bg"]; ?>;
	border: 1px solid <?php echo $postTabs_options["line"]; ?>;
	padding: 0.2em 0.4em;
	color: <?php echo $postTabs_options["inactive_font"]; ?> !important;
	outline:none;		
	}
	
ul.postTabs li.postTabs_curr a{
	border-bottom: 1px solid <?php echo $postTabs_options["active_bg"]; ?>;
	background: <?php echo $postTabs_options["active_bg"]; ?>;
	color: <?php echo $postTabs_options["active_font"]; ?> !important;
	text-decoration: none;

	}

ul.postTabs li a:hover
	{
	color: <?php echo $postTabs_options["over_font"]; ?> !important;
	background: <?php echo $postTabs_options["over_bg"]; ?>;
	text-decoration: none;

	}
