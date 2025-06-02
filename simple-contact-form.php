<?php

/*
 * Plugin Name:       Simple Contact Form
 * Plugin URI:        https://github.com/parham-arianezhad/simple-contact-form
 * Description:       A lightweight and user-friendly contact form plugin for WordPress. Easily add a responsive contact form to any page using a simple shortcode.
 * Version:           1.0.0
 * Author:            Parham Arianezhad
 * Author URI:        https://www.linkedin.com/in/parham-arianezhad/
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       simple-contact-form
 * Domain Path:       /languages
 */

// Prevent direct access to the file for security
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


/**
 * Enqueue plugin styles.
 *
 * Loads the contact form CSS file on the front-end.
 */
function scf_enqueue_styles() {
    wp_enqueue_style(
        'scf_styles', plugin_dir_url( __FILE__ ) . '/assets/css/contact-form.css'
    );
    wp_enqueue_script( 'scf_scripts', plugin_dir_url( __FILE__ ) . '/assets/js/contact-form.js');
}
add_action('wp_enqueue_scripts', 'scf_enqueue_styles');


/**
 * Shortcode callback to display the contact form.
 *
 * Uses output buffering to include the form template and return its content.
 *
 * @return string HTML content of the contact form.
 */
function scf_contact_form_shortcode() {
    ob_start();
    include( plugin_dir_path( __FILE__ ) . '/includes/contact-form.php' );
    return ob_get_clean();
}
add_shortcode( 'scf_contact_form', 'scf_contact_form_shortcode' );

?>