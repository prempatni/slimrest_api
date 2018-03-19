<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


// Get All Product Details

$app->get('/api/products', function(Request $request, Response $response){

    $sql = "SELECT * FROM products";
    try{
        // Get the DB Objects
        $db = new db();
        // Connect to DB
        $db = $db->connect();

        $stmt = $db->query($sql);
        $product = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($product);

    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().' }';
    }

});

// Get the single product.

$app->get('/api/product/{id}', function(Request $request, Response $response){

    $id =$request->getAttribute('id');

    $sql = "SELECT * FROM products WHERE id =$id ";
    try{
        // Get the DB Objects
        $db = new db();
        // Connect to DB
        $db = $db->connect();

        $stmt = $db->query($sql);
        $product = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($product);

    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().' }';
    }

});

// Add Single Product

$app->post('/api/product/add', function(Request $request, Response $response){
    
        $product_name =$request->getParam('product_name');
        $product_qty = $request->getParam('product_qty');
        $product_sku = $request->getParam('product_sku');
        $price= $request->getParam('price');
        $reduced_price= $request->getParam('reduced_price');
        $featured= $request->getParam('featured');
        $description= $request->getParam('description');
        $product_spec= $request->getParam('product_spec');
    
        $sql = "INSERT INTO products (product_name,product_qty,product_sku,price,reduced_price,featured,description,product_spec) VALUES (:product_name,:product_qty,:product_sku,:price,:reduced_price,:featured,:description,:product_spec) ";
        try{
            // Get the DB Objects
            $db = new db();
            // Connect to DB
            $db = $db->connect();
    
            $stmt = $db->prepare($sql);
    
            $stmt->bindParam(':product_name',$product_name);
            $stmt->bindParam(':product_qty', $product_qty);
            $stmt->bindParam(':product_sku', $product_sku);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':reduced_price', $reduced_price);
            $stmt->bindParam(':featured', $featured);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':product_spec', $product_spec);
    
    
            $stmt->execute();
            echo  '{"notice": {"text": "Product Added"}';
    
        }
        catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().' }';
        }
    
    });
    // Edit/Update Single Product
    
    $app->put('/api/product/update/{id}', function(Request $request, Response $response){
        $id = $request->getAttribute('id');
        $product_name = $request->getParam('product_name');
        $product_qty =$request->getParam('product_qty');
        $product_sku = $request->getParam('product_sku');
        $price= $request->getParam('price');
        $reduced_price= $request->getParam('reduced_price');
        $featured= $request->getParam('featured');
        $description= $request->getParam('description');
        $product_spec= $request->getParam('product_spec');
        
         $sql = "UPDATE products SET
                    product_name = :product_name,
                    product_qty 	= :product_qty,
                    product_sku = :product_sku,
                    price = :price,
                    reduced_price = :reduced_price,
                    featured = :featured,
                    description = :description,
                    product_spec = :product_spec
               WHERE id = $id  ";
        try{
            // Get the DB Objects
            $db = new db();
            // Connect to DB
            $db = $db->connect();
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':product_name',$product_name);
            $stmt->bindParam(':product_qty',$product_qty);
            $stmt->bindParam(':product_sku', $product_sku);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':reduced_price', $reduced_price);
            $stmt->bindParam(':featured', $featured);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':product_spec', $product_spec);
            
            
            $stmt->execute();
            echo  '{"notice": {"text": "Product Updated"}';
    
        }
        catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().' }';
    }
    
    });
    
    // Delete User
    $app->delete('/api/product/delete/{id}', function(Request $request, Response $response){
        $id = $request->getAttribute('id');
        $sql = "DELETE FROM products WHERE id = $id";
        try{
            // Get DB Object
            $db = new db();
            // Connect
            $db = $db->connect();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $db = null;
            echo '{"notice": {"text": "Product Deleted"}';
        } catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}';
        }
    }); 
    