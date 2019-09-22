<?php 
include('rsa.php');
?>
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
    $timestamp = time();
    $privateKey  = file_get_contents('./private.key');
	
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
              //($username == $usernameline && $password == $passwordline)
               if($username == $usernameline){
                   // decrypt $password
                   $decrypted = rsa_decryption($password, $privateKey);
                   $split_value = explode("&", $decrypted);
            //$exist = 1;
            if (($timestamp - $split_value[1] < 150) && $split_value[0]== $passwordline){
                $exist = 1;
            }
			break;
	     }			
              }
             fclose($file);	

	
	if($exist == 1){
        echo "<h1> Login Successful </h1>
        <br></br>
        <a href='../client/settings.html'> Settings </a>
        <a href='../client/login.html'> <button> Logout</button></a>
        ";
	}else{
        echo "<br></br>Wrong password or username
        <a href='../client/login.html'> Try again </a>";
	}
?>

</body>
</html>
