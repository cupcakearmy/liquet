<?php
$tags = get_the_tags();
if ($tags) { ?>
    <div class="tags">
        <?php foreach ($tags as $tag) { ?>
            <a class="tag" href="<?= get_tag_link($tag->term_id); ?>"><?= $tag->name; ?></a>
        <?php } ?>
    </div>
<?php }
