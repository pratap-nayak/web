<?php
 include('connection.php');
$msg = "";
if(isset($_GET['id'])){
	$id = $_GET['id'];
//echo $id;
	$result = mysqli_query($conn,"DELETE FROM `tbl_books` WHERE id='$id'");
	if($result){
		$msg = "DELETE SUCCESS";
		header("location:booklist.php?msg=$msg");

		}
		else{
			$msg = "Their is some Error!";
			}
}
?>
