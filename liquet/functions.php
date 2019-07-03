<?php

include_once( 'logos.php' );

add_theme_support( 'align-wide' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'flex', get_template_directory_uri() . '/css/flex.css' );
	wp_enqueue_style( 'liquet', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'liquet-home', get_template_directory_uri() . '/css/home.css' );
	wp_enqueue_style( 'liquet-singular', get_template_directory_uri() . '/css/singular.css' );
	wp_enqueue_style( 'liquet-logos', get_template_directory_uri() . '/css/logos.css' );
	wp_enqueue_style( 'fonts', get_template_directory_uri() . '/vendor/fonts/import.css' );
} );

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