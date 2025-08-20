<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
	header("Access-Control-Max-Age: 18000");

	//CHECK IF IT IS A POST REQUEST
	if($_SERVER['REQUEST_METHOD']==='POST'){

	//DB CONNECTION	
	$MYSQL_Server = "localhost";
	$MYSQL_Username = "root";
	$MYSQL_Password = "";
	$MYSQL_Database = "api-demo";
	$dbh = new PDO("mysql:host=$MYSQL_Server;dbname=$MYSQL_Database;charset=utf8", "$MYSQL_Username", "$MYSQL_Password");	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	//INITIALIZE  POST PARAMS
	$name ='';$email='';$password='';

	if(isset($_POST['name'])){ $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING); }
	if(isset($_POST['email'])){ $email = filter_var($_POST['email'],FILTER_SANITIZE_STRING); }
	if(isset($_POST['password'])){ $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING); }


	if(!empty($name) && !empty($email) && !empty($password)){

	//SEND PARAMS TO DB
		  $sql="INSERT `register` SET `sn` = :mysn
										,`name` = :name
										,`email` = :email	
										,`password` = :password									
										";
							
									$myrec1 = $dbh->prepare($sql);
									$myrec1->bindValue(":mysn","");
									$myrec1->bindValue(":name",$name);
									$myrec1->bindValue(":email",$email);
									$myrec1->bindValue(":password",$password);
									$myrec1->execute();
									$last_id=$dbh->lastInsertId();


	 $response ="Submission Successful and last inserted id".$last_id;
	 
	//RETURN RESPONSE BACK 
	  echo json_encode($response);

	}	

	}else{
		
	$response ="Not Recognized";
	 
	echo json_encode($response);	
		
	}



?>