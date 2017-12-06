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
	 * @return array
	 */
	public function get_attendees() {

		// Load required libraries.
		$this->load->helper( 'datatables' );
		$this->load->library( array( 'Datatables' ) );

		// Start db query.
		$this->datatables->select( 'rg.id as id, rg.name, ch.name as church, age, gender, accommodation' );
		$this->datatables->from( 'registration as rg' );
		$this->datatables->join( 'churches as ch', 'rg.church = ch.id' );

		// Name filter.
		if ( $this->input->post( 'at_name' ) ) {
			$this->datatables->like( 'rg.name', trim( $this->input->post( 'at_name' ) ) );
		}

		// Church filter.
		if ( $this->input->post( 'at_church' ) ) {
			$this->datatables->where( 'rg.church', (int) $this->input->post( 'at_church' ) );
		}

		// Gender filter.
		if ( $this->input->post( 'at_gender' ) ) {
			$this->datatables->where( 'rg.gender', $this->input->post( 'at_gender' ) );
		}

		// Age filter.
		if ( $this->input->post( 'at_age_from' ) || $this->input->post( 'at_age_to' ) ) {
			$from = empty( $this->input->post( 'at_age_from' ) ) ? 1 : (int) $this->input->post( 'at_age_from' );
			$to = empty( $this->input->post( 'at_age_to' ) ) ? 120 : (int) $this->input->post( 'at_age_to' );
			$this->datatables->where( 'rg.age >=', $from );
			$this->datatables->where( 'rg.age <=', $to );
		}

		// Days and time filter.
		if ( $this->input->post( 'at_day' ) ) {
			$this->datatables->join( 'dates as dt', 'rg.id = dt.attendee_id' );
			// Get field name from day value.
			$day_field = $this->get_date_field( $this->input->post( 'at_day' ) );
			if ( $day_field ) {
				// Add day condtion.
				$this->datatables->where( 'dt.' . $day_field, '1' );

				// Time filter works only if you select day filter.
				if ( $this->input->post( 'at_time' ) ) {
					// Join timing table.
					$this->datatables->join( 'timing as ti', 'dt.id = ti.date_id' );
					// Get timing field name from value.
					$time_field = $this->get_time_field( $this->input->post( 'at_time' ) );
					if ( $time_field ) {
						// Add timing filter too.
						$this->datatables->where( 'ti.day', $this->input->post( 'at_day' ) );
						$this->datatables->where( 'ti.' . $time_field, '1' );
					}
				}
			}
		}

		// Add gender full text instead of short term from db.
		$this->datatables->edit_column( 'gender', '$1', 'getGender(gender)' );
		// Add status span for better visibility.
		$this->datatables->edit_column( 'accommodation', '$1', 'getAccommodation(accommodation)' );

		return $this->datatables->generate();
	}
}
