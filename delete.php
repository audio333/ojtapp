 <?php  
include 'DB.php';
$db = new DB();
$tblName = 'tblstudents';

	 if (isset($_POST['id'])) {
	 	$idArr = $_POST['id'];
	 	foreach ($idArr as $id) {
	  	    $condition = array('id' => $id);
	  	    $delete = $db->delete($tblName,$condition);
		    // echo $id;
		    // echo $delete?'ok':'err';
	 	}
	 }
	 
 ?>  