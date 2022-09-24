<?php include_once __DIR__ . '\header.php';
include_once '..\dbHelper\dbhelper.php';




?>
<style>
        .icon {
  font-size: 18px;
  display: inline-block;
  line-height: 1;
  padding: 8px 0;
  border-radius: 50%;
  text-align: center;
  width: 36px;
  height: 36px;
  transition: 0.3s;
}
.icon i{
  color:white;
}
</style>
<!--<script src="../librarian/assets/js/sweetalert.js"></script>-->
<!--<script src="sweetalert2.all.min.js"></script>-->
//<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<div class="main-content">
    <div class="col">
        <div class="card">
            <div class="card-header pt-2">
                <h4>Pending Orders</h4>
            </div>
            <div class="alert alert-success alert-has-icon" id="messegeBlock" style="display: none">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Success</div>
                    <label id="messege">Student Details Updated Sucessfully.</label>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover py-3" id="professorTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Book</th>
                                <th>Book id</th>
                                <th>Accession</th>
                                <th>order date</th>
                                <th>Professor name</th>
                                <th>course</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rows = (new dbhelper)->__getPendingOrders("professor");
                            if ($rows != 0) {
                                $i = 1;
                                foreach ($rows as $row) {
                                    $oid = $row['id'];
                                    $uid = $row['user_id'];
                                    $fname = $row['first_name'];
                                    $phone = $row['phone'];
                                    $email = $row['email'];
                                    $course = $row['course'];
                                    $title = $row['title'];
                                    $book_id = $row['book_id'];
                                    $aceession = $row['accession_number'];
                                    $orderdate = $row['order_date'];
                                    $status = $row['status'];

                            ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $title ?> </td>
                                        <td><?php echo $book_id ?></td>
                                        <td><?php echo $aceession ?>'</td>
                                        <td><?php echo $orderdate ?></td>
                                        <td><?php echo $fname ?></td>
                                        <td><?php echo $course ?></td>
                                        <td>
                                        <a data-toggle="modal" data-target="#aprove" onclick="confirmOrder(id);" id="<?php echo $oid ?>" class="btn btn btn-primary icon mt-1" value="Aprove"><i class="icofont-check-circled"></i></a> 
                        <a id="<?php echo $oid ?>" class="btn btn-warning icon mt-1" value="Reject" onclick="setRejectId(id)" data-toggle="modal" data-target="#reject" ><i class="icofont-ui-delete"></i></a>  </td>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            }else {
                                echo "<tr class='text-center'><td colspan='9'>No Data available</td></tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="aprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-info">
            <div class="card">
                <div class="card-header">
                    <h4>Order Confirmation</h4>
                </div>
                <div class="card-body">
                    <form id="confirmFrom" action="">
                        <div class="section-title mt-0">Order Details</div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Book title & acession</span>
                                </div>
                                <label id="title" class="form-control">title #2543346</label>
                            </div>
                        </div>
                        <label style="display: none" id="orderid"></label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Student details</span>
                                </div>
                                <label id="student" class="form-control">name #regno</label>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Comments </span>
                                </div>
                                <textarea id="comment" name="comment" class="form-control" cols="10" rows="6"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <button id="confirmOrderBtn" class="form-control btn btn-success" type="submit"><i class="fa fa-check-square"></i> confirm order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-info">
            <div class="card">
                <div class="card-header">
                    <h4>Order Reject Remarks</h4>
                </div>
                <div class="card-body">
                    <form id="rejectForm" action="">
                        <div class="section-title mt-0">Enter Remarks for order</div>

                        <div class="form-group">
                            <div class="input-group">

                                <textarea id="remarks" name="remarks" class="form-control" cols="20" rows="6"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <button id="rejectOrderBtn" class="form-control btn btn-success" type="submit"><i class="fa fa-check-square"></i> Reject order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modelSucess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-info">
            <div class="card">
                <div class="card-header">
                    <h4>Order Reject Remarks</h4>
                </div>
                <div class="card-body">
                    <form id="rejectForm" action="">
                        <div class="section-title mt-0">Enter Remarks for order</div>

                        <div class="form-group">
                            <div class="input-group">

                                <textarea id="remarks" name="remarks" class="form-control" cols="20" rows="6"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <button id="rejectOrderBtn" class="form-control btn btn-success" type="submit"><i class="fa fa-check-square"></i> Reject order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     $(document).ready(function() {
        $('#professorTable').DataTable({
            pageLength: 10,
            "lengthChange": false,
            "searching": true,
        });
    });
    function confirmOrder(id) {
        $.ajax({
            url: '../dbHelper/confirmOrder.php',
            type: 'POST',
            data: {
                "id": id
            },
            success: function(response) {
                var obj = JSON.parse(response);

                $.each(obj, function(i, $val) {
                    $("#title").html($val.bookname + '  #' + $val.accession);
                    $("#student").html($val.firstname + '  #' + $val.regno);
                    $("#orderid").html(id);


                });


            }
        });
    }

    rejectid = 0;

    function setRejectId(id) {
        rejectid = id;
    }

    $('#rejectForm').submit(function(event) {
        event.preventDefault();
        var remark = $('#remarks').val();
        $.ajax({
            url: '../dbHelper/confirmOrder.php',
            type: 'POST',
            data: {
                "rejectId": rejectid,
                "remarks": remark
            },
            success: function(response) {
                $('#reject').modal('hide');
                if (response === "1") {
                    setTimeout(function() {
                        swal({
                            title: "Order rejected!",
                            text: "Order rejected successfully",
                            type: "success"
                        }, function() {
                            location.reload();
                        });
                    }, 100);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "Failed!",
                            text: "Order rejected Failed",
                            type: "warning"
                        }, function() {

                        });
                    }, 100);
                }
            }
        });
    });



    $('#confirmFrom').submit(function(event) {
        event.preventDefault();
        var comment = $('#comment').val();

        var orderid = $('#orderid').html();
        $.ajax({
            url: '../dbHelper/confirmOrder.php',
            type: 'POST',
            data: {
                "orderid": orderid,
                "comment": comment
            },
            success: function(response) {
                $('#aprove').modal('hide');
                if (response === "1") {
                    setTimeout(function() {
                        swal({
                            title: "Records updated!",
                            text: "Order Confirmed successfully",
                            type: "success"
                        }, function() {
                            location.reload();
                        });
                    }, 100);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "Failed!",
                            text: "Order Confirmation failed",
                            type: "warning"
                        }, function() {

                        });
                    }, 100);
                }
            }
        });

    });
</script>


<?php include_once __DIR__ . '\footer.php' ?>