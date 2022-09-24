<?php include_once __DIR__ . '\header.php';
include_once '..\dbHelper\dbhelper.php';




?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<div class="main-content">
    <div class="col">
        <div class="card pt-2">
            <div class="card-header">
                <h4 class="col-lg-9 col-md-9 col-12">Students Record</h4>
                <h4 class=" col-lg-3 col-md-3 col-12" style="text-align:end">Total Students:<?php $rows = (new dbhelper)->__getStudentDetails();
                                                                                            echo count($rows) ?></h4>
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
                    <table class="table table-hover mb-0" id="studentTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>phone</th>
                                <th>course</th>
                                <th>Reg_no</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rows = (new dbhelper)->__getStudentDetails();
                            if ($rows != 0) {
                                $i = 1;
                                foreach ($rows as $row) {
                                    $uid = $row['user_id'];
                                    $fname = $row['first_name'];
                                    $laname = $row['last_name'];
                                    $phone = $row['phone'];
                                    $email = $row['email'];
                                    $course = $row['course'];
                                    $regno = $row['regno'];
                                    $Isdeleted = $row['Isdeleted'];

                                    echo '
                    <tr>
                        <td>' . $i . '</td>
                        <td>' . $fname . '&nbsp;' . $laname . ' </td>
                        <td>' . $email . '</td>
                        <td>' . $phone . '</td>
                        <td>' . $course . '</td>
                        <td>' . $regno . '</td>' ?>
                            <?php
                                    if ($Isdeleted == 0) {
                                        echo '<td>Active</td>';
                                    } else {
                                        echo '<td>Deactivated</td>';
                                    }
                                    echo '
                        <td style="display:flex;"><a href="edit_cards.php?uid=' . $uid . '"   id="' . $uid . '"  ><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
                        <a data-toggle="modal" data-target="#exampleModal1" style="color:#6777ef;cursor:pointer" onclick="showDetails1(' . $uid . ',' . $Isdeleted . ')" style="cursor:pointer"><i class="fa-solid fa-user-gear"></i></a>&nbsp;&nbsp;
                        <a data-toggle="modal" data-target="#exampleModal" style="color:red;cursor:pointer" onclick="showDetails(' . $uid . ')" style="cursor:pointer"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    
                        </tr>';
                                    $i++;
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to <label id="lblStatus"></label> this user?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="txtUserId1" />
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
                <button type="button" class="btn btn-primary" onclick="deactivateUser()" id="btnDeactivate" style="display:none">Deactivate</button>
                <button type="button" class="btn btn-primary" onclick="activateUser()" id="btnActivate" style="display:none">Activate</button>
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
                <button type="button" class="btn btn-danger" onclick="deleteUser()">Delete</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#studentTable').DataTable({
            pageLength: 10,
            "lengthChange": false,
            "searching": true,
        });
    });

    function showDetails(id) {
        document.getElementById("txtUserId").value = id;
    }

    function showDetails1(id, status) {
        document.getElementById("txtUserId1").value = id;
        if (status == 0) {
            document.getElementById("lblStatus").innerHTML = "Deactivate";
            document.getElementById("btnActivate").style.display = "none";
            document.getElementById("btnDeactivate").style.display = "block";
        } else {
            document.getElementById("lblStatus").innerHTML = "Activate";
            document.getElementById("btnActivate").style.display = "block";
            document.getElementById("btnDeactivate").style.display = "none";
        }
    }

    function deleteUser() {
        var id = document.getElementById("txtUserId").value;
        $.ajax({
            type: "POST",
            url: "../dbHelper/studentTransactions.php",
            data: {
                type: "Delete",
                uid: id
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

    function deactivateUser() {
        var id = document.getElementById("txtUserId1").value;
        $.ajax({
            type: "POST",
            url: "../dbHelper/studentTransactions.php",
            data: {
                type: "Deactivate",
                uid: id
            },
            success: function(res) {
                if (res == 1) {
                    swal({
                        title: "Success",
                        text: "User Successfully Deactivated",
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

    function activateUser() {
        var id = document.getElementById("txtUserId1").value;
        $.ajax({
            type: "POST",
            url: "../dbHelper/studentTransactions.php",
            data: {
                type: "Activate",
                uid: id
            },
            success: function(res) {
                if (res == 1) {
                    swal({
                        title: "Success",
                        text: "User Successfully Activated",
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