<?php
include_once( 'logos.php' );
include_once( 'tags.php' );

get_header();

$tags = get_tags( [ 'orderby' => 'count', 'order' => 'desc' ] );
?>
    <div id="home">
        <a id="lights" href="javascript:void(0);" onclick="window.toggleLights();">
            <img src="<?= get_template_directory_uri() . '/vendor/icons/contrast.svg' ?>" alt="lights"/>
        </a>
        <div class="flex container vertical middle" id="list-header">
            <div id="header">
                <a href="<?= get_bloginfo( 'wpurl' ); ?>">
                    <h1><?= get_bloginfo( 'name' ); ?></h1>
                    <h3><?= get_bloginfo( 'description' ); ?></h3>
                </a>
				<?php render_links(); ?>
            </div>
        </div>
        <div class="flex container horizontal center" id="list-container">
            <div id="list">
				<?php render_all_tags(); ?>
                <br/><br/><br/>
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'post-preview', get_post_format() );
				}
				?>
            </div>
        </div>
        <div class="spacer"></div>
    </div>
<?php get_footer(); ?>