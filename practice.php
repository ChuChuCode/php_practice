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
<link rel="stylesheet" href="static/practice.css">
<title>ChuChu</title>
</head>

<body>
    <?php
        // Make a function
        function BreakLine(){
            echo "<br>";
        }
        // Cookie name, Variable, Due time
        setcookie("Account","Kerwin",time()+86400);
        //  Delete cookie
        // setcookie("Account","Kerwin",time()-86400);
        // Session
        $_SESSION["Account_id"] = "12";
    ?>
    <?php
        // include other files
        include "header.php";
    ?>

    <form method="GET">
        <input type="text" name="person" placeholder="Put your name">
        <button>SUBMIT</button>
    </form>

    <?php
        $name = $_GET["person"];
        echo "Hi"." ";
        print $name.".";
        // string length
        $str1 =  "The length of ".$name." is : ".strlen($name);
        echo $str1;
        BreakLine();
        // word length
        echo str_word_count($str1);
        BreakLine();
        // reverse string
        echo strrev($name);
        // find string postion
        BreakLine();
        echo strpos($str1,$name);
        // Replace string
        BreakLine();
        echo str_replace($name,"Kerwin",$str1);
    ?>
    <form method="GET">
        <input type="text" name="num1" placeholder="Number1">
        <input type="text" name="num2" placeholder="Number2">
        <select name="operator">
            <option>None</option>
            <option>Add</option>
            <option>Substract</option>
            <option>Multiply</option>
            <option>Devide</option>
            <option>Mod</option>
        </select>
        <br>
        <button name="submit" value="Cal">Calculate</button>
    </form>
    <?php
        if ($_GET["submit"]== "Cal")
        {
            $result1 = $_GET["num1"];
            $result2 = $_GET["num2"];
            $operator = $_GET["operator"];
            if (!is_numeric($result1)){
                echo "You need to insert a number in Num1";
            }
            else if (!is_numeric($result2)){
                echo "You need to insert a number in Num2";
            }
            else{
                switch ($operator) {
                    case "None":
                        echo "You need to select operator.";
                        break;
                    case "Add":
                        echo "Answer : " . $result1 + $result2;
                        break;
                    case "Substract":
                        echo "Answer : " . $result1 - $result2;
                        break;
                    case "Multiply":
                        echo "Answer : " . $result1 * $result2;
                        break;
                    case "Devide":
                        echo "Answer : " . $result1 / $result2;
                        break;
                    case "Mod":
                        echo "Answer : " . $result1 % $result2;
                        break;
                }
            }
        }
		BreakLine();
		echo "Select from users table.";
		BreakLine();
        userList($conn);
		BreakLine();
		BreakLine();
    ?>
	<p>Insert into users table.</p>
	<form method="POST" action="includes/Insert_users-inc.php">
		<?php
			if (!isset($_GET["first"])){
				echo "<input type='text' name='first' placeholder='Firstname'>";
			}else{
				$first = $_GET["first"];
				echo "<input type='text' name='first' placeholder='Firstname' value='$first'>";
			}
			BreakLine();
			if (!isset($_GET["last"])){
				echo "<input type='text' name='last' placeholder='Lastname'>";
			}else{
				$last = $_GET["last"];
				echo "<input type='text' name='last' placeholder='Lastname' value='$last'>";
			}
			BreakLine();
			echo "<input type='text' name='email' placeholder='Email'>";
			BreakLine();
			if (!isset($_GET["UserID"])){
				echo "<input type='text' name='UserID' placeholder='User Name'>";
			}else{
				$UserID = $_GET["UserID"];
				echo "<input type='text' name='UserID' placeholder='User Name' value='$UserID'>";
			}
		?>
		<br>
		<input type="password" name="pwd" placeholder="Password">
		<br>
		<button type="submit" name="user_signup" >Sign Up</button>
	</form>
	<?php
		if (!isset($_GET["signup"])){
			exit();
		}
		$signupCheck=$_GET["signup"];
		switch ($signupCheck){
			case "empty":
				echo "<p class='error'>You did not fill in all fields!</p>";
				exit();
			case "char":
				echo "<p class='error'>You used an invalid characters!</p>";
				exit();
			case "email":
				echo "<p class='error'>You used an invalid e-mail!</p>";
				exit();
			case "sqlerror":
				echo "<p class='error'>SQL has some problem. Contact the developer!</p>";
				exit();
			case "success":
				echo "<p class='success'>You have been signed up!</p>";
				exit();
		}
	?>
    
<br>
</body>

</html>
