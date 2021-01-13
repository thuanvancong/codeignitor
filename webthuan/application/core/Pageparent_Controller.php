<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pageparent_Controller extends CI_Controller {

	public function __construct() {
    parent::__construct();
    // Start the session
    if (!isset($_SESSION)) { session_start(); }
    $check_role = false;    
    // $this->uri->segment(1); // controller
    // $this->uri->segment(2); // action
    // $this->uri->segment(3); // 1stsegment
    // $this->uri->segment(4); // 2ndsegment
    //$user = $_SESSION['user']['user_id'];
    if(!is_null($_SESSION['user']['user_id']))
    {
        $user = $_SESSION['user']['user_id'];
        $Controller = $this->uri->segment(1);
        $Action = $this->uri->segment(2);
        $curent_request = $Controller.'/'.$Action;
        $userRole=$this->checkRoleUser();
        $message_403 = "You don't have access to this page.";
        if(in_array($curent_request, $userRole) || $Controller == 'login' || $Action == 'ajaxCheckLogin' || $user==1)
        {
          $check_role = true;
        }
        else
        {
          show_error($message_403 , 403 );
        }
    }
    else
    {
        $_SESSION = array(
            'user' => 0
        );
        //redirect('Login_Controller/pageLogin', 'refresh');
    }
    // if($check_role == false) {
    // //show_error($message_403 , 403 );
    // }
  }
  function checkRoleUser()
  {
    $user=$_SESSION['user']['user_id'];
    $this->load->model("quanlytrungtam_model");
    $data=$this->quanlytrungtam_model->getRouterByUserID($user);
    $ArrayUserRole = array();
    foreach ($data as $key => $value) {
      $ArrayUserRole[] = $value['router'];
    }
    return $ArrayUserRole;
  }
}

