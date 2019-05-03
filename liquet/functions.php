<?php

add_theme_support( 'align-wide' );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'flex', get_template_directory_uri() . '/css/flex.css' );
	wp_enqueue_style( 'liquet', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'liquet-home', get_template_directory_uri() . '/css/home.css' );
	wp_enqueue_style( 'liquet-singular', get_template_directory_uri() . '/css/singular.css' );
	wp_enqueue_style( 'fonts', get_template_directory_uri() . '/vendor/fonts/import.css' );
} );