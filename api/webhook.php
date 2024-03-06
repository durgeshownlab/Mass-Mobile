<?php
include('../config/config.php');
require_once('../config.php'); // Include the Stripe PHP library

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Retrieve the request's body and the signature
$input = @file_get_contents("php://input");
$event = null;

try {
    // Verify the webhook signature
    $event = \Stripe\Webhook::constructEvent(
        $input,
        $_SERVER['HTTP_STRIPE_SIGNATURE'],
        'whsec_IpilF928YP79xkTh9JE1l54instQlOnj'
    );
} catch (\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    http_response_code(400);
    exit();
}

// Handle the successful payment event
if ($event->type == 'checkout.session.completed') {
    $session = $event->data->object;

    // Extract the transaction ID

    
    $order_type=$session->metadata->order_type;
    
    if($order_type=='normal')
    {

        $transaction_id = $session->payment_intent;

        $custom_order_id=$session->metadata->custom_order_id;

        $address_id=$session->metadata->address_id;
        $product_id=$session->metadata->product_id;
        $user_id=$session->metadata->user_id;

        $en_product_id=base64_encode($product_id);
        
        
        
        $sql="select cart.quantity as quantity, cart.total_price as total_price, products.product_name as product_name, products.product_price as price from cart join products on cart.product_id=products.product_id where cart.product_id={$product_id} and cart.user_id={$user_id} and cart.is_deleted=0 and products.is_deleted=0";
        $result=mysqli_query($con, $sql);
        if(mysqli_num_rows($result)>0)
        {
            $row=mysqli_fetch_assoc($result);
        
            $quantity=$row['quantity'];
            $price_single_unit=$row['price'];
            $total_price=$row['total_price'];
        
        }
        
        
        $payment_method='online';
        $payment_status='success';
        $delivery_status='order placed';
    
        $sql="select * from orders where transaction_id='{$transaction_id}' and is_deleted=0";
        $result=mysqli_query($con, $sql);
            
        
        if(mysqli_num_rows($result)<=0)
        {
            // code for order  event start from the order placed
            date_default_timezone_set("Asia/kolkata");
        
            $order_event_data = [
                [
                    'event_name' => 'order placed',
                    'Date' => date('d-m-Y'),
                    'Time' => date('H:i:s')
                ]
            ];
        
            $json_order_event_data = json_encode($order_event_data);
        
            
        
            $sql="INSERT INTO orders (order_id, user_id, product_id, address_id, transaction_id, quantity, price_single_unit, total_price, payment_method, payment_status, delivery_status, order_event) VALUES ('{$custom_order_id}', {$user_id}, {$product_id}, {$address_id}, '{$transaction_id}', {$quantity}, {$price_single_unit}, {$total_price}, '{$payment_method}', '{$payment_status}', '{$delivery_status}', '{$json_order_event_data}')";
        
            $result=mysqli_query($con, $sql);
            if($result)
            {
                $sql="select name, email from users where user_id={$user_id} and is_deleted=0";
                $result=mysqli_query($con, $sql);
                if(mysqli_num_rows($result)==1)
                {
                    $row=mysqli_fetch_assoc($result);
        
                    $sql_for_product="select * from products where product_id={$product_id} and is_deleted=0";
                    $result_for_product=mysqli_query($con, $sql_for_product);
        
                    if(mysqli_num_rows($result_for_product)==1)
                    {
                        $row_for_product=mysqli_fetch_assoc($result_for_product);
                    }
        
                    $to=$row['email'];
                    $subject="order has been successfully placed";
                    $body="<div style=\"margin:0px auto; width:100%; background-color:#f3f2f0; padding:0px; padding-top:8px; padding-bottom: 8px;\">
                            <table valign=\"top\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"95%\" align=\"center\" style=\"background-color:#fff; padding: 10px 5px\">
                                <tr><td>Hii, <b style=\"text-transform: capitalize;\">{$row['name']}</b></td></tr>
                                <tr><td>
                                    <center> 
                                        <img src=\"https://freepngimg.com/save/18343-success-png-image/1200x1200\" style=\"width: 100px; height: auto;\">
                                        <h1>Your order has been successfully placed</h1>
                                        <img src=\"../{$row_for_product['product_image']}\" style=\"width: 150px; height: auto;\"><br/><br/>
                                        <a href=\"https://taptiemporium.com/shop-details.php?pid={$product_id}\" style=\"text-decoration: none; color: blue; font-size: 1.2rem; text-transform: capitalize;\">{$row_for_product['product_name']}</a><br/>
                                        Quantity:  {$quantity}<br/>
                                        Price: <b> <b>PKR</b></b>".number_format($row_for_product['product_price']*$quantity)."<br/><br/>
                                    </center>
                                </td>
                                </tr>
        
                                <tr>
                                    <td><center>Order ID: {$custom_order_id}</center></td>
                                </tr>
                                <tr>
                                    <td><center>Payment ID: {$transaction_id}</center><br/><br/></td>
                                </tr>
                                <tr><td><center>
                                <a href=\"https://taptiemporium.com\" style=\"padding: 5px 10px; border: none; background-color: green; border-radius: 5px; text-decoration: none; color: #fff;\">Visit Our Website</a><br/><br/>
                                Thank you for shoping
                                </center>
                                </td>
                                </tr>
                            </table>
                            </div>";
        
                    //Import PHPMailer classes into the global namespace
                    //These must be at the top of your script, not inside a function
                
                    require 'PHPMailer/Exception.php';
                    require 'PHPMailer/PHPMailer.php';
                    require 'PHPMailer/SMTP.php';
        
                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);
        
                    try {
                        //Server settings                 //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'hamarfreefire2021@gmail.com';                     //SMTP username
                        $mail->Password   = 'jlatawobrxvhdjgi';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to conect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
                        //Recipients
                        $mail->setFrom('hamarfreefire2021@gmail.com', 'Tapti Store');
                        $mail->addAddress($to, $row['name']);     //Add a recipient
        
        
                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = $subject;
                        $mail->Body    = $body;
        
                        $mail->send();
                        // echo "<script>console.log('Email successfully sent to {$to}')</script>";
                    } 
                    catch (Exception $e){
                        // echo "<script>console.log('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');";
                    }
                }
            }
        }
    }
    else if($order_type=='cart')
    {

        $transaction_id = $session->payment_intent;

        $productDetails=json_decode($session->metadata->productDetails, true);

        $address_id=$session->metadata->address_id;
        $user_id=$session->metadata->user_id;

        $payment_method='online';
        $payment_status='success';
        $delivery_status='order placed';







        
        $status=true;
        for($i=0; $i<count($productDetails); $i++)
        {

            // code for order  event start from the order placed
            date_default_timezone_set("Asia/kolkata");

                $order_event_data = [
                [
                    'event_name' => 'order placed',
                    'Date' => date('d-m-Y'),
                    'Time' => date('H:i:s')
                ]
            ];

            $json_order_event_data = json_encode($order_event_data);

            $sql="INSERT INTO orders (order_id, user_id, product_id, address_id, transaction_id, quantity, price_single_unit, total_price, payment_method, payment_status, delivery_status, order_event) VALUES ('{$productDetails[$i]['custom_order_id']}', {$user_id}, {$productDetails[$i]['product_id']}, {$address_id}, '{$transaction_id}', {$productDetails[$i]['quantity']}, {$productDetails[$i]['price_single_unit']}, {$productDetails[$i]['total_price']}, '{$payment_method}', '{$payment_status}', '{$delivery_status}', '{$json_order_event_data}')";

            $result=mysqli_query($con, $sql);
            if($result)
            {
                $status=true;
            }
            else
            {
                $status=false;
                echo 0;
                exit;
            }
        }
        

        if($status)
        {
            $sql="select name, email from users where user_id={$user_id} and is_deleted=0";
            $result=mysqli_query($con, $sql);
            if(mysqli_num_rows($result)==1) 
            { 
                $row=mysqli_fetch_assoc($result);

                $to=$row['email'];
                $subject="order has been successfully placed";
                $body ="";

                $body .="<div style=\"margin:0px auto; width:100%; background-color:#f3f2f0; padding:0px; padding-top:8px; padding-bottom: 8px;\">
                        <table valign=\"top\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"60%\" align=\"center\" style=\"background-color:#fff; padding: 10px 5px\">
                            <tr><td>Hii, <b style=\"text-transform: capitalize;\">{$row['name']}</b></td></tr>
                            <tr><td>
                                <center style=\"border-bottom: 1px dashed gray;\"> 
                                    <img src=\"https://freepngimg.com/save/18343-success-png-image/1200x1200\" style=\"width: 100px; height: auto;\">
                                    <h1>Your order has been successfully placed</h1>";
                for($i=0; $i<count($productDetails); $i++)
                {
                    $en_product_id=base64_encode($productDetails[$i]['product_id']);
                    $sql_for_product="select * from products where product_id={$productDetails[$i]['product_id']} and is_deleted=0";
                    $result_for_product=mysqli_query($con, $sql_for_product);

                    if(mysqli_num_rows($result_for_product)==1)
                    {
                        $row_for_product=mysqli_fetch_assoc($result_for_product);
                    }
                    $body .="
                            <img src=\"../{$row_for_product['product_image']}\" style=\"width: 150px; height: auto;\"><br/><br/>
                            <a href=\"https://taptiemporium.com/shop-details.php?pid={$product_id}\" style=\"text-decoration: none; color: blue; font-size: 1.2rem; text-transform: capitalize;\">{$row_for_product['product_name']}</a><br/>
                            Quantity:  {$productDetails[$i]['quantity']}<br/>
                            Price: <b> $</b>".number_format($row_for_product['product_price']*$productDetails[$i]['quantity'])."<br/><br/>";
                } 

                    $body .= "
                                </center><br/>
                            </td>
                            </tr>

                            <tr>
                                <td><center>Total Price : $".number_format($total_price)."</center></td>
                            </tr>
                            <tr>
                                <td><center>Payment ID: {$transaction_id}</center><br/><br/></td>
                            </tr>
                            <tr><td><center>
                            <a href=\"https://taptiemporium.com/\" style=\"padding: 5px 10px; border: none; background-color: green; border-radius: 5px; text-decoration: none; color: #fff;\">Visit Our Website</a><br/><br/>
                            Thank you for shoping
                            </center>
                            </td>
                            </tr>
                        </table>
                        </div>";

                    //Import PHPMailer classes into the global namespace
                    //These must be at the top of your script, not inside a function
                
                    require 'PHPMailer/Exception.php';
                    require 'PHPMailer/PHPMailer.php';
                    require 'PHPMailer/SMTP.php';

                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings                 //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'hamarfreefire2021@gmail.com';                     //SMTP username
                        $mail->Password   = 'jlatawobrxvhdjgi';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('hamarfreefire2021@gmail.com', 'tapti store');
                        $mail->addAddress($to, $row['name']);     //Add a recipient


                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = $subject;
                        $mail->Body    = $body;

                        $mail->send();
                        // echo "<script>console.log('Email successfully sent to {$to}')</script>";
                    } 
                    catch (Exception $e){
                        // echo "<script>console.log('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');";
                    }
                    
            }
        }
















    }

}


?>
