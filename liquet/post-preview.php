<?php

include_once('loop-utils.php');

$dates = getDates();
?>

<a href="<?= get_permalink() ?>" class="item">
    <div class="flex container vertical">

        <h2 class="alt-font title"><?php the_title(); ?></h2>
        <div class="flex container horizontal">
            <div>
                <?= $dates['created'] ?>
            </div>
            <div class="flex item grow"></div>
            <div>
                ~<?= do_shortcode('[rt_reading_time]'); ?> min
            </div>
        </div>
        <?php if(has_excerpt()){
            the_excerpt();
        } ?>
    </div>
</a>
<hr/>