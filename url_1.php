<?php 

    require("****.php");

 if(!empty($_POST)) 
    {
		if (empty($_POST['url']) )
	{	$response["success"] = 0;
        $response["message"] = "Please Enter Url";
       
        die(json_encode($response));
    
    }
	
    $query = "INSERT INTO URLS ( url ) VALUES ( :url ) ";

	 $query_params = array(
        ':url' => $_POST['url']
		);
	
	   try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
		}
    catch (PDOException $ex) {
        
        $response["success"] = 0;
        $response["message"] = "Database Error2. Please Try Again!";
        die(json_encode($response));
    }
	
	$response["success"] = 1;
	$response["message"] = "Username Successfully Added!";
	
	if($response["success"] == 1)
	{
		$query = "SELECT id,url
				FROM  `URLS` 
				WHERE url = :url  
				LIMIT 1";
	
		$query_params = array(
        ':url' => $_POST['url']
		);
	try {
    $stmt   = $db->prepare($query);
    $result = $stmt->execute($query_params);
	}
	catch (PDOException $ex) {
    $response["success"] = 0;
    $response["message"] = "Database Error!";
    die(json_encode($response));
	}

// Finally, we can retrieve all of the found rows into an array using fetchAll 
	$rows = $stmt->fetchAll();


if ($rows) {
    $response["success"] = 1;
    $response["message"] = "Post Available!";
    $response["posts"]   = array();
    
    foreach ($rows as $row) {
        $post             = array();
        $post["id"]		  = $row["id"];
        $post["url"]      =         $row["url"];
        //$post["message"]  = $row["message"];
        
        
        //update our repsonse JSON data
        array_push($response["posts"], $post);
    }
    
    // echoing JSON response
    echo json_encode($response);
    
	}
	else {
    $response["success"] = 0;
    $response["message"] = "No Link  Available!";
    die(json_encode($response));
	}}
} 
else
	{
	?>

<h1>URL SHORTNER </h1> 
<form action="url_1.php" method="post"> 
    Enter Url :<br /> 
    <input type="text" name="url" value="" /> 
    <br /><br /> 
    
    <input type="submit" value="Shorten Url" /> 
</form>
<?php
}
	
?>
