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
<div class="main-content">
    <div class="col">
        <div class="card pt-2">
            <div class="card-header">
                <h4>Pending Professor Return Request</h4>
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
                    <table class="table table-hover py-3" id="pendingTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Book</th>
                                <th>Book id</th>
                                <th>Accession</th>
                                <th>order date</th>
                                <th>Professosr name</th>
                                <th>course</th>
                                <th>Returned date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rows = (new dbhelper)->__getProfessorReturnRequests();
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
                                    $returnedDate = $row['returned_date'];


                                    echo '
                    <tr>
                        <td>' . $i . '</td>
                        <td>' . $title . ' </td>
                        <td>' . $book_id . '</td>
                        <td>' . $aceession . '</td>
                        <td>' . $orderdate . '</td>
                        <td>' . $fname . '</td>
                        <td>' . $course . '</td>
                         <td>' . $returnedDate . '</td>
                        <td><a data-toggle="modal" data-target="#aproveReturn" onclick="confirmOrder(id);" id="' . $oid . '" class="btn btn btn-primary icon mt-1" value="Aprove"><i class="icofont-check-circled"></i></a> 
                        <a id="' . $oid . '" class="btn btn-warning icon mt-1" value="Reject" onclick="rejectReturnRequest(id)" data-toggle="modal" data-target="#rejectReturn" ><i class="icofont-ui-delete"></i></a>  </td>
                    </tr>';
                                    $i++;
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

    function confirmReturn(id) {

        setTimeout(function() {
            swal({
                title: "confirm",
                text: "Do You want to Confirm this Return ?",
                type: "info"
            }, function() {
                $.ajax({
                    url: '../dbHelper/processReturn.php',
                    type: 'POST',
                    data: {
                        "id": id
                    },
                    success: function(response) {

                        if (response === "1") {
                            setTimeout(function() {
                                swal({
                                    title: "Success",
                                    text: "Returned confirmed successfully",
                                    type: "success"
                                }, function() {
                                    location.reload();
                                });
                            }, 100);
                        } else {
                            setTimeout(function() {
                                swal({
                                    title: "Failed!",
                                    text: "Return confirm Failed",
                                    type: "warning"
                                }, function() {

                                });
                            }, 100);
                        }

                    }
                });
            });
        }, 100);



    }


    function rejectReturnRequest(id) {
        swal({
            title: "confirm",
            text: "Do You want to Reject this Return ?",
            type: "info"
        }, function() {
            $.ajax({
                url: '../dbHelper/processReturn.php',
                type: 'POST',
                data: {
                    "rid": id
                },
                success: function(response) {

                    if (response === "1") {
                        setTimeout(function() {
                            swal({
                                title: "Success",
                                text: "Returned Rejected successfully",
                                type: "success"
                            }, function() {
                                location.reload();
                            });
                        }, 100);
                    } else {
                        setTimeout(function() {
                            swal({
                                title: "Failed!",
                                text: "Return Reject Failed",
                                type: "warning"
                            }, function() {

                            });
                        }, 100);
                    }

                }
            });
        });
    }
</script>


<?php include_once __DIR__ . '\footer.php' ?>