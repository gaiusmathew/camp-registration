<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );

/**
 * Registration base class.
 * 
 * @extends CI_Controller
 */
class Registration extends CI_Controller {

	/**
	 * Initialise class and set its properties.
	 * 
	 * @access public
	 */
	public function __construct() {
		
		parent::__construct();

		$this->load->library( array( 'session' ) );
		$this->load->helper( array('url' ) );
		$this->load->model( 'front/registration_model' );
		
	}

	/**
	 * Registration form.
	 *
	 * By default render registration form with all required
	 * fields and elements.
	 *
	 * @access public
	 *
	 * @return mixed
	 */
	public function index() {

		// Load form helper.
		$this->load->helper( 'form' );

		// If form submitted, save data.
		if ( ! empty( $this->input->post( 'form_submitted' ) ) ) {
			if ( $this->register() ) {
				// Get churches list.
				$data['success'] = 'Registration successful!';
			}

			//print_r($_POST); exit;
		}

		// Get churches list.
		$data['churches'] = $this->registration_model->get_churches();

		// Render html.
		$this->load->view( 'front/common/header' );
		$this->load->view( 'front/register', $data );
		$this->load->view( 'front/common/footer' );
	}

	/**
	 * Process registration data.
	 *
	 * If validation passed, insert registration data
	 * to database afer proper formatting.
	 *
	 * @access private
	 *
	 * @return mixed
	 */
	public function register() {

		// Validate form.
		if ( $this->validate() ) {

			// Attempt to insert registration data.
			return $this->insert();

		}

		return false;
	}

	/**
	 * Format and insert registration data.
	 *
	 * Send registration data to registration model in
	 * valid format.
	 *
	 * @access private
	 *
	 * @return mixed
	 */
	private function insert() {

		// Registration data.
		$data = array(
			'church' => (int) $this->input->post( 'church' ),
			'name' => trim( $this->input->post( 'name' ) ),
			'gender' => $this->input->post( 'gender' ) === 'F' ? 'F' : 'M',
			'age' => (int) $this->input->post( 'age' ),
			'accommodation' => $this->input->post( 'accommodation' ) ? 1 : 0,
			'hot_water' => $this->input->post( 'hot_water' ) ? 1 : 0,
			'milk' => $this->input->post( 'milk' ) ? 1 : 0,
		);

		if ( $this->input->post( 'day1' ) ) {

		}

		return $this->registration_model->register( $data );
	}

	/**
	 * Set date values.
	 *
	 * @access private
	 *
	 * @return mixed
	 */
	private function set_dates() {


	}

	/**
	 * Validate registration form.
	 *
	 * Set validation rules using Codeigniter form validation
	 * feature and return boolean.
	 *
	 * @access private
	 *
	 * @return mixed
	 */
	private function validate() {

		// Load form validation helper.
		$this->load->library( 'form_validation' );

		// Set validation rules.
		$this->form_validation->set_rules( 'church', 'church', 'trim|required|integer' );
		$this->form_validation->set_rules( 'name', 'name', 'trim|required' );
		$this->form_validation->set_rules( 'age', 'age', 'trim|required|integer' );
		$this->form_validation->set_rules( 'gender', 'gender', 'trim|required|max_length[1]' );

		return $this->form_validation->run();
	}
}
