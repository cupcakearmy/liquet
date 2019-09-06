<?php

include_once( 'logos.php' );

add_theme_support( 'align-wide' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );


add_filter( 'wp_headers', function ( $headers ) {
	$headers['Content-Security-Policy']   = "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self' data: https://s.w.org; report-uri csp@nicco.io";
	$headers['X-Content-Type-Options']    = 'nosniff';
	$headers['X-Frame-Options']           = "deny";
	$headers['Strict-Transport-Security'] = "max-age=31536000";
	$headers['Referrer-Policy']           = "origin";

	return $headers;
} );

add_action( 'wp_enqueue_scripts', function () {
	// JS
	wp_enqueue_script( 'liquet-main', get_template_directory_uri() . '/js/main.js' );

	// CSS
	wp_enqueue_style( 'flex', get_template_directory_uri() . '/css/flex.css' );
	wp_enqueue_style( 'liquet', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'liquet-home', get_template_directory_uri() . '/css/home.css' );
	wp_enqueue_style( 'liquet-singular', get_template_directory_uri() . '/css/singular.css' );
	wp_enqueue_style( 'liquet-logos', get_template_directory_uri() . '/css/logos.css' );
	wp_enqueue_style( 'fonts', get_template_directory_uri() . '/vendor/fonts/import.css' );

	// Lazy loading
	global $wp_query;
	wp_register_script( 'lazy_loading', get_template_directory_uri() . '/js/lazy_load.js', array( 'jquery' ) );
	wp_localize_script( 'lazy_loading', 'lazy_load_params', array(
		'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts'        => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
		'max_page'     => $wp_query->max_num_pages
	) );

	wp_enqueue_script( 'lazy_loading' );
} );


function lazy_load_ajax_handler() {
	$args                = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged']       = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
	query_posts( $args );

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'post-preview', get_post_format() );
		}
	}
	die;
}

add_action( 'wp_ajax_lazy_load', 'lazy_load_ajax_handler' );
add_action( 'wp_ajax_nopriv_lazy_load', 'lazy_load_ajax_handler' );

add_action( 'widgets_init', function () {

	register_sidebar( array(
		'name'          => 'Below posts',
		'id'            => 'below_posts',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="alt-font">',
		'after_title'   => '</h3>',
	) );

} );


add_action( 'admin_init', function () {
	add_settings_section( 'section-link', 'Links', null, 'theme-options' );

	global $links;
	foreach ( $links as $link ) {

		$id = $link . '_url';
		add_settings_field( $id, ucfirst( $link ) . ' Url', function () use ( $id ) { ?>
            <input type="text" name="<?= $id ?>" id="<?= $id ?>" value="<?= get_option( $id ); ?>"/>
		<?php }, 'theme-options', 'section-link' );

		register_setting( 'section-link', $id );
	}

	add_settings_section( 'section-views', 'View counter', null, 'theme-options' );

	add_settings_field( 'view_min', 'Show view counter if views are above:', function () { ?>
        <input type="text" name="view_min" id="view_min" value="<?= (int) get_option( 'view_min' ) ?>"/>
	<?php }, 'theme-options', 'section-views' );

	register_setting( 'section-views', 'view_min' );

} );

function theme_settings_page() { ?>
    <div class='wrap'>
        <h1>Theme Panel</h1>
        <form method="post" action="options.php">
			<?php
			settings_fields( 'section-link' );
			settings_fields( 'section-views' );
			do_settings_sections( 'theme-options' );
			submit_button();
			?>
        </form>
    </div>
<?php }

function add_theme_menu_item() {
	add_menu_page( 'Theme Panel', 'Theme Panel', 'manage_options', 'theme-panel', 'theme_settings_page', null, 99 );
}

add_action( 'admin_menu', 'add_theme_menu_item' );