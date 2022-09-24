<?php include_once __DIR__ . '\header.php';
include_once '..\dbHelper\dbhelper.php';

?>
<style>
    .btnGroupCol {
        text-align: end;
        margin-top: 16px;
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

<div class="main-content row">

    <div class="col-md-12 col-12" x-data="getQuery">

        <div class="card pt-2">
            <div class="card-header">
                <h4 class="col-md-9 mb-3 col-12" style="padding-left:0px">Queries</h4>

                <div class="col-md-3 col-4" style="text-align:end;padding:0px">
                </div>

            </div>
            <div class="card-body">

                <div class="">
                    <table class="table table-borderless table-responsive-sm ">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Created On</th>
                                <th>Response</th>
                                <th>Replied On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="item in queriesList" :key="item.Id">
                                <tr class=" shadow-md border-bottom">
                                    <td class="border-0 py-3"><span x-text="item.Id"></span></td>
                                    <td class="border-0 py-3"><span x-text="item.name"></span></td>
                                    <td class="border-0 py-3"><span x-text="item.email"></span></td>
                                    <td class="border-0 py-3"><span x-text="item.message"></span></td>
                                    <td class="border-0 py-3"><span x-text="new Date(item.createdOn).toLocaleString()"></span></td>
                                    <td class="border-0 py-3"><span x-text="item.response"></span></td>
                                    <td class="border-0 py-3"><span x-text="item.repliedOn!=null?new Date(item.repliedOn).toLocaleString():''"></span></td>
                                    <td class="border-0 py-3">
                                        <i class="fa-solid fa-reply" x-on:click="replyModal(item.Id)" style="cursor:pointer;margin-right:4px;color:darkslateblue"></i>
                                        <i class="fa-solid fa-trash" x-on:click="deleteQuery(item.Id)" style="cursor:pointer;color:red"></i>
                                    </td>
                                </tr>
                            </template>
                            <template x-if="queriesList.length>0?false:true">
                                <tr>
                                    <td colspan="8" class="text-center">No Data Found</td>
                                </tr>
                            </template>
                        </tbody>

                    </table>
                    </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Reply to Query
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Name</label>:
                                <span x-text="query.name"></span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Email</label>:
                                <span x-text="query.email"></span>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="Reply">Reply</label>
                                <textarea class="form-control" id="reply" rows="3" x-model="query.response"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" x-on:click="reply">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    
    let getQuery = () => {
        return {
            queriesList: [],
            dataPerPage: 10,
            currentPage: 1,
            totalPages: 0,
            query: {},
            init() {
                this.getQueries();

            },
            getQueries() {
                const setQueryData = (data) => {
                    this.queriesList = JSON.parse(data);
                }
                $.ajax({
                    type: "POST",
                    url: "../dbHelper/contactus.php",
                    data: {
                        type: "getQueries",
                    },
                    success: function(res) {
                        setQueryData(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            },
            replyModal(id) {
                this.query = this.queriesList.filter(item => item.Id == id)[0];
                $('#exampleModalCenter').modal('show');
            },
            reply() {
                const setQueryData = () => {
                    $.ajax({
                        url: '../api/Mail.php',
                        type: 'POST',
                        data: {
                            action: 'queryReply',
                            email: this.query.email,
                            response: this.query.response
                        },
                        success: function(data) {
                            swal("Success", "Reply sent successfully", "success");
                        }
                    });
                    this.getQueries();
                }
                $.ajax({
                    type: "POST",
                    url: "../dbHelper/contactus.php",
                    data: {
                        type: "reply",
                        id: this.query.Id,
                        response: this.query.response
                    },
                    success: function(res) {
                        if (res == 'success') {
                            $('#exampleModalCenter').modal('hide');
                            setQueryData();
                        }
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            },
            deleteQuery(id) {
                const setQueryData = () => {
                    $.ajax({
                        url: '../api/Mail.php',
                        type: 'POST',
                        data: {
                            action: 'queryDelete',
                            id: id
                        },
                        success: function(data) {
                            swal("Success", "Query deleted successfully", "success");
                        }
                    });
                    this.getQueries();
                }
                $.ajax({
                    type: "POST",
                    url: "../dbHelper/contactus.php",
                    data: {
                        type: "deleteQuery",
                        id: id
                    },
                    success: function(res) {
                        if (res == 'success') {
                            setQueryData();
                        }
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            }

        }
    }
</script>


<?php include_once __DIR__ . '\footer.php' ?>