<?php   

    include("_auth.php");

    $product_id=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['product_id']));

    $output='';

    $sql="select products.product_name as name, products.product_image as image, products.product_price as price, products.base_price as base_price, products.quantity as quantity, products.product_desc as description, category.name as category, sub_category.name as sub_category from products join sub_category on sub_category.sub_category_id=products.sub_category_id join category on sub_category.category_id=category.id where products.product_id={$product_id} and products.is_deleted=0";
    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)==1)
    {
        $row=mysqli_fetch_assoc($result);
        // echo json_encode($row);
        $output .='
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <div class="">
                        <img src="../../images/products/'.$row['image'].'" class="img-fluid rounded" alt="" style="width: 200px; height: auto; max-height: 200px; max-width: 200px;">
                    </div>
                    <div class="col">
                        <div class="row">
                            <b class="col">Name: </b>
                            <p class="col">'.ucwords($row['name']).'</p>
                        </div>
                        <div class="row">
                            <b class="col">Original Price: </b>
                            <p class="col"><b>PKR</b> '.number_format($row['base_price']).'</p>
                        </div>
                        <div class="row">
                            <b class="col">Discounted Price: </b>
                            <p class="col"><b>PKR</b> '.number_format($row['price']).'</p>
                        </div>
                        <div class="row">   
                            <b class="col">Discount: </b>
                            <p class="col">';
                            
                        if($row['base_price']>0)
                        {
                            $output .= ''. 100 - round(($row['price']/$row['base_price'])*100) .' %';
                        }    
                        else
                        {
                            $output .='NA';
                        }
                            
                        $output .=' </p>
                        </div>
                        <div class="row">
                            <b class="col">Available Quantity: </b>
                            <p class="col">'. number_format($row['quantity']).'</p>
                        </div>
                        <div class="row">
                            <b class="col">Category: </b>
                            <p class="col">'.ucwords($row['category']).'</p>
                        </div>
                        <div class="row">
                            <b class="col">Sub Category: </b>
                            <p class="col">'.ucwords($row['sub_category']).'</p>
                        </div>
                    </div>
                </div><br/><hr/>
                
                <b>Related Images:</b><br/>
                <div class="container-fluid">
                    <div class="d-flex align-items-start" style="overflow-x: auto">';

                    $sql_image = "select * from product_images where product_id={$product_id} and is_deleted=0";
                    $result_image=mysqli_query($conn, $sql_image);

                    if(mysqli_num_rows($result_image)>0)
                    {
                        while($row_image=mysqli_fetch_assoc($result_image))
                        {
                            $output .='
                                <div class="m-2">
                                    <img src="../../images/products/'.$row_image['image_path'].'" class="img-fluid rounded" alt="" style="width: 200px; height: auto; max-height: 200px; max-width: 200px;">
                                </div>';
                        }
                    }
        
        $output .='
                    </div>
                </div><hr/>

                <b>Discription:</b><br/>
                <div class="container-fluid">
                    <div class="">
                        <p>'.ucwords($row['description']).'</p>
                    </div>
                </div><hr/>
                    
                <b>Specification:</b>
                <div class="col">';

        $sql="select * from specifications where product_id={$product_id} and is_deleted=0";
        $result=mysqli_query($conn, $sql);

        if(mysqli_num_rows($result)>0)
        {
            while($row=mysqli_fetch_assoc($result))
            {
                $output .='
                    <div class="row">
                        <b class="col">'.ucwords($row['name']).' </b>
                        <p class="col">'.ucwords($row['value']).'</p>
                    </div>';

            }

        }
        $output .='
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        ';
        echo $output;
    }
    else
    {
        echo 0;
    }

?>