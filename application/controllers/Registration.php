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
	 *
	 * @return void
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

		// Load form helper and validation library
		$this->load->helper( 'form' );

		// Validate form.
		if ( $this->validate() ) {

			// Attempt to insert registration data.
			if ( $this->insert() ) {

				// Registration was success.
				$response = array(
					'success' => true,
					'message' => alert_html( 'Registration successful!' ),
				);

			} else {

				// Registration was a failure.
				$response = array(
					'success' => false,
					'errors' => alert_html( 'Registration failed. Try again.' ),
				);
			}

		} else {

			// Validation failed.
			$response = array(
				'success' => false,
				'errors' => validation_errors(),
			);
		}

		// Echo json back to ajax request.
		echo json_encode( $response );
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
			'gender' => $this->input->post( 'username' ) === 'F' ? 'F' : 'M',
			'age' => (int) $this->input->post( 'age' ),
			'accommodation' => empty( $this->input->post( 'accommodation' ) ) ? 0 : 1,
			'hot_water' => empty( $this->input->post( 'hot_water' ) ) ? 0 : 1,
			'milk' => empty( $this->input->post( 'milk' ) ) ? 0 : 1,
		);

		return $this->registration_model->register( $data );
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

		$this->load->library( 'form_validation' );

		// Set validation rules.
		$this->form_validation->set_rules( 'church', 'Church', 'trim|required|integer' );
		$this->form_validation->set_rules( 'name', 'Name', 'trim|required' );
		$this->form_validation->set_rules( 'age', 'Age', 'trim|required|integer' );
		$this->form_validation->set_rules( 'gender', 'Gender', 'trim|required|max_length[1]' );

		return $this->form_validation->run();
	}
}
