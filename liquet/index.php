<?php get_header();

$tags = get_tags(['orderby' => 'count', 'order' => 'desc']);
//$tags = array_map(function ($tag) {
//    return [
//        'name' => $tag->name,
//        'slug' => $tag->slug,
//        'count' => $tag->count,
//    ];
//}, $tags)
?>
    <div id="home">
        <div class="flex container vertical middle" id="list-header">
            <div id="header">
                <a href="<?= get_bloginfo('wpurl'); ?>">
                    <h1><?= get_bloginfo('name'); ?></h1>
                    <h3><?= get_bloginfo('description'); ?></h3>
                </a>
            </div>
        </div>
        <div class="flex container horizontal center" id="list-container">
            <div id="list">
                <?php if ($tags) { ?>
                    <!--            <div class="flex container horizontal center" id="list-container">-->
                    <div class="tags">
                        <?php foreach ($tags as $tag) { ?>
                            <a class="tag" href="<?= get_tag_link($tag->term_id); ?>"><?= $tag->name; ?> <b><?= $tag->count ?></b></a>
                        <?php } ?>
                    </div>
                    <!--            </div>-->
                <?php } ?>
                <br/><br/><br/>
                <?php
                while (have_posts()) {
                    the_post();
                    get_template_part('post-preview', get_post_format());
                }
                ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>