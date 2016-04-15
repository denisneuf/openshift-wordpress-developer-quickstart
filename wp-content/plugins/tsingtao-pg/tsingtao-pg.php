<?php
/**
 * Plugin Name: tsingtao-pg
 * Plugin URI: tsingtao.ml/wp-plugin
 * Description: tsingtao-pg is awesome tool for adding responsive lightbox (overlay) effect for images and also create lightbox for photo albums/galleries on your WordPress blog. WordPress Lightbox is one of the most useful plugins for your website.
 * Version: 0.0.0.1
 * Author: Hanuman
 * Author URI: https://www.tsingtao.ml
 * License: GNU General Public License, v2 (or newer)
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
/*  Copyright 2015 La mejor cerveza de china 

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation using version 2 of the License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


function pluginprefix_setup_post_type() {
 
    // Register our "book" custom post type
    register_post_type( 'sin-categoria', array( 'public' => 'false' ) );
 
}


add_action( 'init', 'pluginprefix_setup_post_type' );
 
function pluginprefix_install() {
 
    // Trigger our function that registers the custom post type
    //pluginprefix_setup_post_types();
 
    // Clear the permalinks after the post type has been registered
    flush_rewrite_rules();
 
}
register_activation_hook( __FILE__, 'pluginprefix_install' );


function pluginprefix_deactivation() {
 
    // Our post type will be automatically removed, so no need to unregister it
 
    // Clear the permalinks to remove our post type's rules
    flush_rewrite_rules();
 
}

register_deactivation_hook( __FILE__, 'pluginprefix_deactivation' );


add_action( 'wp_head', 'my_facebook_tags' );

function my_facebook_tags() {
    
    if (is_home())
    {
    echo 'I am in the head section'.plugin_dir_url( __FILE__ ).'images/icon.gif';
    }
}

add_action( 'wp_enqueue_scripts', 'my_enqueued_assets' );

function my_enqueued_assets() {
    
    if (is_single())
    {
	wp_enqueue_style( 'my-font', '//fonts.googleapis.com/css?family=Roboto' );
    wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/jquery-2.2.2.min.js', array(), '2.2.2', false );
    }
    
}

/*
if ( is_admin() ) {
     // We are in admin mode
     require_once( dirname(__file__).'/admin/admin_menu.php' );
}

*/



add_action( 'admin_menu', 'add_my_custom_menu' );

function add_my_custom_menu() {
    //add an item to the menu
    add_menu_page (
        'Tsingtao Options',
        'Tsingtao',
        'manage_options',
        'tsingtao-pg/my-plugin-form.php',
        '',
        plugin_dir_url( __FILE__ ).'images/icon.gif',
        '23.56'
    );
}

add_action( 'admin_init', 'my_admin_init' );

function my_admin_init() {
    
	register_setting( 'my-settings-group', 'my-setting' );
    
    register_setting( 'my-settings-group', 'my-option', 'intval' );
    
    register_setting( 'my-settings-group', 'my-option-radio', 'intval' );
    
    
	// Sections
	add_settings_section( 'section-one', 'Section One', 'section_one_callback', 'my-plugin' );
    
    add_settings_section( 'section-two', 'Section Two', 'section_two_callback', 'my-plugin' );
    
    add_settings_section( 'section-three', 'Section Three', 'section_three_callback', 'my-plugin' );

	// Fields
	add_settings_field( 'field-one', 'Field One', 'field_one_callback', 'my-plugin', 'section-one' );
    
    add_settings_field( 'field-two', 'Field Two', 'field_two_callback', 'my-plugin', 'section-two' );
    
    add_settings_field( 'field-two', 'Field Three', 'field_three_callback', 'my-plugin', 'section-three' );

}




function section_two_callback() {
	echo "Fuck";
}

function section_three_callback() {
	echo "Radio Hell";
}

function section_one_callback() {
	echo "First One Field Later the World.";
}

function field_one_callback() {
	$setting_value = esc_attr( get_option( 'my-setting' ) );
	echo "<input class='regular-text' type='text' name='my-setting' value='$setting_value' />";
}

function field_two_callback() {
	$setting_value = esc_attr( get_option( 'my-option' ) );
	echo "<input class='regular-text' type='text' name='my-option' value='$setting_value' />";
}

function field_three_callback() {
	$setting_value = esc_attr( get_option( 'my-option-radio' ) );
    
    //$val = checked(1, get_option('my-option-radio'), true);
	
    //echo "<input class='regular-text' type='text' name='my-option-radio' value='$setting_value' />";
    
    $chk1 = checked(1, get_option('my-option-radio'), true);
    $chk2 = checked(2, get_option('my-option-radio'), true);
    
    echo "<input type='radio' name='my-option-radio' value='1' $chk1 />";

    echo "<input type='radio' name='my-option-radio' value='2' $chk2 />";

    
}

$plugindir = plugin_dir_url( __FILE__ );

// Add settings link on plugin page
function your_plugin_settings_link($links) { 
    
    
    
  $settings_link = '<a href="admin.php?page=tsingtao-pg%2Fmy-plugin-form.php">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__);

add_filter("plugin_action_links_$plugin", 'your_plugin_settings_link' );


