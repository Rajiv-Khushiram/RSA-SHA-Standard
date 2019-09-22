<html>
<body>

<?php
	
	//Receive input from clint side
	$input = $_POST['username'];
	$password = $_POST['password'];
	$identifyer=$input;
	$identifyer .=",";
	$identifyer .= $password;
	$identifyer .=",";
	//echo $password;
	
	//check if the input exist
	$exist = 0;



           //read the file line by line
          $file = fopen("../database/database.txt","r");
           while(!feof($file))  {
                 // get a line without the last “newline” character
				$line = trim(fgets($file));
                list($usernameline,$passwordline) = array_pad(explode(',', $line),2,null);
				//print $a
				//compare the content of the input and the line
               if($usernameline == $input ){
			$exist = 1;
			break;
	     }			
              }
             fclose($file);	

	
	if($exist == 1){
		echo "The input  exists! <br/><br/>Please enter another one via <a href='../client/register.html'>register.html</a>";
	}else{
		//open a file named "database.txt"
		$file = fopen("../database/database.txt","a");
		//insert this input (plus a newline) into the database.txt
		fwrite($file,$identifyer."\n");
		//close the "$file"
		fclose($file);
		echo "<h1>Welcome  $input!!</h1>
		<br><br/>
		You are now registered!<br></br>
		<a href='../client/console.html'> Go to Console</a>
		Try registering again with the same ID and see what it says
		<a href='../client/register.html'>register.html</a>";

	}
?>

</body>
</html>
