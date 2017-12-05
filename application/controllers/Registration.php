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
		$this->load->helper( array( 'url', 'user' ) );
		$this->load->model( 'front/registration_model' );

		// Force login.
		force_login();
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
				// Set success message.
				$data['success'] = 'Registration successful!';
			} else {
				// Set error message.
				$data['error'] = 'Oh nah! Registration failed.';
			}
		}

		// Get churches list.
		$data['churches'] = $this->registration_model->get_churches();
		$data['dates'] = $this->get_active_dates();

		// Render html.
		$this->load->view( 'front/common/header' );
		$this->load->view( 'front/register', $data );
		$this->load->view( 'front/common/footer' );
	}

	/**
	 * Get classess to disable dates
	 * @return array
	 */
	private function get_active_dates() {

		$days_class = array();
		$today = strtotime( 'today' );;

		$days = array(
			1 => '04-12-2017',
			2 => '05-12-2017',
			3 => '26-12-2017',
			4 => '27-12-2017',
		);

		foreach ( $days as $key => $day ) {
			if( strtotime( $day ) < $today ) {
				$days_class[ $key ] = 'disabled';
			} else {
				$days_class[ $key ] = '';
			}
		}

		return $days_class;
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

		// Insert attendee personal data and get attendee id.
		$attendee_id = $this->registration_model->register( $data );
		// If attendee added, insert date and time.
		if ( $attendee_id ) {
			$this->insert_dates_time( $attendee_id, $this->input->post( 'day' ) );
		}

		return ( ! empty( $attendee_id ) );
	}

	/**
	 * Set date and time values.
	 *
	 * Get date and time data from form and format
	 * it to match db field.
	 *
	 * @param int $attendee_id Attendee ID.
	 * @param array $dates Dates field value.
	 *
	 * @access private
	 *
	 * @return mixed
	 */
	private function insert_dates_time( $attendee_id, $dates ) {

		//echo '<pre>'; print_r($days); exit;

		// Do not continue if date data is empty.
		if ( empty( $dates ) || ! is_array( $dates ) ) {
			return false;
		}

		$date['attendee_id'] = $attendee_id;
		// Loop through each days.
		for ( $i = 1; $i <= 4; $i++ ) {
			// If the attendee is not available on this day.
			$date[ 'day' . $i ] = isset( $dates[ $i ][ 'available' ] ) ? 1 : 0;
		}

		// Get date id after inserting date.
		$date_id = $this->registration_model->insert_dates( $date );

		// If dates added, insert timing too.
		if ( $date_id ) {
			$timing = array();
			for ( $i = 1; $i <= 4; $i++ ) {
				$timing[] = array(
					'date_id' => $date_id,
					'day' => $i,
					'breakfast' => isset( $dates[ $i ][ 'breakfast' ] ) ? 1 : 0,
					'lunch' => isset( $dates[ $i ][ 'lunch' ] ) ? 1 : 0,
					'tea' => isset( $dates[ $i ][ 'tea' ] ) ? 1 : 0,
					'supper' => isset( $dates[ $i ][ 'supper' ] ) ? 1 : 0,
				);
			}

			$this->registration_model->insert_timings( $timing );
		}
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
		$this->form_validation->set_rules( 'day', 'day', 'callback_dates_required');

		return $this->form_validation->run();
	}

	/**
	 * Custom callback for dates validation.
	 *
	 * Set custom message for dates and timing.
	 *
	 * @param array $value Dates field value.
	 *
	 * @return bool
	 */
	public function dates_required( $value ) {

		$this->form_validation->set_message(
			'dates_required',
			'Why not attending any sessions? Please select dates and time.'
		);

		return true;
		echo '<pre>'; print_r($value); exit;

		return ! empty( $value );
	}
}
