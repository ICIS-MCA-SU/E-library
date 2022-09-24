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

    .icon i {
        color: white;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<div class="main-content">
    <div class="col">
        <div class="card">
            <div class="card-header pt-2">
                <h4>Pending Faculty Approval</h4>
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
                                <th>Faculty Name</th>
                                <th>Registration date</th>
                                <th>Email</th>
                                <th>phone</th>
                                <th>course</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rows = (new dbhelper)->__getPendingAprovalProfessor();
                            if ($rows != 0) {
                                $i = 1;
                                foreach ($rows as $row) {
                                    $id = $row['id'];
                                    $uid = $row['user_id'];
                                    $date = $row['registration_date'];
                                    $fname = $row['first_name'];
                                    $laname = $row['last_name'];
                                    $phone = $row['phone'];
                                    $email = $row['email'];
                                    $course = $row['course'];


                                    echo '
                    <tr>
                        <td>' . $i . '</td>
                        <td>' . $fname . '&nbsp;' . $laname . ' </td>
                        <td>' . $date . '</td>
                        <td>' . $email . '</td>
                        <td>' . $phone . '</td>
                        <td>' . $course . '</td>
                        <td>
                        <a data-toggle="modal" data-target="#aprove" onclick="assignValues(id);" id="' . $uid . '" class="btn btn btn-primary icon mt-1" value="Aprove"><i class="icofont-check-circled"></i></a> 
                        <a id="' . $uid . '" class="btn btn-warning icon mt-1" data-toggle="modal" data-target="#exampleModal" style="color:red;cursor:pointer" onclick="showDetails(' . $id . ',' . $uid . ')" style="cursor:pointer"><i class="icofont-ui-delete"></i></a>  </td>
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


<div class="modal fade" id="aprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-info">
            <div class="card">
                <div class="card-header">
                    <h4>Card distribution for Faculty</h4>
                </div>
                <div class="card-body">
                    <form id="aprovalForm" action="">
                        <div class="section-title mt-0">User Details</div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">First and last name</span>
                                </div>
                                <label id="name" class="form-control">name</label>
                            </div>
                        </div>
                        <label style="display: none" id="userid"></label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">course</span>
                                </div>
                                <label id="course" class="form-control">MCA</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <button id="saveinfoBtn" class="form-control btn btn-success" type="submit"><i class="fa fa-check-square"></i> Approve </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this user?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="txtId" />
            <input type="hidden" id="txtUserId" />

            <!-- <div class="modal-body" style="padding:15px">
                <div class="row">
                    <div class="col-lg-2">
                        <label>Name : </label>
                    </div>
                    <div class="col-lg-10">
                        <label id="lblName" style="text-transform:capitalize"></label>
                    </div>
                </div>
            </div> -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="deleteUserApproval()">Delete</button>
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

        function assignValues(id) {
            $.ajax({
                url: '../dbHelper/studentInfo.php',
                type: 'POST',
                data: {
                    "id": id
                },
                success: function(response) {
                    var obj = JSON.parse(response);

                    $.each(obj, function(i, $val) {
                        $("#name").html($val.firstname + ' ' + $val.lastname);
                        $("#course").html($val.course);
                        $("#userid").html($val.userid);

                    });


                }
            });
        }
        $('#aprovalForm').submit(function(event) {
            event.preventDefault();


            var userid = $('#userid').html();

            // for(i=0; i < arr.length; i++)
            //     alert(arr[i]);


            $.ajax({
                url: '../dbHelper/saveProfessor.php',
                type: 'POST',
                data: {
                    "uid": userid
                },
                success: function(response) {
                    $('#aprove').modal('hide');
                    if (response === "1") {
                        setTimeout(function() {
                            swal({
                                title: "Success!",
                                text: "Professor approved successfully",
                                type: "success"
                            }, function() {
                                location.reload();
                            });
                        }, 100);
                    } else {
                        setTimeout(function() {
                            swal({
                                title: "Failed",
                                text: "Failed approve",
                                type: "warning"
                            }, function() {
                                location.reload();
                            });
                        }, 100);
                    }
                }
            });

        });

        function showDetails(id, uid) {
            document.getElementById("txtId").value = id;
            document.getElementById("txtUserId").value = uid;

        }

        function deleteUserApproval() {
            var id = document.getElementById("txtId").value;
            var uid = document.getElementById("txtUserId").value;
            $.ajax({
                type: "POST",
                url: "../dbHelper/studentTransactions.php",
                data: {
                    type: "DeleteApproval",
                    id: id,
                    uid: uid
                },
                success: function(res) {
                    if (res == 1) {
                        swal({
                            title: "Success",
                            text: "User Successfully deleted",
                            type: "success",
                        }, function() {
                            location.reload();
                        });
                    } else {
                        swal({
                            title: "error",
                            text: "Failed to the user",
                            type: "warning",
                        });
                    }
                },
                error: function(res) {
                    console.log(res);
                }
            });
        }
    </script>


    <?php include_once __DIR__ . '\footer.php' ?>