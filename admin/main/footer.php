  <!-- footer -->
        <div class="footer ">
            <div class="copyright">
                <p>Copyright &copy; <a href="#">Mass Mobile</a> 2018</p>
            </div>
        </div>
        <!-- #/ footer -->
    </div>
    <!-- Common JS -->
    <script src="../assets/plugins/common/common.min.js"></script>
    <!-- Custom script -->
    <script src="js/custom.min.js"></script>
    <!-- Chartjs chart -->
    <script src="../assets/plugins/chartjs/Chart.bundle.js"></script>
    <!-- Toaster js -->
    <script src="../assets/plugins/toastr/js/toastr.min.js"></script>
    <script src="../assets/plugins/toastr/js/toastr.init.js"></script>
    <!-- Custom dashboard script -->
    <script src="js/dashboard-1.js"></script>
  </body>
    <!-- jquery cdn link  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- cdn of google chart  -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        $(document).ready(function(){
            console.log('jquery runing...');
            loadOrdersCount();
            loadProductsCount();
            loadCategoryCount();
            loadSubCategoryCount();
            loadBannerCount();
            loadOutOfStockCount();
            loadOutOfStockNotificationCount();
            
// ------------------------------------------------------------------------------
// ----------------------- on click event coding area ---------------------------
// ------------------------------------------------------------------------------

            // ---------------------------------------------------------------------
            // ---------------------- code start for dashboard card ---------------------
            // ---------------------------------------------------------------------

            $(document).on('click', '.dashboard-card', function(e){
                e.preventDefault();
                let label=$(this).attr('data-label');
                console.log('card clicked', label);

                if(label==='orders')
                {
                    loadOrders();
                }
                else if(label==='products')
                {
                    loadProducts();
                }
                else if(label==='category')
                {
                    loadCategory();
                }
                else if(label==='sub-category')
                {
                    loadSubCategory();
                }
                else if(label==='banners')
                {
                    loadBanner();
                }
                else if(label==='out-of-stock')
                {
                    loadOutOfStock();
                }

            });


            // ---------------------------------------------------------------------
            // ---------------------- code start for Out of Stack tab ---------------------
            // ---------------------------------------------------------------------

            // code for view out of stack tab 
            $(document).on('click', '#out-of-stock-tab', function(e){
                e.preventDefault();
                $("#search-bar").attr('data-search-for', 'out-of-stock');
                console.log('view Out of Stock tab clicked');
                loadOutOfStock();
            });


            // ---------------------------------------------------------------------
            // ------------------------ code end for Out of Stack tab ---------------------
            // ---------------------------------------------------------------------

            // ---------------------------------------------------------------------
            // ---------------------- code start for order tab ---------------------
            // ---------------------------------------------------------------------

            // code for view order tab 
            $(document).on('click', '#orders-tab', function(e){
                e.preventDefault();
                $("#search-bar").attr('data-search-for', 'orders');
                console.log('view Orders tab clicked');
                loadOrders();
            });

            //code for view order in pop up
            $(document).on('click', '.view-order-btn', function(e){
                e.preventDefault();
                let order_id=$(this).data('order-id');
                console.log('View order: ', order_id);
                
                $.ajax({
                    url: 'api/viewOrderDetailsApi.php',
                    type: 'POST',
                    data: {order_id: order_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            //####################################################
            // code for updating the delivery status 
            //####################################################
            $(document).on("click", "#update-delivery-status-btn", function(e){
                e.preventDefault();
                if(confirm('Do you realy want to update'))
                {
                    let delivery_status=$('#delivery-status').val();
                    let order_id=$('[name="order-id"]').val();
                    console.log(delivery_status+"........."+order_id);
                    if(delivery_status=='')
                    {  
                        // alert("Sorry, can't revert the status");
                        warningMsg(`Sorry, You Can't Revert The Status`);
                    }
                    else
                    {
                        $.ajax({
                            url: "api/updateDeliveryStatusApi.php",
                            type: "POST",
                            data: {order_id: order_id, delivery_status: delivery_status},
                            success: function(data){
                                if(data==1)
                                {
                                    loadOrders();
                                    console.log('Delivery status changed to ', delivery_status);
                                    successMsg(`Delivery Status Changed to ${delivery_status}`);
                                    $.ajax({
                                        url: 'api/viewOrderDetailsApi.php',
                                        type: 'POST',
                                        data: {order_id: order_id},
                                        success: function(data){
                                            $('.modal-dialog').html(data);
                                        }
                                    });
                                }
                                else if(data==0)
                                {
                                    errorMsg(`Sorry, Failed to Change the Status`);
                                    console.log('failed to changed');
                                }
                                else
                                {
                                    console.log(data);
                                }
                            }
                        });
                    }
                }
            });

            //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
            // code for confirming or canceling the order as admin
            //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

            // code for cancel order as admin 
            $(document).on("click", "#cancel-order-admin", function(e){
                if(confirm('Do you Really want cancel order'))
                {
                    let order_id=$(this).data('order-id');
                    console.log(order_id);
                    $.ajax({
                        url: "api/cancelOrderApi.php",
                        type: "POST",
                        data: {order_id: order_id},
                        success: function(data) {
                            if(data==1)
                            {
                                loadOrders();
                                console.log('order canceled');
                                successMsg(`Order Canceled`);
                                $.ajax({
                                    url: 'api/viewOrderDetailsApi.php',
                                    type: 'POST',
                                    data: {order_id: order_id},
                                    success: function(data){
                                        $('.modal-dialog').html(data);
                                    }
                                });
                            }
                            else if(data==0)
                            {
                                console.log('order could not be canceled');
                                errorMsg('Order Couldn\'t be Canceled');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            // code for confirming order as admin 
            $(document).on("click", "#confirm-order-admin", function(e){
                if(confirm('Do you Really want Confirm order'))
                {
                    let order_id=$(this).data('order-id');
                    console.log(order_id);
                    $.ajax({
                        url: "api/confirmOrderApi.php",
                        type: "POST",
                        data: {order_id: order_id},
                        success: function(data) {
                            if(data==1)
                            {
                                loadOrders();
                                console.log('order confirmed');
                                successMsg(`Order Confirmed`);
                                $.ajax({
                                    url: 'api/viewOrderDetailsApi.php',
                                    type: 'POST',
                                    data: {order_id: order_id},
                                    success: function(data){
                                        $('.modal-dialog').html(data);
                                    }
                                });
                            }
                            else if(data==0)
                            {
                                console.log('order could not be confirmed');
                                errorMsg('Order Couldn\'t be Confirmed');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

        //  ****************************************************
        //      code  for download the invoice in pdf format
        //  ****************************************************
        $(document).on("click", ".get-invoice-btn", function(e){
            let order_id=$(this).data('order-id');
            console.log(order_id);
            var form = $('<form>', {
            method: 'POST',
            action: 'api/downloadInvoiceApi.php',
            target: '_blank' // Open the PDF in a new tab/window
            });

            // Add hidden input fields for each data item
            form.append($('<input>', {
            type: 'hidden',
            name: 'order_id',
            value: order_id
            }));
            // Append the form to the document and submit it
            form.appendTo(document.body).submit();
        });

        //***************************************************
        //      code for filter 
        //***************************************************

            //code for payment method on change
            $(document).on("change", "input[name=\"payment-mode[]\"]", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();

                let payment_method = [];
                let delivery_status = [];

                let from_date=$('#from').val();
                let to_date=$('#to').val();

                $('input[name="delivery-status[]"]:checked').each(function() {
                    delivery_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'api/sortFilterOrdersApi.php',
                    type: 'POST',
                    data: { payment_method: payment_method, delivery_status: delivery_status, sort_by: sort_by, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(delivery_status, payment_method, sort_by, from_date, to_date);
                        $('.orders-table').html(data);
                    }
                });
            });

            //code for delivery status on change
            $(document).on("change", "input[name=\"delivery-status[]\"]", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();
                let payment_method = [];
                let delivery_status = [];
                let from_date=$('#from').val();
                let to_date=$('#to').val();

                $('input[name="delivery-status[]"]:checked').each(function() {
                    delivery_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'api/sortFilterOrdersApi.php',
                    type: 'POST',
                    data: { payment_method: payment_method, delivery_status: delivery_status, sort_by: sort_by, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(delivery_status, payment_method, sort_by, from_date, to_date);
                        $('.orders-table').html(data);
                    }
                });
            });

            //code for order status on change
            $(document).on("change", "input[name=\"order-status\"]", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();
                let payment_method = [];
                let delivery_status = [];

                let from_date=$('#from').val();
                let to_date=$('#to').val();

                $('input[name="delivery-status[]"]:checked').each(function() {
                    delivery_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'api/sortFilterOrdersApi.php',
                    type: 'POST',
                    data: { payment_method: payment_method, delivery_status: delivery_status, sort_by: sort_by, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(delivery_status, payment_method, sort_by, from_date, to_date);
                        $('.orders-table').html(data);
                    }
                });
            });


            //  ****************************************************
            //      code for sorting the orders in admin pannel
            //  ****************************************************
            $(document).on("change", "input[name=\"sort-by\"]", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();

                let payment_method = [];
                let delivery_status = [];


                let from_date=$('#from').val();
                let to_date=$('#to').val();

                $('input[name="delivery-status[]"]:checked').each(function() {
                    delivery_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'api/sortFilterOrdersApi.php',
                    type: 'POST',
                    data: { sort_by: sort_by, payment_method: payment_method, delivery_status: delivery_status, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(delivery_status, payment_method, sort_by, from_date, to_date);

                        $('.orders-table').html(data);
                    }
                });
            });

            //  ********************************************************************
            //      code for filterign the orders by date range in admin pannel
            //  ********************************************************************
            $(document).on("click", "#filter-by-date-range", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();

                let payment_method = [];
                let delivery_status = [];


                let from_date=$('#from').val();
                let to_date=$('#to').val();

                $('input[name="delivery-status[]"]:checked').each(function() {
                    delivery_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'api/sortFilterOrdersApi.php',
                    type: 'POST',
                    data: { sort_by: sort_by, payment_method: payment_method, delivery_status: delivery_status, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(delivery_status, payment_method, sort_by, from_date, to_date);

                        $('.orders-table').html(data);
                    }
                });
            });
            
            //  ****************************************************
            //      code for when search in serch bar 
            //  ****************************************************

            // when user will search in orders tab 
            $(document).on('keyup', '#search-bar', function(e){
                e.preventDefault();
                let search_for=$('#search-bar').attr('data-search-for');
                let search_text=$('#search-bar').val();
                if(search_for=='orders')
                {
                    console.log(search_for+' :'+search_text);
                    $.ajax({
                        url: 'api/searchOrderApi.php',
                        type: 'POST',
                        data: {search_text: search_text},
                        success: function(data){
                            $('.orders-table').html(data);
                        }
                    });
                }
                
            });

            // when user will search in products tab 
            $(document).on('keyup', '#search-bar', function(e){
                e.preventDefault();
                let search_for=$('#search-bar').attr('data-search-for');
                let search_text=$('#search-bar').val();
                if(search_for=='product')
                {
                    console.log(search_for+' :'+search_text);
                    $.ajax({
                        url: 'api/searchProductApi.php',
                        type: 'POST',
                        data: {search_text: search_text},
                        success: function(data){
                            $('.products-table').html(data);
                        }
                    });
                }
                
            });

            // when user will search in category tab 
            $(document).on('keyup', '#search-bar', function(e){
                e.preventDefault();
                let search_for=$('#search-bar').attr('data-search-for');
                let search_text=$('#search-bar').val();
                if(search_for=='category')
                {
                    console.log(search_for+' :'+search_text);
                    $.ajax({
                        url: 'api/searchCategoryApi.php',
                        type: 'POST',
                        data: {search_text: search_text},
                        success: function(data){
                            $('.category-table').html(data);
                        }
                    });
                }
                
            });

            // when user will search in sub category tab 
            $(document).on('keyup', '#search-bar', function(e){
                e.preventDefault();
                let search_for=$('#search-bar').attr('data-search-for');
                let search_text=$('#search-bar').val();
                if(search_for=='sub-category')
                {
                    console.log(search_for+' :'+search_text);
                    $.ajax({
                        url: 'api/searchSubCategoryApi.php',
                        type: 'POST',
                        data: {search_text: search_text},
                        success: function(data){
                            $('.sub-category-table').html(data);
                        }
                    });
                }
                
            });

            //  ****************************************************
            //      code  for exporting orders in excel
            //  ****************************************************
            $(document).on("click", ".export-button", function(e){
                let timestamp = new Date().getTime();
                
                let sort_by=$('input[name="sort-by"]:checked').val();

                let payment_method = [];
                let delivery_status = [];

                let from_date=$('#from').val();
                let to_date=$('#to').val();

                $('input[name="delivery-status[]"]:checked').each(function() {
                    delivery_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'api/exportOrdersInExcelApi.php',
                    type: 'POST',
                    data: { sort_by: sort_by, payment_method: payment_method, delivery_status: delivery_status, from_date: from_date, to_date: to_date}, 
                    success: function(data, status, xhr) {
                        // console.log(data);
                        console.log(delivery_status, payment_method, sort_by);
                        let filename = "Orders_"+timestamp+".xls"; // Specify the desired filename here
                        let contentType = xhr.getResponseHeader('Content-Type');

                        // Create a Blob from the response data
                        let blob = new Blob([data], { type: contentType });

                        // Create a temporary anchor element and download the file
                        let link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = filename;
                        link.click();

                    }
                });
            });

            

            // ---------------------------------------------------------------------
            // ------------------------ code end for order tab ---------------------
            // ---------------------------------------------------------------------

            // ---------------------------------------------------------------------
            // -------------------- code start for product tab ---------------------
            // ---------------------------------------------------------------------

            // code for view product tab 
            $(document).on('click', '#view-product-tab', function(e){
                e.preventDefault();
                $("#search-bar").attr('data-search-for', 'product');
                console.log('view products tab clicked');
                loadProducts();
            });

            //code for view product in pop up
            $(document).on('click', '.view-product-btn', function(e){
                e.preventDefault();
                let product_id=$(this).data('product-id');
                console.log('View product: ', product_id);
                
                $.ajax({
                    url: 'api/viewProductDetailsApi.php',
                    type: 'POST',
                    data: {product_id: product_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // code for user click on delete product  button 
            $(document).on('click', '.delete-product-btn', function(e){
                e.preventDefault();
                let product_id=$(this).data('product-id');
                console.log('View product: ', product_id);
                if(confirm('You realy want to delete the product'))
                {
                    $.ajax({
                        url: 'api/deleteProductApi.php',
                        type: 'POST',
                        data: {product_id: product_id},
                        success: function(data){
                            if(data==0)
                            {
                                console.log('couldn\'t delete the product ');
                                errorMsg("Couldn't Delete The Product ");
                            }
                            else if(data==1)
                            {
                                console.log('product deleted successfully');
                                loadProducts();
                                successMsg('Product Deleted Sucessfully');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for add product form in pop up
            $(document).on('click', '#add-product-tab', function(e){
                e.preventDefault();
                console.log('add product tab clicked');
                
                $.ajax({
                    url: 'api/addProductFormApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });


            // code for when click on add specificaton field button it wwill add one specification field with name and value
            $(document).on("click", ".add-specification-field-btn", function(e){
                e.preventDefault();
                console.log("specification added ");


                let specificationField=`
                    <div class="row">
                        <div class="col form-group">
                            <input type="text" class="form-control input-flat" placeholder="Name" name="product-specification-name[]">
                        </div>
                        <div class="col form-group">
                            <input type="text" class="form-control input-flat" placeholder="value" name="product-specification-value[]">
                        </div>
                    </div>
                `;

                $(".specification-container").append(specificationField);
            });

            // code for on change on category dropdown and it will add sub-category in add product form
            $(document).on("change", "#product-category", function(e){
                let category_id=$("#product-category").val();
                console.log("change  detected", category_id);
                if(category_id=='')
                {
                    $('#product-sub-category').html(`
                        <option value="">Select Sub Category</option>
                    `);
                }
                else
                {
                    $.ajax({
                        url: "api/loadSubCategoryForDropDownApi.php",
                        type: "POST",
                        data: {category_id: category_id},
                        success: function(data){
                            $('#product-sub-category').html(data);
                        }
                    });
                }
            });



            // when click on add product  btn
            $(document).on("click", "#add-product-submit-btn", function(e){
                e.preventDefault();
                console.log("add clicked");
                let product_name=$("#product-name").val();
                let product_base_price=Number($("#product-base-price").val());
                let product_price=Number($("#product-price").val());
                let product_category=$("#product-category").val();
                let product_sub_category=$("#product-sub-category").val();
                let product_main_image=$("#product-main-image")[0].files[0];
                let product_other_image=$("#product-other-image")[0].files;
                let product_desc=$("#product-desc").val();
                let product_quantity=Number($("#product-quantity").val());
                // let number_of_specification=$("#number-of-specification").val();

                let specification_names = $("input[name='product-specification-name[]']").map(function() {
                    return $(this).val().trim();
                }).get();

                let specification_values = $("input[name='product-specification-value[]']").map(function() {
                    return $(this).val().trim();
                }).get();
                
                if(product_name=='')
                {
                    warningMsg("Please Enter Product Name");
                }
                else if(product_category=='')
                {
                    warningMsg("Please Select Category");
                }
                else if(product_sub_category=='')
                {
                    warningMsg("Please Select Sub Category");
                }
                else if(product_base_price=='')
                {
                    warningMsg("Please Enter Base Price");
                }
                else if(!isValidNumber(product_base_price))
                {
                    warningMsg("Please Enter Valid Base Price");
                }
                else if(product_price=='')
                {
                    warningMsg("Please Enter Price");
                }
                else if(!isValidNumber(product_price))
                {
                    warningMsg("Please Enter Valid Price");
                }
                else if(product_base_price<product_price)
                {
                    warningMsg("Main Price Must be Less Than or Equal to Base price");
                }
                else if(!product_main_image)
                {
                    warningMsg("Please Select Main Image");
                }
                else if(!validateFile(product_main_image))
                {
                    warningMsg("Please Select Valid Main Image");
                }
                else if(product_other_image.length<1)
                {
                    warningMsg("Please Select Other Product Image");
                }
                else if(!validateMultipleFile(product_other_image))
                {
                    warningMsg("Please Select Valid Other Product Image");
                }
                else if(product_quantity=='')
                {
                    warningMsg("Please Enter Quantity");
                }
                else if(!isValidNumber(product_quantity))
                {
                    warningMsg("Please Enter Valid Quantity");
                }
                else if(product_desc=='')
                {
                    warningMsg("Please Enter Product Description");
                }
                
                else
                {
                    // $('#myform')[0]
                    console.log(product_name, product_price, product_base_price, product_category, product_sub_category, product_main_image, product_other_image, product_quantity, product_desc, specification_names, specification_values);

                    // for (let i = 1; i <= number_of_specification; i++) {
                    //     console.log($(`#product-specification-name-${i}`).val(), $(`#product-specification-value-${i}`).val());
                    // }
                    
                    let formData = new FormData();
                    formData.append("product_name", product_name);
                    formData.append("product_price", product_price);
                    formData.append("product_base_price", product_base_price);
                    formData.append("product_quantity", product_quantity);
                    formData.append("product_category", product_category);
                    formData.append("product_sub_category", product_sub_category);
                    formData.append("product_main_image", product_main_image);
                    
                    for (let i = 0; i < product_other_image.length; i++) {
                        formData.append("product_other_image[]", product_other_image[i]);
                    }
                    formData.append("product_desc", product_desc);

                    formData.append("specification_names", specification_names);
                    formData.append("specification_values", specification_values);

                    // $.each(specification_names, function(e, val){
                    //     console.log("hii this si s"+val)
                    // })
                    
                    // formData.append("number_of_specification", number_of_specification);
                    
                    // for (let i = 1; i <= number_of_specification; i++) {
                    //     formData.append(`product_specification_name_${i}`, $(`#product-specification-name-${i}`).val());
                    //     formData.append(`product_specification_value_${i}`, $(`#product-specification-value-${i}`).val());
                    // }

                    $("#add-product-submit-btn").html('Saving...');
                    $("#add-product-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/addProductApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#add-product-submit-btn").html('Add Product');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Add Product Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    `);
                                    console.log('Failed to Add product');
                                }
                                else if(data==1)
                                {
                                    $("#add-product-submit-btn").html('Add Product');
                                    loadProducts();
                                    $('.modal-dialog').html(`
                                    <div class="modal-content">
                                    <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Product Added Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('product added');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }

            });

            //code for update product from in pop up
            $(document).on('click', '.update-product-btn', function(e){
                e.preventDefault();
                let product_id=$(this).data('product-id');
                console.log('View product: ', product_id);
                
                $.ajax({
                    url: 'api/updateProductFormApi.php',
                    type: 'POST',
                    data: {product_id: product_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });


            //code for when click on delete btn on update product popup
            $(document).on('click', '.image-delete-btn', function(e){
                e.preventDefault();
                let image_id=$(this).data('image-id');
                let product_id=$(this).data('product-id');
                console.log('delete image : ', image_id, 'for product ', product_id);
                
                $.ajax({
                    url: 'api/deleteProductImageApi.php',
                    type: 'POST',
                    data: {image_id: image_id},
                    success: function(data){
                        if(data==1) {

                            $.ajax({
                                url: 'api/loadProductImageApi.php',
                                type: 'POST',
                                data: {product_id: product_id},
                                success: function(data){
                                    $(".other-images-container").html(data)
                                }
                            });
                        } 
                        else if(data==0) {
                            console.log('couldn\'t delete the image');
                        }
                        else
                        {
                            console.log(data);
                        }
                    }
                });
            });


            // when click on save changes button for updating the entered details
            $(document).on("click", "#update-product-submit-btn", function(e){
                e.preventDefault();
                console.log("add clicked");
                let product_name=$("#product-name").val();
                let product_base_price=Number($("#product-base-price").val());
                let product_price=Number($("#product-price").val());
                let product_quantity=Number($("#product-quantity").val());
                let product_category=$("#product-category").val();
                let product_sub_category=$("#product-sub-category").val();
                let product_main_image=$("#product-main-image")[0].files[0];
                let product_other_image=$("#product-other-image")[0].files;
                let product_desc=$("#product-desc").val();
                // let number_of_specification=$("#number-of-specification").val();
                let existing_product_image_path=$("#existing-product-image-path").val();
                let product_id=$(this).data('product-id');

                let specification_id = $("input[name='product-specification-id[]']").map(function() {
                    return $(this).val().trim();
                }).get();

                let specification_names = $("input[name='product-specification-name[]']").map(function() {
                    return $(this).val().trim();
                }).get();

                let specification_values = $("input[name='product-specification-value[]']").map(function() {
                    return $(this).val().trim();
                }).get();
                
                if(product_id=='')
                {
                    errorMsg("Something Went Wrong, Please Refresh the Page");
                }
                else if(product_name=='')
                {
                    warningMsg("Please Enter Product Name");
                }
                else if(product_category=='')
                {
                    warningMsg("Please Select Category");
                }
                else if(product_sub_category=='')
                {
                    warningMsg("Please Select Sub Category");
                }
                else if(product_base_price=='')
                {
                    warningMsg("Please Enter Base Price");
                }
                else if(!isValidNumber(product_base_price))
                {
                    warningMsg("Please Enter Valid Base Price");
                }
                else if(product_price=='')
                {
                    warningMsg("Please Enter Price");
                }
                else if(!isValidNumber(product_price))
                {
                    warningMsg("Please Enter Valid Price");
                }
                else if(product_base_price<product_price)
                {
                    warningMsg("Main Price Must be Less Than or Equal to Base price");
                }
                else if(product_main_image && !validateFile(product_main_image))
                {
                    warningMsg("Please Select Valid Main Image");
                }

                else if(product_other_image.length>0 && !validateMultipleFile(product_other_image))
                {
                    warningMsg("Please Select Valid Other Product Image");
                }
                else if(product_quantity=='')
                {
                    warningMsg("Please Enter Quantity");
                }
                else if(!isValidNumber(product_quantity))
                {
                    warningMsg("Please Enter Valid Quantity");
                }
                else if(product_desc=='')
                {
                    warningMsg("Please Enter Product Description");
                }
                else
                {
                    // $('#myform')[0]
                    console.log(product_name, product_price, product_base_price, product_category, product_sub_category, product_main_image, product_other_image, product_quantity, product_desc);

                    // for (let i = 1; i <= number_of_specification; i++) {
                    //     console.log($(`#product-specification-name-${i}`).val(), $(`#product-specification-value-${i}`).val());
                    // }
                    
                    let formData = new FormData();
                    formData.append("product_id", product_id);
                    formData.append("product_name", product_name);
                    formData.append("product_base_price", product_base_price);
                    formData.append("product_price", product_price);
                    formData.append("product_quantity", product_quantity);
                    formData.append("product_category", product_category);
                    formData.append("product_sub_category", product_sub_category);
                    formData.append("product_main_image", product_main_image);
                    
                    for (let i = 0; i < product_other_image.length; i++) {
                        formData.append("product_other_image[]", product_other_image[i]);
                    }
                    formData.append("product_desc", product_desc);
                    // formData.append("number_of_specification", number_of_specification);
                    formData.append("existing_product_image_path", existing_product_image_path);

                    formData.append("specification_id", specification_id);
                    formData.append("specification_names", specification_names);
                    formData.append("specification_values", specification_values);
                    
                    // for (let i = 1; i <= number_of_specification; i++) {
                    //     formData.append(`product_specification_id_${i}`, $(`#product-specification-id-${i}`).val());
                    //     formData.append(`product_specification_name_${i}`, $(`#product-specification-name-${i}`).val());
                    //     formData.append(`product_specification_value_${i}`, $(`#product-specification-value-${i}`).val());
                    // }
                    $("update-product-submit-btn").html('Saving...');
                    $("update-product-submit-btn").attr('disabled', 'true');
                    $.ajax({
                        url: "api/updateProductApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("update-product-submit-btn").html('Save Changes');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Update Product Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    `);
                                    console.log('Failed to Add product');
                                }
                                else if(data==1)
                                {
                                    $("update-product-submit-btn").html('Save Changes');
                                    loadProducts();
                                    loadOutOfStockNotificationCount();
                                    $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Product Updated Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('product added');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }

            });

            // ---------------------------------------------------------------------
            // ---------------------- code end for product tab ---------------------
            // ---------------------------------------------------------------------

            // ---------------------------------------------------------------------
            // ---------------------- code start for category tab ---------------------
            // ---------------------------------------------------------------------

            // code for view category tab 
            $(document).on('click', '#view-category-tab', function(e){
                e.preventDefault();
                $("#search-bar").attr('data-search-for', 'category');
                console.log('view products tab clicked');
                loadCategory();
            });


            //code for view category in pop up
            $(document).on('click', '.view-category-btn', function(e){
                e.preventDefault();
                let category_id=$(this).data('category-id');
                console.log('View category: ', category_id);
                
                $.ajax({
                    url: 'api/viewCategoryDetailsApi.php',
                    type: 'POST',
                    data: {category_id: category_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // code for user click on delete category button 
            $(document).on('click', '.delete-category-btn', function(e){
                e.preventDefault();
                let category_id=$(this).data('category-id');
                console.log('delete category click : ', category_id);
                if(confirm('You realy want to delete the Category'))
                {
                    $.ajax({
                        url: 'api/deleteCategoryApi.php',
                        type: 'POST',
                        data: {category_id: category_id},
                        success: function(data){
                            if(data==0)
                            {
                                console.log('couldn\'t delete the category');
                                errorMsg("Couldn't Delete The Category");
                            }
                            else if(data==1)
                            {
                                console.log('Category deleted successfully');
                                loadCategory();
                                successMsg('Category Deleted Successfully');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for add category form in pop up
            $(document).on('click', '#add-category-tab', function(e){
                e.preventDefault();
                console.log('add category tab clicked');
                
                $.ajax({
                    url: 'api/addCategoryFormApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });


            // when click on add category  btn
            $(document).on("click", "#add-category-submit-btn", function(e){
                e.preventDefault();
                console.log("add category clicked");
                let category_name=$("#category-name").val();
                let category_image=$("#category-image")[0].files[0];

                if(category_name==''){
                    warningMsg("Please Enter Category Name");
                }
                else if(!category_image){
                    warningMsg("Please Select Image");
                }
                else if(!validateFile(category_image)){
                    warningMsg("Please Select Valid Image");
                }
                else{
                    // $('#myform')[0]
                    console.log(category_name, category_image);
                    
                    let formData = new FormData();
                    formData.append("category_name", category_name);
                    formData.append("category_image", category_image);
                    

                    $("#add-category-submit-btn").html('Saving...');
                    $("#add-category-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/addCategoryApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#add-category-submit-btn").html('Add Category');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Add Category Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    `);
                                    console.log('Failed to Add product');
                                }
                                else if(data==1)
                                {
                                    $("#add-category-submit-btn").html('Add Category');
                                    loadCategory();
                                    $('.modal-dialog').html(`
                                    <div class="modal-content">
                                    <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Category Added Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('category added');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for loading update category from in pop up
            $(document).on('click', '.update-category-btn', function(e){
                e.preventDefault();
                let category_id=$(this).data('category-id');
                console.log('View Category: ', category_id);
                
                $.ajax({
                    url: 'api/updateCategoryFormApi.php',
                    type: 'POST',
                    data: {category_id: category_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // when click on save changes button for updating the entered category details
            $(document).on("click", "#update-category-submit-btn", function(e){
                e.preventDefault();
                console.log("add clicked");
                let category_name=$("#category-name").val();
                let category_id=$("#category-id").val();
                let existing_category_image=$("#existing-category-image").val();
                let category_image=$("#category-image")[0].files[0];
                
                if(category_id==''){
                    errorMsg("Something Went Wrong, Please Refresh The Page");
                }
                else if(category_name==''){
                    warningMsg("Please Enter Category Name");
                }
                else if(category_image && !validateFile(category_image)){
                    warningMsg("Please Select Valid Image");
                }
                else
                {
                    console.log(category_name, category_image);
                    
                    let formData = new FormData();
                    formData.append("category_name", category_name);
                    formData.append("category_image", category_image);
                    formData.append("category_id", category_id);
                    formData.append("existing_category_image", existing_category_image);

                    $("#add-category-submit-btn").html('Saving...');
                    $("#add-category-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/updateCategoryApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#update-category-submit-btn").html('Save Changes');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Update Category, Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('Failed to update Category');
                            }
                            else if(data==1)
                            {
                                $("update-category-submit-btn").html('Save Changes');
                                loadCategory();
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Category Updated Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('Category Updated');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });


            // ---------------------------------------------------------------------
            // ---------------------- code end for category tab --------------------
            // ---------------------------------------------------------------------

            // ---------------------------------------------------------------------
            // ---------------------- code start for banners tab ---------------------
            // ---------------------------------------------------------------------

            // code for view Banner tab 
            $(document).on('click', '#view-banner-tab', function(e){
                e.preventDefault();
                $("#search-bar").attr('data-search-for', 'banner');
                console.log('view banner tab clicked');
                loadBanner();
            });


            //code for view banner in pop up
            $(document).on('click', '.view-banner-btn', function(e){
                e.preventDefault();
                let banner_id=$(this).data('banner-id');
                console.log('View banner: ', banner_id);
                
                $.ajax({
                    url: 'api/viewBannerDetailsApi.php',
                    type: 'POST',
                    data: {banner_id: banner_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // code for user click on delete banner button 
            $(document).on('click', '.delete-banner-btn', function(e){
                e.preventDefault();
                let banner_id=$(this).data('banner-id');
                console.log('delete banner click : ', banner_id);
                if(confirm('You realy want to delete the Banner'))
                {
                    $.ajax({
                        url: 'api/deleteBannerApi.php',
                        type: 'POST',
                        data: {banner_id: banner_id},
                        success: function(data){
                            if(data==0)
                            {
                                console.log('couldn\'t delete the banner');
                                errorMsg("Couldn't Delete The Banner");
                            }
                            else if(data==1)
                            {
                                console.log('Banner deleted successfully');
                                loadBanner();
                                successMsg('Banner Deleted Successfully');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for add Banner form in pop up
            $(document).on('click', '#add-banner-tab', function(e){
                e.preventDefault();
                console.log('add banner tab clicked');
                
                $.ajax({
                    url: 'api/addBannerFormApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });


            // when click on add Banner  btn
            $(document).on("click", "#add-banner-submit-btn", function(e){
                e.preventDefault();
                console.log("add Banner clicked");
                let banner_name=$("#banner-name").val();
                let banner_image=$("#banner-image")[0].files[0];

                if(banner_name==''){
                    warningMsg("Please Enter Banner Name");
                }
                else if(!banner_image){
                    warningMsg("Please Select Image");
                }
                else if(!validateFile(banner_image)){
                    warningMsg("Please Select Valid Image");
                }
                else{
                    // $('#myform')[0]
                    console.log(banner_name, banner_image);
                    
                    let formData = new FormData();
                    formData.append("banner_name", banner_name);
                    formData.append("banner_image", banner_image);
                    

                    $("#add-banner-submit-btn").html('Saving...');
                    $("#add-banner-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/addBannerApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#add-banner-submit-btn").html('Add Banner');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Add Banner Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    `);
                                    console.log('Failed to Add Banner');
                                }
                                else if(data==1)
                                {
                                    $("#add-banner-submit-btn").html('Add Banner');
                                    loadBanner();
                                    $('.modal-dialog').html(`
                                    <div class="modal-content">
                                    <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Banner Added Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('banner added');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for loading update banner from in pop up
            $(document).on('click', '.update-banner-btn', function(e){
                e.preventDefault();
                let banner_id=$(this).data('banner-id');
                console.log('View Banner: ', banner_id);
                
                $.ajax({
                    url: 'api/updateBannerFormApi.php',
                    type: 'POST',
                    data: {banner_id: banner_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // when click on save changes button for updating the entered Banner details
            $(document).on("click", "#update-banner-submit-btn", function(e){
                e.preventDefault();
                console.log("add clicked");
                let banner_name=$("#banner-name").val();
                let banner_id=$("#banner-id").val();
                let existing_banner_image=$("#existing-banner-image").val();
                let banner_image=$("#banner-image")[0].files[0];
                
                if(banner_id==''){
                    errorMsg("Something Went Wrong, Please Refresh The Page");
                }
                else if(banner_name==''){
                    warningMsg("Please Enter Banner Name");
                }
                else if(banner_image && !validateFile(banner_image)){
                    warningMsg("Please Select Valid Image");
                }
                else
                {
                    console.log(banner_name, banner_image);
                    
                    let formData = new FormData();
                    formData.append("banner_name", banner_name);
                    formData.append("banner_image", banner_image);
                    formData.append("banner_id", banner_id);
                    formData.append("existing_banner_image", existing_banner_image);

                    $("#add-banner-submit-btn").html('Saving...');
                    $("#add-banner-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/updateBannerApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#update-banner-submit-btn").html('Save Changes');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Update Banner, Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('Failed to update banner');
                            }
                            else if(data==1)
                            {
                                $("update-banner-submit-btn").html('Save Changes');
                                loadBanner();
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Banner Updated Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('Banner Updated');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });


            // ---------------------------------------------------------------------
            // ---------------------- code end for banner tab --------------------
            // ---------------------------------------------------------------------

            // ---------------------------------------------------------------------
            // ------------------ code start for sub-category tab ------------------
            // ---------------------------------------------------------------------

            // code for view sub-category tab 
            $(document).on('click', '#view-sub-category-tab', function(e){
                e.preventDefault();
                $("#search-bar").attr('data-search-for', 'sub-category');
                console.log('view sub category tab clicked');
                loadSubCategory();
            });

            //code for view sub category in pop up
            $(document).on('click', '.view-sub-category-btn', function(e){
                e.preventDefault();
                let sub_category_id=$(this).data('sub-category-id');
                console.log('View sub category: ', sub_category_id);
                
                $.ajax({
                    url: 'api/viewSubCategoryDetailsApi.php',
                    type: 'POST',
                    data: {sub_category_id: sub_category_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // code for user click on delete sub category button 
            $(document).on('click', '.delete-sub-category-btn', function(e){
                e.preventDefault();
                let sub_category_id=$(this).data('sub-category-id');
                console.log('delete category click : ', sub_category_id);
                if(confirm('You realy want to delete the Category'))
                {
                    $.ajax({
                        url: 'api/deleteSubCategoryApi.php',
                        type: 'POST',
                        data: {sub_category_id: sub_category_id},
                        success: function(data){
                            if(data==0)
                            {
                                console.log('couldn\'t delete the sub category');
                                errorMsg("Couldn't Delete The Sub Category");
                            }
                            else if(data==1)
                            {
                                console.log('Sub Category deleted successfully');
                                loadSubCategory();
                                successMsg('Sub Category Deleted Successfully');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for add sub category form in pop up
            $(document).on('click', '#add-sub-category-tab', function(e){
                e.preventDefault();
                console.log('add sub category tab clicked');
                
                $.ajax({
                    url: 'api/addSubCategoryFormApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // when click on add sub category  btn
            $(document).on("click", "#add-sub-category-submit-btn", function(e){
                e.preventDefault();
                console.log("add sub category clicked");
                let category_id=$("#product-category").val();
                let sub_category_name=$("#sub-category-name").val();
                let sub_category_image=$("#sub-category-image")[0].files[0];

                if(category_id==''){
                    warningMsg("Please Select Category");
                }
                else if(sub_category_name==''){
                    warningMsg("Please Enter Sub Category Name");
                }
                else if(!sub_category_image){
                    warningMsg("Please Select Image");
                }
                else if(!validateFile(sub_category_image)){
                    warningMsg("Please Select Valid Image");
                }
                else{
                    // $('#myform')[0]
                    console.log(category_id, sub_category_name, sub_category_image);
                    
                    let formData = new FormData();
                    formData.append("category_id", category_id);
                    formData.append("sub_category_name", sub_category_name);
                    formData.append("sub_category_image", sub_category_image);
                    

                    $("#add-sub-category-submit-btn").html('Saving...');
                    $("#add-sub-category-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/addSubCategoryApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#add-sub-category-submit-btn").html('Add Sub Category');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Add Sub Category Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    `);
                                    console.log('Failed to Add sub category');
                                }
                                else if(data==1)
                                {
                                    $("#add-category-submit-btn").html('Add Sub Category');
                                    loadSubCategory();
                                    $('.modal-dialog').html(`
                                    <div class="modal-content">
                                    <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Sub Category Added Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('sub category added');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for loading update sub category from in pop up
            $(document).on('click', '.update-sub-category-btn', function(e){
                e.preventDefault();
                let sub_category_id=$(this).data('sub-category-id');
                console.log('update sub Category: ', sub_category_id);
                
                $.ajax({
                    url: 'api/updateSubCategoryFormApi.php',
                    type: 'POST',
                    data: {sub_category_id: sub_category_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });




            // when click on save changes button for updating the entered sub category details
            $(document).on("click", "#update-sub-category-submit-btn", function(e){
                e.preventDefault();
                console.log("add clicked");
                
                let category_id=$("#product-category").val();
                let sub_category_id=$("#sub-category-id").val();
                let sub_category_name=$("#sub-category-name").val();

                let existing_sub_category_image=$("#existing-sub-category-image").val();
                let sub_category_image=$("#sub-category-image")[0].files[0];
                

                if(sub_category_id==''){
                    errorMsg("Something Went Wrong, Please Refresh the Page");
                }
                else if(category_id==''){
                    warningMsg("Please Select Category");
                }
                else if(sub_category_name==''){
                    warningMsg("Please Enter Sub Category Name");
                }
                else if(sub_category_image && !validateFile(sub_category_image)){
                    warningMsg("Please Select Valid Image");
                }
                else
                {
                    console.log(category_id, sub_category_name);
                    
                    let formData = new FormData();
                    formData.append("category_id", category_id);
                    formData.append("sub_category_id", sub_category_id);
                    formData.append("sub_category_name", sub_category_name);
                    formData.append("existing_sub_category_image", existing_sub_category_image);
                    formData.append("sub_category_image", sub_category_image);

                    $("#update-sub-category-submit-btn").html('Saving...');
                    $("#update-sub-category-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/updateSubCategoryApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#update-sub-category-submit-btn").html('Save Changes');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Update Sub Category, Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('Failed to update sub Category');
                            }
                            else if(data==1)
                            {
                                $("#update-sub-category-submit-btn").html('Save Changes');
                                loadSubCategory();
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Sub Category Updated Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('sub Category Updated');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });


            // ---------------------------------------------------------------------
            // ------------------ code end for sub-category tab ------------------
            // ---------------------------------------------------------------------





// ------------------------------------------------------------------------------
// ----------------------- function coding area --------------------------------- 
// ------------------------------------------------------------------------------
            // function for loading the Orders 
            function loadOrders()
            {
                $.ajax({
                    url: 'api/loadOrdersApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.fluid-container').html(data);
                    }
                });
            }

            // function for loading the out of stock  
            function loadOutOfStock()
            {
                $.ajax({
                    url: 'api/loadOutOfStockApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.fluid-container').html(data);
                    }
                });
            }

            // function for loading the Product 
            function loadProducts()
            {
                $.ajax({
                    url: 'api/loadProductsApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.fluid-container').html(data);
                    }
                });
            }

            // function for loading the Category  
            function loadCategory()
            {
                $.ajax({
                    url: 'api/loadCategoryApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.fluid-container').html(data);
                    }
                });
            }

            // function for loading the Category  
            function loadBanner()
            {
                $.ajax({
                    url: 'api/loadBannerApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.fluid-container').html(data);
                    }
                });
            }

            // function for loading the Category  
            function loadSubCategory()
            {
                $.ajax({
                    url: 'api/loadSubCategoryApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.fluid-container').html(data);
                    }
                });
            }

            // function for validating the file wheather it is valid file or not 
            function validateFile(file) {
                // Check file type (for example, allow only images)
                var allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp", "image/bmp", "image/tiff", "image/jpg"];
                if (!allowedTypes.includes(file.type)) {
                    return false;
                }
                // Check file size (for example, limit it to 2MB)
                var maxSizeMB = 5;
                var maxSizeBytes = maxSizeMB * 1024 * 1024;
                if (file.size > maxSizeBytes) {
                    return false;
                }
                // Additional checks can be added here as needed.
                return true;
            }

            // function for validating the file wheather it is valid file or not 
            function validateMultipleFile(files) {
                // Check file type (for example, allow only images)
                var allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp", "image/bmp", "image/tiff", "image/jpg"];

                for (let i = 0; i < files.length; i++) {
                    
                    if (!allowedTypes.includes(files[i].type)) {
                        return false;
                    }
                    // Check file size (for example, limit it to 5MB)
                    var maxSizeMB = 5;
                    var maxSizeBytes = maxSizeMB * 1024 * 1024;
                    if (files[i].size > maxSizeBytes) {
                        return false;
                    }
                    
                }
                return true;
            }
    
            // function for validate the name 
            function validateName(name) {
                // Regular expression to check if the name contains any numbers
                const regex = /\d/;
                if (regex.test(name)) {
                    // Name contains a number, so it is not valid
                    return false;
                }
                // Name does not contain any numbers, so it is valid
                return true;
            }
    
            //finction to validate the num,ber
            function isValidNumber(str) {
                // Regular expression to match a number (integer or decimal)
                // var numberPattern = /@[-+]?\d+(\.\d+)?$/;
                var numberPattern = /^[1-9]\d*$/;
                return numberPattern.test(str);
            }

            // code for sucess toast 
            function successMsg(msg)
            {
                toastr.success(msg, "Success", {
                    positionClass: "toast-top-center",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                });
            }

            // code for error toast 
            function errorMsg(msg)
            {
                toastr.error(msg, "Error", {
                    positionClass: "toast-top-center",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                });
            }

            // code for warning toast 
            function warningMsg(msg)
            {
                toastr.warning(msg, "Warning", {
                    positionClass: "toast-top-center",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                });
            }

            
            // function for loading the orders count
            function loadOrdersCount()
            {
                $.ajax({
                    url: 'api/loadOrdersCountApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.orders-count').html(data);
                    }
                });
            }

            // function for loading the products count
            function loadOutOfStockNotificationCount()
            {
                $.ajax({
                    url: 'api/loadOutOfStockNotificationCountApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.out-of-stock-notification-count').html(data);
                    }
                });
            }

            // function for loading the out of stock count
            function loadOutOfStockCount()
            {
                $.ajax({
                    url: 'api/loadOutOfStockCountApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.out-of-stock-count').html(data);
                    }
                });
            }

            // function for loading the products count
            function loadProductsCount()
            {
                $.ajax({
                    url: 'api/loadProductsCountApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.products-count').html(data);
                    }
                });
            }

            // function for loading the category count
            function loadCategoryCount()
            {
                $.ajax({
                    url: 'api/loadCategoryCountApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.category-count').html(data);
                    }
                });
            }

            // function for loading the sub-category count
            function loadSubCategoryCount()
            {
                $.ajax({
                    url: 'api/loadSubCategoryCountApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.sub-category-count').html(data);
                    }
                });
            }

            // function for loading the Banner count
            function loadBannerCount()
            {
                $.ajax({
                    url: 'api/loadBannerCountApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.banner-count').html(data);
                    }
                });
            }

        });

    
    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
            ['Order Status', 'Count'],
            ['Order Placed',  <?php echo mysqli_num_rows($result_op) ?>],
            ['Order Confirmed',      <?php echo mysqli_num_rows($result_oc) ?>],
            ['Shipped',  <?php echo mysqli_num_rows($result_s) ?>],
            ['Out for Delevery', <?php echo mysqli_num_rows($result_ofd) ?>],
            ['delivered',    <?php echo mysqli_num_rows($result_d) ?>],
            ['canceled',    <?php echo mysqli_num_rows($result_c) ?>]
            ]);

            var options = {
                title: '',
                width: '100%',
                height: '300',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('delivery-pie-chart-for-1-month'));

            chart.draw(data, options);
           
        }
    </script>
    

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
            ['Order Status', 'Count'],
            ['Order Placed',  <?php echo mysqli_num_rows($result_opy) ?>],
            ['Order Confirmed',      <?php echo mysqli_num_rows($result_ocy) ?>],
            ['Shipped',  <?php echo mysqli_num_rows($result_sy) ?>],
            ['Out for Delevery', <?php echo mysqli_num_rows($result_ofdy) ?>],
            ['delivered',    <?php echo mysqli_num_rows($result_dy) ?>],
            ['canceled',    <?php echo mysqli_num_rows($result_cy) ?>]
            ]);

            var options = {
                title: '',
                width: '100%',
                height: '300',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('delivery-pie-chart-for-1-year'));

            chart.draw(data, options);
        }
    </script>

</body>

</html>