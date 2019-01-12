/**
 * Created by SiBeNDu on 1/4/17.
 */
$(document).ready(function () {

    var jsonData=[];


    $(".all-products .product-attribute").hover(

        function () {

            console.log("Entering ID - " + $(this).attr("id"));
            window['row' + $(this).attr("id")] = new Date();
            $(this).children("div.detail-value").css("display","block");

        }, function () {
            $(this).children("div.detail-value").css("display","none");
            var time = new Date()- window['row' + $(this).attr("id") ];

            jsonData.push({
               'attribute_detail_id': $(this).attr("id"),
                'spent_time':time
            });
            // sendData(jsonData);
            console.log("time:" + time);
            console.log("Leaving ID - " + $(this).attr("id"));

        }
    );

    $(".btn-details").on('click','.buy-now-btn',function (e) {
        e.preventDefault();
        var purchaseData={
            'product_id': $(this).data('product-id')
        };
        purchaseProduct(purchaseData);
        alert("Product Purchased");
    });


    window.setInterval(function(){
        sendData(jsonData);
        jsonData=[];
    }, 5000);

});

function sendData(jsonData){
    console.log(jsonData);
    var feedback = $.ajax({
        type: "POST",
        url: "save_data.php",
        data:JSON.stringify(jsonData),
        dataType:"json"
    }).done(function(message){
        console.log(message);
    }).fail(function (jqXHR, textStatus) {
        console.log("Call failed: "+textStatus);
    });
    
}

function purchaseProduct(productData){
    console.log(productData);
    var feedback = $.ajax({
        type: "POST",
        url: "purchase_product.php",
        data:JSON.stringify(productData),
        dataType:"json"
    }).done(function(message){
        console.log(message);
    }).fail(function (jqXHR, textStatus) {
        console.log("Call failed: "+textStatus);
    });

}