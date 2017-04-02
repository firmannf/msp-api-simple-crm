<?php
$app->post('/login', function ($request, $response) {
    $data = $request->getParsedBody();

    $password = md5($data['password']);
    $sql = "SELECT * FROM user WHERE username = '$data[username]' AND password = '$password'";
    $statement = $this->db->prepare($sql);
    $statement->execute();
    $user = $statement->rowCount();

    if ($user > 0) {		
		return $this->response->withJson(true);
	} 

    return $this->response->withJson(false);
});

$app->get('/customers', function ($request, $response) {
    $sql = "SELECT * FROM customers";
    $statement = $this->db->prepare($sql);
    $statement->execute();
    $customers = $statement->fetchAll();

    return $this->response->withJson($customers);
});

$app->post('/customers', function ($request, $response) {
    $data = $request->getParsedBody();
    $sql = "INSERT INTO customers(Id, Name, Company, ProfileImageUrl, PhoneNumber, Latitude, Longitude, Address)
                VALUES(:Id, :Name, :Company, :ProfileImageUrl, :PhoneNumber, :Latitude, :Longitude, :Address)";
    $statement = $this->db->prepare($sql);
    $statement->bindParam("Id", $data['Id']);
    $statement->bindParam("Name", $data['Name']);
    $statement->bindParam("Company", $data['Company']);
    $statement->bindParam("ProfileImageUrl", $data['ProfileImageUrl']);
    $statement->bindParam("PhoneNumber", $data['PhoneNumber']);
    $statement->bindParam("Latitude", $data['Latitude']);
    $statement->bindParam("Longitude", $data['Longitude']);
    $statement->bindParam("Address", $data['Address']);
    $statement->execute();
    $data['Id'] = $this->db->lastInsertId();

    return $this->response->withJson($data);
});

$app->get('/sales', function ($request, $response) {
    $sql = "SELECT * FROM sales";
    $statement = $this->db->prepare($sql);
    $statement->execute();
    $sales = $statement->fetchAll();

    return $this->response->withJson($sales);
});

$app->post('/sales', function ($request, $response) {
    $data = $request->getParsedBody();
    $sql = "INSERT INTO sales(Id, Title, Description, Amount, Percentage, Deal, OrderDate, CustomerId)
                VALUES(:Id, :Title, :Description, :Amount, :Percentage, :Deal, :OrderDate, :CustomerId)";
    $statement = $this->db->prepare($sql);
    $statement->bindParam("Id", $data['Id']);
    $statement->bindParam("Title", $data['Title']);
    $statement->bindParam("Description", $data['Description']);
    $statement->bindParam("Amount", $data['Amount']);
    $statement->bindParam("Percentage", $data['Percentage']);
    $statement->bindParam("Deal", $data['Deal']);
    $statement->bindParam("OrderDate", $data['OrderDate']);
    $statement->bindParam("CustomerId", $data['CustomerId']);
    $statement->execute();
    $data['Id'] = $this->db->lastInsertId();
    
    return $this->response->withJson($data);
});