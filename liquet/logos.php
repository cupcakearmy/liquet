<?php

$links = [ 'medium', 'github', 'twitter', 'website' ];

function render_links( $expanded = false ) {
	global $links;
	?>
    <div id="logos">
		<?php if ( $expanded ) { ?>
            <div class="title alt-font">
                <a class="made-by-link" target="_blank" href="https://github.com/cupcakearmy/liquet">made with ❤️ by @cupcakearmy</a>
                discuss & share
                <br/>
                <img src="<?= get_template_directory_uri() . '/vendor/icons/down.svg' ?>" alt="arrow down"/>
            </div>
		<?php } ?>
        <div class="list flex container horizontal middle center">
			<?php
			foreach ( $links as $link ) {
				$saved = get_option( $link . '_url' );
				if ( $saved ) { ?>
                    <a href="<?= $saved ?>" target="_blank" rel="noopener">
                        <img src="<?= get_template_directory_uri() . '/vendor/logos/' . $link . '.png' ?>"
                             alt="<?= $link; ?>" rel="noopener"/>
                    </a>
				<?php }
			}
			?></div>
    </div>
	<?php
}