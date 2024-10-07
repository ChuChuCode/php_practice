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
<link rel="stylesheet" href="static/nav.css">
<title>ChuChu</title>
</head>

<body>
    <?php
        // Should put into header.php
    ?>
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
    ?>
    
<br>
<iframe frameborder="0" src="https://itch.io/embed/2327248?border_width=5&amp;dark=true" width="560" height="175">
    <a href="https://chuchu-akabu.itch.io/biball">BiBALL by ChuChu_Akabu</a>
</iframe>
</body>

</html>
