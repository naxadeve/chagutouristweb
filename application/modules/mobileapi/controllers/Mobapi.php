<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobapi extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->load->model('Api_model');

    $api_key = $this->input->post('api_key');
    if(APP_SECRET_KEY != $api_key)
    {
      //Client do not have right permission to access the server....
      //forbidden.....
      //  http_response_code(403);
      $this->output->set_output(json_encode(array('status' => false, 'message' => 'invalid Api Key')))->_display();
      exit;
    }
  }


    public function language()
    {
      $data=$this->general->get_tbl_data_result('name,language,alias','publicationsubcat');//this is language table
      $response['error'] = 0 ;
      $response['message'] = 'List Of Unverified report';
      $response['data'] = $data;
      echo json_encode($response);
      
    }

  public function checkNregistration(){ //checking of new user or already registered and reigistering
    $data=$this->input->post('data');
    //var_dump($data);                     //getting data from api
    if($data){                           //1.check data is empty / notS
      $data_array = json_decode($data, true);
      $email=$data_array['email'];
      //var_dump($email);
      $getuser=$this->Api_model->getuser(); //get array of username from databasae
      if (in_array($email,$getuser, true)) {  //5.checking num exists or not
        $response['error'] = 0;
        $response['message'] = 'User is already exist';
      }else{
        $this->data['maxid'] = $this->general->get_tbl_data_result('"max"(user_id) as id','users');
        $datafinal=array(
            'username'=>$data_array['name'],
            'token'=>'CTG'.$this->data['maxid'][0]['id'],
            'email'=>$data_array['email'],
            'gender'=>$data_array['gender'],
            'purpose'=>$data_array['purpose_of_visit'],
            //'contact_num'=>$data_array['contact_num'],
            //'start_date'=>$data_array['start_date'],
            //'end_date'=>$data_array['end_date'],
            'country'=>$data_array['country']
              );
        //echo "<pre>";print_r($datafinal);die;
        $register=$this->Api_model->register('users',$datafinal);       //inserting data in table & parsing 1 parameter data array with column name and value
        if($register){           //3.check if data inserted or not
          $response['error'] = 0;
          $response['message'] = 'Registered successfully';
        }else{
          $response['error'] = 1;
          $response['message'] = 'Registration failed';
        }                          //3
      }
    }else{                           //2.if empty send no data response
      $response['error'] = 1 ;
      $response['message'] = 'No data';
    }
    echo json_encode($response);
  }
  public function  authCheck(){
    $data=$this->input->post('data');   //getting data from api
    if($data){                           //1.check data is empty / notS
      $data_array = json_decode($data, true);
      $token=$data_array['token'];
      $tokencheck=$this->general->get_tbl_data_result('token','users',array('token'=>$token));
      if($tokencheck) {  //5.checking num exists or not
        //$tokencheck=$this->Api_model->check_auth('users',$token); 
        //$date = new DateTime("now");
        $date =date('Y-m-d');
        $token=$this->general->get_tbl_data_result('token','users',array('end_date >='=>$date,'token'=>$token));
        //echo $this->db->last_query();die;
        if($tokencheck)
        {
          $response['error'] = 0;
          $response['message'] = 'Valid user';
        }else{
          $response['error'] = 1;
          $response['message'] = 'Your token is expired Please Contact to service provider !!';
          $response['data'] = null;
        }
      }else{
        $response['error'] = 1;
        $response['message'] = 'Invalid user';       //inserting data in table & parsing 1 parameter data array with column name and value
        $response['data'] = null;
      }
    }else{
      $response['error'] = 1 ;
      $response['message'] = 'No data';
    }
    echo json_encode($response);
  }
  public function registerUser() {  //register user
    $data=$this->input->post('data');
    if($data){  
      $data_array = json_decode($data, true);
      $this->data['maxid'] = $this->general->get_tbl_data_result('"max"(user_id) as id','users');
      $register=$this->Api_model->register('users',$data_array);       //inserting data in table & parsing 1 parameter data array with column name and value
      if($register){           //3.check if data inserted or not
        $response['error'] = 0;
        $response['message'] = 'Registered successfully';
      }else{
        $response['error'] = 1;
        $response['message'] = 'Registration failed';
      }  
    }else{
      $response['error'] = 1 ;
      $response['message'] = 'No data';
    }
    echo json_encode($response);
  }
  public function check_registered_num(){
    $data=$this->input->post('data');
                    //getting data from api

    if($data){

      //$ph_data=$this->Api_model->get_num();
      $data_array=json_decode($data,TRUE);
      $registered_number=array();
      // var_dump(sizeof($data_array));
      // exit();
      $get_mob=$this->Api_model->get_mobile_no();


    for($i=0;$i<sizeof($data_array);$i++){



        if (in_array($data_array[$i]['mobile_no'],$get_mob,true)) {

          $num=$this->Api_model->get_user_detail($data_array[$i]['mobile_no']);

          $user_data=array(

            "name"=>$num['full_name'],
            "img_url"=>$num['image_url'],
            "mobile_no"=>$num['mobile_no'],
            "token"=>$num['token'],
            "registered"=>TRUE
          );
          array_push($registered_number,$user_data);


        }else{
          $user_data=array(

            "name"=>$data_array[$i]['name'],
            "img_url"=>$data_array[$i]['img_url'],
            "mobile_no"=>$data_array[$i]['mobile_no'],
            "token"=>"",
            "registered"=>FALSE
          );
          array_push($registered_number,$user_data);

        }
     }

     $response['error'] = 0 ;
     $response['message'] = 'List of registered and not registered data';
     $response['data'] = $registered_number;

    }else{
      $response['error'] = 1 ;
      $response['message'] = 'No data';

    }

    echo  json_encode($response);
  }
  public function categoryApi() {
    $category = $this->general->get_tbl_data_result('category_name,category_table,category_type,category_photo,summary_list','categories_tbl');
    $final=array();
    $i=0;
    foreach($category as $data){
      $sum=$this->Api_model->get_sum_name($data['category_table'],$data['summary_list']);
      $sum_name=$sum['nepali_lang'];
      $da=array('summary_name'=>$sum_name);
      //}
      $a=array_merge($category[$i],$da);
      array_push($final,$a);
      $i++;
      }
    $response['status']=0;
    $response['data']=$final;
    echo json_encode($response);
    // echo "<pre>";
    // print_r($response);die;
  }
}//end


            