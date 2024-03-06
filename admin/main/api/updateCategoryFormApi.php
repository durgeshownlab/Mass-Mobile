<?php 
include("_auth.php");


$category_id=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['category_id']));

$output ='';


$sql="select * from category where id={$category_id} and is_deleted=0";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==1)
{
    $row=mysqli_fetch_assoc($result);
}

$output .= '
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Category</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Category Name</label>
                    <input type="hidden" value="'.$row['id'].'" name="category-id" id="category-id">
                    <input type="text" class="form-control input-flat" placeholder="Category Name" name="category-name" id="category-name" value="'.$row['name'].'" required>
                </div>

                <div class="col form-group">
                    <label class="form-label">Category Image (Size 500x500)</label>
                    <input type="hidden" value="../../../images/category/'.$row['image'].'" name="existing-category-image" id="existing-category-image">
                    <input type="file" class="form-control input-flat" name="category-image" id="category-image">
                    <img src="../../images/category/'.$row['image'].'" class="img-fluid rounded pt-2" alt="" style="width: 100px; height: auto; max-height: 200px; max-width: 200px;">
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="update-category-submit-btn">Save Changes</button>
        </div>
    </div>';

echo $output;
?>