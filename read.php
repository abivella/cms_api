
<?php
header("Content-Type:application/json");
//connection with the database
include_once ("dbconnect.php");

if(!empty($_GET['price'])) {
    $price=$_GET['price'];

    $items = getItems($price, $conn);
    if (empty($items))
    {
        jsonResponse(200, "Items Not Found", NULL);
    }
    else
    {
        jsonResponse(200, "Item Found", $items);

        
    }
} else {
jsonResponse(400,"Invalid Request",NULL);
}


function jsonResponse($status, $status_message, $data)
	{
	header("HTTP/1.1 " . $status_message);
	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;
	$json_response = json_encode($response);
	echo $json_response;
	}

function getItems($price, $conn)
	{
    
	//$sql = "SELECT * FROM event";
    
    $sql = "SELECT * FROM products WHERE price >= " . $price;
    
	$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
	$data = array();
	while ($rows = mysqli_fetch_assoc($resultset))
		{
		$data[] = $rows;
		}

	return $data;
	}

?>
