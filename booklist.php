<?php
 include('connection.php');
 
 if (isset($_GET['pageno'])) {
	            $pageno = $_GET['pageno'];
	        } else {
	            $pageno = 1;
	        }
	        $no_of_records_per_page = 8;
	        $offset = ($pageno-1) * $no_of_records_per_page;

			$total_pages_sql = "SELECT COUNT(*) FROM tbl_books";
	        $result = mysqli_query($conn,$total_pages_sql);
	        $total_rows = mysqli_fetch_array($result)[0];
	        $total_pages = ceil($total_rows / $no_of_records_per_page);

	$result = mysqli_query($conn,"SELECT * FROM `tbl_books` ORDER BY `id` asc LIMIT $offset, $no_of_records_per_page") or die('Error');
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
	<a href="index.html" class="book-bar-item">Home</a>
    <a href="booklist.php" class="book-bar-item">Book List</a>
    <a href="addnewbook.php" class="book-bar-item">Add New Book</a>
    </div>  
  </div>
</div>

<!-- Page content -->

<div class="content">
<div class="container">
  <h4>Book List</h4>
  <div class="table-responsive noticeView">
	    <table class="table-all">
	      <thead>
	         <tr class="menuBar">
	           <th style="text-align:center;">ID</th>
	           <th style="text-align:center;">BOOK NAME</th>
	           <th style="text-align:center;">CATEGORY</th>
	           <th style="text-align:center;">AUTHOR</th>
	           <th style="text-align:center;">ISBN</th>
	           <th style="text-align:center;">STATUS</th>
	           <th style="text-align:center;">READ</th>
	           <th style="text-align:center;">FEEDBACK</th>
	           <th style="text-align:center;">ACTION</th>
	         </tr>
	      </thead>
	      <tbody>
		  <?php
			$c=1;
			while($row = mysqli_fetch_array($result)) {

			$bookname = $row['book_name'];
			$category = $row['book_category'];
			$author = $row['author_name'];
			$isbn = $row['isbn_number'];
			$status = $row['status'];
			$read = date("d/m/Y", strtotime($row['read_date']));
			$feedback = $row['feedback'];
			$id = $row['id'];
		  ?>
			<tr>
	          <td><?php echo $id ?></td>
	          <td><?php echo $bookname ?></td>
	          <td><?php echo $category ?></td>
	          <td><?php echo $author ?></td>
	          <td><?php echo $isbn ?></td>
	          <td><?php echo $status ?></td>
	          <td><?php echo $read ?></td>
	          <td><?php echo $feedback ?></td>
	          <td><a title="Edit Book" style="margin-right:15px;" href="edit_book.php?id=<?php echo $id ?>"><b><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></b></a>
			 <a title="Delete Book" onclick="return confirm('Are you sure to delete?')" href="delete_book.php?id=<?php echo $id ?>"><b><i class="fa fa-trash-o" aria-hidden="true"></i></span></b></a>
			 </td>
			</tr>
			<?php
			}
			?>
		 </tbody>
	    </table>
	</div><!-- End table-responsive -->
  </div>
  

<!-- End page content -->
</div>

<!-- Footer -->
<footer class="footer">
  <p>Powered by: Piyush Barik</p>
</footer>
</body>
</html>
