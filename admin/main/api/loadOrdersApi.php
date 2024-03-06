<?php 

    include("_auth.php");

    $output = '';

    $output .='
        <div class="sort-filter-bar-container">
            <div class="filter-button">
                <i class="fa-solid fa-sliders"></i>&nbsp;Filter
                <div class="filter-list-container">
                    <div class="filter-list">
                        <div class="payment-mode-filter">
                            <p class="bg-primary">Payment Mode</p>
                            <div class="filter-item">
                                <input type="checkbox" name="payment-mode[]" id="pod-filter" value="pod">
                                <label for="pod-filter">POD</label>
                            </div>

                            <div class="filter-item">
                                <input type="checkbox" name="payment-mode[]" id="online-filter" value="online">
                                <label for="online-filter">Online</label>
                            </div>
                        </div>

                        <div class="delivery-status-filter">
                            <p class="bg-primary">Delivery Status</p>
                            <div class="filter-item">
                                <input type="checkbox" name="delivery-status[]" id="order-placed-filter" value="order placed">
                                <label for="order-placed-filter">Order Placed</label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" name="delivery-status[]" id="order-confirmed-filter" value="order confirmed">
                                <label for="order-confirmed-filter">Order Confirmed</label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" name="delivery-status[]" id="shipped-filter" value="shipped">
                                <label for="shipped-filter">Shipped</label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" name="delivery-status[]" id="out-for-delivery-filter" value="out for delivery">
                                <label for="out-for-delivery-filter">Out For Delivery</label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" name="delivery-status[]" id="delivered-filter" value="delivered">
                                <label for="delivered-filter">Delivered</label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" name="delivery-status[]" id="canceled-filter" value="canceled">
                                <label for="canceled-filter">Order Canceled</label>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>

            <div class="sort-button">
                <i class="fa-solid fa-sort"></i>&nbsp;Sort
                <div class="sort-list-container">
                    <div class="sort-list">
                        <p class="bg-primary">Sort By</p>

                        <div class="sort-item">
                            <input type="radio" name="sort-by" id="default-sort" value="default" checked>
                            <label for="default-sort">Default</label>
                        </div>

                        <div class="sort-item">
                            <input type="radio" name="sort-by" id="newest-first-sort" value="newest first" >
                            <label for="newest-first-sort">Newest First</label>
                        </div>

                        <div class="sort-item">
                            <input type="radio" name="sort-by" id="oldest-first-sort" value="oldest first">
                            <label for="oldest-first-sort">Oldest First</label>
                        </div>

                        <div class="sort-item">
                            <input type="radio" name="sort-by" id="low-to-high-sort" value="low to high">
                            <label for="low-to-high-sort">Price - Low to High</label>
                        </div>

                        <div class="sort-item">
                            <input type="radio" name="sort-by" id="high-to-low-sort" value="high to low">
                            <label for="high-to-low-sort">Price - High to Low</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="export-button">
                <i class="fa-solid fa-file-arrow-down"></i>&nbsp; Export
            </div>

            <div class="date-range">
                <label for="from">From</label>
                <input type="date" id="from" name="from">
                <label for="to">to</label>
                <input type="date" id="to" name="to">
                <input type="button" value="Get" id="filter-by-date-range">
            </div>
        </div>';

    $output .='
    <div class="row">
    <div class="col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="active-member">
                    <div class="table-responsive">
                        <table class="table table-xs primary-table-bordered orders-table">
                            <thead class="thead-primary">
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
                            </thead>
                            <tbody>';




    $sql="select * from orders order by order_date desc";
    $result=mysqli_query($conn, $sql);

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
            <tr data-order-id="'.$row['order_id'].'">
                <td>
                    <p>'.$i++.'</p>
                </td>

                <td>
                    <p>'.$row['order_id'].'</p>
                </td>

                <td>
                    <p>'.ucwords(substr($row2['product_name'], 0, 30)).'';
                        
                        if(strlen($row2['product_name'])>30)
                        {
                            $output .='...';
                        }
            $output .='
                    </p>
                </td>

                <td>
                    <p>'.ucwords($row['quantity']).'</p>
                </td>

                <td>
                    <p> <b>PKR</b> '.number_format($row['total_price']).'</p>
                </td>

                <td>
                    <p class="badge';
            if($row['order_status']=='delivered')
            {
                $output .=' badge-success';
            }        
            else if($row['order_status']=='confirmed')
            {
                $output .=' badge-primary';
            }        
            else if($row['order_status']=='pending')
            {
                $output .=' badge-warning';
            }        
            else if($row['order_status']=='canceled')
            {
                $output .=' badge-danger';
            }        
            
            $output .='">'.ucwords($row['order_status']).'</p>
                </td>

                <td>
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
                <td>
                    <p>'.ucwords($row['order_date']).'</p>
                </td>

                <td class="text-right">
                    <button type="button" class="btn btn-primary btn-sm view-order-btn" data-order-id="'.$row['order_id'].'" data-toggle="modal" data-target="#ModalCenter">
                        <i class="fa-regular fa-eye px-2"></i>
                    </button>
                </td>
            </tr>';
        }
    }

$output .='                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    ';

echo $output;

?>