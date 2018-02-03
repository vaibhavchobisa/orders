<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;



//Get All Order Transactions



$app->get('/api/transactions', function(Request $request, Response $response){

	$sql="SELECT * FROM all_orders";

	try{

//Getting the 'database' Object
		$db = new database();

	//Calling The Connection Now
		$db = $db->connect();

		$stmt = $db->query($sql);
		$orders = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($orders);

	} catch(PDOException $e){

		echo '{"error": {"text": '.$e->getMessage().'}';

	}

});



//Get A Single Transaction



$app->get('/api/transaction/{id}', function(Request $request, Response $response){

	$id= $request->getAttribute('id');


	$sql="SELECT * FROM all_orders WHERE id = $id";

	try{

//Getting the 'database' Object
		$db = new database();

	//Calling The Connection Now
		$db = $db->connect();

		$stmt = $db->query($sql);
		$order = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($order);

	} catch(PDOException $e){

		echo '{"error": {"text": '.$e->getMessage().'}';

	}

});



//Add A New Order Transaction



$app->post('/api/transaction/add', function(Request $request, Response $response){

	$type1 = $request->getParam('type1');
	$qty1 = $request->getParam('qty1');
	$type2 = $request->getParam('type2');
	$qty2 = $request->getParam('qty2');
	$type3 = $request->getParam('type3');
	$qty3 = $request->getParam('qty3');
	$type4 = $request->getParam('type4');
	$qty4 = $request->getParam('qty4');
	$type5 = $request->getParam('type5');
	$qty5 = $request->getParam('qty5');


	$sql="INSERT INTO all_orders (type1,qty1,type2,qty2,type3,qty3,type4,qty4,type5,qty5) VALUES 
	(:type1,:qty1,:type2,:qty2,:type3,:qty3,:type4,:qty4,:type5,:qty5)";

	try{

//Getting the 'database' Object
		$db = new database();

	//Calling The Connection Now
		$db = $db->connect();

		$stmt = $db->prepare($sql);

		$stmt->bindParam(':type1', $type1);
		$stmt->bindParam(':qty1', $qty1);
		$stmt->bindParam(':type2', $type2);
		$stmt->bindParam(':qty2', $qty2);
		$stmt->bindParam(':type3', $type3);
		$stmt->bindParam(':qty3', $qty3);
		$stmt->bindParam(':type4', $type4);
		$stmt->bindParam(':qty4', $qty4);
		$stmt->bindParam(':type5', $type5);
		$stmt->bindParam(':qty5', $qty5);

		$stmt->execute();

		echo 'NEW ORDER TRANSACTION ADDED';

	} catch(PDOException $e){

		echo '{"error": {"text": '.$e->getMessage().'}';

	}

});