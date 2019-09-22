<html>
<body>

<?php
	
	//Receive input from clint side
    $username = $_POST['username'];
    $password = $_POST['password'];
	$identifyer=$username;
	$identifyer .=",";
	$identifyer .= $password;
	$identifyer .=",";

	
	//check if the input exist
    $exist = 0;
    $login = 0;

           //read the file line by line
          $file = fopen("../database/database.txt","r");
           while(!feof($file))  {
                 // get a line without the last “newline” character
                $line = trim(fgets($file));

                //  list($usernameline, $passwordline) = explode(",",$line);
                list($usernameline,$passwordline) = array_pad(explode(',', $line),2,null);
				//print $a
                //compare the content of the input and the line
               // echo $line;
               // echo $usernameline;
               //echo $password;

              //  echo $password;
               if($username == $usernameline && $password == $passwordline){
			$exist = 1;
			break;
	     }			
              }
             fclose($file);	

	
	if($exist == 1){
        echo $password;
        echo "<h1> You have succesfully signed in </h1>
        <br></br>
        <a href='../client/settings.html'> Settings </a>
        <a href='../client/login.html'> <button> Logout</button></a>
        ";
	}else{
        echo "Wrong password or username
        <a href='../client/login.html'> Try again </a>";
	}
?>

</body>
</html>
