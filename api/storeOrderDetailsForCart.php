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
$user_id=$data['user_id'];


$total_price=0;

$sql="select cart.quantity as quantity, cart.total_price as total_price, products.product_id as product_id, products.product_name as product_name, products.product_price as price from cart join products on cart.product_id=products.product_id where cart.user_id={$_SESSION['user_id']} and cart.is_deleted=0 and products.is_deleted=0";
$result=mysqli_query($con, $sql);
if(mysqli_num_rows($result)>0)
{
    $productDetails=array();
    $i=0; 
    while($row=mysqli_fetch_assoc($result))
    {
        $custom_order_id= time().'' . bin2hex(random_bytes(4));

        $productDetails[$i]=[
            'product_id'        =>  $row['product_id'],
            'custom_order_id'   =>  $custom_order_id,
            'quantity'          =>  $row['quantity'],
            'price_single_unit' =>  $row['price'],
            'total_price'       =>  $row['total_price']
        ];
        $total_price += $row['total_price'];
        $i++;
    }
}





$product = $stripe->products->create([
    'name' => 'Tapti Store Cart Order',
    'type' => 'good', //service or 'good' for a physical product
]);


$price = $stripe->prices->create([
    'product' => $product->id,
    'unit_amount' => $total_price*100, // amount in cents
    'currency' => 'usd',
]);

// Create a Checkout Session
$checkout_session =  $stripe->checkout->sessions->create([
    'success_url' => 'https://taptiemporium.com/successForCart.php?data='.base64_encode(json_encode($productDetails)),
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
            'quantity' => 1,
        ],
    ],
    'metadata' => [
        'productDetails' => json_encode($productDetails),
        'address_id' => $address_id,
        'user_id' => $user_id,
        'order_type'   =>  'cart',
    ],
]);

echo json_encode(['id' => $checkout_session->id]);
exit();

?>

