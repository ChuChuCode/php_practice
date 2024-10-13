<?php
    // let session can go through other pages
    session_start();
    // include db connection php -> Use $conn
    include_once "includes/dbconn-inc.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="static/errorHandler.css">
<title>ChuChu - Upload Page</title>
</head>

<body>
    <?php
        // Make a function
        function BreakLine(){
            echo "<br>";
        }
    ?>
    <?php
        // include other files
        include "header.php";
    ?>
	<form action="./includes/upload-inc.php" method="post" enctype="multipart/form-data">
		<input type="file" name="file">
		<!-- <input type="file" name="file" accept="image/png, image/jpeg" /> -->
		<button type="submit" name="upload_submit">Upload</button>
	</form>
	<?php
		if (isset($_GET["upload"]))
		{
			switch ($_GET["upload"]){
				case "error":
					echo "<p class='error'>File upload error.</p>";
					break;
				case "extension":
					echo "<p class='error'>Not Supported file extension.</p>";
					break;
				case "image":
					echo "<p class='error'>not selected image.</p>";
					break;
				case "success":
					echo "<p class='success'>upload success.</p>";
					break;
			}
			
		}
	?>
</body>

</html>
