<?php

include("_auth.php");

$order_id=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['order_id']));

$output ='';

$sql = "select * from orders where order_id='{$order_id}'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);
}

$sql_for_product="select product_name, product_image, product_desc from products where product_id={$row['product_id']}";
$result_for_product = mysqli_query($conn, $sql_for_product);
if(mysqli_num_rows($result_for_product)>0)
{
    $row_for_product=mysqli_fetch_assoc($result_for_product);
}

$sql_for_address="select * from address where address_id={$row['address_id']}";
$result_for_address = mysqli_query($conn, $sql_for_address);
if(mysqli_num_rows($result_for_address)>0)
{
    $row_for_address=mysqli_fetch_assoc($result_for_address);
}

$output .='
<div class="modal-content">
    <!-- form header  -->
    <div class="modal-header align-items-center">
        <div class="form-title">View Order Details</div>
        <div>
            <div class="get-invoice-btn btn btn-success btn-sm" data-order-id="'.$order_id.'">Get Invoice</div>
        </div>';

if($row['delivery_status'] !='delivered' && $row['is_canceled'] == 0 && $row['order_status'] == 'pending')
{

    $output .='<div class="admin-operation-container">';
    $output .='<button class="btn btn-danger btn-sm m-1" id="cancel-order-admin" data-order-id="'.$row['order_id'].'">Cancel Order</button>';
    $output .='<button class="btn btn-success btn-sm m-1" id="confirm-order-admin" data-order-id="'.$row['order_id'].'">Confirm Order</button>';
    $output .='</div>';
}


$output .='
        <div class="form-close-btn">
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>
    </div>

    <div class="modal-body">
        <input type="hidden" name="order-id" value="'.$row['order_id'].'">
        <div class="col">
            <div class="row">
                <div class="col">
                    <img src="../../images/products/'.$row_for_product['product_image'].'" alt="" style="width: 100%; height: auto;">
                </div>

                <div class="col">
                    <div class="product-name-desc-container">
                        <div class="product-name mb-3">
                            <b> Product Name :</b><br/>
                            '.ucwords($row_for_product['product_name']).'
                        </div>
                        <div class="product-desc mb-3">
                            <b> Description :</b><br/>
                            '.$row_for_product['product_desc'].'
                        </div>
                    </div>

                    <div class="product-price-quantity-container">
                        <div class="product-price mb-3">
                            <b>PKR</b> '.number_format($row['price_single_unit']).'
                        </div>
                        <div class="product-quantity mb-3">
                            <b>Quantity: </b>'.$row['quantity'].'
                        </div>
                    </div>

                    <div class="product-total-price-container">
                        <div class="product-total-price">
                            <b>Total Price: </b><span><b>PKR</b> '.number_format($row['total_price']).'</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="card-payment-details col d-flex flex-column">
                    <div class="d-flex flex-column mb-3">
                        <b>Transaction ID: </b>
                        <span>'.$row['transaction_id'].'</span>
                    </div>
                    <div class="d-flex flex-column mb-3">
                        <b>Order ID: </b>
                        <span>'.$row['order_id'].'</span>
                    </div>
                    <div class="d-flex flex-column mb-3">
                        <b>Payment Type</b>
                        <span>'.$row['payment_method'].'</span>
                    </div>
                    <div class="d-flex flex-column mb-3">
                        <b>Payment Status</b>
                        <span>'.$row['payment_status'].'</span>
                    </div>
                    <div class="col">
                        <b class="row">Delivery Status </b>';
                    if($row['is_canceled']==0)
                    {
                        if($row['order_status']!='pending')     
                        {
                            if($row['delivery_status']!='delivered')
                            {
                                $output .='
                                <div class="input-group">
                                    <select class="form-control" id="delivery-status">';
            
                                if($row['delivery_status']=='order confirmed')
                                {
                                    $output .='
                                        <option value="">'.$row['delivery_status'].'</option>
                                        <option value="shipped">Shipped</option>';
                                }
                                else if($row['delivery_status']=='shipped')
                                {
                                    $output .='
                                        <option value="">'.$row['delivery_status'].'</option>
                                        <option value="out for delivery">Out For Delivery</option>';
                                }
                                else if($row['delivery_status']=='out for delivery')
                                {
                                    $output .='
                                        <option value="">'.$row['delivery_status'].'</option>
                                        <option value="delivered">Delivered</option>';
                                }
                                $output .='</select> 
                                        <button class="btn btn-success btn-sm" id="update-delivery-status-btn">Update</button>
                                    </div>            
                                ';
                            }
                            else
                            {
                                $output .='<span class="row badge badge-success">Delivered</span>';
                            }
                        }
                        else
                        {
                            $output .='<span class="row badge badge-warning">Pending</span>';
                        }
                    }
                    else
                    {
                        $output .='<span class="row badge badge-danger">Canceled</span>';
                    }
        
        $output .='
                    </div>
                </div>
                <div class="card-delivery-address-details col">
                    <div class="product-delivery-address-title">
                        <p class="bg-secondary d-inline px-2 border-white rounded">Delivery Address </p>
                    </div>
                    <div class="product-order-date d-flex flex-column mb-3">
                        <b>Order Date</b>
                        <span>'.$row['order_date'].'</span>
                    </div>
                    <div class="product-delivery-person d-flex flex-column mb-3">
                        <span>'.ucwords($row_for_address['name']).'</span>
                        <span>
                            '.$row_for_address['address'].'<br/>
                            <b>Locality:</b> '.$row_for_address['locality'].'</br>
                            <b>City:</b> '.$row_for_address['city'].' <br/>
                            <b>State:</b> '.$row_for_address['state'].' </br>
                            <b>Pin Code:</b> '.$row_for_address['pin_code'].'
                        </span>
                    </div>
                    <div class="product-delivery-phone-number d-flex flex-column mb-3">
                        <b>Phone Number:</b>
                        <span>'.$row_for_address['mobile'].'</span>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="delivery-status-event-container">
            <div class="delivery-status-event">';
        
        $order_event=json_decode($row['order_event'], true);
    
        for($i=0; $i<count($order_event); $i++)
        {
            if($order_event[$i]['event_name']!='order canceled')
            {
                $output .='
                <div class="delivery-status-order-confirmed ">
                    <div class="delivery-status-text">
                        <span>'.$order_event[$i]['event_name'].'</span>
                    </div>
                    <div class="delivery-status-date-time">
                        <span>'.$order_event[$i]['Date'].' '.$order_event[$i]['Time'].'</span>
                    </div>
                </div>';
            }   
            else
            {
                $output .='
                <div class="delivery-status-order-canceled ">
                    <div class="delivery-status-text">
                        <span>'.$order_event[$i]['event_name'].'</span>
                    </div>
                    <div class="delivery-status-date-time">
                        <span>'.$order_event[$i]['Date'].' '.$order_event[$i]['Time'].'</span>
                    </div>
                </div>';
            }
    
        }
    
        $output .='
            </div>
        </div>
    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>

';

echo $output;

?>