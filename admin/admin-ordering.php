<!--Browser Icon-->
<link rel="icon" type="image/x-icon" href="images/Logos/ILAW_Logo.png">

<?php
include('database_connection.php');
include('../function.php');
$active = "Customers";
include('header.php');
include('sidebar.php');
$email = $_SESSION['email'];
$sql = "SELECT * FROM user_details WHERE user_email = '$email' ";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);
$userid = $user['user_id'];
$transaction = get_invoice_no($connect);
?>

<!--Main Content-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="pt-2"><strong>Admin Ordering</strong></h5>
        </ol>
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item" aria-current="page"><a href="customers.php">Customers</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a>Admin Ordering</a></li>
        </ol>
    </nav>
    <span id="alert_action"></span>
    <form method="post" id="order_form">
        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">

            <div class="form-group">
                <label name="transaction_id"><b>Transaction ID:</b> <?php echo $transaction ?></label>
                <input type="hidden" id="puser" class="puser" name="transaction_id" value="<?php echo $transaction ?>">
                <?php date_default_timezone_set('Asia/Manila'); ?>
                <input type="hidden" name="time" id="time" value="<?php echo date("M d, Y h:i a"); ?>">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><b>Enter Receiver Name:</b></label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Name" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><b>Enter Customer ID:</b></label>
                        <input type="text" name="customer_id" id="customer_id" class="form-control" value="<?php echo $userid ?>" readonly />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Enter Contact Number:</b></label>
                        <input type="number" name="customer_no" id="customer_no" class="form-control" placeholder="09*********" min="0" required />
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label><b>Enter Receiver Address:</b></label>
                        <textarea name="order_address" style="resize:none;" id="order_address" class="form-control" placeholder="Blk/Lot/Street/Barangay" height="10px" required></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label><b>Region</b></label>
                        <select class="form-control" id="region" name="region" style="cursor: pointer;">
                            <option value="">--- Select Region ---</option>
                            <?php
                            $query = mysqli_query($con, "select * from table_region");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <option value="<?php echo $row['region_id']; ?>"> <?php echo $row['region_name']; ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><b>Province</b></label>
                        <select class="form-control" id="province" name="province" style="cursor: pointer;" required>
                            <option value="">--- Select Province ---</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><b>City/ Municipality</b></label>
                        <select class="form-control" id="city" name="city" style="cursor: pointer;" required>
                            <option value="">--- Select City ---</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><b>ZIP Code</b></label>
                        <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="ZIP Code" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label><b>Enter Courier:</b></label>
                    <select name="courier" style="cursor:pointer" id="courier" class=" form-control" required>;
                        <option value="">--- Select Courier ---</option>;
                        <?php echo fill_courier_price($connect) ?>;
                    </select>
                </div>
                <!-- <div class="col-md-2">
                    <label><b>Courier Fee:</b></label>
                    <input class="form-control" type='text' id='fee' name='fee' readonly />
                </div> -->
                <div class="col-md-4">
                    <label><b>Courier Fee:</b></label>
                    <!-- <td><input class="form-control" type='text' id='fee' name='fee' readonly /></td> -->
                    <input type="hidden" class="form-control subtotal" type='text' id='fee' name='fee' value="0" readonly />
                    <input class="form-control subtotal" type='text' id='showfee' name='showfee' value="₱0" readonly />
                </div>
                <div class="col-md-4">
                    <label><b>Grand Total</b></label>
                    <input type="hidden" id='total' name='total' value="0" readonly />
                    <input class="form-control subtotal" type='text' id='totalview' name='totalview' value="₱0" readonly />
                </div>
            </div>
        </div>

        <div class="container" id="product">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="table-responsive mt-2">
                        <div id="message"></div>
                        <table class="table table-bordered table-striped text-center" id="refresh">
                            <thead>
                                <tr>
                                    <td colspan="7">
                                        <h6 style="color:orange">ILAW Lighting and Equipment Trading <i class="fa fa-lightbulb-o" aria-hidden="true"></i></h6>
                                    </td>
                                </tr>
                                <tr>
                                    <th><b>PRODUCT</b></th>
                                    <th><b>PRICE</b></th>
                                    <th><b>QUANTITY</b></th>
                                    <th><b>TOTAL PRICE</b></th>
                                    <th>
                                        <!-- <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a> -->
                                        <input type="hidden" name="action" id="action" value="all" />
                                        <!-- <button class="btn btn-info btn-block clear" id="clear" name="clear"><i class="bi bi-eraser"></i>Clear All</button> -->
                                        <a type="button" class="btn btn-danger p-1 mr-3 text-white btn-block clear" id="clear" name="clear"><i class="fa fa-trash" title="Remove all items"></i> Delete All</a>
                                    </th>
                                </tr>
                            </thead>
                            <?php
                            // OUT PUT TABLE
                            $stmt = $con->prepare('SELECT * FROM admin_cart');
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $grand_total = 0;
                            $x = 0;
                            while ($row = $result->fetch_assoc()) :
                                $x++;
                                echo '
                                <input type="hidden" name="prod_id[]"  id="prod_id' . $x . '"  value="' . $row["product_id"] . '">
                                <input type="hidden" name="product_name[]"  id="product_name' . $x . '"  value="' . $row["product_name"] . '">
                                <input type="hidden" name="unit[]"  id="unit' . $x . '"  value="' . $row["unit"] . '">
                                <input type="hidden" name="product_price[]" id="items_price' . $x . '" value="' . $row["price"] . '">
                                <input type="hidden" name="quantity[]" id="quantity' . $x . '" value="' . $row["quantity"] . '">
                                <input type="hidden" class= "total_cost" name="total_cost[]" id="total' . $x . '" value="' . $row["total"] . '">
                    
							';
                            ?>
                                <tr>
                                    <input type="hidden" id="pid" class="pid" value="<?= $row['product_id'] ?>">
                                    <td><?= $row['product_name'] ?></td>
                                    <td>₱<?= number_format($row['price'], 2); ?>
                                    </td>
                                    <input type="hidden" class="pprice" value="<?= $row['price'] ?>">
                                    <td>
                                        <input type="number" class="form-control itemQty" value="<?= $row['quantity'] ?>" style="width:75px;" readonly>
                                        <input type="hidden" class="form-control totalFetch" value="<?= $row['total'] ?>" style="width:75px;" readonly>
                                    </td>
                                    <td>₱<?= number_format($row['total'], 2); ?></td>
                                    <td>
                                        <!-- <a href="action.php?remove= class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fa fa-trash"></i></a> -->
                                        <input type="hidden" name="product_id" id="product_id" value="<?php echo $row['product_id'] ?>" />
                                        <a class="btn btn-danger p-1  text-white delete" name="delete"><i class="fa fa-trash white"></i> Delete</a>
                                    </td>
                                </tr>
                                <?php $grand_total += $row['total']; ?>
                            <?php endwhile; ?>


                            <tr>
                                <td colspan="2">
                                    <i class="fa fa-shopping-cart" style="font-size:25px"></i>
                                </td>
                                <td colspan="2" class="text-center text-success"><b>Products Added to Cart</b></td>
                                <input type="hidden" class="pcode" value="<?= $row['items_id'] ?>">
                                <td>
                                    <input type="hidden" name="btn_submit" id="btn_submit" value="Add" />
                                    <input type="submit" name="action" id="action" class="btn btn-success" />
                                </td>
                            </tr>
                            </tbody>
                        </table>
    </form>
