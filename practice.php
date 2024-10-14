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
<title>ChuChu - practice</title>
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

		// php built-in functions. 
		// See https://www.php.net/manual/en/funcref.php or 
		// https://www.w3schools.com/php/php_functions.asp

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
		if (isset($_GET["signup"])){
			$signupCheck=$_GET["signup"];
			switch ($signupCheck){
				case "empty":
					echo "<p class='error'>You did not fill in all fields!</p>";
					break;
				case "char":
					echo "<p class='error'>You used an invalid characters!</p>";
					break;
				case "email":
					echo "<p class='error'>You used an invalid e-mail!</p>";
					break;
				case "sqlerror":
					echo "<p class='error'>SQL has some problem. Contact the developer!</p>";
					break;
				case "success":
					echo "<p class='success'>You have been signed up!</p>";
					break;
				default:
					echo "<p class='error'>Unknown error!</p>";
				}
		}
		BreakLine();
		// password hashing
		echo "Password Check.<br>";
		$pwd = "test123";
		$hashedpwd = password_hash($pwd,PASSWORD_DEFAULT);
		if (password_verify($pwd,$hashedpwd)){
			echo "<br>Password is correct!";
		}
		BreakLine();
		// Array 

		// index array

		$data = array("first","2nd");
		$data[] = "Kerwin";
		$data[] = "15";
		array_push($data,12);
		array_push($data,"Peter","Chu",0.2);
		print_r($data);

		BreakLine();
		//associative array 
		$data1 = array(
			"first"=>"Kerwin",
			"last"=>"Chu"
			);
		$data1["age"] = 29;
		print_r($data1);
		BreakLine();
		echo " ".$data1["age"];

		//multidimensional array
		$data2 = array();
		$data2[] = array(1,2,3);
		$data2[] = "Kerwin";
		BreakLine();
		print_r($data2);
		BreakLine();
		print_r($data2[0]);
		BreakLine();
		echo $data2[0][1];
		BreakLine();
		// Search directory
		$file_name = Glob('./*');
		print_r($file_name);
	?>
</body>

</html>
