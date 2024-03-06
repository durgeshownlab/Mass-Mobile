<?php   

    include("_auth.php");

    $category_id=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['category_id']));

    $output='';

    
    $sql="select * from category where id={$category_id} and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)==1)
    {
        $row=mysqli_fetch_assoc($result);
    
        $output .='
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <div class="">
                        <img src="../../images/category/'.$row['image'].'" class="img-fluid rounded" alt="" style="width: 200px; height: auto; max-height: 200px; max-width: 200px;">
                    </div>
                    <div class="col">
                        <div class="row">
                            <b class="col text-center" style="font-size: 20px;">'.ucwords($row['name']).'</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>';
        echo $output;
    }
    else
    {
        echo 0;
    }

?>