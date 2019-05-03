<?php

function getNextURL( $next ) {
	$post = get_adjacent_post( true, '', ! $next, 'post_tag' );
	if ( ! $post ) {
		$post = get_adjacent_post( false, '', ! $next, 'post_tag' );
	}

	return ( $post ? get_permalink( $post->ID ) : get_bloginfo( 'wpurl' ) );
}

function getDates() {
	$created_year  = get_the_date( 'Y' );
	$created       = get_the_date( ( $created_year == date( 'Y' ) ? 'F j' : null ) );
	$modified_year = get_the_modified_date( 'Y' );
	$modified      = get_the_modified_date( ( $modified_year == $created_year ? 'F j' : null ) );

	return [
		'created'  => $created,
		'modified' => $modified,
		'different'     => $created != $modified,
	];
}