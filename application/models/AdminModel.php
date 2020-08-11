<?php
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
        // $res = $this->mongo_db->get('cities');

        $cities = $this->mongo_db->get('cities');
        // ->select("cnryID","cityName");
        $cntry = $this->mongo_db->get("countries");
        $cntry_list =[];
 
        foreach($cntry as $i =>$cn){
            
            foreach($cn['_id'] as $id){
             $cntry_list[$i]['country'] = $cn;
             $cntry_list[$i]['country']['cidd'] = $id;
            }
        }
        
        $city_list = [];
 
        foreach($cities as $i => $ci){
             foreach($cntry_list as $row){
                if($ci['cnryID'] == $row['country']['cidd']){
                    $city_list[$i] = $ci;
                    $city_list[$i]['name'] = $row['country']['countryName'];
                        
                }
     
            }
        }
        return $city_list;
    }

  
    
    public function checkCountry($data)
    {
      
       extract($data);
      $this->mongo_db->where('countryName', $countryName);
      $query = $this->mongo_db->get('countries');
      $this->mongo_db->where('code', $code);
      $query1 = $this->mongo_db->get('countries');


        if ((count($query)==0)&& (count($query1)==0)){
            return true;
        }
        // return (count($query) == 0 ? 'true' : 'false');
        else{
            
            return false;
        }
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
    
    public function getSingleUser($id){
        $this->mongo_db->where(array("_id" => new MongoDB\BSON\ObjectID($id)));
        
        $users = $this->mongo_db->get("usermasters");
        return $users;
       }

       public function updateInactiveUser($id)
       {
          $query = $this->mongo_db->where(array("_id" => new MongoDB\BSON\ObjectID($id)))->set(array("status"=>'Inactive'))->update('usermasters');
          return $query;
       }
  
       public function updateActiveUser($id)
       {
          $query = $this->mongo_db->where(array("_id" => new MongoDB\BSON\ObjectID($id)))->set(array("status"=>'Active'))->update('usermasters');
          return $query;
       }


       public function countryInactive($id)
       {
          $query = $this->mongo_db->where(array("_id" => new MongoDB\BSON\ObjectID($id)))->set(array("status"=>'Inactive'))->update('countries');
          return $query;
       }
  
       public function countryActive($id)
       {
          $query = $this->mongo_db->where(array("_id" => new MongoDB\BSON\ObjectID($id)))->set(array("status"=>'Active'))->update('countries');
          return $query;
       }
       public function chatRoomInactive($id)
       {
          $query = $this->mongo_db->where(array("_id" => new MongoDB\BSON\ObjectID($id)))->set(array("status"=>'Inactive'))->update('rooms');
          return $query;
       }
  
       public function chatRoomActive($id)
       {
          $query = $this->mongo_db->where(array("_id" => new MongoDB\BSON\ObjectID($id)))->set(array("status"=>'Active'))->update('rooms');
          return $query;
       }

       public function cityInactive($id)
       {
          $query = $this->mongo_db->where(array("_id" => new MongoDB\BSON\ObjectID($id)))->set(array("status"=>'Inactive'))->update('cities');
          return $query;
       }
  
       public function cityActive($id)
       {
          $query = $this->mongo_db->where(array("_id" => new MongoDB\BSON\ObjectID($id)))->set(array("status"=>'Active'))->update('cities');
          return $query;
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
        //  bin2hex('admin@aalap')
        //  hex2bin('61646d696e4061616c6170')
         //admin@aalap(admin Key) => 61646d696e4061616c6170
          /* API URL */
          $subjectUid='61646d696e4061616c6170';
          $url = 'https://api.cometchat.com/v1.8/users/'.$subjectUid.'/groups';
           
          /* Init cURL resource */
          $ch = curl_init($url);
            
          /* Array Parameter Data */
        //   $data = ['guid'=>'india2','name'=>'india2','type'=>'public'];
          $data = ['guid'=>$chatUSersId,'name'=>$name,'type'=>'public'];
//var_dump($data);die;
             $data= json_encode($data);
          /* pass encoded JSON string to the POST fields */
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
             
          /* set the content type json */
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                      'accept: application/json',
                      'Content-Type:application/json',
                      'apikey:78ec146ea09632dd15c7fe08d9a4c420af64f5ca',
                      'appid:48942283c24520' 
                  ));
              
          /* set return type json */
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              
          /* execute request */
          $result = curl_exec($ch);
             
        //  var_dump($result);die;

          /* close cURL resource */
          curl_close($ch);
 
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
    public function deleteCountry($id)
    {
        $this ->mongo_db->where('_id', new MongoDB\BSON\ObjectID($id));
        $query = $this->mongo_db->delete('countries');
        return $query;
    }

    public function deletecity($id)
    {
        $this ->mongo_db->where('_id', new MongoDB\BSON\ObjectID($id));
        $query = $this->mongo_db->delete('cities');
        return $query;
    }

    public function getcountryDetails($id)
    {

        
        $query=$this->mongo_db->get_where('countries',(array('_id' => new MongoDB\BSON\ObjectID($id))));
        
        return $query;
    }

    public function getcityDetails($id)
    {
        $query=$this->mongo_db->get_where('cities',(array('_id' => new MongoDB\BSON\ObjectID($id))));
        return $query;  
    }

    public function checkCountry1($name,$code)
    {
        $this->mongo_db->where('countryName', $countryName);
        $query = $this->mongo_db->get('countries');
        $this->mongo_db->where('code', $code);
        $query1 = $this->mongo_db->get('countries');
  
  
          if ((count($query)==0)&& (count($query1)==0)){
            $query=$this->mongo_db->get_where('countries',(array('countriesName' => $name,'code'=>$code)));
            return $query;
              
          }
          else{
            
            return x;
          }
        // $query=$this->mongo_db->get_where('countries',(array('countriesName' => $name,'code'=>$code)));
        // return $query;
    }

    public function checkcity1($name)
    {
        $query=$this->mongo_db->get_where('cities',(array('citiesName' => $name)));
        return $query;
    }

    public function updateCountry($id,$cname)
    { 
    //   var_dump($id,$cname,$code);die(); 

      $query = $this->mongo_db->where(array("_id" => new MongoDB\BSON\ObjectID($id)))->set(array("countryName"=>$cname,))->update('countries');
      return $query;
    }

    public function updateCity($id,$cname)
    { 
       
        $query = $this->mongo_db->where(array("_id" => new MongoDB\BSON\ObjectID($id)))->set(array("cityName"=>$cname,"code"=>$code))->update('cities');
        return $query;
    }

    public function deletusermasters1($id)
    {
        $this ->mongo_db->where('_id', new MongoDB\BSON\ObjectID($id));
        $query = $this->mongo_db->delete('usermasters');
        return $query;
    }

 }

?>   