</div>
</div>
</div>
<span id="alert_action"></span>
<!--Datatable-->
<div class="mb-3 p-3 button-container bg-white border shadow-sm">
    <div class="table-responsive">
        <table id="tableID" class="display table table-bordered table-hover w-100 table-sm" cellspacing="0">
            <thead>
                <tr>
                    <th class="print_border  text-center"><b>PRODUCT IMAGE</b></th>
                    <th class="print_border  text-center"><b>PRODUCT NAME</b></th>
                    <th class="print_border  text-center"><b>STOCKS</b></th>
                    <th class="print_border  text-center"><b>PRODUCT PRICE</b></th>
                    <th class="print_border text-center"><b>ACTION</b></th>

                </tr>
            </thead>
        </table>
    </div>
    <!--/Datatable-->
</div>
<div id="dataModal" class="modal fade">
    <div class="modal-dialog modal-md">
        <form method="post" id="quantity_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-list-alt"></i> Add Quantity</h4>
                </div>
                <center>
                    <div class="col-md-4 mt-2">
                        <input type="hidden" id="pid" class="pid">
                        <input type="hidden" id="pname" class="pname">
                        <input type="hidden" id="punit" class="punit">
                        <input type="hidden" id="pprice" class="pprice">
                        <input type="hidden" id="pcode" class="pcode">
                        <input type="hidden" id="pstock" class="pstock">
                        <label><b>Add Quantity:</b>
                            <input type="number" class="form-control" name="pqty" id="pqty" min="1" value="1" required>
                    </div>
                    <div class="modal-footer">
                        <input type="button" name="action" id="quantity" class="btn btn-info submit" value="Add" />
                        <input type="button" class="btn btn-danger btn-" data-dismiss="modal" value="Close">
                    </div>
            </div>
        </form>
    </div>
