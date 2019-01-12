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


            //Merge all Data from remote Call
            $finalInputData = array();

            for($i=0;$i<count($data);$i++){
                $add=true;
                for($j=0;$j<count($finalInputData);$j++){
                    if($finalInputData[$j]['attribute_detail_id']==$data[$i]['attribute_detail_id']){
                        $finalInputData[$j]['spent_time'] += $data[$i]['spent_time'];
                        $add=false;
                    }
                }
                if($add){
                    array_push($finalInputData,$data[$i] );
                }

            }


            //Get All Previous Data
            $previousDataSql= "SELECT * FROM spent_time WHERE user_id = '".$_SESSION['userId']."' and purchased_product_id is null";
            $previousDataResult = mysqli_query($conn, $previousDataSql) or die (mysqli_error($conn));

            $previousData = array();
            foreach ($previousDataResult as $row){
                $previousData[] = array(
                    'attribute_detail_id'=>$row['product_attribute_detail_id'],
                    'spent_time'=>$row['spent_milisec']
                );
            }

            //Merge Previous Data and Remote Data
            for($i=0;$i<count($finalInputData);$i++){
                $add=true;
                for($j=0;$j<count($previousData);$j++){
                    if($previousData[$j]['attribute_detail_id']==$finalInputData[$i]['attribute_detail_id']){
                        $previousData[$j]['spent_time'] += $finalInputData[$i]['spent_time'];
                        $add=false;
                    }
                }
                if($add){
                    array_push($previousData,$finalInputData[$i] );
                }

            }
            

            // Delete Previous Data and Add new Formatted Data
            $deleteSql = "DELETE FROM `spent_time` WHERE `user_id` = '".$_SESSION['userId']."' and purchased_product_id is null";
            $deleteSuccess = mysqli_query($conn, $deleteSql) or die (mysqli_error($conn));

            if($deleteSuccess){

                $sql = "INSERT INTO spent_time (`user_id`,`product_attribute_detail_id`,`spent_milisec`) VALUES ";

                foreach ($previousData as $row) {
                    $sql .= "('" . $_SESSION['userId'] . "','" . $row['attribute_detail_id'] . "','" . $row['spent_time'] . "'),";
                }

                $mainSql = substr($sql, 0, strlen($sql) - 1);

                $data = mysqli_query($conn, $mainSql) or die (mysqli_error($conn));

            }


            echo json_encode($data);
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