<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cmodel extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	function checkUserQuestion($question,$customerid)
		{
			$this->db->select('q.*,c.*');
            $this->db->from('transition_details'.' q'); 
            $this->db->join('customers c', 'c.id=q.cust_id', 'left');
			$this->db->where('q.question',$question);
			$this->db->where('c.id',$customerid);
			$query = $this->db->get();
			return $query;
		}
		
	function get_category_approve($approve_val)
	{
	   $setval = array(
		   'status' => 'Yes',
		);
		$array=join(',',$approve_val);
		$this->db->where('id IN ('.$array.')',NULL, FALSE);
		$this->db->update('blooddonor_group', $setval);
		return false;
	}
	function get_category_deapprove($deapprove_val)
	{
		$setval = array(
               'status' => 'No',
         );
		$array=join(',',$deapprove_val);
		$this->db->where('id IN ('.$array.')',NULL, FALSE);
		$this->db->update('blooddonor_group', $setval);
		return false;
	}
		
		
	function get_donor_approve($approve_val)
	{
	   $setval = array(
		   'status' => 'Yes',
		);
		$array=join(',',$approve_val);
		$this->db->where('id IN ('.$array.')',NULL, FALSE);
		$this->db->update('bloodbank', $setval);
		return false;
	}
	function get_donor_deapprove($deapprove_val)
	{
		$setval = array(
               'status' => 'No',
         );
		$array=join(',',$deapprove_val);
		$this->db->where('id IN ('.$array.')',NULL, FALSE);
		$this->db->update('bloodbank', $setval);
		return false;
	}
	
	function checkReviewQuestion($qid,$uid,$tid)
		{
			$this->db->where('cust_id', $uid);
			$this->db->where('que_id', $qid);
			$this->db->where('token_id', $tid);
			$query = $this->db->get('review_question');
			return $query;
	}
				
	 function checkUserTemplate($table,$colum,$data)
		{
			$this->db->where($colum, $data);
			$query = $this->db->get($table);
			return $query;
		}
		
	function getLastInsertedId($table,$orderId)
     {
		$query = $this->db
						->order_by($orderId,'desc')
						->limit(1)
						->get($table);
		return $query->row_array();
     }
	 
	 
	
	 function checkAppoinment($docId,$meridium,$day)
		{
			$this->db->where('docId', $docId);
			$this->db->where('day', $day);
			if($meridium!=""){
				$this->db->where('meridium', $meridium);
			}
			$query = $this->db->get('appooinment_schedule');
			return $query;
			/*if($query->num_rows() > 0)
				return 1;
			else
				return 0;*/
		}
	
	function checkAppoinment1($docId,$day,$chemId)
		{
			$this->db->where('doctors_id', $docId);
			$this->db->where('working_days', $day);
			$this->db->where('chember_id', $chemId);
			$query = $this->db->get('appooinment_schedule');
			return $query;
		}
		 
	  function forgotPassword($table,$colum,$tomail)
		{
			$this->db->where($colum, $tomail);
			$query = $this->db->get($table);
			return $query;
		}
	 
	 function checkOldPass($table,$old_password,$docId)
		{
			//$this->db->where('email', $this->session->userdata('userMail'));
			$this->db->where('id', $docId);
			$this->db->where('password', $old_password);
			$query = $this->db->get($table);
			return $query;
		}

	function checkdonorOldPass($table,$old_password,$docId)
		{
			//$this->db->where('email', $this->session->userdata('userMail'));
			$this->db->where('id', $docId);
			$this->db->where('md5_pwd', $old_password);
			$query = $this->db->get($table);
			return $query;
		}


 function checkuser($table,$colum,$email,$colum2)
		{
			$this->db->where($colum, $email);
			$this->db->where($colum2.'!=', '');
			$query = $this->db->get($table);
			return $query;
		}
	function getComonLogin($table,$userCol, $usr, $passCol, $pwd)
     {
		$query = $this->db->get_where($table, array($userCol=>$usr, $passCol=>$pwd));
		return $query->row_array();
     }
	

	function get_user($usr, $pwd)
     {
		$query = $this->db->get_where('customers', array('email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1 ));
		return $query->row_array();
     }
	
	
	function get_userLogin($usr, $pwd, $status)
     {
		 if($status=="customer"){
		     $query = $this->db->get_where('customers', array('email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1 ));
			 return $query->row_array();
		 }
		 elseif($status=="doctor"){
		     	$general = $this->db->get_where('edoctors', array('email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1, 'doctorType'=> 'General' ));
				$consult = $this->db->get_where('edoctors', array('email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1, 'doctorType'=> 'Consultancy' ));
				$appoinment = $this->db->get_where('edoctors', array('email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1, 'doctorType'=> 'Appoinment' ));
				$both = $this->db->get_where('edoctors', array('email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1, 'doctorType'=> 'Both' ));
				if ($general->num_rows() > 0)
				{
				 	 return array(
						'generalResult' => $general->row_array(),
						'doctorType' => 'General'
						);
				}
				elseif ($consult->num_rows() > 0)
				{
				 	 return array(
						'consultResult' => $consult->row_array(),
						'doctorType' => 'Consultancy'
						);
				}
				elseif ($appoinment->num_rows() > 0)
				{
				 	 return array(
						'appoinmentResult' => $appoinment->row_array(),
						'doctorType' => 'Appoinment'
						);
				}
				elseif ($both->num_rows() > 0)
				{
				 	 return array(
						'bothResult' => $both->row_array(),
						'doctorType' => 'Both'
						);
				}
		 }
     }
	 
	 
	function update_table($tablename, $tableprimary_idname,$tableprimary_idvalue, $updated_array){
		$modified_date = time();
		$this->db->where($tableprimary_idname,$tableprimary_idvalue);
		$dbquery = $this->db->update($tablename, $updated_array); 

		if($dbquery)
			return true;
		else
			return false;
	}
	
	function userauth($userID = '', $password='' ){
		$query =	$this->db->get_where('user', array('user_name'=> $userID, 'user_password'=>$password, 'user_published'=> 1 ));
		return $query;
	}
	
	function doctorsauth($email = '', $password='' ){
		$query = $this->db->get_where('edoctors', array('email'=> $email, 'password'=>$password, 'active'=> 1 ));
		return $query;
	}	
	
	function getalluser(){
		$query = $this->db->order_by('id','desc')->get('user');
		return $query;	
	}
	
/*----- Insert Table and Get ID -------- */
	
	function inertTable($table, $data){
		if($this->db->insert($table, $data)):
			return $this->db->insert_id();
		else:
			return false;
		endif;
	}
/*----- Delete Table Row -------- */
	function deletetable_row($tablename, $tableidname, $tableidvalue){
		if($this->db->where($tableidname, $tableidvalue)->delete($tablename)) return true;
		return false;
	}	
	
	
	
	
/*----- Find table data with id and Oreder one and all -------- */
function getAlldiagonostic($start,$limit){
		$this->db->select('*');
		$this->db->from('diagonostic');
		$this->db->order_by('diagonostic_name', 'asc');
		if($start!=""){
			$this->db->limit($start,$limit);
		}
		$query =   $this->db->get();
		return $query;	
	}

function getAllclinic($start,$limit){
		$this->db->select('*');
		$this->db->from('clinic');
		$this->db->order_by('clinic_name', 'asc');
		if($start!=""){
			$this->db->limit($start,$limit);
		}
		$query =   $this->db->get();
		return $query;	
	}


function getAllHospital($start,$limit){
		$this->db->select('*');
		$this->db->from('hospital');
		$this->db->order_by('hospital_name', 'asc');
		if($start!=""){
			$this->db->limit($start,$limit);
		}
		$query =   $this->db->get();
		return $query;	
	}

function getArrayItemTable($table,$colum,$id,$date,$datecol,$orderId,$order){
		  if($id!=""){
			  $this->db->where_in($colum,$id);
		  }
		   if($date!=""){
			  $this->db->where($date,$datecol);
		  }
		  $this->db->order_by($orderId,$order);
   		  $query = $this->db->get($table);
		return $query;
}

function getTable($table,$column,$order){
		$query =   $this->db
						->order_by($column, $order)
						->get($table);
		return $query;	
	}

function getOneItemTable($table,$tableColum,$userColum,$orderId,$order){
		$query =   $this->db
						->order_by($orderId, $order)
						->where($tableColum,$userColum)
						->get($table);
		return $query->row_array();	
	}
// Display All data with id
function getAllItemTable($table,$colum,$id,$statusColum,$status,$orderId,$order){
					if($id!=""){
						$this->db->where($colum,$id);
					}
					if($status!=""){
						$this->db->where($statusColum,$status);
					}
					$this->db->order_by($orderId,$order);
   		   $query = $this->db->get($table);
		//return $query->result();
		return $query;
}
// Display All data with id and date
function getAllItemWithDateTable($table,$colum,$id,$statusColum,$status,$orderId,$order){
		$query =   $this->db
						->where($colum,$id)
						->where($statusColum,$status)
						->where('answer=', NULL)
						->where('date',date('Y-m-d'))
						->order_by($orderId,$order)
						->get($table);
		return $query;
		
}


function getMedicalReport($patientId){
		$query =   $this->db
						->where('patientId',$patientId)
						->get('medicalreport');
		return $query->result();	
	}
	
function getDoctorsTable($doctId){
		$query =   $this->db
						->where('id',$doctId)
						->get('edoctors');
		return $query->row_array();	
	}
	
/*----- Get a table row by primary key id -------- */
	function getTableRow($table,$column,$ID){
		$query = $this->db->get_where($table, array($column =>$ID));
		return $query;	
	}
/*----- //Get a table row by primary key id -------- */

/*----- Update a table row by primary key id -------- */
	function updateTable($tablename, $tableprimary_idname,$tableprimary_idvalue, $updated_array){
		$modified_date = time();
		$this->db->where($tableprimary_idname,$tableprimary_idvalue);
		$dbquery = $this->db->update($tablename, $updated_array); 

		if($dbquery)
			return true;
		else
			return false;
	}
	
	
	function GetAllPage($type = '', $limit = 0, $start = 0){
		$this->db->order_by('id', 'desc')->limit($limit, $start);
		return $this->db->get_where('pagelist',array('type'=>$type));
	}
	

 public function record_count($table) {
        return $this->db->count_all($table);
    }
	
	
	function getTransCustomDoctorData($table,$fieldId,$id,$searchType,$keyword,$sessionId,$groupId,$order,$start,$limit){
			$this->db->select('a.*,b.fullname as cname,b.email as custEmail, b.mobileno, c.fullname as dname, c.*');
            $this->db->from($table.' a'); 
            $this->db->join('customers b', 'b.id=a.cust_id', 'left');
            $this->db->join('edoctors c', 'c.id=a.doc_id', 'left');
			if($keyword!=""){
				if($searchType=="doctor"){
				 	$this->db->like('c.fullname', $keyword); 
				}
				elseif($searchType=="patient"){
				 	$this->db->like('b.fullname', $keyword); 
				}
			}
			if($id!=""){
				 $this->db->where('a.'.$fieldId,$id);
			}
			elseif($sessionId!=""){
				 $this->db->where('a.doc_id',$sessionId);
			}
			if($groupId!=""){
				 $this->db->group_by('a.'.$groupId); 
			}
            $this->db->order_by('a.'.$fieldId,$order);
			$this->db->limit($start,$limit);         
            $query = $this->db->get(); 
            return $query;
	}
	
	
	
	/*function getTransCustomDoctorData($table,$fieldId,$id,$searchType,$keyword,$sessionId,$groupId,$start,$limit){
			if($table=="transition_details"){
				$query = $this->db->query("select * from answer");
				foreach($query->result() as $row){
					$ansToken[] =  $row->tokenId;
				}
			}
			
			
			$this->db->select('a.*,b.fullname as cname,b.email as custEmail, b.mobileno, c.fullname as dname, c.*');
            $this->db->from($table.' a'); 
            $this->db->join('customers b', 'b.id=a.cust_id', 'left');
            $this->db->join('edoctors c', 'c.id=a.doc_id', 'left');
			if($keyword!=""){
				if($searchType=="doctor"){
				 	$this->db->like('c.fullname', $keyword); 
				}
				elseif($searchType=="patient"){
				 	$this->db->like('b.fullname', $keyword); 
				}
			}
			if($id!=""){
				 $this->db->where('a.'.$fieldId,$id);
			}
			elseif($sessionId!=""){
				 $this->db->where('a.doc_id',$sessionId);
			}
			
			if($table=="transition_details"){
				$this->db->where_not_in('a.token_id',$ansToken);
			}
			if($groupId!=""){
				 $this->db->group_by('a.'.$groupId); 
			}
            $this->db->order_by('a.'.$fieldId,'desc');
			$this->db->limit($start,$limit);         
            $query = $this->db->get(); 
            return $query;
	}*/
	
	
	
	function getConsultancyAnswer($doctorname,$patientname,$today,$from,$to,$start,$limit){
			$this->db->select('a.*,b.fullname as cname,b.email as custEmail, b.mobileno, c.fullname as dname, c.*,an.*');
            $this->db->from('transition_details a'); 
            $this->db->join('customers b', 'b.id=a.cust_id', 'left');
            $this->db->join('edoctors c', 'c.id=a.doc_id', 'left');
			$this->db->join('answer an', 'a.token_id=an.tokenId', 'left');
			
			 	if($from=="" && $to!=""){
				 $this->db->where('date', $to); 
				}
				elseif($from!="" && $to!=""){
					 $this->db->where('date >=', $from);
					 $this->db->where('date <=', $to); 
				}
			
			if($doctorname!=""){
				$this->db->like('c.fullname', $doctorname); 
			}
			if($patientname!=""){
				$this->db->like('b.fullname', $patientname); 
			}
			if($today!=""){
					if($today=="question"){
				 	$this->db->where('a.date', date('Y-m-d')); 
					}
					elseif($today=="answer"){
						$this->db->like('an.ans_date', date('Y-m-d')); 
					}
			}
			
            $this->db->order_by('a.tid','desc');
			$this->db->limit($start,$limit);         
            $query = $this->db->get(); 
            return $query;
	}
	
	function getTotalQueAns($table,$colid){
            $this->db->order_by($colid,'desc');
            $query = $this->db->get($table); 
            return $query;
	}
	
// join table

function getPaymentReport($t1,$t2,$t1Col,$t2Col,$orderCol,$order,$name,$from,$to,$start,$limit){
			$this->db->select('*');
            $this->db->from($t1.' p'); 
            $this->db->join($t2.' d', 'd.'.$t2Col.'= p.'.$t1Col.'', 'left');
			if($name!=""){
				 $this->db->like('d.fullname', $name); 
				 $this->db->or_like('d.Speciality', $name);
				 $this->db->or_like('d.contactNo', $name);
				 $this->db->or_like('d.degree', $name);
				 $this->db->or_like('p.payment_by', $name);
				 $this->db->or_like('p.method', $name);
				 $this->db->or_like('p.payment_key', $name);
			}
			elseif($from=="" && $to!=""){
				 $this->db->where('p.date', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('p.date >=', $from);
				 $this->db->where('p.date <=', $to); 
			}
			$this->db->order_by('p.'.$orderCol,$order);
			$this->db->limit($start,$limit);          
            $query = $this->db->get(); 
			return $query;
}



function getAppoinmentReport($t1,$t2,$t1Col,$t2Col,$orderCol,$order,$name,$doctor_id,$patient_name,$today,$status,$from,$to,$detColId,$detId,$start,$limit){
			$this->db->select('a.*,d.fullname, d.id as docId');
            $this->db->from($t1.' a'); 
            $this->db->join($t2.' d', 'd.'.$t2Col.'= a.'.$t1Col.'', 'left');
			
			if($doctor_id!=""){
				 $this->db->where('a.doctor_Id', $doctor_id);
			}
			if($patient_name!=""){
				 $this->db->where('a.patient_name', $patient_name);
			}
			if($today!=""){
				 $this->db->where('a.updateDate', date('Y-m-d')); 
			}
			if($status!=""){
				 $this->db->where('a.confirm', $status); 
			}
			if($name!=""){
				$this->db->like('a.patient_name', $name); 
				$this->db->or_like('a.customerMobile', $name);
				$this->db->or_like('a.appoinmentTime', $name);
			}
			elseif($from=="" && $to!=""){
				 $this->db->where('a.updateDate', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('a.updateDate >=', $from);
				 $this->db->where('a.updateDate <=', $to); 
			}
			if($detId!=""){
				 $this->db->where('a.'.$detColId, $detId); 
			}
			$this->db->order_by('a.'.$orderCol,$order);
			//$this->db->limit($start,$limit);          
            $query = $this->db->get(); 
			return $query;
}

function getPaymentHistory($table,$colId,$matchId){
			$query =   $this->db
					->where($colId,$matchId)
					->get($table);
				 return $query;
		}





function getUserDoctorCount($doctorid,$from,$to,$keyword,$speciltyId,$fullname,$email,$username,$hospitalName,$currentPosition,$bmdcNumber,$doctorType){
			if($doctorType!=""){
				 $this->db->like('doctorType', $doctorType);	
			}
			if($from=="" && $to!=""){
				 $this->db->where('created_time', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('created_time >=', $from);
				 $this->db->where('created_time <=', $to); 
			}
			 if($keyword=="today"){
				 $this->db->where('created_time', date('Y-m-d'));
			 }
			 elseif($keyword=="online"){
				 $this->db->where('loginStatus', 1);
			 }
			if($speciltyId!=""){
				 $this->db->where('SpecialityID', $speciltyId);
			}
			if($fullname!=""){
				 $this->db->like('fullname', $fullname);
			}
			if($email!=""){
				 $this->db->like('email', $email);
			}
			if($username!=""){
				 $this->db->where('username', $username);
			}
			if($hospitalName!=""){
				 $this->db->like('hospitalName', $hospitalName);
			}
			if($currentPosition!=""){
				 $this->db->like('currentPosition', $currentPosition);
			}
			if($bmdcNumber!=""){
				 $this->db->like('bmdcNumber', $bmdcNumber);
			}
		$this->db->where_in('id', $doctorid);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('edoctors'); 
		return $query;
	}
	
function getUserDoctorList($doctorid,$from,$to,$keyword,$speciltyId,$fullname,$email,$username,$hospitalName,$currentPosition,
$bmdcNumber,$doctorType,$start, $limit){
			if($doctorType!=""){
				 $this->db->like('doctorType', $doctorType);	
			}
			if($from=="" && $to!=""){
				 $this->db->where('created_time', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('created_time >=', $from);
				 $this->db->where('created_time <=', $to); 
			}
			 if($keyword=="today"){
				 $this->db->where('created_time', date('Y-m-d'));
			 }
			 elseif($keyword=="online"){
				 $this->db->where('loginStatus', 1);
			 }
			if($speciltyId!=""){
				 $this->db->where('SpecialityID', $speciltyId);
			}
			if($fullname!=""){
				 $this->db->like('fullname', $fullname);
			}
			if($email!=""){
				 $this->db->like('email', $email);
			}
			if($username!=""){
				 $this->db->where('username', $username);
			}
			if($hospitalName!=""){
				 $this->db->like('hospitalName', $hospitalName);
			}
			if($currentPosition!=""){
				 $this->db->like('currentPosition', $currentPosition);
			}
			if($bmdcNumber!=""){
				 $this->db->like('bmdcNumber', $bmdcNumber);
			}
			$this->db->where_in('id', $doctorid);
			$this->db->order_by('id', 'desc');
			$this->db->limit($start, $limit);
			$query = $this->db->get('edoctors');
			return $query;
}




	
	
function getAllDoctorCount($from,$to,$keyword,$speciltyId,$fullname,$email,$username,$hospitalName,$currentPosition,$bmdcNumber,$doctorType){
			
			if($doctorType!=""){
				 $this->db->like('doctorType', $doctorType);	
			}
			if($from=="" && $to!=""){
				 $this->db->where('created_time', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('created_time >=', $from);
				 $this->db->where('created_time <=', $to); 
			}
			 if($keyword=="today"){
				 $this->db->where('created_time', date('Y-m-d'));
			 }
			 elseif($keyword=="online"){
				 $this->db->where('loginStatus', 1);
			 }
			if($speciltyId!=""){
				 $this->db->where('SpecialityID', $speciltyId);
			}
			if($fullname!=""){
				 $this->db->like('fullname', $fullname);
			}
			if($email!=""){
				 $this->db->like('email', $email);
			}
			if($username!=""){
				 $this->db->where('username', $username);
			}
			if($hospitalName!=""){
				 $this->db->like('hospitalName', $hospitalName);
			}
			if($currentPosition!=""){
				 $this->db->like('currentPosition', $currentPosition);
			}
			if($bmdcNumber!=""){
				 $this->db->like('bmdcNumber', $bmdcNumber);
			}
			
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('edoctors'); 
		return $query;
	}
	
function getAllDoctorList($from,$to,$keyword,$speciltyId,$fullname,$email,$username,$hospitalName,$currentPosition,
$bmdcNumber,$doctorType,$start, $limit){
			if($doctorType!=""){
				 $this->db->like('doctorType', $doctorType);	
			}
			if($from=="" && $to!=""){
				 $this->db->where('created_time', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('created_time >=', $from);
				 $this->db->where('created_time <=', $to); 
			}
			 if($keyword=="today"){
				 $this->db->where('created_time', date('Y-m-d'));
			 }
			 elseif($keyword=="online"){
				 $this->db->where('loginStatus', 1);
			 }
			if($speciltyId!=""){
				 $this->db->where('SpecialityID', $speciltyId);
			}
			if($fullname!=""){
				 $this->db->like('fullname', $fullname);
			}
			if($email!=""){
				 $this->db->like('email', $email);
			}
			if($username!=""){
				 $this->db->where('username', $username);
			}
			if($hospitalName!=""){
				 $this->db->like('hospitalName', $hospitalName);
			}
			if($currentPosition!=""){
				 $this->db->like('currentPosition', $currentPosition);
			}
			if($bmdcNumber!=""){
				 $this->db->like('bmdcNumber', $bmdcNumber);
			}
			
			$this->db->order_by('id', 'desc');
			$this->db->limit($start, $limit);
			$query = $this->db->get('edoctors');
			return $query;
	}
	
	
		
	
	
		
			
	
function getDoctorCount($table,$id,$from,$to,$keyword,$doctorType){
			if($doctorType!=""){
				 $this->db->like('doctorType', $doctorType);	
			}
			if($from=="" && $to!=""){
				 $this->db->where('created_time', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('created_time >=', $from);
				 $this->db->where('created_time <=', $to); 
			}
			if($keyword!=""){
				 if($table=="edoctors"){
					 if($keyword=="today"){
						 $this->db->where('created_time', date('Y-m-d'));
					 }
					 elseif($keyword=="online"){
						 $this->db->where('loginStatus', 1);
					 }
					 else{
						 $this->db->where('SpecialityID', $keyword);
						 $this->db->like('fullname', $keyword); 
						 $this->db->or_like('Speciality', $keyword);
						 $this->db->or_like('username', $keyword);
						 $this->db->or_like('email', $keyword);
						 $this->db->or_like('hospitalName', $keyword);
						 $this->db->or_like('currentPosition', $keyword);
						 $this->db->or_like('bmdcNumber', $keyword);
					 }
				}
				else{
					 $this->db->like('fullname', $keyword); 
					 $this->db->or_like('email', $keyword);
					 $this->db->or_like('mobileno', $keyword);
				 }
			}
		$query = $this->db->get($table); 
		return $query;
	}
	
function getDoctorPaginate($table,$id,$from,$to,$keyword,$doctorType, $start, $limit){
			if($doctorType!=""){
				 $this->db->like('doctorType', $doctorType);	
			}
			if($from=="" && $to!=""){
				 $this->db->where('created_time', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('created_time >=', $from);
				 $this->db->where('created_time <=', $to); 
			}
			if($keyword!=""){
				 if($table=="edoctors"){
					 if($keyword=="today"){
						 $this->db->where('created_time', date('Y-m-d'));
					 }
					 elseif($keyword=="online"){
						 $this->db->where('loginStatus', 1);
					 }
					 else{
						 $this->db->where('SpecialityID', $keyword);
						 $this->db->like('fullname', $keyword); 
						 $this->db->or_like('Speciality', $keyword);
						 $this->db->or_like('username', $keyword);
						 $this->db->or_like('email', $keyword);
						 $this->db->or_like('hospitalName', $keyword);
						 $this->db->or_like('currentPosition', $keyword);
						 $this->db->or_like('bmdcNumber', $keyword);
					 }
				}
				else{
					 $this->db->like('fullname', $keyword); 
					 $this->db->or_like('email', $keyword);
					 $this->db->or_like('mobileno', $keyword);
				 }
			}
		$this->db->order_by($id, 'desc');
		if($start!=""){
			$this->db->limit($start, $limit);
		}
		
		$query = $this->db->get($table); 
		return $query;
	}
	
	
	function getSpecialistList(){
		$this->db->order_by('id');
		$query = $this->db->get('dr_specialty'); 
		return $query;
	}
	
	
	//get doctors  by speacility id
	function getDoctorBySpecialitiID($specialityID){
		//$query = $this->db
		//->order_by('id', 'DESC')
		//->get_where('edoctors', array('SpecialityID'=>$specialityID,'doctorType'=>'Consultancy','feePrimary !=' =>0,'active'=>1));
		//return $query;
		
		
			$this->db->select('*');
            $this->db->from('edoctors'); 
			$this->db->where('SpecialityID',$specialityID);
			$this->db->where('active',1);
			$this->db->where('feePrimary !=',0);
			//$this->db->where('doctorType','Consultancy');
			//$this->db->or_where('doctorType','Both');
			
            $this->db->order_by('fullname','asc');
            $query = $this->db->get(); 
            return $query;	
	}

	function getCity($countryID){
		return $this->db->get_where('citylist', array('CountryID'=>$countryID));
	}
	
	function GetCountryByID($countryID){
		return $this->db->get_where('countries', array('idCountry'=>$countryID));
	}
	function GetCityByID($cityID){
		return $this->db->get_where('citylist', array('CityID'=>$cityID));
	}
	
	
/////////////// Doctors List /////////////////


public function record_countApponment($docType,$disDoctorName,$specialty,$district,$location,$dDesignation,$dHospital) {
        	if($dtype!=""){
				if($docType!="All Doctor"){
					$this->db->select('*');
					$this->db->from('edoctors');
					$this->db->where('doctorType',$docType);
					//$this->db->or_where('doctorType','Both');
					if($disDoctorName!=""){
						$this->db->like('fullname',$disDoctorName);   
					}
					if($specialty!=""){
						$this->db->where('SpecialityID',$specialty);   
					}
					if($district!=""){
						$this->db->like('district',$district);   
					}
					if($location!=""){
						$this->db->like('location',$location);   
					}
					if($dDesignation!=""){
							$this->db->like('currentPosition',$dDesignation);
					}
					if($dHospital!=""){
						$this->db->where('hospitalName',$dHospital);
					}
					
				}
				elseif($dtype=="All Doctor"){
					$this->db->select('*');
					$this->db->from('edoctors');
					if($disDoctorName!=""){
						$this->db->like('fullname',$disDoctorName);   
					}
					if($specialty!=""){
						$this->db->where('SpecialityID',$specialty);   
					}
					if($district!=""){
						$this->db->like('district',$district);   
					}
					if($location!=""){
						$this->db->like('location',$location);   
					}
					if($dDesignation!=""){
							$this->db->like('currentPosition',$dDesignation);
					}
					if($dHospital!=""){
						$this->db->where('hospitalName',$dHospital);
					}
				}
			}
			
			else{
				$this->db->select('*');
				$this->db->from('edoctors');
			}
			$result = $this->db->get();
			return $result->num_rows();
    }
	
function doctorsList($dtype,$disDoctorName,$specialty,$district,$location,$dDesignation,$dHospital,$start,$limit){
			if($dtype!=""){
				if($dtype!="All Doctor"){
					$this->db->select('*');
					$this->db->from('edoctors');
					$this->db->where('doctorType',$dtype);
					//$this->db->or_where('doctorType','Both');
					/*if($specialty==""){
						$this->db->or_where('doctorType','Both');
					}*/
					
					if($disDoctorName!=""){
						$this->db->like('fullname',$disDoctorName);   
					}
					if($specialty!=""){
						$this->db->where('SpecialityID',$specialty);   
					}
					if($district!=""){
						$this->db->like('district',$district);   
					}
					if($location!=""){
						$this->db->like('location',$location);   
					}
					if($dDesignation!=""){
							$this->db->like('currentPosition',$dDesignation);
					}
					if($dHospital!=""){
						$this->db->where('hospitalName',$dHospital);
					}
					
				}
				elseif($dtype=="All Doctor"){
					$this->db->select('*');
					$this->db->from('edoctors');
					if($disDoctorName!=""){
						$this->db->like('fullname',$disDoctorName);   
					}
					if($specialty!=""){
						$this->db->where('SpecialityID',$specialty);   
					}
					if($district!=""){
						$this->db->like('district',$district);   
					}
					if($location!=""){
						$this->db->like('location',$location);   
					}
					if($dDesignation!=""){
							$this->db->like('currentPosition',$dDesignation);
					}
					if($dHospital!=""){
						$this->db->where('hospitalName',$dHospital);
					}
				}
			}
			else{
				$this->db->select('*');
				$this->db->from('edoctors');
			}
			$this->db->limit($start,$limit);
			$result = $this->db->get();
            return $result;
	}	
	
	
	function homepageDoctorsList($specialtyId,$homeDisplay){
			$this->db->select('*');
            $this->db->from('edoctors');
			if($homeDisplay!=""){
				$this->db->where('user_onlinestatus','1');  
				$this->db->where('sequence !=','0');
				$this->db->group_by('id');   
				$this->db->order_by('sequence','asc'); 
			}
			if($specialtyId!=""){
				$this->db->where('SpecialityID',$specialtyId); 
				$this->db->order_by('id','desc');  
			}
			
			
			$this->db->limit(20); 
            $query = $this->db->get(); 
            return $query;
	}	
	public function GetDoctorsRow($keyword) {        
        $this->db->order_by('id', 'DESC');
        $this->db->like("fullname", $keyword);
        return $this->db->get('edoctors')->result_array();
    }
	
	public function GetRow($keyword) {        
        $this->db->order_by('id', 'DESC');
        $this->db->like("hospitalName", $keyword);
        return $this->db->get('edoctors')->result_array();
    }
	public function DistrictRow($keyword) {        
        $this->db->order_by('name', 'asc');
		$this->db->where('parent_id', '22');
        $this->db->like("name", $keyword);
        return $this->db->get('countryall')->result_array();
    }
	
	public function LocationRow($keyword) {        
        $this->db->order_by('id', 'DESC');
		$this->db->group_by('location');
        $this->db->like("location", $keyword);
        return $this->db->get('edoctors')->result_array();
    }
	
	
	function getSpecialityByType($dtype){
			$this->db->select('e.SpecialityID, e.doctorType, s.*');
            $this->db->from('edoctors'.' e'); 
            $this->db->join('dr_specialty s', 's.id=e.SpecialityID', 'left');
			if($dtype!="All Doctor"){
				$this->db->where('e.doctorType',$dtype);
				$this->db->or_where('e.doctorType','Both');
			}
			$this->db->group_by('e.SpecialityID');
            $this->db->order_by('s.specialty','asc');
            $query = $this->db->get(); 
            return $query;
	}
	
	 public function record_countUserTran($table,$colum,$id) {
			   $this->db->where($colum,$id);
        return $this->db->get($table);
    }
	function getAllUserQues($table,$colum,$id,$statusColum,$status,$orderId,$order,$start,$limit){
					$this->db->where($colum,$id);
					if($status!=""){
						$this->db->where($statusColum,$status);
					}
					$this->db->order_by($orderId,$order);
					$this->db->limit($start,$limit);
   		   $query = $this->db->get($table);
		//return $query->result();
		return $query;
}



function update_squnce($table,$seqColum,$seqence,$idColum,$id)
		{
	
			$query=$this->db->query("select * from ".$table." where ".$seqColum."='".$seqence."'");
			$results=$query->result();
			foreach($results as $row);
			$sequenceVal=$row->$seqColum;
			$nid=$row->$idColum;
								
			if($seqence!=$sequenceVal){
				$update=$this->db->query("update ".$table." set ".$seqColum."='".$seqence."' where ".$idColum."='".$id."'");
			}
			else{
				$query1=$this->db->query("select * from ".$table." where ".$idColum."='".$id."'");
				$results1=$query1->result();
				foreach($results1 as $row1);
				$sequenceVal1=$row1->$seqColum;
				$nid1=$row1->$idColum;
			
				$update=$this->db->query("update ".$table." set ".$seqColum."='".$sequenceVal1."' where ".$idColum."='".$nid."'");
				$update1=$this->db->query("update ".$table." set ".$seqColum."='".$seqence."' where ".$idColum."='".$id."'");
			}
	}
	

function getAllPaidUserQues($cusid,$start,$limit){
					$this->db->where('cust_id',$cusid);
					$this->db->where('status','Paid');
					$this->db->where('bikashTransition_id !=','');
					$this->db->order_by('tid','desc');
					//$this->db->limit($start,$limit);
   		   $query = $this->db->get('transition_details');
		//return $query->result();
		return $query;
}	



function getAllPendingUserQues($cusid,$trid,$start,$limit){
					$this->db->where('cust_id',$cusid);
					$this->db->where('status','Pending');
					if($trid!=""){
						$this->db->where('bikashTransition_id!= ','');
					}
					if($trid==""){
						$this->db->where('bikashTransition_id','');
					}
					$this->db->order_by('tid','desc');
					//$this->db->limit($start,$limit);
   		   $query = $this->db->get('transition_details');
		//return $query->result();
		return $query;
}	

	public function GetAppPat($table,$colum,$keyword) {        
        $this->db->order_by('appoin_id', 'DESC');
        $this->db->like($colum, $keyword);
        return $this->db->get($table)->result_array();
    }

	public function GetRowDocCust($table,$colum,$keyword) {        
        $this->db->order_by('id', 'DESC');
        $this->db->like($colum, $keyword);
        return $this->db->get($table)->result_array();
    }


	function getAllSearchItem($table,$keyword,$from,$to,$orderid,$order)
	  {
		  if($from=="" && $to!=""){
				 $this->db->where('from_date', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('from_date >=', $from);
				 $this->db->where('from_date <=', $to); 
			}
					 
		  if($keyword!=""){
			  	if($keyword=="today"){
					$this->db->where('from_date', date('Y-m-d'));
				}
				else{
				  $this->db->like('memberName',$keyword);
				  $this->db->or_like('member_type',$keyword);
				}
		   }
		  $this->db->order_by($orderid,$order);
		  $query = $this->db->get($table);
		  return $query;
	  }	
	  
	  function getAlldonorGroup($keyword,$groupName,$donorGroupType,$from,$to,$start,$limit)
	  {
		  if($from=="" && $to!=""){
				 $this->db->where('entry_time', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('entry_time >=', $from);
				 $this->db->where('entry_time <=', $to); 
			}
			if($keyword=="today"){
				$this->db->where('entry_time', date('Y-m-d'));
			}	 
		  	if($groupName!=""){
				  $this->db->where('groupname',$groupName);
			}
			if($donorGroupType!=""){
				  $this->db->where('group_type',$donorGroupType);
			}

		  $this->db->order_by('groupname','asc');
		  if($start!=""){
		  	$this->db->limit($start,$limit);
		  }
		  $query = $this->db->get('blooddonor_group');
		  return $query;
	  }	
	  
	  function getAlldonor($keyword,$from,$to,$start,$limit)
	  {
		  if($from=="" && $to!=""){
				 $this->db->where('entry_time', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('entry_time >=', $from);
				 $this->db->where('entry_time <=', $to); 
			}
					 
		  if($keyword!=""){
			  	if($keyword=="today"){
					$this->db->where('entry_time', date('Y-m-d'));
				}
				else{
				  $this->db->like('blood_group',$keyword);
				  $this->db->or_like('name',$keyword);
				}
		   }
		  $this->db->order_by('id','desc');
		  if($start!=""){
		  	$this->db->limit($start,$limit);
		  }
		  $query = $this->db->get('bloodbank');
		  return $query;
	  }	
	  
	  
	  function getUserCountStatus($keyword,$from,$to)
	  {
		  if($from=="" && $to!=""){
				 $this->db->where('created_date', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('created_date >=', $from);
				 $this->db->where('created_date <=', $to); 
			}
					 
		  if($keyword!=""){
				  $this->db->where('user_id',$keyword);
		   }
		  $this->db->where('user_id !=','');
		  $this->db->order_by('user_name','asc');
		  $query = $this->db->get('user_reg');
		  return $query;
	  }
	  
	  function getUserStatus($keyword,$from,$to,$start,$limit)
	  {
		  if($from=="" && $to!=""){
				 $this->db->where('created_date', $to); 
			}
			elseif($from!="" && $to!=""){
				 $this->db->where('created_date >=', $from);
				 $this->db->where('created_date <=', $to); 
			}
					 
		  if($keyword!=""){
				  $this->db->where('user_id',$keyword);
		   }
		  $this->db->where('user_id !=','');
		  $this->db->order_by('user_name','asc');
		  $this->db->limit($start,$limit);
		  $query = $this->db->get('user_reg');
		  return $query;
	  }	
	  
	 
	 
	 
	  function donorCount($bloodGroup,$district,$location)
	  {
		  if($bloodGroup!=""){
			  $this->db->where('blood_group',$bloodGroup);
		  }
		   if($district!=""){
			  $this->db->where('district',$district);
		  }
		   if($location!=""){
			  $this->db->like('location',$location);
		  }
		  $this->db->order_by('name','asc');
		  $query = $this->db->get('bloodbank');
		  return $query;
	  }	
	  
	  
	  function donorSearchList($bloodGroup,$district,$location,$start,$limit)
	  {
		  if($bloodGroup!=""){
			  $this->db->where('blood_group',$bloodGroup);
		  }
		   if($district!=""){
			  $this->db->like('district',$district);
		  }
		   if($location!=""){
			  $this->db->like('location',$location);
		  }
  	      $this->db->where('donationExpDate <', date('Y-m-d'));
		  $this->db->order_by('name','asc');
		  if($start!=""){
		  	$this->db->limit($start,$limit);
		  }
		  $query = $this->db->get('bloodbank');
		  return $query;
	  }	
	  
	  
	///////////////////// Group List //////////////////////
	function donorGroupCount()
	  {
		  $this->db->order_by('groupname','asc');
		  $query = $this->db->get('blooddonor_group');
		  return $query;
	  }	
	  
	  
	  function donorGroupSearchList($start,$limit)
	  {
		  $this->db->order_by('groupname','asc');
		  $this->db->limit($start,$limit);
		  $query = $this->db->get('blooddonor_group');
		  return $query;
	  }	
	  
	  function blooddonation($start,$limit)
	  {
		  $this->db->order_by('donationId','desc');
		  if($start!=""){
		  	$this->db->limit($start,$limit);
		  }
		  $query = $this->db->get('blooddonation');
		  return $query;
	  }
	  
	  function allHospitalList()
	  {
		  $this->db->where('hospitalName !=','');
		  $this->db->group_by('hospitalName');
		  $this->db->order_by('hospitalName','asc');
		  $query = $this->db->get('edoctors');
		  return $query;
	  }	
	  
	  
	  function getConsultancyDoctor($doctorid,$limit){
		  
		 if($doctorid!=""){
			$this->db->where_in('id',$doctorid);
		 }
		// $this->db->where('doctorType','Consultancy');
		$this->db->order_by('id','desc');
		if($limit!=""){
			$this->db->limit($limit);
		}
		
 		$query = $this->db->get('edoctors');
		return $query;
	}
}
