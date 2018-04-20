<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title>Account</title>
	<meta http-equiv="content-type" content="text/html; charset=Windows-1250" />
</head>

<?php

extract($_REQUEST);
	if (isset($_POST['Submit'])){
		
		//Getting the values 
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$accountNumber = $_POST['accountNumber'];
		$accountType = $_POST['accountType'];
		$accountDescription = $_POST['accountDescription'];
		$cost = $_POST['cost'];
		//$filecontents = file_get_contents($file);
		
		//Displaying what was entered on the previous screen
			echo "$firstName, $lastName<br>";
			echo "Your email is $email<br>";
			echo "The account number you entered is $accountNumber<br>";
			echo "The account type you entered is $accountType<br>";
			echo "The account description you entered is $accountDescription<br>";
			echo "The cost of the account is $cost<br>";
			
			echo "<br>Is this an active account?";
			//echo "<button type ='Submit' name = 'Yes' id = 'Yes' value = 'Yes'></button>";
			//echo "<button type = 'Submit' name = 'No' id = 'No' value = 'No'></button>";
		
			echo "<a href='yes.php'>Yes</a>";
			echo "<a href='no.php'>No</a>";
			
				$mySQL_Host="localhost" ;
				$mySQL_User="root" ;
				$mySQL_Pass="" ;

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
			
			$sqlCheck = "SELECT accountType FROM accounts WHERE accountType = '$accountNumber'";
			$resultCheck = send_sql($sqlCheck, $link, $database);
			$account_number = mysqli_fetch_array($resultCheck);
			$account_number = $account_number[0];
			
			if ($account_number == $accountNumber ){
				
				echo "This account already exists!";
				
			}else{
			
			$sql = "INSERT INTO accounts (id, firstName, lastName, email, accountType) VALUES ( 1, '$firstName', '$lastName', '$email', '$accountNumber')";
			$result = send_sql($sql, $link, $database);
			
			$sql2 = "INSERT INTO accountTypes(id, account_type, descritpion, cost) VALUES (1, '$accountType', '$accountDescription', '$cost')";
			$result = send_sql($sql2, $link, $database);
	}

  
  
  	}
	else{?>	
	<head>
	<title>Account1</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23.1" />
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">


	<p>Please enter your first name: 
	<input type="text" id="firstName" name="firstName"><br></p>
	
	<p>Please enter your last name:
	<input type="text" id="lastName" name="lastName"><br></p>
	
	<p>Please enter your email:
	<input type="text" id="email" name="email"><br></p>
	
	<p>Please enter your account number:
	<input type="text" id="accountNumber" name="accountNumber"><br></p>
	
	<p>Please enter the account type:
	<input type="text" id="accountType" name="accountType"><br></p>
	
	<p>Please enter account description:
	<input type="text" id="accountDescription" name="accountDescription"><br></p>
	
	<p>Please enter the cost:
	<input type="text" id="cost" name="cost"><br></p>
	
	
	

	<input type="submit" name="Submit" id="Submit" value="Submit"></input>

	
	</body>

</html>
	<?php } ?>