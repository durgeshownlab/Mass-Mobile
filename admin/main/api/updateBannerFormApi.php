<?php 
include("_auth.php");


$banner_id=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['banner_id']));

$output ='';

$sql="select * from banners where banner_id={$banner_id} and is_deleted=0";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==1)
{
    $row=mysqli_fetch_assoc($result);
}

$output .= '
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Banner</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">banner Name</label>
                    <input type="hidden" value="'.$row['banner_id'].'" name="banner-id" id="banner-id">
                    <input type="text" class="form-control input-flat" placeholder="banner Name" name="banner-name" id="banner-name" value="'.$row['banner_name'].'" required>
                </div>

                <div class="col form-group">
                    <label class="form-label">Banner Image (Size 1425x325)</label>
                    <input type="hidden" value="../../../images/banner/'.$row['banner_image'].'" name="existing-banner-image" id="existing-banner-image">
                    <input type="file" class="form-control input-flat" name="banner-image" id="banner-image">
                    <img src="../../images/banner/'.$row['banner_image'].'" class="img-fluid rounded pt-2" alt="" style="width: 100px; height: auto; max-height: 200px; max-width: 200px;">
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="update-banner-submit-btn">Save Changes</button>
        </div>
    </div>';

echo $output;
?>