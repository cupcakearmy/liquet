<?php

get_header();
the_post();

include_once( 'loop-utils.php' );

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

                <div class="flex item grow" id="main">
                    <div class="flex container vertical middle">
                        <div class="box" id="header">
                            <h1 class="alt-font"><?= the_title() ?></h1>
                        </div>
                    </div>
                    <div class="flex container vertical middle" id="content">
                        <div class="flex container horizontal">
                            <div>
                                <b><?= $dates['created'] ?></b>
								<?php if ( $dates['different'] ) { ?>
                                    <br/>
                                    <small>updated on <?= $dates['modified'] ?></small>
								<?php } ?>
                            </div>
                            <div class="flex item grow"></div>
                            <div>
                                <b>~<?= do_shortcode( '[rt_reading_time]' ); ?> min</b>
                            </div>
                        </div>
                        <br><br>
						<?php the_content(); ?>
                        <br>
						<?php get_template_part( 'tags-list', get_post_format() ); ?>
                    </div>
                </div>

                <a class="flex item shrink links" href="<?= getNextURL( true ) ?>">
                    <div class="alt-font">next</div>
                </a>
            </div>
        </div>
    </div>
<?php get_footer(); ?>