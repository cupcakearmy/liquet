<?php

include_once( 'loop-utils.php' );
include_once( 'logos.php' );
include_once( 'tags.php' );

get_header();
the_post();

$dates = getDates();

?>
    <div class="flex container vertical fill" id="singular">
        <div class="flex item shrink gohome">
            <a href="<?= get_bloginfo( 'wpurl' ); ?>">
                <span class="alt-font"><?= get_bloginfo( 'name' ); ?></span>
            </a>
        </div>
        <div class="flex item grow">
            <div class="flex container horizontal fill">
                <a class="flex item shrink links" href="<?= getNextURL( false ) ?>">
                    <div class="alt-font">previous</div>
                </a>

                <div class="flex item grow container vertical middle" id="main">

                    <!-- Title -->
                    <div class="flex container vertical middle">
                        <div class="box" id="header">
                            <h1 class="alt-font"><?= the_title() ?></h1>
                        </div>
                    </div>

                    <!-- Content Body -->
                    <div class="flex container vertical middle" id="content">

                        <!-- Reading time and date -->
						<?php if ( is_singular( 'post' ) ) : ?>
                            <div class="flex container horizontal">
                                <div>
                                    <b><?= $dates['created'] ?></b>
									<?php if ( $dates['different'] ) { ?>
                                        <br/>
                                        <small>updated on <?= $dates['modified'] ?></small>
									<?php } ?>
                                </div>
                                <div class="flex item grow"></div>
                                <div class="text-align-right">
                                    <b>~<?= do_shortcode( '[rt_reading_time]' ); ?> min</b>
									<?= getCurrentPageViews() ?>
                                </div>
                            </div>
                            <br><br>
						<?php endif; ?>

                        <!-- Content -->
						<?php the_content(); ?>
                    </div>

                    <!-- Tags -->
					<?php if ( is_singular( 'post' ) ) : ?>
                        <div class="auto-width text-align-center">
                            <br>
							<?php render_current_tags(); ?>
                            <br>
                        </div>
					<?php endif; ?>

                    <!-- Links -->
                    <div class="flex container vertical middle auto-width">
						<?php render_links( true ); ?>
                    </div>

                    <!-- Bottom Widgets -->
					<?php if ( is_singular( 'post' ) ) : ?>
						<?php if ( is_active_sidebar( 'below_posts' ) ) : ?>
                            <br><br><br><br><br><br>
                            <div class="auto-width widget-area text-align-center">
								<?php dynamic_sidebar( 'below_posts' ); ?>
                            </div>
						<?php endif; ?>
					<?php endif; ?>
                </div>

                <a class="flex item shrink links" href="<?= getNextURL( true ) ?>">
                    <div class="alt-font">next</div>
                </a>
            </div>
        </div>
    </div>
<?php get_footer(); ?>