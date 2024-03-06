<?php 

include("_auth.php");

$output ='';

$output .= '
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Product</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control input-flat" placeholder="Product Name" name="product-name" id="product-name" required>
                </div>
                
                <div class="col form-group">
                    <label class="form-label">Category</label>
                    <select class="form-control input-flat" name="product-category" id="product-category" required>
                        <option value="">Select Category</option>';

                    $sql = "select * from category where is_deleted=0";
                    $result=mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result)>0)
                    {
                        while($row=mysqli_fetch_assoc($result))
                        {
                            $output .='<option value="'.$row['id'].'">'.ucwords($row['name']).'</option>';
                        }
                    }

                    $output .='
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Sub Category</label>
                    <select class="form-control input-flat" name="product-sub-category" id="product-sub-category" required>
                        <option value="">Select Sub Category</option>
                    </select>
                </div>

                <div class="col form-group">
                    <label class="form-label">Original Price</label>
                    <input type="number" class="form-control input-flat" placeholder="Original Price" name="product-base-price" id="product-base-price" required>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Discounted Price</label>
                    <input type="number" class="form-control input-flat" placeholder="Discounted Price" name="product-price" id="product-price" required>
                </div>

                <div class="col form-group">
                    <label class="form-label">Main Image (Size 500x500)</label>
                    <input type="file" class="form-control input-flat" name="product-main-image" id="product-main-image" required>
                </div>
            </div>
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Other Images (Size 500x500)</label>
                    <input type="file" class="form-control input-flat" name="product-other-image[]" id="product-other-image" multiple>
                </div>

                <div class="col form-group">
                    <label class="form-label">Quantity</label>
                    <input type="number" class="form-control input-flat" name="product-quantity" id="product-quantity" placeholder="Quantity" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-control h-150px" rows="6" style="height: 55px;" name="product-desc" id="product-desc" required></textarea>
            </div>
            
            <hr/>
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Add Specification</label><br/>
                    <button class="btn btn-success btn-sm add-specification-field-btn">Add</button>
                </div>
            </div>

            <div class="specification-container">
                <div class="row">
                    <div class="col form-group">
                        <input type="hidden" value="" name="product-specification-id[]" >

                        <input type="text" class="form-control input-flat" placeholder="Name" name="product-specification-name[]" value="">
                    </div>
                    <div class="col form-group">
                        <input type="text" class="form-control input-flat" placeholder="value" name="product-specification-value[]" value="">
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="add-product-submit-btn">Add Product</button>
        </div>
    </div>';

echo $output;
?>