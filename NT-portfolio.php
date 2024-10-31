<?php
/*
Plugin Name: NT Portfolio
Description: Enhance your site with awesome tiles and single portfolio items to showcase your portfolio! 
Version: 1.0
Author: NODETRACK
Author URI: https://nodetrack.com
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

NT Portfolio is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
NT Portfolio is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with NT Portfolio. If not, see https://www.gnu.org/licenses/gpl-2.0.html
*/
?>
<?php


if(file_exists(plugin_dir_path( __FILE__ ).'core/helperFunctionsPro.php'))
{
	include('core/helperFunctionsPro.php');
}
else
{
	include('core/helperFunctions.php');
}

include('core/portfolioCustomPost.php');
include('core/shortcodes.php');
include('core/helpPage.php');

?>