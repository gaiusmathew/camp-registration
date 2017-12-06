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
	 * Delete and attendee in emergency.
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function delete_attendee( $id ) {

		// Get the id from url.
		$id = $this->uri->segment( 4 );

		// Do not continue if valid id is not found.
		if ( empty( $id ) ) {
			redirect( 'admin' );
		}

		$this->load->model( 'front/registration_model' );

		// Attempt to delete attendee.
		if ( $this->registration_model->delete_attendee( base64_decode( $id ) ) ) {
			$this->session->set_flashdata( 'success', 'Attendee deleted.' );
		} else {
			$this->session->set_flashdata( 'error', 'Oops! Could not delete the attendee.' );
		}

		redirect( 'admin' );
	}
}
