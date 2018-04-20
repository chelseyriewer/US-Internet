<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title>Yes</title>
	<meta http-equiv="content-type" content="text/html; charset=Windows-1250" />
</head>


<?php
//Yes was clicked

extract($_REQUEST);
if (isset($_POST['Submit'])){
				$mySQL_Host="localhost" ;
				$mySQL_User="root" ;
				$mySQL_Pass="" ;
			
			//Getting the accountNumber
			$accountNumber = $_POST['accountNumber'];
			
			function connect(){
				global $mySQL_Host, $mySQL_User,$mySQL_Pass;
				if ( ! $linkid = mysqli_connect("$mySQL_Host", "$mySQL_User","$mySQL_Pass")){
					echo "Impossible to connect to ", $mySQL_Host, "<br />";
					exit;
				}
				return $linkid;
			}

			function send_sql( $sql, $link, $db ) {
					if ( ! ($succ = mysqli_select_db($link, $db))) {
						echo mysqli_error();
						exit;
					}
					if ( ! ($res = mysqli_query ( $link, $sql))) {
						echo  mysqli_error($link);
						exit;
					}
				return $res;
			}
			$link = connect();
			$database = "criewer";
			$sql = "UPDATE accounts SET active = '1' WHERE accountType = '$accountNumber'";
			$result = send_sql($sql, $link, $database);
			
echo "Your account is active<br>";

echo "Would you like to deactivate it?";
echo "<a href='no.php'>Yes</a>";

echo "<br>Would you like to add another account?";
echo "<a href='accounts.php'>Yes</a>";
} else{?>	
	<head>
	<title>Active</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23.1" />
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">


	<p>Please enter your account number to verify: 
	<input type="text" id="accountNumber" name="accountNumber"><br></p>
	

	<input type="submit" name="Submit" id="Submit" value="Submit"></input>

	
	</body>

</html>
	<?php } ?>