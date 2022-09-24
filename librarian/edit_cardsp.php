<?php include_once __DIR__. '\header.php';
include_once '..\dbHelper\dbhelper.php';




?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<div class="main-content" >
    <div class="col">
        <div class="card pt-2">
            <div class="card-header">
                <h4>Edit Cards</h4>
                <a style="color: whitesmoke" onclick="assignValues(<?php echo $_GET['uid']?>)" data-toggle="modal" data-target="#aprove"  class="btn btn-primary float-right"><i class="fa fa-plus"></i> &nbsp; Add Card</a>
            </div>
            <div class="alert alert-success alert-has-icon" id="messegeBlock" style="display: none">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Success</div>
                    <label id="messege">Professor Details Updated Sucessfully.</label>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>card number</th>
                            <th>card Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $uid=$_GET['uid'];
                        $rows =(new dbhelper)->__getProfessorDetails($uid);
                        if($rows != 0 )
                        {
                            $i=1;
                            foreach ($rows as $row){
                                $cardnumber=$row['card_number'];
                                $status= $row['status'] ;



                                echo '
                    <tr>
                        <td>'.$i.'</td>
                        <td>'.$cardnumber.' </td>
                        <td>'.$status.' </td>
                       
                        <td><input href="#"  onclick="deleteCard('.$uid.','.$cardnumber.','.$status.');" type="button" id="'.$uid.'" class="btn btn btn-primary" value="Delete"> </td>
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


<div class="modal fade" id="aprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-info">
            <div class="card">
                <div class="card-header">
                    <h4>Card distribution for Professor</h4>
                </div>
                <div class="card-body">
                    <form id="aprovalForm" action="">
                        <div class="section-title mt-0">User Details</div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">First and last name</span>
                                </div>
                                <label id="name" class="form-control">Mahesh gouda</label>
                            </div>
                        </div>
                        <label style="display: none" id="userid"></label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">course</span>
                                </div>
                                <label id="course"  class="form-control">MCA</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Register number</span>
                                </div>
                                <label id="regno"  class="form-control">1234566ree</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <button class="form-control btn btn-info" onclick="addCard()" type="button" id="addcard" ><i class="fa fa-plus-circle"></i> Add Cards to User</button>

                            </div>
                        </div>
                        <div id="cardBlock">

                        </div>


                        <div class="form-group">
                            <div class="input-group">
                                <button id="saveinfoBtn" class="form-control btn btn-success" type="submit" ><i class="fa fa-check-square"></i> Save info</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let cardCount = 1;

    function assignValues(id){
        $.ajax({
            url: '../dbHelper/studentInfo.php',
            type: 'POST',
            data: {"eid": id},
            success: function (response) {
                var obj = JSON.parse(response);

                $.each(obj, function(i, $val)
                {
                    $("#name").html($val.firstname+ ' '+$val.lastname);
                    $("#course").html($val.course);
                    $("#regno").html($val.regno);
                    $("#userid").html($val.userid);

                    $('#cardBlock').empty();
                    cardCount = 1;
                });


            }
        });
    }

    function deleteCard(uid,cardnumber,status){
        if(status >= 1) {
            setTimeout(function() {
                swal({
                    title: "danger",
                    text: "Cannot Delete card now",
                    type: "warning"
                }, function() {
                    location.reload();
                });
            }, 100);

        }else {
            $.ajax({
                url: '../dbHelper/studentInfo.php',
                type: 'POST',
                data: {"uid": uid, "cardnumber": cardnumber},
                success: function (response) {


                    if (response === "1") {
                        setTimeout(function () {
                            swal({
                                title: "Success!",
                                text: "Cards Deleted successfully",
                                type: "success"
                            }, function () {
                                location.reload();
                            });
                        }, 100);
                    } else {
                        setTimeout(function () {
                            swal({
                                title: "Failed",
                                text: "Failed to Delete cards",
                                type: "warning"
                            }, function () {
                                location.reload();
                            });
                        }, 100);
                    }

                }
            });
        }
    }

    function addCard(){
        $('#cardBlock').append(' <div class="form-group"> <div class="input-group"><div class="input-group-prepend"> <span id="" class="input-group-text">Card '+cardCount+' </span> </div> <input id="cardnumber'+cardCount+'"  type="text" class="form-control" placeholder="enter card number" required> </div>   </div> ');

        cardCount++;
    }


    $('#aprovalForm').submit(function (event) {
        event.preventDefault();
        var arr = $('#cardBlock input').map(function () {
            return this.value;
        });

        var userid = $('#userid').html();


        $.ajax({
            url: '../dbHelper/addCards.php',
            type: 'POST',
            // data: "{'uid':'"+ userid +"','cards':'"+ arr +"'}",
            data: {"uid": userid,"cards":JSON.stringify(arr)},
            success: function (response) {
                $('#aprove').modal('hide');
                if (response === "1") {
                    setTimeout(function() {
                        swal({
                            title: "Success!",
                            text: "Cards Added successfully",
                            type: "success"
                        }, function() {
                            location.reload();
                        });
                    }, 100);
                } else {
                    setTimeout(function() {
                        swal({
                            title: "Failed",
                            text: "Failed to Add cards",
                            type: "warning"
                        }, function() {
                            location.reload();
                        });
                    }, 100);
                }
            }
        });

    });




</script>


<?php include_once __DIR__. '\footer.php' ?>

