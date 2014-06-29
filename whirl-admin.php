<?php
/**
 * Plugin Name: Whirl Sites Admin Plugin
 * Plugin URI: http://www.whirlsites.com
 * Description: This plugin is required for all Whirl Sites clients and adds special site functionality.
 * Author: Whirl Sites
 * Author URI: http://www.whirlsites.com
 * Version: 1.1.1
 */
 
// GitHub Updates

// Update Test
 
include_once('updater.php');

if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
    $config = array(
        'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
        'proper_folder_name' => 'whirl-admin', // this is the name of the folder your plugin lives in
        'api_url' => 'https://api.github.com/repos/whirlsites/whirl-admin', // the github API url of your github repo
        'raw_url' => 'https://raw.github.com/whirlsites/whirl-admin/master', // the github raw url of your github repo
        'github_url' => 'https://github.com/whirlsites/whirl-admin', // the github url of your github repo
        'zip_url' => 'https://github.com/whirlsites/whirl-admin/zipball/master', // the zip url of the github repo
        'sslverify' => true, // 
        'requires' => '3.0', // which version of WordPress does your plugin require?
        'tested' => '3.3', // which version of WordPress is your plugin tested up to?
        'readme' => 'readme.txt' // which file to use as the readme for the version number
    );
    new WP_GitHub_Updater($config);
}

// Child Page Conditional

function is_subpage() {
    global $post;                              // load details about this page

    if ( is_page() && $post->post_parent ) {   // test to see if the page has a parent
        return $post->post_parent;             // return the ID of the parent post

    } else {                                   // there is no parent so ...
        return false;                          // ... the answer to the question is false
    }
}

// Remove WordPress Version

remove_action( 'wp_head', 'wp_generator' );

// Add Dashboard Widget

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'Whirl Sites', 'custom_dashboard_help');
}

function custom_dashboard_help() {
echo '<p>Welcome to your Whirl Site! Need help? Contact us at <a href="mailto:help@whirlsites.com">here</a>.</p>';
}

// Theme Customizer

function whirl_custom( $wp_customize ) {
  //All our sections, settings, and controls will be added here
}
add_action( 'customize_register', 'whirl_custom' );

?>