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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="main-content">
    <div class="col">
        <div class="card pt-2">
            <div class="card-header">
                <h4>Pending Assignment</h4>
            </div>
            <div class="alert alert-success alert-has-icon" id="messegeBlock" style="display: none">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Success</div>
                    <label id="messege">Book Details Updated Sucessfully.</label>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover pb-3" id="pendingTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Book</th>
                                <th>Book id</th>
                                <th>Accession</th>
                                <th>order date</th>
                                <th>Student name</th>
                                <th>course</th>
                                <th>Reg_no</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rows = (new dbhelper)->__getPendingOrdersAprovals();
                            if ($rows != 0) {
                                $i = 1;
                                foreach ($rows as $row) {
                                    $oid = $row['id'];
                                    $uid = $row['user_id'];
                                    $fname = $row['first_name'];
                                    $phone = $row['phone'];
                                    $email = $row['email'];
                                    $course = $row['course'];
                                    $regno = $row['regno'];
                                    $title = $row['title'];
                                    $book_id = $row['book_id'];
                                    $aceession = $row['accession_number'];
                                    $orderdate = $row['order_date'];
                                    $status = $row['status'];
                                    $time1 = $row['aprove_time'];
                                    $time1 = strtotime($time1);
                                    $time2 = strtotime(date("H:i:s"));
                                    $difference = round(abs($time2 - $time1) / 3600, 2);
                                    if ($difference >= 24) {
                                        (new dbhelper)->__cancelOrder($oid);
                                        (new dbhelper)->__setAccessionStatusToZero($aceession);
                                        $cardnumber = (new dbhelper)->__getCardNumberFromOrder($oid);
                                        (new dbhelper)->__setCardStatustoZero($cardnumber);
                                    } else {

                            ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $title ?> </td>
                                            <td><?php echo $book_id ?></td>
                                            <td><?php echo $aceession ?>'</td>
                                            <td><?php echo $orderdate ?></td>
                                            <td><?php echo $fname ?></td>
                                            <td><?php echo $course ?></td>
                                            <td><?php echo $regno ?></td>


                                            <td>
                                            <a  onclick="assignBook(<?php echo $oid ?>);" type="button" id="<?php echo $oid ?>" class="btn btn btn-primary icon mt-1" value="Aprove"><i class="icofont-check-circled"></i></a> 
                        <a  class="btn btn-warning icon mt-1" value="Reject" type="button" id="<?php echo $oid ?>" onclick="cancelOrder(<?php echo $oid ?>)" ><i class="icofont-ui-delete"></i></a>  </td>
                                               
                                            </td>
                                        </tr>
                            <?php
                                        $i++;
                                    }
                                }
                            } else {
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



<script>
      $(document).ready(function() {
        $('#pendingTable').DataTable({
            pageLength: 10,
            "lengthChange": false,
            "searching": true,
        });
    });
    function assignBook(aid) {
        $.ajax({
            url: '../dbHelper/confirmOrder.php',
            type: 'POST',
            data: {
                "aid": aid
            },
            success: function(response) {
                if (response === "1") {
                    setTimeout(function() {
                        swal({
                            title: "Assigned!",
                            text: "Order Assigned successfully",
                            type: "success"
                        }, function() {
                            location.reload();
                        });
                    }, 100);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "Failed!",
                            text: "Order Assigne Failed",
                            type: "warning"
                        }, function() {

                        });
                    }, 100);
                }
            }
        });
    }

    function cancelOrder(rid) {

        $.ajax({
            url: '../dbHelper/confirmOrder.php',
            type: 'POST',
            data: {
                "rid": rid
            },
            success: function(response) {
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
    }
</script>


<?php include_once __DIR__ . '\footer.php' ?>