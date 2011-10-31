<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$this->config->load('storage');
		$status_file = $this->config->item('status_file');
		$data['status_messages'] = file_exists($status_file) ?
				nl2br(file_get_contents($status_file)) :
				'No status updates yet.';

		$this->load->view('index', $data);
	}

	public function update() {
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$message = $this->input->post('author').': '.$this->input->post('status')."\n";

			$this->config->load('storage');
			file_put_contents($this->config->item('status_file'), $message, FILE_APPEND);
		}

		$this->load->helper('url');
		redirect('/');
	}
}

