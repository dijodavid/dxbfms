<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Extending core controller
 * @author Dijo David
 * 
 */

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		
		//load library
		$this->load->library('session');
		
		//only admin can access
		if(!$this->ion_auth->logged_in() && $this->router->fetch_class() != "auth" && !$this->ion_auth->is_admin())
		{
			$excluded = array("api"); //list of excluded controllers
			
			if( !in_array($this->router->fetch_class(), $excluded) )
			{
				$this->set_message("Please login as admin to continue.", "error");
				redirect(base_url()."auth/login");
			}
		}
    }
	
	/**
	 * To check whether the method called using Ajax
	 */
	public function is_ajax()
	{
		if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	/**
	 * Only admin can execute the following code
	 * Otherwise it will redirect to the index page
	 */
	protected function only_admin()
	{
		$controller = $this->router->fetch_class();
		$redirect_uri = $controller."/index";
		$redirect_uri = ($this->ion_auth->logged_in()) ? base_url() : "auth/login";
				
		if( !$this->ion_auth->is_admin())
		{
			$this->set_message("Please login as admin to continue.", "error");
			$this->session->set_flashdata('redirect', current_url()); //set to redirect to the page after login
			redirect($redirect_uri);
		}
	}
	
	/**
	 * Only logged in users can access the page
	 * Otherwise it will redirect to the login page
	 */
	public function only_registered()
	{
		$redirect_uri = "auth/login";
				
		if( !$this->ion_auth->logged_in() )
		{
			$this->set_message("Please login to continue.", "error");
			redirect($redirect_uri);
		}
	}
	
	
	/**
	 * Set flash message to show in the redirected page. 
	 * 
	 * @param string message
	 * @param string type - warning, error, success, info
	 * @return void
	 */
	public function set_message($message = FALSE, $type = "warning")
	{
		if($message)
		{
			$this->session->set_flashdata('msg_popup',$message);
			$this->session->set_flashdata('msg_type',strtolower($type));
		}
	}
	
	/**
	 * Generate drop-down list array from result object.
	 * 
	 * @param object - result object
	 * @param string $val_column - the value column in database
	 * 
	 * @return array
	 */
	public function get_dropdown_array($result_obj, $val_column="name")
	{
		$result = array();
		
		if($result_obj)
		{
			foreach ($result_obj as $item) 
			{
				$result[$item->id] = $item->{$val_column};	
			}
		}
		$result[0] = "Please Select";
		
		ksort($result); //sort in ascending order, according to the key
		
		return $result;
	}
	
	
	/**
	 * Get user id of the logged in user
	 * 
	 */
	function user_id()
	{
		return ($this->ion_auth->logged_in()) ? $this->ion_auth->user()->row()->id : false;
	}
	
        /**
         * Validating function for dropdown list
         * @param type $str
         * @return type 
         * Added by : SIMI D S
         * date     : 07-11-2013
         */
        
    public function dropdown_validation($str)
	{
            
		if ($str =='0')
		{
			$this->form_validation->set_message('dropdown_validation', 'The %s field is required');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    
    /** 
 *    Method is used to validate strings to allow alpha
 *    numeric spaces underscores and dashes ONLY.
 *    @param $str    String    The item to be validated.
 *    @return BOOLEAN   True if passed validation false if otherwise.
 *    Added by : SIMI D 
 *    date     : 20-11-2013  
 */
	function _alpha_dash_space($str_in = '')
	{
	    if (! preg_match("/^([-a-z0-9_()\[\]\/ ])+$/i", $str_in) && !empty($str_in))
	    {
	        $this->form_validation->set_message('_alpha_dash_space', 'The %s field may only contain alpha-numeric characters, spaces, underscores, and dashes.');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	} 

	
	/**
	 * validate for existing member id 
	 */
	public function validate_member_id($member_id)
	{
		$this->load->model('member');
		
		$member = $this->member->get_by_column(array('member_id'=>  strtoupper($member_id)));

		if ($member->num_rows())
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('validate_member_id', 'The %s is invalid or no such member exists.');
			return FALSE;
		}
	}
	
	/**
	 * validate for existing club 
	 */
	public function validate_club_name($club)
	{
		$this->load->model('club');
		
		$club = $this->club->get_by_column(array('name'=>  strtoupper($club)));

		if ($club->num_rows())
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('validate_club_name', 'The %s is invalid or no such club exists.');
			return FALSE;
		}
	}


	public function compare_dates($last_date, $first_date)
	{
	  	$first_date = strtotime($first_date);
	  	$last_date  = strtotime($last_date);
	  
	  	if($first_date >= $last_date)
	  	{
		    $this->form_validation->set_message('compare_dates', 'The Expiry Date must be greater than the Joining Date.');
		    return false;
  		}
	
	  return true;
	}
	
}