<?php 

include("_auth.php");

$output ='';

$output .= '
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Banner</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Banner Name</label>
                    <input type="text" class="form-control input-flat" placeholder="Banner Name" name="banner-name" id="banner-name" required>
                </div>
                <div class="col form-group">
                    <label class="form-label">Banner Image (Size 1425x325)</label>
                    <input type="file" class="form-control input-flat" name="banner-image" id="banner-image" required>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="add-banner-submit-btn">Add Banner</button>
        </div>
    </div>';

echo $output;
?>