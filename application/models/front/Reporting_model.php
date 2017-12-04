<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * Reporting model class.
 * 
 * @extends CI_Model
 */
class Reporting_model extends CI_Model {

	/**
	 * Initialise class and set its properties.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();

		$this->load->database();
	}

	/**
	 * Get list of attendees.
	 *
	 * Filter churches by district, state or country.
	 *
	 * @access public
	 *
	 * @param int $district District ID.
	 * @param int $state State ID.
	 * @param int $country Country ID.
	 *
	 * @return array
	 */
	public function get_attendees( $district = 0, $state = 0, $country = 0 ) {

		$this->db->from( 'registration' );

		return $this->db->get()->result_array();
	}
}
