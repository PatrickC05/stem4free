<?php

require('inc/register-menus.php');
require('inc/helper-functions.php');
require('inc/customizer.php');
require('inc/home-cpt.php');

function s4f_script_enqueue()
{
    wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/master.min.css', false, NULL, 'all' );
    wp_enqueue_style('google_fonts', 'https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Roboto+Mono:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap', false, NULL, 'all' );
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css', false, NULL, 'all' );
}

add_action('wp_enqueue_scripts', 's4f_script_enqueue');

function remove_admin_bar() {
    show_admin_bar(false);
}

add_action('after_setup_theme', 'remove_admin_bar');