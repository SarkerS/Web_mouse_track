<?php

//initialize excel file
require 'php-export-data.class.php';
$exporter = new ExportDataExcel('browser', 'report.xls');
$exporter->initialize();


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

//get attribute rows
$productAttributeSql = "SELECT product_attributes.attribute_name, product_attribute_details.product_attribute_detail_id,product_attribute_details.attribute_value
        FROM products,product_attributes,product_attribute_details 
        WHERE products.product_id = product_attribute_details.product_id AND 
            product_attribute_details.attribute_id = product_attributes.attribute_id";
$productAttributeResult = mysqli_query($conn, $productAttributeSql) or die (mysqli_error($conn));

$attributeNames = array();
$attributeDetailIds = array();
$attributeValues = array();


foreach ($productAttributeResult as $item) {
    $attributeNames[]=$item['attribute_name'];
    $attributeDetailIds[]=$item['product_attribute_detail_id'];
    $attributeValues[]=$item['attribute_value'];
}


//get products and spend times

$sql = "SELECT users.user_id,purchased_products.product_id FROM users,purchased_products WHERE users.user_id = purchased_products.user_id";
$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));


$purchaseData=array();

$i=0;
foreach ($result as $row) {

    $purchaseData[$i]['product_data']=$row;
    $purchaseData[$i]['spent_times']=array();

    $sql = "SELECT * FROM purchased_products,spent_time WHERE purchased_products.purchased_product_id = spent_time.purchased_product_id and purchased_products.product_id = '".$row['product_id']."' and spent_time.user_id = '".$row['user_id']."'";
    $spentTimeResult = mysqli_query($conn, $sql) or die (mysqli_error($conn));

    foreach ($spentTimeResult as $spentRow){

        $purchaseData[$i]['spent_times'][]=array(
            'product_attribute_detail_id'=>$spentRow['product_attribute_detail_id'],
            'spent_time'=>$spentRow['spent_milisec']
        );

    }

$i++;

}


$finalSaveArray=array();

foreach ($purchaseData as $purchaseLine){

    $userSpentTimeArray = array();

    foreach ($attributeDetailIds as $id){

        $add = true;
        foreach ($purchaseLine['spent_times'] as $row){
            if($row['product_attribute_detail_id']==$id){
                $userSpentTimeArray[]=$row['spent_time'];
                $add=false;
            }
        }
        if($add){
            $userSpentTimeArray[]=0;
        }
    }
    array_unshift($userSpentTimeArray, $purchaseLine['product_data']['user_id']);
    $userSpentTimeArray[]=$purchaseLine['product_data']['product_id'];

    $finalSaveArray[]=$userSpentTimeArray;


}

array_unshift($attributeNames, " ");
array_unshift($attributeDetailIds, " ");
array_unshift($attributeValues, "User Id");
$attributeValues[]="Purchased Product";

$exporter->addRow($attributeNames);
$exporter->addRow($attributeValues);
$exporter->addRow($attributeDetailIds);

foreach ($finalSaveArray as $row){

    $exporter->addRow($row);
}

$exporter->finalize();

exit();

?>