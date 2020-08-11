<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admincontroller extends CI_Controller {

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
		// $this->load->library('mongo_db', array('activate'=>'default'),'mongo_db_conn');
		// $res = $this->mongo_db->get('usermasters');
    
		// // var_dump($res);
		// echo "<pre>";
		// print_r($res);
    $this->load->view('admin/index');
	}

  	public function login()
  	{

	     $email='admin@yaass.com';
	     $password='12345';
	     $getemail=$this->input->post('email');
	     $getpwd=$this->input->post('pwd');
	     if ($email==$getemail && $password==$getpwd) 
	     {

	         redirect('AdminController/user');
	     }
	     else
	     {
	      $this->session->set_flashdata('error_status','Wrong Email Id & Password combination.');
	      
	      $this->load->view('admin/index');

	     }

   }

  	public function auth_login()
  	{
	    $email = $this->security->xss_clean($this->input->post('email'));	    
      	$password = $this->security->xss_clean($this->input->post('pwd'));      
	    $LumpData = array('email'=>$email,'password'=>$password);	        
	    $result = $this->AdminModel->validate($LumpData);	    
      if(!empty($result))	    
      { 	      
         redirect('AdminController/user');	    
      }
	  else	    
      {
	     $this->session->set_flashdata('error_status','Wrong Email Id & Password combination.');	       
         $this->load->view('admin/index');
	   } 	                     
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

   
    public function user()	
  	{
	    $data['newUser'] = $this->AdminModel->getNewUser();      
       $this->load->view('admin/userdetails',$data);	
	}

	public function company()	
  	{	    
      $data['company'] = $this->AdminModel->getcompany();      
      $this->load->view('admin/companydetails',$data);
	}
/*country controller start*/
	public function city()	
  	{	    
	  $data['city'] = $this->AdminModel->getcity(); 
	  $this->load->view('admin/cityMgmt',$data);

	}
	public function country()	
  	{	
		     
	  $data['countries'] = $this->AdminModel->getcountry(); 
		$this->load->view('admin/country',$data);
	
	}
	public function education()	
  	{	
	
	  $data['educations'] = $this->AdminModel->geteducation(); 
	 
      $this->load->view('admin/education',$data);
	
	}
	public function jobs()	
  	{	
		     
	  $data['jobs'] = $this->AdminModel->getjobs(); 
	 
      $this->load->view('admin/jobs',$data);
	 
	}
	public function countrylivingins()	
  	{	
		     
	  $data['countrylivingins'] = $this->AdminModel->getcountrylivingins(); 
	 
      $this->load->view('admin/countrylivingins',$data);
	 
	}
	public function ethnicities()	
  	{	
		     
	  $data['ethnicities'] = $this->AdminModel->getethnicities(); 
	 
      $this->load->view('admin/ethnicities',$data);
	
	}

 
	public function addcity($_id = "")    
 	{
 		if($_id !="")
        {
          $data['city'] = $this->AdminModel->getcountryDetails($_id);
          $this->load->view('admin/addcity',$data);
          
         }
         else{
            $this->load->view('admin/addcity');
         }      
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
	 
	  public function addeducation($_id = "")    
 	{
 		if($_id !="")
        {
		  $data['educations'] = $this->AdminModel->geteducationDetails($_id);
		  
          $this->load->view('admin/addeducation',$data);
          
         }
         else{
            $this->load->view('admin/addeducation');
         }      
	  }

	  public function addjobs($_id = "")    
 	{
 		if($_id !="")
        {
		  $data['jobs'] = $this->AdminModel->getjobsDetails($_id);
		  
          $this->load->view('admin/addjobs',$data);
          
         }
         else{
            $this->load->view('admin/addjobs');
         }      
	  }


	  public function addethnicities($_id = "")    
 	{
 		if($_id !="")
        {
		  $data['ethnicities'] = $this->AdminModel->getethnicitiesDetails($_id);
		  
          $this->load->view('admin/addethnicities',$data);
          
         }
         else{
            $this->load->view('admin/addethnicities');
         }      
	  }

	  public function addcountrylivingins($_id = "")    
 	{
 		if($_id !="")
        {
		  $data['countrylivingins'] = $this->AdminModel->getcountrylivinginsDetails($_id);
		  
          $this->load->view('admin/addcountrylivingins',$data);
          
         }
         else{
            $this->load->view('admin/addcountrylivingins');
         }      
	  }


	  
  	public function insertcity()
  	{
      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');    
      $this->form_validation->set_rules('cityName', 'city Name', 'required',
      
	      array(
	                'required'      => 'The %s should not be blank.'
	                /*'is_unique'     => 'This %s already exists.'*/
	                // 'alpha_space'	=> '%s you have entered is invalid.must be provide in alphabetical characters.'
	           )
	     );
	    if($this->form_validation->run() === FALSE)
	    {          
	          $this->load->view('admin/addcity');
	    }
	    else
	    {
	    	 $city_name=$this->security->xss_clean($this->input->post('cityName'));
	            $cName = $this->AdminModel->checkcity($city_name);
	            if(empty($cName))
	            {
	            	$data = array(
				        'cityName'=>$this->input->post('cityName'),
				        'status' => "Active"
				        
				    );
				        $this->AdminModel->insertcityModel($data);
				        $this->session->set_flashdata('Success','Details inserted Successfully');
				        redirect('AdminController/city');
	            } else 
	            {
	            	$this->session->set_flashdata('error','city Name not unique');
			        redirect('AdminController/city');
	            }
	        
	    }
   	} 
  	public function insertcountry()
  	{
		  
      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');    
      $this->form_validation->set_rules('countryName', 'Country Name', 'required',
      
	      array(
	                'required'      => 'The %s should not be blank.'
	                /*'is_unique'     => 'This %s already exists.'*/
	                // 'alpha_space'	=> '%s you have entered is invalid.must be provide in alphabetical characters.'
	           )
	     );
	    if($this->form_validation->run() === FALSE)
	    {          
	          $this->load->view('admin/addcountry');
	    }
	    else
	    {
	    	 $country_name=$this->security->xss_clean($this->input->post('countryName'));
	            $cName = $this->AdminModel->checkcountry($country_name);
	            if(empty($cName))
	            {
	            	$data = array(
				        'countryName'=>$this->input->post('countryName'),
				        'status' => "Active"
				        
				    );
				        $this->AdminModel->insertcountryModel($data);
				        $this->session->set_flashdata('Success','Details inserted Successfully');
				        redirect('AdminController/country');
	            } else 
	            {
	            	$this->session->set_flashdata('error','Country Name not unique');
			        redirect('AdminController/country');
	            }
	        
	    }
	   }
	    
  	public function inserteducation()
  	{
		  
      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');    
      $this->form_validation->set_rules('educationsName', 'educations Name', 'required',
      
	      array(
	                'required'      => 'The %s should not be blank.'
	                /*'is_unique'     => 'This %s already exists.'*/
	                // 'alpha_space'	=> '%s you have entered is invalid.must be provide in alphabetical characters.'
	           )
	     );
	    if($this->form_validation->run() === FALSE)
	    {          
	          $this->load->view('admin/addeducation');
	    }
	    else
	    {
	    	 $educations_name=$this->security->xss_clean($this->input->post('educationsName'));
	            $cName = $this->AdminModel->checkeducation($educations_name);
	            if(empty($cName))
	            {
	            	$data = array(
				        'educationsName'=>$this->input->post('educationsName'),
				        'status' => "Active"
				        
				    );
				        $this->AdminModel->inserteducationModel($data);
				        $this->session->set_flashdata('Success','Details inserted Successfully');
				        redirect('AdminController/education');
	            } else 
	            {
	            	$this->session->set_flashdata('error','education Name not unique');
			        redirect('AdminController/education');
	            }
	        
	    }
   	} 
  	public function insertjobs()
  	{
		  
      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');    
      $this->form_validation->set_rules('jobsName', 'jobs Name', 'required',
      
	      array(
	                'required'      => 'The %s should not be blank.'
	                /*'is_unique'     => 'This %s already exists.'*/
	                // 'alpha_space'	=> '%s you have entered is invalid.must be provide in alphabetical characters.'
	           )
	     );
	    if($this->form_validation->run() === FALSE)
	    {          
	          $this->load->view('admin/addjobs');
	    }
	    else
	    {
	    	 $jobs_name=$this->security->xss_clean($this->input->post('jobsName'));
	            $cName = $this->AdminModel->checkjobs($jobs_name);
	            if(empty($cName))
	            {
	            	$data = array(
				        'jobsName'=>$this->input->post('jobsName'),
				        'status' => "Active"
				        
				    );
				        $this->AdminModel->insertjobsModel($data);
				        $this->session->set_flashdata('Success','Details inserted Successfully');
				        redirect('AdminController/jobs');
	            } else 
	            {
	            	$this->session->set_flashdata('error','jobs Name not unique');
			        redirect('AdminController/jobs');
	            }
	        
	    }
	   } 
	   

  	public function insertethnicities()
  	{
		  
      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');    
      $this->form_validation->set_rules('ethnicitiesName', 'ethnicities Name', 'required',
      
	      array(
	                'required'      => 'The %s should not be blank.'
	                /*'is_unique'     => 'This %s already exists.'*/
	                // 'alpha_space'	=> '%s you have entered is invalid.must be provide in alphabetical characters.'
	           )
	     );
	    if($this->form_validation->run() === FALSE)
	    {          
	          $this->load->view('admin/addethnicities');
	    }
	    else
	    {
	    	 $ethnicities_name=$this->security->xss_clean($this->input->post('ethnicitiesName'));
	            $cName = $this->AdminModel->checkethnicities($ethnicities_name);
	            if(empty($cName))
	            {
	            	$data = array(
				        'ethnicitiesName'=>$this->input->post('ethnicitiesName'),
				        'status' => "Active"
				        
				    );
				        $this->AdminModel->insertethnicitiesModel($data);
				        $this->session->set_flashdata('Success','Details inserted Successfully');
				        redirect('AdminController/ethnicities');
	            } else 
	            {
	            	$this->session->set_flashdata('error','ethnicities Name not unique');
			        redirect('AdminController/ethnicities');
	            }
	        
	    }
	   } 
	   
  	public function insertcountrylivingins()
  	{
		  
      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');    
      $this->form_validation->set_rules('countrylivinginsName', 'countrylivingins Name', 'required',
      
	      array(
	                'required'      => 'The %s should not be blank.'
	                /*'is_unique'     => 'This %s already exists.'*/
	                // 'alpha_space'	=> '%s you have entered is invalid.must be provide in alphabetical characters.'
	           )
	     );
	    if($this->form_validation->run() === FALSE)
	    {          
	          $this->load->view('admin/addcountrylivingins');
	    }
	    else
	    {
	    	 $countrylivingins_name=$this->security->xss_clean($this->input->post('countrylivinginsName'));
	            $cName = $this->AdminModel->checkcountrylivingins($countrylivingins_name);
	            if(empty($cName))
	            {
	            	$data = array(
				        'countrylivinginsName'=>$this->input->post('countrylivinginsName'),
				        'status' => "Active"
				        
				    );
				        $this->AdminModel->insertcountrylivinginsModel($data);
				        $this->session->set_flashdata('Success','Details inserted Successfully');
				        redirect('AdminController/countrylivingins');
	            } else 
	            {
	            	$this->session->set_flashdata('error','countrylivingins Name not unique');
			        redirect('AdminController/countrylivingins');
	            }
	        
	    }
   	} 

   	 public function updatecityDetails()
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
	          $data['city'] = $this->AdminModel->getcityDetails($id);
	          $this->load->view('admin/addcity',$data);
	       }
	       else{
	            $city_name=$this->security->xss_clean($this->input->post('city'));
	            $cName = $this->AdminModel->checkcity($city_name);
	            if(empty($cName))
	            {
	            	$this->AdminModel->updatecity($id,$city_name);
			        $this->session->set_flashdata('Success','Updated Successfully.');
			        redirect('AdminController/city');
	            } else 
	            {
	            	$this->session->set_flashdata('error','ethnicities Name not unique');
			        redirect('AdminController/city');
	            }	     
	          
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
	            $cName = $this->AdminModel->checkcountry($country_name);
	            if(empty($cName))
	            {
	            	$this->AdminModel->updatecountry($id,$country_name);
			        $this->session->set_flashdata('Success','Updated Successfully.');
			        redirect('AdminController/country');
	            } else 
	            {
	            	$this->session->set_flashdata('error','Country Name not unique');
			        redirect('AdminController/country');
	            }	     
	          
	        }
	      
	    }


		public function updateeducationDetails()
		{
			$id = $this->input->post('_id');
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			 $this->form_validation->set_rules('educations', 'educationsName', 'required',
				  array(
					  'required'      => 'The %s should not be blank.',
				  )
			 );
			 if($this->form_validation->run() == FALSE)
			 {
				$data['countries'] = $this->AdminModel->geteducationDetails($id);
				$this->load->view('admin/addeducation',$data);
			 }
			 else{
				  $educations_name=$this->security->xss_clean($this->input->post('educations'));
				  $cName = $this->AdminModel->checkeducation($educations_name);
				  if(empty($cName))
				  {
					  $this->AdminModel->updateeducation($id,$educations_name);
					  $this->session->set_flashdata('Success','Updated Successfully.');
					  redirect('AdminController/education');
				  } else 
				  {
					  $this->session->set_flashdata('error','education Name not unique');
					  redirect('AdminController/education');
				  }	     
				
			  }
			
		  }
  
		public function updatejobsDetails()
		{
			$id = $this->input->post('_id');
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			 $this->form_validation->set_rules('jobs', 'jobsName', 'required',
				  array(
					  'required'      => 'The %s should not be blank.',
				  )
			 );
			 if($this->form_validation->run() == FALSE)
			 {
				$data['countries'] = $this->AdminModel->getjobsDetails($id);
				$this->load->view('admin/addjobs',$data);
			 }
			 else{
				  $jobs_name=$this->security->xss_clean($this->input->post('jobs'));
				  $cName = $this->AdminModel->checkjobs($jobs_name);
				  if(empty($cName))
				  {
					  $this->AdminModel->updatejobs($id,$jobs_name);
					  $this->session->set_flashdata('Success','Updated Successfully.');
					  redirect('AdminController/jobs');
				  } else 
				  {
					  $this->session->set_flashdata('error','jobs Name not unique');
					  redirect('AdminController/jobs');
				  }	     
				
			  }
			
		  }

		public function updateethnicitiesDetails()
		{
			$id = $this->input->post('_id');
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			 $this->form_validation->set_rules('ethnicities', 'ethnicitiesName', 'required',
				  array(
					  'required'      => 'The %s should not be blank.',
				  )
			 );
			 if($this->form_validation->run() == FALSE)
			 {
				$data['countries'] = $this->AdminModel->getethnicitiesDetails($id);
				$this->load->view('admin/addethnicities',$data);
			 }
			 else{
				  $ethnicities_name=$this->security->xss_clean($this->input->post('ethnicities'));
				  $cName = $this->AdminModel->checkethnicities($ethnicities_name);
				  if(empty($cName))
				  {
					  $this->AdminModel->updateethnicities($id,$ethnicities_name);
					  $this->session->set_flashdata('Success','Updated Successfully.');
					  redirect('AdminController/ethnicities');
				  } else 
				  {
					  $this->session->set_flashdata('error','ethnicities Name not unique');
					  redirect('AdminController/ethnicities');
				  }	     
				
			  }
			
		  }
  
		public function updatecountrylivinginsDetails()
		{
			$id = $this->input->post('_id');
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			 $this->form_validation->set_rules('countrylivingins', 'countrylivinginsName', 'required',
				  array(
					  'required'      => 'The %s should not be blank.',
				  )
			 );
			 if($this->form_validation->run() == FALSE)
			 {
				$data['countries'] = $this->AdminModel->getcountrylivinginsDetails($id);
				$this->load->view('admin/addcountrylivingins',$data);
			 }
			 else{
				  $countrylivingins_name=$this->security->xss_clean($this->input->post('countrylivingins'));
				  $cName = $this->AdminModel->checkcountrylivingins($countrylivingins_name);
				  if(empty($cName))
				  {
					  $this->AdminModel->updatecountrylivingins($id,$countrylivingins_name);
					  $this->session->set_flashdata('Success','Updated Successfully.');
					  redirect('AdminController/countrylivingins');
				  } else 
				  {
					  $this->session->set_flashdata('error','countrylivingins Name not unique');
					  redirect('AdminController/countrylivingins');
				  }	     
				
			  }
			
		  }
  

	  public function deletecity($_id) 
	  {   	   
	    $this->AdminModel->deletecity($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/city');
	  }
	  public function deletecountry($_id) 
	  {   	   
	    $this->AdminModel->deleteCountry($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/country');
	  }


	  public function deleteeducation($_id) 
	  {   	   
	    $this->AdminModel->deleteeducation($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/education');
	  }

	  public function deletejobs($_id) 
	  {   	   
	    $this->AdminModel->deletejobs($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/jobs');
	  }

	  public function deleteethnicities($_id) 
	  {   	   
	    $this->AdminModel->deleteethnicities($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/ethnicities');
	  }

	  public function deletecountrylivingins($_id) 
	  {   	   
	    $this->AdminModel->deletecountrylivingins($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/countrylivingins');
	  }

	  public function updateInactivecity($id)
	  {
	  	$this->AdminModel->updateInactivecity($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/city');
	  }
	  public function updateInactiveCountry($id)
	  {
	  	$this->AdminModel->updateInactiveCountry($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/country');
	  }

	  public function updateActivecity($id)
	  {
	  	$this->AdminModel->updateActivecity($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/city');
	  }
	  public function updateActiveCountry($id)
	  {
	  	$this->AdminModel->updateActiveCountry($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/country');
	  }

   /*country controller end*/

   /*orientation controller start */
  	public function orientation()
	{
	    $data['orientation'] = $this->AdminModel->getorientation();      
       $this->load->view('admin/orientation',$data);	
	}

	public function addorientation($_id = "") 
  	{
  		if($_id !="")
        {
          $data['Orientation'] = $this->AdminModel->getOrientationDetails($_id);
          $this->load->view('admin/addorientation',$data);
          
         }
         else{
            $this->load->view('admin/addorientation');
         }            
    }

   public function insertorientation()
   {
      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
      
      $this->form_validation->set_rules('orientationType', 'orientation Type', 'required',
      array(
                'required'      => 'The %s should not be blank.'
                /*'is_unique'     => 'This %s already exists.'*/
                // 'alpha_space'	=> '%s you have entered is invalid.must be provide in alphabetical characters.'
        )
      );
      if($this->form_validation->run() === FALSE)
      {
         $this->load->view('admin/addorientation');
      }
      else
      {
	       $orientation_name=$this->security->xss_clean($this->input->post('orientationType'));
	       $oName = $this->AdminModel->checkOrientation($orientation_name);
	       if(empty($oName))
		   {
				       	$data = array(
			         'orientationType'=>$this->input->post('orientationType'),
			         'status' => "Active"
			          );
			         $this->AdminModel->insertorientationModel($data);
	            	$this->AdminModel->updateOrientation($id,$orientation_name);
			        $this->session->set_flashdata('Success','Details inserted Successfully.');
			        redirect('AdminController/orientation');
	        } else 
	        {
	            	$this->session->set_flashdata('error','orientation Name not unique');
			        redirect('AdminController/orientation');
	        }	
         
      }
   }   

   public function updateOrientationDetails()
	  {
	      $id = $this->input->post('_id');
	      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
	       $this->form_validation->set_rules('orientation', 'orientationType', 'required',
	            array(
	                'required'      => 'The %s should not be blank.',
	            )
	       );
	       if($this->form_validation->run() == FALSE)
	       {
	          $data['orientation'] = $this->AdminModel->getOrientationDetails($id);
	          $this->load->view('admin/addorientation',$data);
	       }
	       else{
	            $orientation_name=$this->security->xss_clean($this->input->post('orientation'));
	            $oName = $this->AdminModel->checkOrientation($orientation_name);
	            if(empty($oName))
	            {
	            	$this->AdminModel->updateOrientation($id,$orientation_name);
			        $this->session->set_flashdata('Success','Updated Successfully.');
			        redirect('AdminController/orientation');
	            } else 
	            {
	            	$this->session->set_flashdata('error','orientation Name not unique');
			        redirect('AdminController/orientation');
	            }	     
	          
	        }
	      
	    } 
	    
	  public function deleteorientation($_id) 
	  {   	   
	    $this->AdminModel->deleteOrientation($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/orientation');
	  }

	  public function updateInactiveorientation($id)
	  {
	  	$this->AdminModel->updateInactiveorientation($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/orientation');
	  }

	  public function updateActiveorientation($id)
	  {
	  	$this->AdminModel->updateActiveorientation($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/orientation');
	  }

/*orientation controller end*/
    public function religion()
	{
	   $data['religion'] = $this->AdminModel->getreligion();     
       $this->load->view('admin/religion',$data);
	}

	public function addreligion($_id = "") 
    {
    	if($_id !="")
        {
          $data['religion'] = $this->AdminModel->getreligionDetails($_id);
          $this->load->view('admin/addreligion',$data);
          
         }
         else{
            $this->load->view('admin/addreligion');
         }                 
    }

    public function insertreligion()
    {
      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
    
      $this->form_validation->set_rules('religion', 'religion', 'required',
      array(
                'required'      => 'The %s should not be blank.'
                /*'is_unique'     => 'This %s already exists.'*/
                // 'alpha_space'	=> '%s you have entered is invalid.must be provide in alphabetical characters.'
      )
      );
      if($this->form_validation->run() === FALSE)
      {       
          $this->load->view('admin/addreligion');
      }
      else
      {

      	    $religion_name=$this->security->xss_clean($this->input->post('religion'));
	        $cName = $this->AdminModel->checkReligion($religion_name);
	            if(empty($cName))
	            {
	            	$data = array(
			          'religion'=>$this->input->post('religion'),
			          'status' => "Active"
			          );
			          $this->AdminModel->insertreligionModel($data);
			          $this->session->set_flashdata('Success','Details inserted Successfully');
			          redirect('AdminController/religion');
	            } else 
	            {
	            	$this->session->set_flashdata('error','Religion Name not unique');
			        redirect('AdminController/religion');
	            }	
          
      }
    }
    
    public function updateReligionDetails()
	  {
	      $id = $this->input->post('_id');
	      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
	       $this->form_validation->set_rules('religion', 'religion', 'required',
	            array(
	                'required'      => 'The %s should not be blank.',
	            )
	       );
	       if($this->form_validation->run() == FALSE)
	       {
	          $data['religion'] = $this->AdminModel->getreligionDetails($id);
	          $this->load->view('admin/addreligion',$data);
	       }
	       else{
	            $religion_name=$this->security->xss_clean($this->input->post('religion'));
	            $cName = $this->AdminModel->checkReligion($religion_name);
	            if(empty($cName))
	            {
	            	$this->AdminModel->updateReligion($id,$religion_name);
			        $this->session->set_flashdata('Success','Updated Successfully.');
			        redirect('AdminController/religion');
	            } else 
	            {
	            	$this->session->set_flashdata('error','Religion Name not unique');
			        redirect('AdminController/religion');
	            }	     
	          
	        }
	      
	    }

	  public function deletereligion($_id) 
	  {   	   
	    $this->AdminModel->deletereligion($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/religion');
	  }

	  public function updateInactiveReligion($id)
	  {
	  	$this->AdminModel->updateInactiveReligion($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/religion');
	  }

	  public function updateActiveReligion($id)
	  {
	  	$this->AdminModel->updateActiveReligion($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/religion');
	  }

    /*end religion controller*/ 

     public function test()
    { 
  		echo "Congrats";
  	
     }

     public function maritalStatus()
     {
	     $data['maritalStatus'] = $this->AdminModel->getmaritalStatus();	     
	     $this->load->view('admin/maritalStatus',$data);
	 }

     public function nationalitiesStatus()
     {
		 $data['nationalitiesStatus'] = $this->AdminModel->getnationalitiesStatus();
		//  var_dump($data);die();
	     $this->load->view('admin/nationalitiesStatus',$data);
	 }

	  public function addmarital($_id = "") 
	  {
	  	if($_id !="")
        {
          $data['marital'] = $this->AdminModel->getmaritalDetails($_id);
          $this->load->view('admin/addmarital',$data);
          
         }
         else{
            $this->load->view('admin/addmarital');
         }   	         
	  }
	  public function addnationalities($_id = "") 
	  {
	  	if($_id !="")
        {
		  $data['nationalities'] = $this->AdminModel->getnationalitiesDetails($_id);
		 
          $this->load->view('admin/addnationalities',$data);
          
         }
         else{
            $this->load->view('admin/addnationalities');
         }   	         
	  }

	  public function insertmaritalStatus()
	  {
	      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
	    
	      $this->form_validation->set_rules('marital', 'name', 'required',
	      array(
	                'required'      => 'The %s should not be blank.'
	                /*'is_unique'     => 'This %s already exists.'*/
	                // 'alpha_space'  => '%s you have entered is invalid.must be provide in alphabetical characters.'
	      )
	      );
	      if($this->form_validation->run() === FALSE)
	      {       
	          $this->load->view('admin/addmarital');
	      }
	      else
	      {
	      	$marital_name=$this->security->xss_clean($this->input->post('marital'));
	            $cName = $this->AdminModel->checkMarital($marital_name);
	            if(empty($cName))
	            {
	            	$data = array(
			          'name'=>$this->input->post('marital'),
			          'status' => "Active"
			          );
			          $this->AdminModel->insertMaritalModel($data);
			          $this->session->set_flashdata('Success','Details inserted Successfully');
			          redirect('AdminController/maritalStatus');
	            } else 
	            {
	            	$this->session->set_flashdata('error','Marital Status not unique');
			        redirect('AdminController/maritalStatus');
	            }


	          
	      }
	  }

	  public function insertnationalitiesStatus()
	  {
	      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
	    
	      $this->form_validation->set_rules('nationalities', 'name', 'required',
	      array(
	                'required'      => 'The %s should not be blank.'
	                /*'is_unique'     => 'This %s already exists.'*/
	                // 'alpha_space'  => '%s you have entered is invalid.must be provide in alphabetical characters.'
	      )
	      );
	      if($this->form_validation->run() === FALSE)
	      {       
	          $this->load->view('admin/addnationalities');
	      }
	      else
	      {
	      	$nationalities_name=$this->security->xss_clean($this->input->post('nationalities'));
	            $cName = $this->AdminModel->checknationalities($nationalities_name);
	            if(empty($cName))
	            {
	            	$data = array(
			          'name'=>$this->input->post('nationalities'),
			          'status' => "Active"
			          );
			          $this->AdminModel->insertnationalitiesModel($data);
			          $this->session->set_flashdata('Success','Details inserted Successfully');
			          redirect('AdminController/nationalitiesStatus');
	            } else 
	            {
	            	$this->session->set_flashdata('error','nationalities Status not unique');
			        redirect('AdminController/nationalitiesStatus');
	            }


	          
	      }
	  }

	   public function updateMaritalDetails()
	  {
	      $id = $this->input->post('_id');
	      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
	       $this->form_validation->set_rules('marital', 'name', 'required',
	            array(
	                'required'      => 'The %s should not be blank.',
	            )
	       );
	       if($this->form_validation->run() == FALSE)
	       {
	          $data['marital'] = $this->AdminModel->getmaritalDetails($id);
	          $this->load->view('admin/addmarital',$data);
	       }
	       else{
	            $marital_name=$this->security->xss_clean($this->input->post('marital'));
	            $cName = $this->AdminModel->checkMarital($marital_name);
	            if(empty($cName))
	            {
	            	$this->AdminModel->updateMarital($id,$marital_name);
			        $this->session->set_flashdata('Success','Updated Successfully.');
			        redirect('AdminController/maritalStatus');
	            } else 
	            {
	            	$this->session->set_flashdata('error','Marital Status not unique');
			        redirect('AdminController/maritalStatus');
	            }	     
	          
	        }
	      
		}
		

	  public function updatenationalitiesDetails()
	  {
	      $id = $this->input->post('_id');
	      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
	       $this->form_validation->set_rules('nationalities', 'name', 'required',
	            array(
	                'required'      => 'The %s should not be blank.',
	            )
	       );
	       if($this->form_validation->run() == FALSE)
	       {
	          $data['nationalities'] = $this->AdminModel->getnationalitiesDetails($id);
	          $this->load->view('admin/addnationalities',$data);
	       }
	       else{
	            $nationalities_name=$this->security->xss_clean($this->input->post('nationalities'));
	            $cName = $this->AdminModel->checknationalities($nationalities_name);
	            if(empty($cName))
	            {
	            	$this->AdminModel->updatenationalities($id,$nationalities_name);
			        $this->session->set_flashdata('Success','Updated Successfully.');
			        redirect('AdminController/nationalitiesStatus');
	            } else 
	            {
	            	$this->session->set_flashdata('error','nationalities Status not unique');
			        redirect('AdminController/nationalitiesStatus');
	            }	     
	          
	        }
	      
		}
		

	  public function deletemarital($_id) 
	  {   	   
	    $this->AdminModel->deletemarital($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/maritalStatus');
	  }

	  public function deletenationalities($_id) 
	  {   	   
	    $this->AdminModel->deletenationalities($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/nationalitiesStatus');
	  }

	  public function updateInactivemarital($id)
	  {
	  	$this->AdminModel->updateInactivemarital($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/maritalStatus');
	  }


	  	  public function updateInactivenationalities($id)
	  {
	  	$this->AdminModel->updateInactivenationalities($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/nationalitiesStatus');
	  }

	  public function updateActivemarital($id)
	  {
	  	$this->AdminModel->updateActivemarital($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/maritalStatus');
	  }


	  public function updateActivenationalities($id)
	  {
	  	$this->AdminModel->updateActivenationalities($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/nationalitiesStatus');
	  }


  // Partner Looking

	  public function partner()
	  {
	     $data['partnerLooking'] = $this->AdminModel->getpartnerLooking();    
	     $this->load->view('admin/partner',$data);
	  }


	   public function addpartner($_id = "") 
	   {

	        if($_id !="")
	        {
	          $data['partner'] = $this->AdminModel->getpartner($_id);
	          $this->load->view('admin/addpartner',$data);
	          
	         }
	         else{
	            $this->load->view('admin/addpartner');
	         } 
	   }  

	  public function insertpartner()
	  {
	      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
	    
	      $this->form_validation->set_rules('partner', 'name', 'required',
	      array(
	                'required'      => 'The %s should not be blank.'
	                /*'is_unique'     => 'This %s already exists.'*/
	                // 'alpha_space'  => '%s you have entered is invalid.must be provide in alphabetical characters.'
	      )
	      );
	      if($this->form_validation->run() === FALSE)
	      {       
	          $this->load->view('admin/addpartner');
	      }
	      else
	      {

	      		$partner_name=$this->security->xss_clean($this->input->post('partner'));
	             $pName = $this->AdminModel->checkPartner($partner_name);
	            if(empty($pName))
		         {
		            	$data = array(
				          'name'=>$this->input->post('partner'),
				          'status' => "Active"
				          );
				          $this->AdminModel->insertpartnerModel($data);
				          $this->session->set_flashdata('Success','Details inserted Successfully');
			        redirect('AdminController/partner');
	            } else 
	            {
	            	$this->session->set_flashdata('error','Partner Looking Field Is Not Unique');
			        redirect('AdminController/partner');
	            }
	          
	      }
	  }


	  public function updatePartnerDetails()
	  {
	      $id = $this->input->post('_id');
	      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
	       $this->form_validation->set_rules('partner', 'Partner Name', 'required',
	            array(
	                'required'      => 'The %s should not be blank.',
	                // 'is_unique'     => 'This %s already exists.',
	                // 'alpha_space' => '%s you have entered is invalid.must be provide in alphabetical characters.'
	        )
	     );
	       if($this->form_validation->run() == FALSE)
	       {
	          $data['partner'] = $this->AdminModel->getpartner($id);
	          $this->load->view('admin/addpartner',$data);
	       }
	       else{
	       	     $partner_name=$this->security->xss_clean($this->input->post('partner'));
	             $pName = $this->AdminModel->checkPartner($partner_name);
	            if(empty($pName))
	            {
	            	$this->AdminModel->updatePartner($id,$partner_name);
			        $this->session->set_flashdata('Success','Updated Successfully.');
			        redirect('AdminController/partner');
	            } else 
	            {
	            	$this->session->set_flashdata('error','Partner Looking Field Is Not Unique');
			        redirect('AdminController/partner');
	            }
	        }
	      
	    }

	  public function deletepartner($_id) 
	  {   	   
	    $this->AdminModel->deletept($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/partner');
	  }

	  public function updateInactivePartner($id)
	  {
	  	$this->AdminModel->updateInactivePartner($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/partner');
	  }

	  public function updateActivePartner($id)
	  {
	  	$this->AdminModel->updateActivePartner($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/partner');
	  }
  // End Partner Looking


	  public function createinterest()  
	  {	      
	      $data['createinterest'] = $this->AdminModel->getinterest();
	      $this->load->view('admin/createinterests',$data);
	  }

	    public function addinterest()  
	  	{
	        $this->load->view('admin/addinterest');
	  	}

	  public function insertinterest()
	  {    
	      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
	    
	      $this->form_validation->set_rules('categoryname', 'Category Name', 'required'/*|is_unique[companyinterests.name]*/,
	      array(
	                'required'      => 'The %s should not be blank.'
	                //'is_unique'     => 'This %s already exists.'
	                // 'alpha_space'  => '%s you have entered is invalid.must be provide in alphabetical characters.'
	      )
	      );
	      if($this->form_validation->run() === FALSE)
	      {       
	          $this->load->view('admin/addinterest');
	      }

	      else
	          {
	                $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/YaassAdmin/assets/uploads/interestimage/';
	                $config['allowed_types']        = 'gif|jpg|png|jpeg|JPG|PNG';
	                $config['overwrite']        = TRUE;
	                $config['remove_spaces']        = TRUE;
	                $config['max_size']        = '0';
	                $this->load->library('upload', $config);
	                $this->upload->initialize($config);
	                    // print_r($this->upload->do_upload('picture'));die();
	                if(!$this->upload->do_upload('pic')) 
	                {
	                  
	                    $this->session->set_flashdata('Success','Upload not Success');

	                    redirect('AdminController/addinterest');
	                }
	                else
	                {
	                    $data = $this->upload->data();
	                    // var_dump('picture'.$data);die();
	                    $imagename ='interestimage/'. $data['file_name'];
	                    $data = array(
	                    'categoryname'=>$this->input->post('categoryname'),
	                    'interestimage'=> $imagename,
	                    'status' => "Active"
	                    );
	                      $result = $this->mongo_db->insert('companyinterests',$data);
	                          if ($result == TRUE) {
	                          $this->session->set_flashdata('Success','interest added successfully.');
	                          redirect(base_url()."AdminController/createinterest");
	                          } 

	                    else {
	                          $this->session->set_flashdata('error_status','Sorry Please Try with Different 
	                            Category Name.');
	                          $this->load->view('admin/addinterest');
	                          } 
	                    // $this->AdminModel->insertinterestModel($data);
	                    // $this->session->set_flashdata('Success','Details inserted Successfully');
	                    // redirect('AdminController/createinterests');
	                }
	          }
	}
	public function updateInactiveInterest($id)
	  {
	  	$this->AdminModel->updateInactiveInterest($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/createinterest');
	  }

	  public function updateActiveInterest($id)
	  {
	  	$this->AdminModel->updateActiveInterest($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/createinterest');
	  }

//school or college management controller start 
	public function schoolMgmt()	
  	{	    
      $data['school'] = $this->AdminModel->getSchool();      
      $this->load->view('admin/schoolMgmt',$data);
	}

	public function addSchool($_id = "")    
 	{
 		if($_id !="")
        {
          $data['school'] = $this->AdminModel->getschoolDetails($_id);
          $this->load->view('admin/addSchool',$data);
          
         }
         else{
            $this->load->view('admin/addSchool');
         }      
  	}
     
  	public function insertSchool()
  	{
      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');    
      $this->form_validation->set_rules('schoolName', 'School / College Name', 'required',
      
	      array(
	                'required'      => 'The %s should not be blank.'
	           )
	     );
	    if($this->form_validation->run() === FALSE)
	    {          
	          $this->load->view('admin/addSchool');
	    }
	    else
	    {
	    	 $country_name=$this->security->xss_clean($this->input->post('schoolName'));
	            $cName = $this->AdminModel->checkSchool($country_name);
	            if(empty($cName))
	            {
	            	$data = array(
				        'schoolName'=>$this->input->post('schoolName'),
				        'status' => "Active"
				        
				    );
				        $this->AdminModel->insertschoolModel($data);
				        $this->session->set_flashdata('Success','Details inserted Successfully');
				        redirect('AdminController/schoolMgmt');
	            } else 
	            {
	            	$this->session->set_flashdata('error','School / College Name not unique');
			        redirect('AdminController/schoolMgmt');
	            }
	        
	    }
   	} 

   	 public function updateSchoolDetails()
	  {
	      $id = $this->input->post('_id');
	      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
	       $this->form_validation->set_rules('schoolName', 'School / College Name', 'required',
	            array(
	                'required'      => 'The %s should not be blank.',
	            )
	       );
	       if($this->form_validation->run() == FALSE)
	       {
	          $data['school'] = $this->AdminModel->getschoolDetails($id);
	          $this->load->view('admin/addSchool',$data);
	       }
	       else{
	            $country_name=$this->security->xss_clean($this->input->post('schoolName'));
	            $cName = $this->AdminModel->checkSchool($country_name);
	            if(empty($cName))
	            {
	            	$this->AdminModel->updateSchool($id,$country_name);
			        $this->session->set_flashdata('Success','Updated Successfully.');
			        redirect('AdminController/schoolMgmt');
	            } else 
	            {
	            	$this->session->set_flashdata('error','School / College Name not unique');
			        redirect('AdminController/schoolMgmt');
	            }	     
	          
	        }
	      
	    }

	  public function deleteSchool($_id) 
	  {   	   
	    $this->AdminModel->deleteSchool($_id);
	    $this->session->set_flashdata('Success','Deleted Successfully.');
	    redirect('AdminController/schoolMgmt');
	  }

	  public function updateInactiveSchool($id)
	  {
	  	$this->AdminModel->updateInactiveSchool($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/schoolMgmt');
	  }

	  public function updateActiveSchool($id)
	  {
	  	$this->AdminModel->updateActiveSchool($id);
	    $this->session->set_flashdata('Success','status updated successfully.');
	    redirect('AdminController/schoolMgmt');
	  }

  	//school or college management controller end 

 	//degree management controller end 
	  public function degreeMgmt()	
	  {	    
	      $data['degree'] = $this->AdminModel->getDegree();      
	      $this->load->view('admin/degreeMgmt',$data);
      }

      public function addDegree($_id = "")    
 	{
 		if($_id !="")
        {
          $data['degree'] = $this->AdminModel->getschoolDetails($_id);
          $this->load->view('admin/addDegree',$data);
          
         }
         else{
            $this->load->view('admin/addDegree');
         }      
  	}

  	public function insertDegree()
  	{
      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');    
      $this->form_validation->set_rules('degree', 'Degree', 'required',
      
	      array(
	                'required'      => 'The %s should not be blank.'
	           )
	     );
	    if($this->form_validation->run() === FALSE)
	    {          
	          $this->load->view('admin/addDegree');
	    }
	    else
	    {
	    	 $country_name=$this->security->xss_clean($this->input->post('degree'));
	            $cName = $this->AdminModel->checkDegree($country_name);
	            if(empty($cName))
	            {
	            	$data = array(
				        'degree'=>$this->input->post('degree'),
				        'status' => "Active"
				        
				    );
				        $this->AdminModel->insertdegreeModel($data);
				        $this->session->set_flashdata('Success','Details inserted Successfully');
				        redirect('AdminController/degreeMgmt');
	            } else 
	            {
	            	$this->session->set_flashdata('error','degree is not unique');
			        redirect('AdminController/degreeMgmt');
	            }
	        
	    }
   	} 

   	 public function updateDegreeDetails()
	  {
	      $id = $this->input->post('_id');
	      $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
	       $this->form_validation->set_rules('schoolName', 'School / College Name', 'required',
	            array(
	                'required'      => 'The %s should not be blank.',
	            )
	       );
	       if($this->form_validation->run() == FALSE)
	       {
	          $data['school'] = $this->AdminModel->getschoolDetails($id);
	          $this->load->view('admin/addDegree',$data);
	       }
	       else{
	            $country_name=$this->security->xss_clean($this->input->post('schoolName'));
	            $cName = $this->AdminModel->checkSchool($country_name);
	            if(empty($cName))
	            {
	            	$this->AdminModel->updateSchool($id,$country_name);
			        $this->session->set_flashdata('Success','Updated Successfully.');
			        redirect('AdminController/degreeMgmt');
	            } else 
	            {
	            	$this->session->set_flashdata('error','School / College Name not unique');
			        redirect('AdminController/degreeMgmt');
	            }	     
	          
	        }
	      
	    }

	public function fulldata_get()	
  	{
	    $data['result'] = $this->AdminModel->getfullDetails();      
     	var_dump($data);die;	  
	}

  
    //Valid users

     public function validuser()	
  	{
  	   
	   $data['validuser'] = $this->AdminModel->getvaliduser(); 

       $this->load->view('admin/validuser',$data);	
	}




	//Update Valid User Status

 public function updatevalidstatus()
  {
    $data['_id'] = $this->input->post('_id');
    $data['accountStatus'] = $this->input->post('accountStatus');
    //print_r($data);die();
	$update = $this->AdminModel->validstatus($data);
	// $response =[
	// 	"status" => "success",
	// 	"message" => "updated successfully",
	// 	"data" => $data['accountStatus']
	// ];
	// redirect('AdminController/validuser');
	// $data['validuser'] = $this->AdminModel->getvaliduser(); 

    //    $this->load->view('admin/validuser',$data);
	
    //var_dump($update);
  }

	public function viewvaliduser()
	{
		$id = $this->uri->segment(3);
		$data['viewvaliduser'] = $this->AdminModel->getSingleUser($id); 
		$this->load->view('admin/viewvaliduser',$data);
	}	  

	public function dashboard()
	{
		$this->load->view('admin/dashboard');
	}

	public function privileges(){

		$this->load->view('admin/guess_privileges');
	}

	public function guessUserManagement(){

		$this->load->view('admin/guess_usermgmt');
	}

	public function rewards(){

		$this->load->view('admin/rewards');
	}

	public function redemption(){
		$this->load->view('admin/redemption');
	}

	public function chatRoom(){

		$this->load->view('admin/chat_room');
	}

	public function badwords(){
		$this->load->view('admin/badwords');
	}

	public function feedback(){

		$this->load->view('admin/feedback');	
	}

	public function spamusers(){

		$this->load->view('admin/spam_users');
	}

	public function customNotification(){

		$this->load->view('admin/notification_customnoti');
	}

	public function analytics(){

		$this->load->view('admin/analytics');
	}

}

?>