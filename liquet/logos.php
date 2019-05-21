<?php

$links = [ 'medium', 'github', 'twitter', 'website' ];

function render_links( $expanded = false ) {
	global $links;
	?>
    <div id="logos">
	<?php if ( $expanded ) { ?>
        <div id="title" class="alt-font">
        discuss & share
        <br/>
        <img src="<?= get_template_directory_uri() . '/vendor/icons/down.svg' ?>"
             alt="arrow down"/>
        </div>
    <?php } ?>
    <div class="flex container horizontal middle center" id="list">
		<?php
		foreach ( $links as $link ) {
			$saved = get_option( $link . '_url' );
			if ( $saved ) { ?>
                <a href="<?= $saved ?>" target="_blank">
                    <img src="<?= get_template_directory_uri() . '/vendor/logos/' . $link . '.png' ?>"
                         alt="<?= $link; ?>"/>
                </a>
			<?php }
		}
		?></div>
    </div><?php
}