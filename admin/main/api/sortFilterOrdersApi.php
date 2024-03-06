<?php

include("_auth.php");

$payment_method=[];
$delivery_status=[];
$sort_by=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['sort_by']));

if(isset($_POST['from_date']) && isset($_POST['to_date']))
{
    $from_date=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['from_date']));
    $to_date=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['to_date']));
}

$output = '';
 
if(isset($_POST['payment_method']))
{
    $payment_method = $_POST['payment_method'];
}

if(isset($_POST['delivery_status']))
{
    $delivery_status = $_POST['delivery_status'];
}


if(!empty($payment_method) || !empty($delivery_status) || !empty($sort_by))
{
    $sql = "SELECT * FROM orders WHERE 1=1 ";

    if(isset($_POST['from_date']) && isset($_POST['to_date']) && !empty($from_date) && !empty($to_date))
    {
        $sql .= " and  (date(order_date) BETWEEN '{$from_date}' AND '{$to_date}' or DATE(order_date) BETWEEN '{$to_date}' AND '{$from_date}') ";
    }

    if(!empty($payment_method))
    {
        $sql .= " and payment_method IN ('" . implode("','", $payment_method) . "') ";
    }
    if(!empty($delivery_status))
    {
        $sql .= " and delivery_status IN ('" . implode("','", $delivery_status) . "') ";
    }


    if($sort_by=='default')
    {
        $sql .= " order by order_date desc";
    }
    else if($sort_by=='newest first')
    {
        $sql .= " order by order_date desc";
    }
    else if($sort_by=='oldest first')
    {
        $sql .= " order by order_date asc";
    }
    else if($sort_by=='low to high')
    {
        $sql .= " order by total_price asc";
    }
    else if($sort_by=='high to low')
    {
        $sql .= " order by total_price desc";
    }
    else
    {
        $sql .= " order by order_date desc";
    }
    
        // $sql="select * from orders order by order_date desc";
        $result=mysqli_query($conn, $sql);

        $output .=' <thead class="thead-primary">
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Order Status</th>
                            <th>Delivery Status</th>
                            <th>Order Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>';
    
        if(mysqli_num_rows($result)>0)
        {
            $i=1;
            while($row=mysqli_fetch_assoc($result)){
                $sql2="select product_name from products where product_id={$row['product_id']}";
                $result2=mysqli_query($conn, $sql2);
                if(mysqli_num_rows($result2)>0)
                {
                    $row2=mysqli_fetch_assoc($result2);
                }
                
                $output .='
                <tr data-order-id="'.$row['order_id'].'"';
        $output .='>
                    <td>'.$i++.'</td>
                    <td class="order-id">
                        <p>'.$row['order_id'].'</p>
                    </td>
                    <td class="product-name">
                        <p>'.ucwords($row2['product_name']).'</p>
                    </td>
                    <td class="quantity">
                        <p>'.$row['quantity'].'</p>
                    </td>
                    <td class="total-price">
                        <p><b>PKR</b> '.number_format($row['total_price']).'</p>
                    </td>
                    <td class="quantity">
                        <p ';

        if($row['order_status']=='pending')
        {
            $output .='class="badge badge-warning"';
        }
        else if($row['order_status']=='canceled')
        {
            $output .='class="badge badge-danger"';
        }
        else if($row['order_status']=='confirmed')
        {
            $output .='class="badge badge-primary"';
        }
        else if($row['order_status']=='delivered')
        {
            $output .='class="badge badge-success"';
        }
                        
        $output .='>';

        $output .= ''.ucwords($row['order_status']).'';
        
        $output .='</p>
                    </td>
                    <td class="order-date">
                        <p class="badge ';
        
        if($row['delivery_status']=='delivered')
        {
            $output .=' badge-success';
        }        
        else if($row['delivery_status']=='confirmed')
        {
            $output .=' badge-primary';
        }        
        else if($row['delivery_status']=='placed')
        {
            $output .=' badge-warning';
        }        
        else if($row['delivery_status']=='canceled')
        {
            $output .=' badge-danger';
        }    
        else
        {
                $output .=' badge-secondary';
        }
                        
        $output .='">'.ucwords($row['delivery_status']).'</p>
                    </td>
                    <td class="order-date">
                        <p>'.$row['order_date'].'</p>
                    </td>
                    <td class="text-right">
                        <button type="button" class="btn btn-primary btn-sm view-order-btn" data-order-id="'.$row['order_id'].'" data-toggle="modal" data-target="#ModalCenter">
                            <i class="fa-regular fa-eye px-2"></i>
                        </button>
                    </td>
                </tr>';
            }
        }

} 
else
{
    $sql="select * from orders order by order_date desc";
    $result=mysqli_query($conn, $sql);

    $output .=' <thead class="thead-primary">
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>';

    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        while($row=mysqli_fetch_assoc($result)){
            $sql2="select product_name from products where product_id={$row['product_id']}";
            $result2=mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result2)>0)
            {
                $row2=mysqli_fetch_assoc($result2);
            }
            
            $output .='
            <tr data-order-id="'.$row['order_id'].'"';
            
    $output .='>
                <td>'.$i++.'</td>
                <td class="order-id">
                    <p>'.$row['order_id'].'</p>
                </td>
                <td class="product-name">
                    <p>'.ucwords($row2['product_name']).'</p>
                </td>
                <td class="quantity">
                    <p>'.$row['quantity'].'</p>
                </td>
                <td class="total-price">
                    <p><b>PKR</b>'.number_format($row['total_price']).'</p>
                </td>
                <td class="quantity">
                    <p ';

                if($row['order_status']=='pending')
                {
                    $output .='class="badge badge-warning"';
                }
                else if($row['order_status']=='canceled')
                {
                    $output .='class="badge badge-danger"';
                }     
                                
                $output .='>';

                if($row['delivery_status']=='delivered')
                {
                    $output .=''.ucwords($row['delivery_status']).'';
                }
                else
                {
                    $output .= ''.ucwords($row['order_status']).'';
                }

                $output .='</p>
                        </td>

            
                <td class="order-date">
                    <p>'.$row['order_date'].'</p>
                </td>
                <td class="text-right">
                    <button type="button" class="btn btn-primary btn-sm view-order-btn" data-order-id="'.$row['order_id'].'" data-toggle="modal" data-target="#ModalCenter">
                        <i class="fa-regular fa-eye px-2"></i>
                    </button>
                </td>
            </tr>';
        }
    }
}
  
echo $output;
?>