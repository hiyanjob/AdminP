<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admincontroller extends CI_Controller 

{
    /*Secret key is used for hashing the password with sha256 method of hash_hmac()*/
    public static $secretKey = "21232f297a57a5a743894a0e4a801fc3";
     function __construct()
     {
         parent::__construct();
          $this->load->library('mongo_db');
         $this->load->model('AdminModel');
	  }
	 
	public function index()	
    {
		$this->load->view('admin/index');
	}

    public function auth_login()
    {
	    $email = $this->security->xss_clean($this->input->post('email'));	    
        $password = $this->security->xss_clean($this->input->post('pwd'));      
	    $LumpData = array('email'=>$email,'password'=>$password);	        
	    $result = $this->AdminModel->validate($LumpData);	    
	       if(!empty($result))	    
	      { 
		      redirect('AdminController/dashboard');	    
	      }
		    
	      else	    
	      {
		     $this->session->set_flashdata('error_status','Wrong Email Id & Password combination.');	       
	         $this->load->view('admin/index');
		  } 
	                     
    }

	public function logout()
	{
	  	 redirect($this);
	}

    public function dashboard()
	{
		$this->load->view('admin/dashboard');
	}

    public function user()	
    {
	  $data['newUser'] = $this->AdminModel->getNewUser();      
      $this->load->view('admin/userdetails',$data);	
	}

	public function privileges()
	{
		$this->load->view('admin/guess_privileges');
	}

	public function guessUserManagement()
	{
		$this->load->view('admin/guess_usermgmt');
	}

	public function rewards()
	{
		$this->load->view('admin/rewards');
	}

	public function redemption()
	{
		$this->load->view('admin/redemption');
	}

	public function chatRoom()
	{
		$data['roomList'] = $this->AdminModel->getRoomList();
		//var_dump(json_encode($data));
		$this->load->view('admin/chat_room',$data);
	}

	public function badwords()
	{
		$this->load->view('admin/badwords');
	}

	public function feedback()
	{
		$this->load->view('admin/feedback');
	}

	public function customNotification()
	{
		$this->load->view('admin/notification_customnoti');
	}

	public function spamusers()
	{
		$this->load->view('admin/spam_users');
	}

	public function analytics()
	{
		$this->load->view('admin/analytics');
	}

	public function country()
	{
		$data['cntyList'] = $this->AdminModel->getCountryList(); 
		//var_dump($data);die;     
        $this->load->view('admin/countryMgmt',$data);
	}

	public function jtest()
   {

		$id = $this->uri->segment(3);
		$data['viewvaliduser'] = $this->AdminModel->getSingleUser($id); 
		//var_dump($data);die();
		$this->load->view('admin/jtest',$data);
	//    $this->load->view('admin/jtest');
   }

   public function userInactive($id)
	  {
	  	$this->AdminModel->updateInactiveUser($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/user');
	  }

	  public function userActive($id)
	  {
	  	$this->AdminModel->updateActiveUser($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/user');
	  }



	  public function countryInactive($id)
	  {
	  	$this->AdminModel->countryInactive($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/country');
	  }

	  public function countryActive($id)
	  {
	  	$this->AdminModel->countryActive($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/country');
	  }
	  public function chatRoomInactive($id)
	  {
	  	$this->AdminModel->chatRoomInactive($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/chatRoom');
	  }

	  public function chatRoomActive($id)
	  {
	  	$this->AdminModel->chatRoomActive($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/chatRoom');
	  }


	  public function cityInactive($id)
	  {
	  	$this->AdminModel->cityInactive($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/city');
	  }

	  public function cityActive($id)
	  {
	  	$this->AdminModel->cityActive($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/city');
	  }

	public function city()
	{
		$data['cityList'] = $this->AdminModel->getCityList(); 
		$i = 0;
	    foreach ($data['cityList'] as $key) {
	    	$cid[$i] = $key['cnryID'];
	        $name[] = $this->AdminModel->CountryName($cid[$i]);
	        $i++;
	    }
	//    var_dump($name);die();
		$data['cntry'] = $name;
		$this->load->view('admin/cityMgmt',$data);
	}

	// public function addCountry()
	// {
	// 	$this->load->view('admin/addcountry');
	// }

	public function addCity($_id = "")
	{
		if($_id !="")
        {
		$data['city'] = $this->AdminModel->getcityDetails($_id);
		$this->load->view('admin/addcity',$data);
		}
		else{
			$data['cntyList'] = $this->AdminModel->getCountryList(); 
            $this->load->view('admin/addcity',$data);
         }
	}
	

	public function insertCountry()
	{
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
        $this->form_validation->set_rules('countryName', 'countryName', 'required|trim|alpha_numeric_spaces|min_length[2]|max_length[25]',
          array(
                'required'      => 'You have not provided %s',
                'alpha'     => 'The %s Only used alphabetics'
         )

         );
        $this->form_validation->set_rules('code', 'code', 'required|trim|numeric',
          array(
                'required'      => 'You have not provided %s'              
          )

         );
       
       if ($this->form_validation->run() == FALSE)
       {
         $this->load->view('admin/addcountry');
       }  
       else{
			$data = array(
				'countryName' => $this->input->post('countryName') ,
				'code'=> $this->input->post('code'),
				'status' => 'Active',
				'createdAt' => date('d-m-Y H:i:s')
				 );
			$res = $this->AdminModel->checkCountry($data);
			if($res == 'true')
			{
				$this->AdminModel->insertCountryModel($data);
				$this->session->set_flashdata('Success','Country Added Successfully.');
	            redirect('AdminController/country');
			}
			else
			{
				$this->session->set_flashdata('Success','Country Name & Code Not Unique.');
	            redirect('AdminController/addCountry');

			}
	      }
	}

	public function insertCity()
	{
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
        $this->form_validation->set_rules('city', 'city', 'required|trim|min_length[3]|max_length[25]|alpha_numeric_spaces',
          array(
                'required'      => 'You have not provided %s' 
                , 'alpha'     => 'The %s Only used alphabetics'             
          )

         );
       
       if ($this->form_validation->run() == FALSE)
       {
         $this->load->view('admin/addcountry');
       }  
       else{
			$data = array(
				'cnryID' => $this->input->post('cnryID') ,
				'cityName'=> $this->input->post('city'),
				'status' => 'Active',
				'createdAt' => date('d-m-Y H:i:s')
				 );
			$res = $this->AdminModel->checkCity($data);

			if($res == 'true')
			{
				$this->AdminModel->insertCityModel($data);
				$this->session->set_flashdata('Success','City Added Successfully.');
	            redirect('AdminController/city');
			}
			else
			{
				$this->session->set_flashdata('Success','City Already Available In This Country.');
	            redirect('AdminController/addCity');

			}
		  }
	 }
	public function addroom()
	{
		$this->load->view('admin/addRoom');
	}

	public function getList()
    {
         $ID = $this->input->post('category');
         if($ID == 'Country')
         {
           echo $this->AdminModel->getCountry();
         }
         else{
         	echo $this->AdminModel->getCity();
         }
    }

    public function insertRoom()
    {
    	$data = array(
    		'type' => $this->input->post('type'),
    		'chatUSersId' => $this->input->post('id'),
    		'status' => 'Active',
			'createdAt' => date('d-m-Y H:i:s')
			 );
			 
			
    	$chk = $this->AdminModel->checkRoom($data);

    	if($chk == 'true' && $data['type'] == 'Country')
		{
				$name = $this->AdminModel->getCountryName($data);
				$this->AdminModel->insertRoomModel($data,$name);

				$this->session->set_flashdata('Success','Room Createde Successfully.');
	            redirect('AdminController/chatRoom');
		}
		else if($chk == 'true' && $data['type'] == 'City')
		{
			    $name = $this->AdminModel->getCityName($data);
				$this->AdminModel->insertRoomModel($data,$name);
				$this->session->set_flashdata('Success','Room Createde Successfully.');
	            redirect('AdminController/chatRoom');
		}
		else
		{
			$this->session->set_flashdata('Success','Room already Available.');
	        redirect('AdminController/addroom');
		}
	}

	public function deletecountry($_id) 
	  {   	   
	    $this->AdminModel->deleteCountry($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/country');
	  }

	  public function deletecity($_id) 
	  {   	   
	    $this->AdminModel->deletecity($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/city');
	  }
	
	  public function addcountry($_id = "")    
 	{
		 if($_id !="")
        {
		  $data['country'] = $this->AdminModel->getcountryDetails($_id);
		  $this->load->view('admin/addcountry',$data);
          
         }
         else{
            $this->load->view('admin/addcountry');
         }      
	  }
	  
	  public function updateCountryDetails()
	  {
		  
		  $id = $this->input->post('_id'); 
		  
		  $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
	       $this->form_validation->set_rules('country', 'countryName', 'required',
	            array(
	                'required'      => 'The %s should not be blank.',
	            )
	       );
	       if($this->form_validation->run() == FALSE)
	       {
			  $data['countries'] = $this->AdminModel->getcountryDetails($id);
			  
	          $this->load->view('admin/addcountry',$data);
	       }
	       else{
				$country_name=$this->security->xss_clean($this->input->post('country'));
				$country_code=$this->security->xss_clean($this->input->post('code'));

				$cName = $this->AdminModel->checkcountry1($country_name,$country_code);
				
				if(empty($cName))
	            {
					
					$this->AdminModel->updateCountry($id,$country_name,$country_code);
			        $this->session->set_flashdata('Success','Updated Successfully.');
			        redirect('AdminController/country');
	            } else
	            {
	            	$this->session->set_flashdata('error','Country Name not unique');
			        redirect('AdminController/country');
	            }	     
	          
	        }
	      
		} 
		
		public function updateCityDetails()
		{
			
			$id = $this->input->post('_id'); 

			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			$this->form_validation->set_rules('city', 'cityName', 'required',
				  array(
					  'required'      => 'The %s should not be blank.',
				  )
			 );
			 if($this->form_validation->run() == FALSE)
			 {
				
				$data['cities'] = $this->AdminModel->getcityDetails($id);
				$this->load->view('admin/addcity',$data);
			 }
			 else{
				  $city_name=$this->security->xss_clean($this->input->post('city'));
				  
				  $cName = $this->AdminModel->checkcity1($city_name);
				  
				  
				  if(empty($cName))
				  {
					  
					  $this->AdminModel->updateCity($id,$city_name);
					  $this->session->set_flashdata('Success','Updated Successfully.');
					  redirect('AdminController/city');
				  } else 
				  {
					  $this->session->set_flashdata('error','Country Name not unique');
					  redirect('AdminController/city');
				  }	     
				
			  }
			
		  } 
		  
	public function deletusermasters($_id) 
	  { 
	    $this->AdminModel->deletusermasters1($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/user');
	  }

	  


}

?>
