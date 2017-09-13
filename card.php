 <?php  
include 'DB.php';
$db = new DB();
$tblName = 'tblstudents';

	 if (isset($_POST['id'])) {
	 	$idArr = $_POST['id'];
	 	foreach ($idArr as $id) {
		    // echo '<span>'.$id.'</span><br>';
		 	$condition['where'] = array('id'=>$id);
	        // $condition['return_type'] = 'single';
		    $users = $db->getRows($tblName, $condition);
		    foreach ($users as $user) {

				$layout = '<div id="id_container">';
				$layout .= '<div id="front">';
				$layout .= '<div id="ojt"><center>OJT</center></div>';
				$layout .= '<div id="control"><center>';
				$layout .= '<strong>'.$user['control'].'</strong>';
				$layout .= '</center>';
				$layout .= '</div>';
				$layout .= '<div id="photo"><img src="image/'.$user['filename'].'" width="96" height="96" alt="photo" /></div>';
				$layout .= '<div id="logo"><img src="image/pldt_logo.png" width="211" height="61" alt="logo" /></div>';
				$layout .= '<div id="nickname">';
				$layout .= '<center>';
				$layout .= '<strong>'.$user['nickname'].'</strong>';
				$layout .= '</center>';
				$layout .= '</div>';
				$layout .= '<div id="facility"><center>'.$user['facility'].'</center></div>';
				$layout .= '<div id="name" class="name"><strong><center>'.$user['name'].'</center></strong></div>';
				$layout .= '<div id="signature" class="below_text">SIGNATURE</div>';
				$layout .= '<div id="access"><center>ACCESS AUTHORIZATION</center></div>';
				$layout .= '</div>';
				$layout .= '<div id="back">';
				$layout .= '<div id="note">"Always wear ID inside the premises."</div>';
				$layout .= '<div class="label_bg" id="label_validity">VALIDITY</div>';
				$layout .= '<div class="info" id="info_validity">'.$user['validity'].'</div>';
				$layout .= '<div class="label_bg" id="label_start">START</div>';
				$layout .= '<div class="info" id="info_start">'.$user['started'].'</div>';
				$layout .= '<div class="label_bg" id="label_contact">CONTACT NO.</div>';
				$layout .= '<div class="info" id="info_contact">'.$user['contact'].'</div>';
				$layout .= '<div id="supervisor" class="name"><strong><center>'.$user['supervisor'].'</center></strong></div>';
				$layout .= '<div id="designation" class="below_text">'.$user['designation'].'</div>';
				$layout .= '<div id="img_signature"><img src="image/signature.png" alt="signature" width="205" height="90" /></div>';
				$layout .= '<div id="apd" class="name"><strong><center>'.$user['slapd'].'</center></strong></div>';
				$layout .= '<div id="apdtitle" class="below_text">'.$user['apdtitle'].'</div>';
				$layout .= '<div id="bg_logo"><img src="image/pldt_logo2.png" width="170" height="170" /></div>';
				$layout .= '</div>';
				$layout .= '</div>';

				echo $layout;

		    	// echo $user['name'].'<br>';
		    	// echo $user['address'].'<br>';
		    	// echo $user['school'].'<br>';
		    	// echo $user['address'].'<br>';
		    	// echo $user['department'].'<br><br>';
		    }
	 	}
	 }
	 
 ?>  