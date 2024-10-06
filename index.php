<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="static/nav.css">
<title>ChuChu</title>
</head>

<body>
    <?php
        // Should put into header.php
    ?>
    <nav>
        <a href="index.php">
            <img src="static/ChuChu.png" alt="Icon" width="30" height="30"/>
        </a>
        <a href="#">Home</a>
        <a href="#">Collection</a>
        <a href="#">About me</a>
    </nav>
    <form method="GET">
        <input type="text" name="person">
        <button>SUBMIT</button>
    </form>
<?php
    $name = $_GET["person"];
    echo "Hi"." ";
    print $name.".";
?>

</body>

</html>
