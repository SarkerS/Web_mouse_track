<?php


session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "project_hci_new";
// Create connection
$conn = new mysqli($host, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_SESSION['userId'])) {
    if ($_SESSION['userId'] != null) {

        $data = json_decode(file_get_contents('php://input'), true);

        if(count($data)>0){

            $sql = "INSERT INTO purchased_products (`user_id`,`product_id`) VALUES ('".$_SESSION['userId']."','".$data['product_id']."')";

            $success =  mysqli_query($conn, $sql) or die (mysqli_error($conn));

            if($success){
                $sql = "UPDATE  spent_time SET purchased_product_id = '".$conn->insert_id."' where user_id= '".$_SESSION['userId']."' and  purchased_product_id is null;";
                $success =  mysqli_query($conn, $sql) or die (mysqli_error($conn));
            }
            echo json_encode($success);

        }else{
            echo json_encode(false);
            die();
        }

    } else {
        echo json_encode(false);
        die();
    }

} else {
    echo json_encode(false);
    die();
}


?>