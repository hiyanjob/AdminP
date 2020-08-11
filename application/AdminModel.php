`<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

function __construct()
    {
        parent::__construct();
       
    }
    /*Query will Check the credentials*/
    public function validate($data)
    {
        $this->load->library('mongo_db', array('activate'=>'default'),'mongo_db_conn');
        $post=array('email' => $data['email'],'password' => $data['password']);

        $this->mongo_db->where($post);
        $res= $this->mongo_db->get('adminmasters');
        return $res;
    }

    public function getNewUser()
    {
        $query = $this->mongo_db->get('usermasters');
        return $query; 
    }
   
    public function getCountryList()
    {
        $res = $this->mongo_db->get('countries');
        return $res;   
    }  

    public function getCityList()
    {             
        $res = $this->mongo_db->get('cities');
        return $res;
    }

    public function checkCountry($data)
    {
       extract($data);
       $this->mongo_db->where('countryName', $countryName);
       $this->mongo_db->where('code', $code);
       $query = $this->mongo_db->get('countries');
       return (count($query) == 0 ? 'true' : 'false');
    }

    public function insertCountryModel($data)
    {
        $query = $this->mongo_db->insert('countries',$data);        
        return $query;
    }

    public function checkCity($data)
    {
       extract($data);
       $this->mongo_db->where('cityName', $cityName);
       $this->mongo_db->where('cnryID', $cnryID);
       $query = $this->mongo_db->get('cities');
       return (count($query) == 0 ? 'true' : 'false');   
    }

    public function insertCityModel($data)
    {
        $query = $this->mongo_db->insert('cities',$data);        
        return $query;
    }

   /* public function getCountryName($id)
    {
        $this->mongo_db->select('countryName');
        $this->mongo_db->where('_id', $id);
        $res = $this->mongo_db->get('countries');
        return $res;
   
    }*/

    public function getCountry()
    {
        $query = $this->mongo_db->get_where('countries',array('status'=>'Active'));
        $output = '<option value="">Select Country</option>';
        foreach ($query as $row)
         {
            foreach ($row['_id'] as $id)
             {                
               $output .='<option value="'.$id.'">'.$row['countryName'].'</option>'; 
           }
         }
        return $output; 
    }
    
    public function getCity()
    {
        $query = $this->mongo_db->get_where('cities',array('status'=>'Active'));
        
        $output = '<option value="">Select City</option>';
        foreach ($query as $val)
         {
            foreach ($val['_id'] as $id)
            {

                $output .='<option value="'.$id.'">'.$val['cityName'].'</option>'; 
            }
         }
        return $output; 
    }

    public function checkRoom($data)
    {
        extract($data);
        $this->mongo_db->where('chatUSersId', $chatUSersId);
        $this->mongo_db->where('type', $type);
        $query = $this->mongo_db->get('rooms');
        return (count($query) == 0 ? 'true' : 'false');
    }

    public function insertRoomModel($data,$name)
    {
        extract($data);
        $ins = array(
            'chatUSersId' => $chatUSersId,
            'groupName' => $name,
            'type' => $type,
            'status' => $status,
            'createdAt' => $createdAt
         );
        $res = $this->mongo_db->insert('rooms',$ins);
        return $res;

    }
    public function getRoomList()
    {
        $this->mongo_db->where(array('$or' => array(array("type" => 'Country'), array("type" => 'City'))));
        $query = $this->mongo_db->get('rooms');      
        return $query;
    }

    public function getCountryName($data)
    {
        extract($data);
        $this->mongo_db->where(array('_id'=>$chatUSersId));
        $query=$this->mongo_db->get_where('countries',(array('_id' => new MongoDB\BSON\ObjectID($chatUSersId))));
        foreach ($query as $row)
         {               
            $output = $row['countryName']; 
          
         }
        return $output; 
    }

    public function getCityName($data)
    {
        extract($data);
        $this->mongo_db->where(array('_id'=>$chatUSersId));
        $query=$this->mongo_db->get_where('cities',(array('_id' => new MongoDB\BSON\ObjectID($chatUSersId))));
        foreach ($query as $row)
         {               
            $output = $row['cityName']; 
          
         }
        return $output;
    }
    
    public function CountryName($id)
    {
        $this->mongo_db->where(array('_id'=>$id));
        $query=$this->mongo_db->get_where('countries',(array('_id' => new MongoDB\BSON\ObjectID($id))));
        foreach ($query as $row)
         {               
            $output = $row['countryName']; 
          
         }
        return $output; 
    }


 }
?>   