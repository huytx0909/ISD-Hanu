<?php
if(isset($_POST['query'])) {
	$output = '';
	$q = $_POST['query'];
	$query = "SELECT * from user WHERE username LIKE '%$q%'";
	$result = mysqli_query($db, $query);
	$output = '<ul class ="list-unstyled">';
	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$output .= '<li>'.$row['username'].'</li>'
		}
	} else {
		$output .= '<li> Username not found</li>';
	}
	 $output .= '</ul>';
	 echo $output;
}

?>