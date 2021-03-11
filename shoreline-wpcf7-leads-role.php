<?php
/**
 * Plugin Name: Shoreline WPCF7 Redirect Role
 * Plugin URI: https://github.com/shorelinemedia/shoreline-wpcf7-redirect-editor-access
 * Description: Allow users with the 'manage_others_posts' capabilities to see Leads from WPCF7 Leads plugin
 * Author: Shoreline Media Marketing
 * Author URI: https://shoreline.media
 * Version: 1.0
 * Text Domain: shoreline-wpcf7-leads-role
 * Domain Path: /languages
 * License: GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * GitHub Plugin URI: https://github.com/shorelinemedia/shoreline-wpcf7-leads-role
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( !function_exists( 'sl9_wpcf7_leads_role_init' ) ) {
    function sl9_wpcf7_leads_role_init() {
        $wpcf7_lead_exists = class_exists( 'WPCF7R_Post_Types' );
        $default_cap = 'edit_others_posts';
        
        // Get the role capability to scope the menu to-- can adjust with an option
        if ( is_multisite() ) {
            $wpcf7_leads_cap = get_site_option( 'sl9_wpcf7_leads_cap', $default_cap );
        } else {
            $wpcf7_leads_cap = get_option( 'sl9_wpcf7_leads_cap', $default_cap );
        }

        if ( $wpcf7_lead_exists ) {
            // Remove the submenu
            remove_submenu_page( 'wpcf7', 'edit.php?post_type=wpcf7r_leads' );
            // Re-add submenu
            add_submenu_page( 'wpcf7', 'Leads', 'Leads', $wpcf7_leads_cap, 'edit.php?post_type=wpcf7r_leads' );           
        }

    }
    // Kick off after admin_menu, which is when the plugin adds submenu
    add_action( 'admin_menu', 'sl9_wpcf7_leads_role_init', 20 );
}
