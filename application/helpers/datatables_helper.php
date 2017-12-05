<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * Get gender full text from code.
 *
 * @param string $gender Gender code.
 *
 * @return string
 */
function getGender( $gender ) {

	return trim( $gender ) == 'F' ? 'Female' : 'Male';
}

/**
 * Get accommodation required full text from status.
 *
 * @param int $required Accommodation required?
 *
 * @return string
 */
function getAccommodation( $required ) {

	if ( boolval( $required ) ) {
		return '<small class="label bg-green">Required</small>';
	} else {
		return '<small class="label bg-red">Not required</small>';
	}
}