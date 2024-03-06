<?php

session_start();
include("../config/config.php");
include("../config.php");

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$data = json_decode(file_get_contents("php://input"), true);

$address_id= $data['address_id'];
$product_id= $data['product_id'];
$user_id=$_SESSION['user_id'];

$en_product_id=base64_encode($product_id);

$custom_order_id= time().'' . bin2hex(random_bytes(4));


$sql="select cart.quantity as quantity, cart.total_price as total_price, products.product_name as product_name, products.product_price as price from cart join products on cart.product_id=products.product_id where cart.product_id={$product_id} and cart.user_id={$_SESSION['user_id']} and cart.is_deleted=0 and products.is_deleted=0";
$result=mysqli_query($con, $sql);
if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);

    $quantity=$row['quantity'];
    $price_single_unit=$row['price'];
    $total_price=$row['total_price'];


    if(true)
    {
        $product = $stripe->products->create([
            'name' => $row['product_name'],
            'type' => 'good', //service or 'good' for a physical product
        ]);
        
        
        $price =  $stripe->prices->create([
            'product' => $product->id,
            'unit_amount' => $price_single_unit*100, // amount in cents
            'currency' => 'usd',
        ]);
        
        // Create a Checkout Session
        $checkout_session =  $stripe->checkout->sessions->create([
            'success_url' => 'https://taptiemporium.com/success.php?orderId='.$custom_order_id,
            'cancel_url' => 'https://taptiemporium.com/fail.php',
            'payment_method_types'   => ['card'],
            'mode' => 'payment',
            'billing_address_collection' => 'required',
            'shipping_address_collection' => [
                'allowed_countries' => ['US'],
            ],
            'line_items' => [
                [
                    'price' => $price->id,
                    'quantity' => $quantity,
                ],
            ],
            'metadata' => [
                'product_id' => $product_id,
                'address_id' => $address_id,
                'user_id' => $user_id,
                'custom_order_id'   =>  $custom_order_id,
                'order_type'   =>  'normal',
            ],
        ]);

        echo json_encode(['id' => $checkout_session->id]);
        exit();
    }
}


?>