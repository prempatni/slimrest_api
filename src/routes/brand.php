<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
// Get All Brand Details 

$app->get('/api/brands', function(Request $request, Response $response){

    $sql = "SELECT * FROM brands";
    try{
        // Get the DB Objects
        $db = new db();
        // Connect to DB
        $db = $db->connect();

        $stmt = $db->query($sql);
        $brand = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($brand);

    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().' }';
    }

});

// Get Single Brand

$app->get('/api/brand/{id}', function(Request $request, Response $response){

    $id =$request->getAttribute('id');

    $sql = "SELECT * FROM brands WHERE id =$id ";
    try{
        // Get the DB Objects
        $db = new db();
        // Connect to DB
        $db = $db->connect();

        $stmt = $db->query($sql);
        $brand = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($brand);

    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().' }';
    }

});

// Add Single Brand
$app->post('/api/brand/add', function(Request $request, Response $response){
    
        $brand_name =$request->getParam('brand_name');
        
        $sql = "INSERT INTO brands (brand_name) VALUES (:brand_name) ";
        try{
            // Get the DB Objects
            $db = new db();
            // Connect to DB
            $db = $db->connect();
    
            $stmt = $db->prepare($sql);
    
            $stmt->bindParam(':brand_name',$brand_name);
            
            $stmt->execute();
            echo  '{"notice": {"text": "Brand Added"}';
    
        }
        catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().' }';
        }
    
    });

// Edit/Update Single Brand

$app->put('/api/brand/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $brand_name = $request->getParam('brand_name');
	
     $sql = "UPDATE brands SET
                brand_name = :brand_name
			 WHERE id = $id  ";
	try{
		// Get the DB Objects
		$db = new db();
		// Connect to DB
		$db = $db->connect();

		$stmt = $db->prepare($sql);
        $stmt->bindParam(':brand_name',$brand_name);
		
        $stmt->execute();
		echo  '{"notice": {"text": "Brand Updated"}';

	}
	catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().' }';
}

});

// Delete User
$app->delete('/api/brand/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM brands WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Brand Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
}); 
