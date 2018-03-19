<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;



// Get All Category

$app->get('/api/category', function(Request $request, Response $response){

    $sql = "SELECT * FROM categories";
    try{
        // Get the DB Objects
        $db = new db();
        // Connect to DB
        $db = $db->connect();

        $stmt = $db->query($sql);
        $category = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($category);

    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().' }';
    }

});

// Get Single Category

$app->get('/api/category/{id}', function(Request $request, Response $response){

    $id =$request->getAttribute('id');

    $sql = "SELECT * FROM categories WHERE id =$id ";
    try{
        // Get the DB Objects
        $db = new db();
        // Connect to DB
        $db = $db->connect();

        $stmt = $db->query($sql);
        $category = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($category);

    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().' }';
    }

});

// Add Single Category

$app->post('/api/category/add', function(Request $request, Response $response){
    
        $category =$request->getParam('category');
        
        $sql = "INSERT INTO categories (category) VALUES (:category) ";
        try{
            // Get the DB Objects
            $db = new db();
            // Connect to DB
            $db = $db->connect();
    
            $stmt = $db->prepare($sql);
    
            $stmt->bindParam(':category',$category);
            
            $stmt->execute();
            echo  '{"notice": {"text": "Category Added"}';
    
        }
        catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().' }';
        }
    
    });
    // Edit/Update Single Category
    
    $app->put('/api/category/update/{id}', function(Request $request, Response $response){
        $id = $request->getAttribute('id');
        $category = $request->getParam('category');
        
        $sql = "UPDATE categories SET
                    category = :category,
               WHERE id = $id  ";
        try{
            // Get the DB Objects
            $db = new db();
            // Connect to DB
            $db = $db->connect();
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':category',$category);
            
            $stmt->execute();
            echo  '{"notice": {"text": "Category Updated"}';
    
        }
        catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().' }';
    }
    
    });
    
    // Delete User
    $app->delete('/api/category/delete/{id}', function(Request $request, Response $response){
        $id = $request->getAttribute('id');
        $sql = "DELETE FROM categories WHERE id = $id";
        try{
            // Get DB Object
            $db = new db();
            // Connect
            $db = $db->connect();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $db = null;
            echo '{"notice": {"text": "Category Deleted"}';
        } catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}';
        }
    }); 
    