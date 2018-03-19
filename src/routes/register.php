<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get All Registration details

$app->get('/api/register', function(Request $request, Response $response){

    $sql = "SELECT * FROM users";
    try{
        // Get the DB Objects
        $db = new db();
        // Connect to DB
        $db = $db->connect();

        $stmt = $db->query($sql);
        $register = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($register);

    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().' }';
    }

});


// Get Single Register user

$app->get('/api/register/{id}', function(Request $request, Response $response){

    $id =$request->getAttribute('id');

    $sql = "SELECT * FROM users WHERE id =$id ";
    try{
        // Get the DB Objects
        $db = new db();
        // Connect to DB
        $db = $db->connect();

        $stmt = $db->query($sql);
        $register = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($register);

    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().' }';
    }

});

// Add Single User

$app->post('/api/register/add', function(Request $request, Response $response){

    $username =$request->getParam('username');
    $email = $request->getParam('email');
    $password = $request->getParam('password');

    $sql = "INSERT INTO users (username,email,password) VALUES (:username,:email,:password) ";
    try{
        // Get the DB Objects
        $db = new db();
        // Connect to DB
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':username',$username);
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

$app->patch('/api/register/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $username = $request->getParam('username');
	$email =$request->getParam('email');
	$password = $request->getParam('password');
    
	 $sql = "UPDATE users SET
                username = :username,
				email 	= :email,
				password = :password
           WHERE id = $id  ";
	try{
		// Get the DB Objects
		$db = new db();
		// Connect to DB
		$db = $db->connect();

		$stmt = $db->prepare($sql);
        $stmt->bindParam(':username',$username);
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
$app->delete('/api/register/delete/{id}', function(Request $request, Response $response){
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
