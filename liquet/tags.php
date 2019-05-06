<?php

function render_all_tags() {
	$tags = get_tags( [ 'orderby' => 'count', 'order' => 'desc' ] );

	if ( $tags ) { ?>
        <div class="tags">
			<?php foreach ( $tags as $tag ) { ?>
                <a class="tag" href="<?= get_tag_link( $tag->term_id ); ?>"><?= $tag->name; ?>
                    <b><?= $tag->count ?></b></a>
			<?php } ?>
        </div>
	<?php }
}

function render_current_tags() {
	$tags = get_the_tags();
	if ( $tags ) { ?>
        <div class="tags">
			<?php foreach ( $tags as $tag ) { ?>
                <a class="tag" href="<?= get_tag_link( $tag->term_id ); ?>"><?= $tag->name; ?></a>
			<?php } ?>
        </div>
	<?php }
}