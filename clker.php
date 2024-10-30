<?php
/*
Plugin Name: Clker.com
Plugin URI: http://wordpress.org/extend/plugins/clkercom-clip-art/
Description: Adds Clker.com clipart to tiny_mce component of wordpress
Version: 1.2.3
Author: Mohamed Ibrahim
Author URI: http://www.clker.com
*/

/*  Copyright 2008  Mohamed Ibrahim  (email : mibrahim@mibrahim.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function clkerplugin_addbuttons() {
   // Don't bother doing this stuff if the current user lacks permissions
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
 
   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "add_clkerplugin_tinymce_plugin");
     add_filter('mce_buttons', 'register_clkerplugin_button');
   }
}
 
function register_clkerplugin_button($buttons) {
   array_push($buttons, "separator", "clker");
   return $buttons;
}
 
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_clkerplugin_tinymce_plugin($plugin_array) {
   $plugin_array['clker'] ='../../../wp-content/plugins/clkercom-clip-art/mce/editor_plugin.js';
   return $plugin_array;
}
 
// init process for button control
add_action('init', 'clkerplugin_addbuttons');

?>
