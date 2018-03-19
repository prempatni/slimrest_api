<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get login details

$app->get('/api/login', function(Request $request, Response $response){

    $sql = "SELECT * FROM users";
    try{
        // Get the DB Objects
        $db = new db();
        // Connect to DB
        $db = $db->connect();

        $stmt = $db->query($sql);
        $login = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($login);

    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().' }';
    }

});

// Get Single login user

$app->get('/api/login/{id}', function(Request $request, Response $response){

    $id =$request->getAttribute('id');
    $email =$request->getAttribute('email');
    $password =$request->getAttribute('password');


    $sql = "SELECT * FROM users WHERE id =$id ";
    try{
        // Get the DB Objects
        $db = new db();
        // Connect to DB
        $db = $db->connect();

        $stmt = $db->query($sql);
        $login = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($login);

    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().' }';
    }

});

$app->post('/api/login/add', function(Request $request, Response $response){
    
       
        $email = $request->getParam('email');
        $password = $request->getParam('password');
    
        $sql = "INSERT INTO users (email,password) VALUES (:email,:password) ";
        try{
            // Get the DB Objects
            $db = new db();
            // Connect to DB
            $db = $db->connect();
    
            $stmt = $db->prepare($sql);
    
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
    
    
            $stmt->execute();
            echo  '{"notice": {"text": "User Added"}';
    
        }
        catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().' }';
        }
    
    });

   // Edit/Update Single User

$app->put('/api/login/update/{id}', function(Request $request, Response $response){
	$id = $request->getAttribute('id');
	$email =$request->getParam('email');
	$password = $request->getParam('password');
    
	 $sql = "UPDATE users SET
				email 	= :email,
				password 	= :password
           WHERE id = $id";
	try{
		// Get the DB Objects
		$db = new db();
		// Connect to DB
		$db = $db->connect();

		$stmt = $db->prepare($sql);

		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':password', $password);
        
		$stmt->execute();
		echo  '{"notice": {"text": "User Updated"}';

	}
	catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().' }';
}

});

// Delete User
$app->delete('/api/login/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM users WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "User Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
}); 
