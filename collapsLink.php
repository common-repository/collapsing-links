<?php
/*
Plugin Name: Collapsing Links
Plugin URI: http://robfelty.com/plugins/collapsing-links
Description: Uses javascript to expand and collapse links to show the posts that belong to the link category 
Author: Robert Felty
Version: 0.4
Author URI: http://robfelty.com
Tags: sidebar, widget, links, blogroll, navigation, collapsing, collapsible

Copyright 2007-2015 Robert Felty

This file is part of Collapsing Links

		Collapsing Links is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License as published by 
    the Free Software Foundation; either version 2 of the License, or (at your
    option) any later version.

    Collapsing Links is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Collapsing Links; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/ 

$url = get_settings('siteurl');
if (!is_admin()) {
  $inFooter = get_option('collapsLinkInFooter');
  wp_enqueue_script('collapsFunctions',
      "$url/wp-content/plugins/collapsing-links/collapsFunctions.js",
      array('jquery'), '1.7', $inFooter);
  add_action( 'wp_head', array('collapsLink','get_head'));
}
add_action('activate_collapsing-links/collapsLink.php', array('collapsLink','init'));

class collapsLink {

	function init() {
    include('collapsLinkStyles.php');
    $defaultStyles=compact('selected','default','block','noArrows','custom');
    if( function_exists('add_option') ) {
      update_option( 'collapsLinkOrigStyle', $style);
      update_option( 'collapsLinkDefaultStyles', $defaultStyles);
    }
    if (!get_option('collapsLinkStyle')) {
			add_option( 'collapsLinkStyle', $style);
		}
    if (!get_option('collapsLinkSidebarId')) {
      add_option( 'collapsLinkSidebarId', 'sidebar');
    }
	}


	function get_head() {
		$url = get_settings('siteurl');
    $style=stripslashes(get_option('collapsLinkStyle'));
    echo "<style type='text/css'>
    $style
    </style>\n";
	}
}


function collapsLink($args='') {
  include_once( 'collapsLinkList.php' );
  if (!is_admin()) {
    list_links($args);
  }
}
include('collapsLinkWidget.php');
?>
