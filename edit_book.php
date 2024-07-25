<?php

 include('connection.php');

    $msg = "";
	// Error & success messages
    global $success_msg, $error_book, $error_cat, $error_auth, $error_isbn, $error_status, $error_date, $error_feed;

if(isset($_GET['id'])){
  $bookID = $_GET['id'];	
if (isset($_POST['submit'])) {
	$idd =  $_POST['nid'];
      if (!empty($_POST["bookname"]) &&  preg_match("/^[a-zA-Z ]+$/",$_POST["bookname"])) {
               $bookname = $_POST['bookname'];
            }else {
               $error_book = "<p>Name is required only alphabets and space</p>";
        }  
		
	  if (!empty($_POST["category"]) &&  preg_match("/^[a-zA-Z ]+$/",$_POST["category"])) {
               $category = $_POST['category'];
            }else {
               $error_cat = "<p>Category is required only alphabets and space</p>";
        }  
		
	  if (!empty($_POST["author"]) &&  preg_match("/^[a-zA-Z ]+$/",$_POST["author"])) {
               $author = $_POST['author'];
            }else {
               $error_auth = "<p>Author is required only alphabets and space</p>";
        }  
		
	  if (empty($_POST["isbn"])) {
               $error_isbn = "<p>ISBN Number required</p>";
            }else {
               $isbn = $_POST['isbn'];
        }  
		
	  if (empty($_POST["status"])) {
               $error_isbn = "<p>Status is required</p>";
            }else {
               $status = $_POST['status'];
        }  
		
	  if (empty($_POST["read-date"])) {
               $error_date = "<p>Read Date is required</p>";
            }else {
               $read = $_POST['read-date'];
        }  
		
	  if (empty($_POST["about-book"])) {
               $error_feed = "<p>Read Date is required</p>";
            }else {
               $feedback = $_POST['about-book'];
        }
		
		$update = mysqli_query($conn,"UPDATE `tbl_books` SET `book_name`='$bookname',`book_category`='$category',`author_name`='$author',`isbn_number`='$isbn',`status`='$status',`read_date`='$read',`feedback`='$feedback' WHERE id='$idd'") or die('Error');
		if($update){
                    $success_msg = "<h4 style='color:green;'>The book has been updated successfully.</h4>";
					$msg = "UPDATED SUCCESS";
				    header("location:booklist.php?msg=$msg");
                }else{
                    $success_msg = "<h4 style='color:red;'>There is some error, please try again.</h4>";
                }

}
}
$result = mysqli_query($conn,"SELECT * FROM `tbl_books` WHERE `id`='$bookID'") or die('Error');
while($row = mysqli_fetch_array($result))
  {
    $bookname = $row['book_name'];
	$category = $row['book_category'];
	$author = $row['author_name'];
	$isbn = $row['isbn_number'];
	$status = $row['status'];
	$read = $row['read_date'];
	$feedback = $row['feedback'];
	$id = $row['id'];
  }
?>

<!DOCTYPE html>
<html>
<head>
<title>Welcome to My Books | Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta content="Welcome to My Books" name="description">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<!-- Navbar -->
<div class="book-top">
  <div class="book-bar">
    <a href="index.html" class="book-bar-item wide"><b>MY</b> Books</a>
    
	<div class="right hide-small">
	<a href="index.html" class="book-bar-item nav-menu">Home</a>
    <a href="booklist.php" class="book-bar-item nav-menu">Book List</a>
    <a href="addnewbook.php" class="book-bar-item nav-menu">Add New Book</a>
    </div>  
  </div>
</div>

<!-- Page content -->

<div class="content">
 <div class="container">
	<div class="panel book-form">
	<div class="panel-heading">
		<h4>Add New Book</h4>
	</div>
	<div class="panel-body">
    <p>Fill the details to add new book.</p>
	<?php echo $success_msg; ?>
    <form method="post" enctype="multipart/form-data" id="addBook" role="form">
	<input type="hidden" class="input" id="nid" name="nid" value="<?php echo $bookID; ?>">
	<div class="book-col">
	<label>Book Name<span style="color:red;">*</span></label>
	<input class="input" type="text" name="bookname" autocomplete="off" value="<?php echo $bookname; ?>">
	<?php echo $error_book; ?>
	</div>
	
	<div class="book-col">
	<label>Category<span style="color:red;">*</span></label>
	<input class="input" type="text" name="category" autocomplete="off" value="<?php echo $category; ?>">
	<?php echo $error_cat; ?>
	</div>
	
	<div class="book-col">
	<label>Author<span style="color:red;">*</span></label>
	<input class="input" type="text" name="author" autocomplete="off" value="<?php echo $author; ?>">
	<?php echo $error_auth; ?>
	</div>
	
	<div class="book-col">
	<label>ISBN Number<span style="color:red;">*</span></label>
	<input class="input" type="text" name="isbn" id="isbn" autocomplete="off" value="<?php echo $isbn; ?>">
	<?php echo $error_isbn; ?>
	</div>
	
	<div class="book-col">
	<label>Status<span style="color:red;">*</span></label>
	<select class="select" name="status" required="required">
	<option value="READING" <?=$status == 'READING' ? ' selected="selected"' : '';?>>Reading</option>
	<option value="READ" <?=$status == 'READ' ? ' selected="selected"' : '';?>>Read</option>
	</select>
	<?php echo $error_status; ?>
	</div>
	
	<div class="book-col">
	<label>Reading Date<span style="color:red;">*</span></label>
	<input class="input" type="date" id="read-date" name="read-date" autocomplete="off" value="<?php echo $read; ?>">
	<?php echo $error_date; ?>
	</div>
	
	<div class="book-col-full">
	<label>About Book<span style="color:red;">*</span></label>
	<textarea class="input" id="about-book" name="about-book" rows="2" cols="50"><?php echo $feedback; ?></textarea>
	<?php echo $error_feed; ?>
	</div>
	
	<div class="book-col-full" style="text-align: center;">
      <button class="book-button" type="submit" name="submit" id="submit" onclick="return confirm('Are you sure to update?')">
        <i class="fa fa-paper-plane"></i> ADD BOOK
      </button>
	</div>
    </form>
	</div>
   </div>
  </div>
  
<!-- End page content -->
</div>

<!-- Footer -->
<footer class="footer">
  <p>Powered by: Piyush Barik</p>
</footer>

</body>
</html>
