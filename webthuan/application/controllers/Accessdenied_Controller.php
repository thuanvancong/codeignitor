<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accessdenied_Controller extends CI_Controller {

  public function __construct() {

    parent::__construct();

    // load base_url
    $this->load->helper('url');
  }

  public function index()
  {
    $data['pageName'] ='accessdenied';
    $this->load->view("quanlytrungtam/layout_accessdenied",$data);
  }

}