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

/**
 * Get delete link for attendee.
 *
 * @param int $id Attendee ID.
 *
 * @return string
 */
function getDeleteLink( $id ) {

	if ( ! empty( $id ) ) {
		return '<a href="' . base_url( 'admin/delete/attendee/' . base64_encode( $id ) ) . '" class="delete" title="Delete now"><button type="button" class="btn btn-danger btn-xs">Delete</button></a>';
	}

	return '';
}