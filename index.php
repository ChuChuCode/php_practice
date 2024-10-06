<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title</title>
</head>

<body>
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
