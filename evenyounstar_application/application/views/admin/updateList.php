<?php 
$array	= $_POST['arrayorder'];
if ($_POST['update'] == "update"){
	
	$count = 1;
	foreach ($array as $idval) {
		$query = "UPDATE ecmember SET sequence = " . $count . " WHERE b_id = " . $idval;
		$this->db->query($query);
		$count ++;	
	}
	echo 'All saved! refresh the page to see the changes';
}
?>