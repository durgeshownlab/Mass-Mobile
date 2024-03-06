<?php 

include("_auth.php");

$output ='';

$output .= '
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Category Name</label>
                    <input type="text" class="form-control input-flat" placeholder="Category Name" name="category-name" id="category-name" required>
                </div>
                <div class="col form-group">
                    <label class="form-label">Category Image (Size 500x500)</label>
                    <input type="file" class="form-control input-flat" name="category-image" id="category-image" required>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="add-category-submit-btn">Add Category</button>
        </div>
    </div>';

echo $output;
?>