</div>
<!-- End of About Us -->
<?php
include("footer.php")
?>

</div>
<script>
    $(document).ready(function() {
        var clear = "all";
        var isPageBeingRefreshed = false;
        $(window).on('beforeunload', function() {

            isPageBeingRefreshed = true;
        });

        $.ajax({

            url: "action.php",
            method: "POST",
            data: {
                clear: clear,

            },
            success: function(data) {
                $("#refresh").load(location.href + " #refresh");
            }

        }).error(function() {

            if (!isPageBeingRefreshed) {

                // Displaying error message
            }
        });


        function get_filter_text(text_id) {
            var filterData = [];
            $('#' + text_id + ':checked').each(function() {
                filterData.push($(this).val());
            });
            return filterData;
        };



        //Ordering

        $(document).on('submit', '#order_form', function(event) {
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            $('#btn_action').val('Add');
            var form_data = $(this).serialize();

            Swal.fire({
                icon: 'question',
                title: 'Are you sure you want to submit this order?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "action.php",
                        method: "POST",
                        data: form_data,
                        dataType: "json",
                        success: function(data) {
                            // $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                            if (data.feedback == 'Product Cart is Empty') {
                                Swal.fire('Warning.', 'Product Cart is Empty !', 'warning')
                            } else {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Success.',
                                    text: 'Order Successfully Added !',
                                    type: 'success'
                                }).then(function() {
                                    location.href = "../admin/customers.php"
                                });
                            }

                        },
                    })
                }
            });
        });


        $("#courier").on('change', function() {
            var courier = $(this).val();
            $.ajax({
                method: "POST",
                url: "courier_amount.php",
                data: {
                    courier: courier
                },
                dataType: "json",
                success: function(data) {
                    $("#fee").val(data.courier_fee);
                    $("#showfee").val('₱' + data.courier_fee);
                    // var fee = $('#fee').val();
                    // var total = $('#total').val();
                    var subtotal = 0;
                    var fee = $('#fee').val();
                    $('.total_cost').each(function() {
                        subtotal += parseFloat($(this).val());
                    });
                    // var total = parseFloat(fee) + parseFloat(subtotal);

                    var output = parseFloat(fee) + parseFloat(subtotal)

                    $('#total').val(output);
                    $("#totalview").val('₱' + output);

                }

            });
        })

        $("#region").on('change', function() {
            var regionId = $(this).val();
            $.ajax({
                method: "POST",
                url: "../locajax.php",
                data: {
                    regionId: regionId
                },
                dataType: "html",
                success: function(data) {
                    $("#province").html(data);
                }

            });
        })

        $("#province").on('click', function() {
            var provinceId = $(this).val();
            $.ajax({
                method: "POST",
                url: "../locajax.php",
                data: {
                    provinceId: provinceId
                },
                dataType: "html",
                success: function(data) {
                    $("#city").html(data);
                }

            });
        })

        $("#province").on('change', function() {
            var provinceId = $(this).val();
            $.ajax({
                method: "POST",
                url: "../locajax.php",
                data: {
                    provinceId: provinceId
                },
                dataType: "html",
                success: function(data) {
                    $("#city").html(data);
                }

            });
        })





        $(".itemQty").on('change', function() {
            var $el = $(this).closest('tr');
            var pid = $el.find(".pid").val();
            var pprice = $el.find(".pprice").val();
            var qty = $el.find(".itemQty").val();
            // location.reload(true);
            $.ajax({
                url: 'action.php',
                method: 'post',
                cache: false,
                data: {
                    qty: qty,
                    pid: pid,
                    pprice: pprice
                },
                success: function(response) {
                    console.log(response);
                    // $("#total").load(location.href + " #total");
                }
            });
        });

        // Load total no.of items added in the cart and display in the navbar
        load_cart_item_number();

        function load_cart_item_number() {
            $.ajax({
                url: 'action.php',
                method: 'get',
                data: {
                    cartItem: "cart_item"
                },
                success: function(response) {
                    $("#cart-item").html(response);
                }
            });
        }


        $(document).on('click', '.addItemBtn', function() {
            $('#dataModal').modal('show');
            $('#quantity_form')[0].reset();
            var gpid = $(this).attr("id");
            $('#pid').val(gpid);
            var gpname = $(this).data("pname");
            $('#pname').val(gpname);
            var gpunit = $(this).data("punit");
            $('#punit').val(gpunit);
            var gpprice = $(this).data("pprice");
            $('#pprice').val(gpprice);
            var gpcode = $(this).data("pcode");
            $('#pcode').val(gpcode);
            var gpstock = $(this).data("pstock");
            $('#pstock').val(gpstock);
            $("#quantity").focus();

            // var pqty = $el.find(".pqty").val();

        });

        $('#pqty').keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault();
                $("#quantity").focus();
            }
        });


        $(document).on('click', '.submit', function() {
            var puser = $('#puser').val();
            var pid = $('#pid').val();
            var pname = $('#pname').val();
            var punit = $('#punit').val();
            var pprice = $('#pprice').val();
            var pstock = $('#pstock').val();
            var pqty = $('#pqty').val();
            var pcode = $('#pcode').val();
            var stocks = pstock - pqty;
            var submit = "submit";
            if (stocks < 0) {
                Swal.fire('Warning.', 'Stocks is Not Enough', 'warning')
            } else {
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        puser: puser,
                        pid: pid,
                        pname: pname,
                        punit: punit,
                        pprice: pprice,
                        pqty: pqty,
                        pcode: pcode,
                        submit: submit,
                        stocks: stocks
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#dataModal').modal('hide');
                        load_cart_item_number();
                        $("#refresh").load(location.href + " #refresh");
                        if (data.feedback == 'success') {
                            Swal.fire({
                                icon: 'success',
                                type: 'success',
                                title: 'Item',
                                text: 'Item Added Successfully',
                                showConfirmButton: false,
                                timer: 2000

                            })
                            var value = $('#total').val();
                            // var fee = $('#fee').val();
                            var subtotal = parseFloat(pqty) * parseFloat(pprice);
                            var output = parseFloat(value) + parseFloat(subtotal);
                            $('#total').val(output);

                            $("#totalview").val('₱' + output);

                        } else {
                            Swal.fire('Warning.', 'Item is Added Already !', 'warning')
                        }

                    }
                });
            }
        });


        $(document).on('click', '.delete', function() {
            var $el = $(this).closest('tr');
            var product_id = $el.find(".pid").val();
            var price = $el.find(".pprice").val();
            var qty = $el.find(".itemQty").val();
            // var product_id = $('.pid').val();
            // var price = $('.pprice').val();
            // var qty = $('.itemQty').val();
            var remove = product_id;
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure you want to remove item ?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "action.php",
                        method: "POST",
                        data: {
                            remove: remove,

                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                type: 'success',
                                title: 'Item',
                                text: 'Item Deleted Successfully',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            var value = $('#total').val();
                            var subtotal = parseFloat(qty) * parseFloat(price);
                            var output = parseFloat(value) - parseFloat(subtotal);
                            $('#total').val(output);
                            $("#refresh").load(location.href + " #refresh")
                            $("#totalview").val('₱' + output);



                        }
                    })
                }

            });

        });


        $(document).on('click', '.clear', function() {
            var action = $('#action').val();
            var clear = action;

            Swal.fire({
                icon: 'warning',
                title: 'Are you sure you want to delete all data?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "action.php",
                        method: "POST",
                        data: {
                            clear: clear,

                        },
                        success: function(data) {
                            $("#refresh").load(location.href + " #refresh");
                            Swal.fire('Removed', 'Removed Succesfully', 'success')
                            var value = $('#fee').val();
                            $('#total').val(value);
                            $("#totalview").val('₱' + value);
                        }
                    })
                }

            });

        });

        var orderingdataTable = $('#tableID').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "admin_ordering_fetch.php",
                type: "POST"
            },
            "columnDefs": [{
                "targets": [0, 1, 2],
                "orderable": false,
            }, ],
            "pageLength": 9999999
        });





    });
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>