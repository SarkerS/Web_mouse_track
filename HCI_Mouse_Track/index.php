<?php

include "header.php";

$sql = "SELECT *from  products";

$productsResult = mysqli_query($conn, $sql) or die (mysqli_error($conn));

$productArray  = array();

foreach ($productsResult as $product){

    $productArray[$product['product_id']]=array();

    $sql = "SELECT products.product_id,category.category_id,category.category_name,product_attributes.attribute_id,product_attributes.attribute_name,product_attribute_details.attribute_value,product_attribute_details.product_attribute_detail_id 
      FROM products,category,product_attributes,product_attribute_details 
      where products.category_id = category.category_id  and products.product_id = ".$product['product_id']."
      and product_attributes.attribute_id = product_attribute_details.attribute_id 
      and products.product_id = product_attribute_details.product_id";

    $productDetailResult = mysqli_query($conn, $sql) or die (mysqli_error($conn));
    foreach ($productDetailResult as $productDetail){
        array_push($productArray[$product['product_id']], $productDetail);

    }

}


?>


<section id="main_content">
    <div class="container">

        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Items</li>
        </ol>

        <div class="row">

            <aside class="col-lg-3 col-md-4 col-sm-4">
                <div class="box_style_1">
                    <h4>Categories</h4>
                    <ul class="submenu-col">

                        <li><a href="#" id="active">Shirts</a></li>
                    </ul>

                    <hr>

                    <h5>Upcoming Event</h5>

                    <p> we are going to arrange an exhibition of our upcoming clothes in next week Monday at 4.30pm in
                        our main showroom. </p>
                </div>
            </aside>

            <div class="col-lg-9 col-md-8 col-sm-8">
                <div class="all-products row">


                    <?php
                    
                        // Fetch one and one row
                        foreach ($productArray as $key=>$product) {
                            ?>

                            <div class="col-lg-4 col-md-6">
                                <div class="col-item">
                                    
                                    <div class="photo">
                                        <a href="#"><img class="product-attribute" id="<?php echo $product[2]['product_attribute_detail_id'] ?>"  style="height: 320px;" src="<?php echo $image_host . $product[2]['attribute_value']; ?>" alt=""/></a>

                                        
                                    </div>
                                    <div class="info">

                                        <div id="<?php echo $product[0]['product_attribute_detail_id'] ?>"
                                             class="product-attribute row">
                                            <div class="course_info col-md-6 col-sm-6">
                                                <h5><?php echo $product[0]['attribute_name'] ?></h5>
                                            </div>
                                            <div class="detail-value text-center course_info col-md-6 col-sm-6">
                                                <h6><?php echo $product[0]['attribute_value'] ?></h6>
                                            </div>
                                        </div>
                                        <div id="<?php echo $product[1]['product_attribute_detail_id'] ?>"
                                             class="product-attribute row">
                                            <div class="course_info col-md-6 col-sm-6">
                                                <h5><?php echo $product[1]['attribute_name'] ?></h5>
                                            </div>
                                            <div class="detail-value text-center course_info col-md-6 col-sm-6">
                                                <h6><?php echo $product[1]['attribute_value'] ?></h6>
                                            </div>
                                        </div>
                                        <div id="<?php echo $product[3]['product_attribute_detail_id'] ?>"
                                             class="product-attribute row">
                                            <div class="course_info col-md-6 col-sm-6">
                                                <h5><?php echo $product[3]['attribute_name'] ?></h5>
                                            </div>
                                            <div class=" detail-value text-center course_info col-md-6 col-sm-6">
                                                <h6><?php echo $product[3]['attribute_value'] ?></h6>
                                            </div>
                                        </div>
                                        <div id="<?php echo $product[4]['product_attribute_detail_id'] ?>"
                                             class="product-attribute row">
                                            <div class="course_info col-md-6 col-sm-6">
                                                <h5><?php echo $product[4]['attribute_name'] ?></h5>
                                            </div>
                                            <div class="detail-value text-center course_info col-md-6 col-sm-6">
                                                <h6><?php echo $product[4]['attribute_value'] ?></h6>
                                            </div>
                                        </div>
                                        <div id="<?php echo $product[5]['product_attribute_detail_id'] ?>"
                                             class="product-attribute row">
                                            <div class="course_info col-md-6 col-sm-6">
                                                <h5><?php echo $product[5]['attribute_name'] ?></h5>
                                            </div>
                                            <div class="detail-value text-center course_info col-md-6 col-sm-6">
                                                <h6><?php echo $product[5]['attribute_value'] ?></h6>
                                            </div>
                                        </div>
                                        <div id="<?php echo $product[6]['product_attribute_detail_id'] ?>"
                                             class="product-attribute row">
                                            <div class="course_info col-md-6 col-sm-6">
                                                <h5><?php echo $product[6]['attribute_name'] ?></h5>
                                            </div>
                                            <div class="detail-value text-center course_info col-md-6 col-sm-6">
                                                <h6><?php echo $product[6]['attribute_value'] ?></h6>
                                            </div>
                                        </div>
                                        <div id="<?php echo $product[7]['product_attribute_detail_id'] ?>"
                                             class="product-attribute row">
                                            <div class="course_info col-md-6 col-sm-6">
                                                <h5><?php echo $product[7]['attribute_name'] ?></h5>
                                            </div>
                                            <div class="detail-value text-center course_info col-md-6 col-sm-6">
                                                <h6><?php echo $product[7]['attribute_value'] ?></h6>
                                            </div>
                                        </div>





                                        <div class="separator clearfix">
                                            <p class="btn-add"><a href=""></a></p>

                                            <p class="btn-details"><a class="buy-now-btn" data-product-id="<?php echo $product[0]['product_id'];?>" href=""><i class="icon-cart"></i> Buy now</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php

                    }

                    ?>


                   


                </div>
                <!-- End row -->
            </div>
            <!-- End col-lg-9-->


        </div>
        <!-- End row -->


    </div>
    <!-- End container -->
</section>
<!-- End main_content -->


<?php

include "footer.php";
?>
