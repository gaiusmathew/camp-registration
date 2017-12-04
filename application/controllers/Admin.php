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
		$this->load->helper( array( 'url' ) );
	}

	/**
	 * Admin index page.
	 *
	 * @access public
	 *
	 * @return mixed
	 */
	public function index() {

		$this->reporting();
	}

	/**
	 * Admin reporting page.
	 *
	 * By default render registration form with all required
	 * fields and elements.
	 *
	 * @access public
	 *
	 * @return mixed
	 */
	public function reporting() {

		$this->load->model( 'front/registration_model' );

		// Get churches list.
		$data['churches'] = $this->registration_model->get_churches();

		// Render html.
		$this->load->view( 'back/common/header' );
		$this->load->view( 'back/reporting', $data );
		$this->load->view( 'back/common/footer' );
	}

	public function get_attendees() {

		$this->load->library( array( 'Datatables' ) );

		$this->datatables->select( 'id, name, church, age, gender, accommodation' )
			->from( 'registration' );
			//->join('quiz_fbusers', 'quiz_results.fb_id = quiz_fbusers.fb_id')
			//->where('quiz_results.id_quiz =', $id );

		echo $this->datatables->generate();
	}
}
