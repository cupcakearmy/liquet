<?php

$links = [ 'medium', 'github', 'twitter', 'website' ];

function render_links() {
	global $links;
	?>
    <div class="flex container horizontal middle center" id="logos"><?php
	foreach ( $links as $link ) {
		$saved = get_option( $link . '_url' );
		if ( $saved ) { ?>
            <a href="<?= $saved ?>" target="_blank">
                <img src="<?= get_template_directory_uri() . '/vendor/logos/' . $link . '.png' ?>"
                     alt="<?= $link; ?>"/>
            </a>
		<?php }
	}
	?></div><?php
}