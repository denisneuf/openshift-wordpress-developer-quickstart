<?php
/**
* This is where you can copy and paste your functions !
*/

// -----------------------------------------------
// Excluir disable_wp_emojicons
// -----------------------------------------------

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

// -----------------------------------------------
// Remove wp_generator
// -----------------------------------------------

remove_action('wp_head', 'wp_generator');

// -----------------------------------------------
// Remove wlwmanifest_link rsd_link index_rel_link
// -----------------------------------------------

remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.

// -----------------------------------------------
// Remove EditURI
// -----------------------------------------------

remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link

// -----------------------------------------------
// Remove comments/feed/ /feed/ application/rss+xml
// -----------------------------------------------

remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed

// -----------------------------------------------
// Remove https://api.w.org/ wp-json
// -----------------------------------------------

remove_action( 'wp_head', 'rest_output_link_wp_head' );

// -----------------------------------------------
// Remove wp-embed.min.js
// -----------------------------------------------

remove_action( 'wp_head', 'wp_oembed_add_host_js' );

// Remove WP Version From Styles    
add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );
// Remove WP Version From Scripts
//add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );

// Function to remove version numbers
function sdt_remove_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}


function starter_customize_register( $wp_customize ) 
{
    $wp_customize->add_section( 'starter_new_section_name' , array(
        'title'    => __( 'Fuentes', 'starter' ),
        'priority' => 30
    ) );   

    $wp_customize->add_setting( 'starter_new_setting_name' , array(
        'default'   => '#000000',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
        'label'    => __( 'Header Color', 'starter' ),
        'section'  => 'starter_new_section_name',
        'settings' => 'starter_new_setting_name',
    ) ) );
}


add_action( 'customize_register', 'starter_customize_register');


function mytheme_customize_css()
{
    
    
    wp_enqueue_style( 'bohn-fonts-style', get_stylesheet_directory_uri() .'/font.css?ver=4af097a1b94d48466873848234463dd2');
    

}
add_action( 'wp_enqueue_scripts', 'mytheme_customize_css');

    // No "Quick Tips" on the homepage
function preventHomepageTips($query) {
	if($query->is_home() && $query->is_main_query()) {
		$query->set('cat', '-4'); // 40 is Quick Tips's category ID
	}
}
add_action('pre_get_posts', 'preventHomepageTips');