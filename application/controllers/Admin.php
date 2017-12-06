<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * Admin base class.
 * 
 * @extends CI_Controller
 */
class Admin extends CI_Controller {

	/**
	 * Initialise class and set its properties.
	 * 
	 * @access public
	 */
	public function __construct() {

		parent::__construct();

		$this->load->library( array( 'session' ) );
		$this->load->helper( array( 'url', 'user' ) );

		// Force login.
		force_login();
	}

	/**
	 * Admin index page.
	 *
	 * By default render registration form with all required
	 * fields and elements.
	 *
	 * @access public
	 *
	 * @return mixed
	 */
	public function index() {

		$this->load->model( 'front/registration_model' );

		// Get churches list.
		$data['churches'] = $this->registration_model->get_churches();

		// Render html.
		$this->load->view( 'back/common/header' );
		$this->load->view( 'back/reporting', $data );
		$this->load->view( 'back/common/footer' );
	}

	/**
	 * Get attendees list based on the filters.
	 *
	 * Get the json output to display on datatables.
	 * This functions takes memory! Seriously.
	 * Filter the sql query and get the output based on
	 * the filters applied.
	 * Sorting and pagination will also be taken care by
	 * Datatables library.
	 *
	 * @access public
	 *
	 * @return string
	 */
	public function get_attendees() {

		$this->load->model( 'back/reporting_model' );

		// Generate output and display it.
		echo $this->reporting_model->get_attendees();
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
