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

		// Accommodation filter.
		if ( $this->input->post( 'at_acco' ) !== '' ) {
			$acco = $this->input->post( 'at_acco' ) == 0 ? 0 : 1;
			$this->datatables->where( 'rg.accommodation', $acco );
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

		$this->datatables->edit_column( 'name', '$1', 'getCaps(name)' );
		// Add gender full text instead of short term from db.
		$this->datatables->edit_column( 'gender', '$1', 'getGender(gender)' );
		// Add status span for better visibility.
		$this->datatables->edit_column( 'accommodation', '$1', 'getAccommodation(accommodation)' );
		$this->datatables->add_column( 'delete', '$1', 'getDeleteLink(id)' );

		return $this->datatables->generate();
	}

	/**
	 * Get list of attendees to export.
	 *
	 * No pagination or limit. Export all!
	 *
	 * @access public
	 *
	 * @return array
	 */
	public function get_attendees_export() {

		// Start db query.
		$this->db->select( 'rg.id as id, rg.name, ch.name as church, age, gender, accommodation' );
		$this->db->from( 'registration as rg' );
		$this->db->join( 'churches as ch', 'rg.church = ch.id' );

		// Name filter.
		if ( $this->input->post( 'name' ) ) {
			$this->db->like( 'rg.name', trim( $this->input->post( 'name' ) ) );
		}

		// Church filter.
		if ( $this->input->post( 'church' ) ) {
			$this->db->where( 'rg.church', (int) $this->input->post( 'church' ) );
		}

		// Gender filter.
		if ( $this->input->post( 'gender' ) ) {
			$this->db->where( 'rg.gender', $this->input->post( 'gender' ) );
		}

		// Age filter.
		if ( $this->input->post( 'age_from' ) || $this->input->post( 'age_to' ) ) {
			$from = empty( $this->input->post( 'age_from' ) ) ? 1 : (int) $this->input->post( 'age_from' );
			$to = empty( $this->input->post( 'age_to' ) ) ? 120 : (int) $this->input->post( 'age_to' );
			$this->db->where( 'rg.age >=', $from );
			$this->db->where( 'rg.age <=', $to );
		}

		// Accommodation filter.
		if ( $this->input->post( 'accommodation' ) !== '' ) {
			$acco = $this->input->post( 'accommodation' ) == 0 ? 0 : 1;
			$this->db->where( 'rg.accommodation', $acco );
		}

		// Days and time filter.
		if ( $this->input->post( 'day' ) ) {
			$this->db->join( 'dates as dt', 'rg.id = dt.attendee_id' );
			// Get field name from day value.
			$day_field = $this->get_date_field( $this->input->post( 'day' ) );
			if ( $day_field ) {
				// Add day condtion.
				$this->db->where( 'dt.' . $day_field, '1' );

				// Time filter works only if you select day filter.
				if ( $this->input->post( 'time' ) ) {
					// Join timing table.
					$this->db->join( 'timing as ti', 'dt.id = ti.date_id' );
					// Get timing field name from value.
					$time_field = $this->get_time_field( $this->input->post( 'time' ) );
					if ( $time_field ) {
						// Add timing filter too.
						$this->db->where( 'ti.day', $this->input->post( 'day' ) );
						$this->db->where( 'ti.' . $time_field, '1' );
					}
				}
			}
		}

		return $this->db->get()->result();
	}

	/**
	 * Get day table field name from value.
	 *
	 * From day filter value, get proper field value in
	 * database table.
	 *
	 * @param int $value Day number.
	 *
	 * @access private
	 *
	 * @return bool|string
	 */
	private function get_date_field( $value ) {

		// Make sure it is number.
		$value = (int) $value;

		// Add day string and return the field name.
		return in_array( $value, array( '1', '2', '3', '4' ) ) ? 'day' . $value : false;
	}

	/**
	 * Get timing table field name from value.
	 *
	 * Get timing table field name from timing
	 * field value from filter.
	 *
	 * @param string $value Timing value.
	 *
	 * @access private
	 *
	 * @return bool|string
	 */
	private function get_time_field( $value ) {

		return in_array( $value, array( 'breakfast', 'lunch', 'tea', 'supper' ) ) ? $value : false;
	}
}
