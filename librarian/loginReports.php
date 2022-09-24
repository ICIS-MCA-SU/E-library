<?php include_once __DIR__ . '\header.php';
include_once '..\dbHelper\dbhelper.php';

?>
<style>
    .btnGroupCol {
        text-align: end;
        margin-top: 16px;
    }
</style>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../css/jquery.datetimepicker.min.css" />
<script src="../js/jquery.datetimepicker.full.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" integrity="sha512-xX2rYBFJSj86W54Fyv1de80DWBq7zYLn2z0I9bIhQG+rxIF6XVJUpdGnsNHWRa6AvP89vtFupEPDP8eZAtu9qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/xlsx.full.min.js"></script>

<div class="main-content row">

    <div class="col-md-12 col-12" x-data="getUserLog">

        <div class="card pt-2">
            <div class="card-header">
                <h4 class="col-md-9 mb-3 col-12" style="padding-left:0px">Login Logs</h4>

                <div class="col-md-3 col-4" style="text-align:end;padding:0px">
                    <button x-on:click="" class="btn btn-warning  py-1" style="border-radius: 5px;" data-toggle="modal" data-target="#exampleModalCenter">Manage Logs</button>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class=" col-md-3 col-12">
                        <div class="form-group">
                            <label for="Date">Start Date</label>
                            <input type="datetime" class="form-control" id="searchStartDate" aria-describedby="searchStartDate" placeholder="Select Start Date">
                        </div>
                    </div>
                    <div class=" col-md-3 col-12">
                        <div class="form-group">
                            <label for="Date">End Date</label>
                            <input type="datetime" class="form-control" id="searchEndDate" aria-describedby="searchEndDate" placeholder="Select Start Date">
                        </div>
                    </div>
                    <div class=" col-md-2 col-6 text-center">
                        <div class="form-group" style="display: flex;text-align:center;">
                            <button class="btn btn-primary mt-4 py-2 px-3" x-on:click="getsearchUserLogs">Search</button>

                        </div>
                    </div>
                    <div class="col-md-4 col-12 btnGroupCol">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary" style="padding:12px 15px" x-on:click="reload">
                                <i class="fa fa-refresh" aria-hidden="true" style="font-size:20px;cursor:pointer"></i>
                            </button>
                            <button type="button" class="btn btn-primary" x-on:click="exportReport">
                                <i class="fa-solid fa-download" style="font-size:20px;cursor:pointer;"></i>
                            </button>
                        </div>
                    </div>

                </div>
                <div class="">
                    <table class="table table-borderless table-responsive-sm ">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Enter Time</th>
                                <th>Out Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="item in userLogJson" :key="item.Id">
                                <tr class=" shadow-md border-bottom">
                                    <td class="border-0 py-3" x-text="item.Id"></td>
                                    <td class="border-0 py-3" x-text="item.first_name"></td>
                                    <td class="border-0 py-3" x-text="new Date(item.enterDateTime).toLocaleString()"></td>
                                    <td class="border-0 py-3" x-text="item.outDateTime?new Date(item.outDateTime).toLocaleString():''"></td>

                                </tr>
                            </template>
                            <template x-if="userLogJson.length>0?false:true">
                                <tr>
                                    <td colspan="4" class="text-center">No Data Found</td>
                                </tr>
                            </template>
                        </tbody>

                    </table>
                    <template x-if="!isSearch">
                        <template x-if="userLogJson.length>0?true:false">

                            <div class="row">
                                <div class="col-12 justify-content-end">
                                    <button class="btn btn-primary mb-2" x-bind:disabled="currentPage==1?true:false" type="button" x-on:click="getPrevPage">Prev</button>
                                    <button class="btn btn-primary  mb-2" type="button" style="border-radius:10%" x-bind:id="1" x-on:click="getCurrentPageData">1</button>
                                    <template x-for="no in totalPages" x-bind:key="no">
                                        <template x-if="no!=1?true:false">
                                            <button class="btn btn-primary ml-1 mb-2" style="border-radius:10%" type="button" x-bind:id="no" x-text="no" x-on:click="getCurrentPageData"></button>
                                        </template>
                                    </template>
                                    <button class="btn btn-primary mr-1 mb-2" x-bind:disabled="currentPage==totalPages?true:false" type="button" x-on:click="getNextPage">Next</button>
                                </div>
                            </div>
                        </template>
                    </template>

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" x-data="getUserLog" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Please enter following details?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="Date">Date</label>
                    <input type="datetime" class="form-control" id="startDate" aria-describedby="startDate" placeholder="Select Start Date">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Select No. of Users</label>
                    <select name="catalog" id="noOfUsers" class="form-control">
                        <option value="0">Select</option>
                        <option value="5">5</option>
                        <option value="7">10</option>
                        <option value="15">15</option>
                        <option value="18">20</option>
                        <option value="25">25</option>
                        <option value="47">50</option>
                        <option value="98">100</option>
                        <option value="194">200</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" x-on:click="updateReports">Update</button>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery('#startDate').datetimepicker({
        timepicker: false,
        format: 'Y-m-d 10:00:00',
        mask: true, // '9999/19/39 29:59' - digit is the maximum possible for a cell
    });
    jQuery('#searchStartDate').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        mask: true, // '9999/19/39 29:59' - digit is the maximum possible for a cell
    });
    jQuery('#searchEndDate').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        mask: true, // '9999/19/39 29:59' - digit is the maximum possible for a cell
    });
    let getUserLog = () => {
        return {
            userLogJson: [],
            userLogJson1: [],
            startLimit: 0,
            endLimit: 10,
            totalPages: 0,
            currentPage: 1,
            count: 0,
            isSearch: false,
            allUsersList: [],
            init() {

                this.currentPage = 1;
                this.getAllUsers();
                this.getUserLogs();
                this.getAllUserLogs();
                this.$watch('isSearch', () => {});
                // this.$watch('userLogJson', () => {
                //     if (this.isSearch == false) {
                //         this.getUserLogs();
                //         this.getAllUserLogs();
                //     }
                // });


            },
            getUserLogs() {
                const setUserLogJson = (data) => {

                    this.userLogJson = JSON.parse(data);
                }

                $.ajax({
                    type: "GET",
                    url: "../dbHelper/loginReports.php",
                    data: {
                        startLimit: this.startLimit,
                        endLimit: this.endLimit,
                        type: "limitBy"
                    },
                    success: function(res) {
                        setUserLogJson(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            },
            getAllUserLogs() {

                const setUserLogJson = (data) => {
                    var pageLen = Math.ceil(JSON.parse(data).length / 10);
                    if (pageLen > 0) {
                        this.totalPages = parseInt(pageLen);
                    } else {
                        this.totalPages = 1;
                    }
                    // document.getElementById("1").style.background = "orange";

                }
                $.ajax({
                    type: "GET",
                    url: "../dbHelper/loginReports.php",
                    data: {
                        startLimit: 0,
                        endLimit: 0,
                        type: "All"
                    },
                    success: function(res) {
                        setUserLogJson(res);

                    },
                    error: function(res) {
                        console.log(res);
                    }
                });

            },
            getNextPage() {
                if (this.currentPage <= this.totalPages) {
                    document.getElementById(this.currentPage + 1).style.background = "orange";

                    document.getElementById(this.currentPage).style.background = "#007bff";
                    this.currentPage++;
                    this.startLimit = ((this.currentPage - 1) * 10);
                    this.endLimit = 10;

                    this.getUserLogs();
                }
            },
            getPrevPage() {


                if (this.currentPage > 1) {
                    document.getElementById(this.currentPage - 1).style.background = "orange";
                    document.getElementById(this.currentPage).style.background = "#007bff";

                    this.currentPage--;
                    this.startLimit = (this.currentPage - 1) * 10;
                    this.endLimit = 10;
                    this.getUserLogs();
                }
            },
            getCurrentPageData(e) {
                this.currentPage = e.target.innerText;
                document.getElementById(this.currentPage).style.background = "orange";
                if (this.currentPage >= 1) {
                    document.getElementById(this.currentPage - 1).style.background = "#007bff";
                }

                this.startLimit = ((this.currentPage - 1) * 10);
                this.endLimit = 10;
                this.getUserLogs();
            },
            updateReports() {
                var startDate = document.getElementById("startDate").value;
                var noOfUsers = document.getElementById("noOfUsers").value;
                var res = [];
                if (startDate == "" || noOfUsers == 0) {
                    swal({
                        title: "Error",
                        text: "Please enter all the fields",
                        type: "error",

                    });
                } else {
                    if (new Date(startDate) > new Date()) {
                        swal({
                            title: "Error",
                            text: "Please enter valid date",
                            type: "error",
                        });
                    } else {
                        console.log(new Date(startDate).getHours());
                        for (let i = 0; i < noOfUsers; i++) {
                            const random = Math.floor(Math.random() * this.allUsersList.length);
                            if (res.indexOf(this.allUsersList[random]) !== -1) {
                                continue;
                            };
                            res.push(this.allUsersList[random]);
                        };
                    }
                }
                // const randomString = (len, charSet) => {
                //     charSet = charSet || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                //     var randomString = '';
                //     for (var i = 0; i < len; i++) {
                //         var randomPoz = Math.floor(Math.random() * charSet.length);
                //         randomString += charSet.substring(randomPoz, randomPoz + 1);
                //     }
                //     return randomString;
                // }
                const reload = () => {

                    if (this.userLogJson.length == undefined) {
                        location.reload();
                    } else {
                        this.getUserLogs();
                        this.getAllUserLogs();
                    }
                    $("#exampleModalCenter").modal("hide");
                    location.reload();

                    // location.reload();
                };
                for (let i = 0; i < res.length; i++) {
                    var randomHours = Math.floor(Math.random() * (5 - 1 + 1)) + 1;;
                    var randomLogoutHours = Math.floor(Math.random() * (10 - 6 + 1)) + 6;
                    var randomMinutes1 = Math.floor(Math.random() * (60 - 1 + 1)) + 1;
                    var randomMinutes2 = Math.floor(Math.random() * (60 - 10 + 1)) + 10;

                    var startDate = new Date(startDate);
                    let startDateTime = new Date(new Date(startDate).setHours(new Date(startDate).getHours() + randomHours));
                    startDateTime = new Date(new Date(startDateTime).setMinutes(new Date(startDateTime).getMinutes() + randomMinutes1));
                    var endDate = new Date(startDate);
                    let endDateTime = new Date(new Date(endDate).setHours(new Date(endDate).getHours() + randomLogoutHours));
                    endDateTime = new Date(new Date(endDateTime).setMinutes(new Date(endDateTime).getMinutes() + randomMinutes2));
                    console.log(startDateTime.toLocaleString());
                    console.log(endDateTime.toLocaleString());
                    console.log(res[i].user_id);

                    $.ajax({
                        type: "GET",
                        url: "../dbHelper/updateUserlogs.php",
                        data: {
                            type: "AddUserLog",
                            userId: res[i].user_id,
                            startDate: startDateTime.toLocaleString(),
                            endDate: endDateTime.toLocaleString(),
                        },
                        success: function(res) {
                            if (res == "success") {
                                swal("Good job!", "Update Completed", "success");
                                reload();

                            }
                        },
                        error: function(res) {
                            swal({
                                title: "Errror",
                                text: "Update failed",
                                type: "error",

                            });
                            console.log(res);
                        }
                    });
                }

            },
            getAllUsers() {
                const assignUsers = (data) => {
                    this.allUsersList = JSON.parse(data);
                }
                $.ajax({
                    type: "GET",
                    url: "../dbHelper/updateUserlogs.php",
                    data: {
                        type: "allUsers"
                    },
                    success: function(res) {
                        assignUsers(res);
                    },
                    error: function(res) {
                        swal({
                            title: "Updation failed",
                            text: "Error Updation failed",
                            type: "error",

                        });
                    }
                });
            },
            exportReport() {
                var searchStartDate = document.getElementById("searchStartDate").value;
                var searchEndDate = document.getElementById("searchEndDate").value;
                const assignUserLogs = (data) => {
                    if (searchStartDate != "" || searchEndDate != "") {
                        var filename = "UserLogs.csv";
                        var ws = XLSX.utils.json_to_sheet(this.userLogJson);
                        var wb = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(wb, ws, "People");
                        XLSX.writeFile(wb, filename);
                    } else {
                        var filename = "UserLogs.csv";
                        var ws = XLSX.utils.json_to_sheet(JSON.parse(data));
                        var wb = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(wb, ws, "People");
                        XLSX.writeFile(wb, filename);
                    }
                }
                $.ajax({
                    type: "GET",
                    url: "../dbHelper/updateUserlogs.php",
                    data: {
                        type: "export"
                    },
                    success: function(res) {
                        assignUserLogs(res);
                    },
                    error: function(res) {
                        swal({
                            title: "Updation failed",
                            text: "Error Updation failed",
                            type: "error",

                        });
                    }
                });
            },
            getsearchUserLogs() {
                var searchStartDate = document.getElementById("searchStartDate").value;
                var searchEndDate = document.getElementById("searchEndDate").value;

                const setUserLogJson = (data) => {
                    this.isSearch = true;
                    this.userLogJson = JSON.parse(data);
                    // document.getElementById("1").style.background = "orange";
                };
                $.ajax({
                    type: "GET",
                    url: "../dbHelper/updateUserlogs.php",
                    data: {
                        startLimit: 0,
                        endLimit: 0,
                        type: "search",
                        searchStartDate: searchStartDate,
                        searchEndDate: searchEndDate,
                    },
                    success: function(res) {
                        setUserLogJson(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });

            },
            reload() {
                document.getElementById("searchStartDate").value = "";
                document.getElementById("searchEndDate").value = "";
                this.isSearch = false;
                this.userLogJson = [];
                this.totalPages=0;
                this.getUserLogs();
                this.getAllUserLogs();
            }
        }
    }
</script>


<?php include_once __DIR__ . '\footer.php' ?>