<?php
get_header();

$obj = get_queried_object();
$type = get_class($obj);

switch ($type) {
    case 'WP_Term':
        $types = [
            'post_tag' => 'tag',
            'category' => 'category'
        ];
        $alt_title = $obj->slug;
        $alt_subtitle = $types[$obj->taxonomy];
        break;
    case 'WP_User':
        $alt_title = $obj->display_name;
        $alt_subtitle = 'author';
        break;
    default:
        $alt_title = null;
        break;
}
?>
    <div id="home">
        <div class="flex container vertical middle" id="list-header">
            <a class="gohome" href="<?= site_url(); ?>">
                <span class="alt-font"><?= get_bloginfo('name'); ?></span>
            </a>
            <div id="header">
                <h1><?= $alt_title ?></h1>
                <h3><?= $alt_subtitle ?></h3>
            </div>
        </div>
        <div class="flex container horizontal center" id="list-container">
            <div id="list">
                <?php
                while (have_posts()) {
                    the_post();
                    get_template_part('post-preview', get_post_format());
                }
                ?>
            </div>
        </div>
        <div class="spacer"></div>
    </div>
<?php get_footer(); ?>