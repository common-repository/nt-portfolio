<?php
//help page;

add_action('admin_menu', 'ndtrck_ntp_add_help_page');

function ndtrck_ntp_add_help_page() {
	add_submenu_page( 'edit.php?post_type=nt_portfolio', 'NT portfolio help', 'Help', 'read', 'nt-portfolio-help', 'ndtrck_ntp_display_help_page' );
}

function ndtrck_ntp_display_help_page()
{
	$outputHtml = '<div>';
	$outputHtml .= '<h1>How to use</h1>';
	$outputHtml .= '</div>';

	$outputHtml .= '<div>';
	$outputHtml .= '<h1>Shortcodes</h1>';
	$outputHtml .= '<p>There are 2 main shortcodes, <strong>[ntportfolio]</strong> and <strong>[ntportfolio_single]</strong></p>';
	$outputHtml .= '<p><strong>[ntportfolio_single]</strong> accepts the following argument: <strong>id</strong> and <strong>layout</strong></br>';
	$outputHtml .= '<strong>id</strong> will be the id of your NT Portfolio item</br>';
	$outputHtml .= '<strong>layout</strong> can be <strong>"standard"</strong> and <strong>"reversed"</strong></br>';
	$outputHtml .= '<strong>[ntportfolio]</strong> accepts the following arguments: <strong>id</strong>, <strong>colums</strong> and <strong>layout</strong></br>';
	$outputHtml .= '<strong>columns</strong> can be set to 2, 3 or 4</br>';
	$outputHtml .= '<strong>layout</strong> can be <strong>"glass"</strong>, <strong>"centblack"</strong>, <strong>"vertblack"</strong> or <strong>"kinetic"</strong></br>';
	$outputHtml .= '<strong>id</strong> will be the ids of your NT Portfolio items. If you want to have more than 1 post id, you can provide them and seperate them with comma (,)</br>';
	$outputHtml .= '<h2>Example use</h2>';
	$outputHtml .= '<strong>[ntportfolio id="449,450,398" columns="3" layout="vertblack"]</strong></br>';
	$outputHtml .= '<strong>[ntportfolio_single id="449" layout="reversed"]</strong>';
	$outputHtml .= '</div>';

	$outputHtml .= '<div>';

	$outputHtml .= '</div>';

	
	$outputHtml .= '<div>';
	$outputHtml .= '<h1>Customizing the look</h1>';
	$outputHtml .= '<h2>Tiles</h2>';
	$outputHtml .= '<img src="'.plugins_url( 'images/tilehelp.png',  dirname(__FILE__) ).'" style="width:100%;">';
	$outputHtml .= '<h2>Single Item</h2>';
	$outputHtml .= '<img src="'.plugins_url( 'images/singlehelp.png',  dirname(__FILE__) ).'" style="width:100%;">';
	$outputHtml .= '<h2>Free/Pro comparison</h2>';
	$outputHtml .= '<strong>the settings underlined with red are for the pro version of this plug in.</strong></br>';
	$outputHtml .= '<a href="#" target="_blank">get it here</a></br>';
	$outputHtml .= '<img src="'.plugins_url( 'images/comparison.png',  dirname(__FILE__) ).'">';
	$outputHtml .= '<strong>if you have the pro version, in order to update, disable the free version of the plug in and then install and activate the pro version</strong>';
	$outputHtml .= '</div>';
	
	echo $outputHtml;
}

?>