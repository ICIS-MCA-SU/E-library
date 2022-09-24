<?php include_once __DIR__. '\header.php';
include_once '..\dbHelper\dbhelper.php';
?>

<div class="main-content">
    <section class="section">
        <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">New Registrations</h5>
                                        <?php
                                        $totalRegistration =(new dbhelper)->__getNewRegistrationCount();
                                        ?>
                                        <h2 class="mb-3 font-18"><?php echo $totalRegistration;?></h2>
<!--                                        <p class="mb-0"><span class="col-green">10%</span> Increase</p>-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/1.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15"> Orders Requests</h5>
                                        <?php
                                        $totalOders =(new dbhelper)->__getTotalOrdersCount();
                                        ?>
                                        <h2 class="mb-3 font-18"><?php echo $totalOders ?></h2>
<!--                                        <p class="mb-0"><span class="col-orange">09%</span> Decrease</p>-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/2.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Return requests</h5>
                                        <?php
                                        $totalReturnRequests =(new dbhelper)->__getReturnRequestCount();
                                        ?>
                                        <h2 class="mb-3 font-18"><?php echo $totalReturnRequests;?></h2>
<!--                                        <p class="mb-0"><span class="col-green">18%</span>-->
<!--                                            Increase</p>-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/3.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Pending Returns</h5>
                                        <?php
                                        $totalPendingReturns =(new dbhelper)->__getPendingReturns();
                                        ?>
                                        <h2 class="mb-3 font-18"><?php echo $totalPendingReturns?></h2>
<!--                                        <p class="mb-0"><span class="col-green">42%</span> Increase</p>-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/4.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Chart</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart4" class="chartsh"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Chart</h4>
                    </div>
                    <div class="card-body">
                        <div class="summary">
                            <div class="summary-chart active" data-tab-group="summary-tab" id="summary-chart">
                                <div id="chart3" class="chartsh"></div>
                            </div>
                            <div data-tab-group="summary-tab" id="summary-text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Chart</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart2" class="chartsh"></div>
                    </div>
                </div>
            </div>
        </div>

<!--        <div class="row">-->
<!--            <div class="col-md-6 col-lg-12 col-xl-6">-->

<!--                <div class="card">-->
<!--                    <div class="card-header">-->
<!--                        <h4>Users Enquires</h4>-->
<!--                        <form class="card-header-form">-->
<!--                            <input type="text" name="search" class="form-control" placeholder="Search">-->
<!--                        </form>-->
<!--                    </div>-->
<!--                    <div class="card-body">-->
<!--                        <div class="support-ticket media pb-1 mb-3">-->
<!--                            <img src="assets/img/users/user-1.png" class="user-img mr-2" alt="">-->
<!--                            <div class="media-body ml-3">-->
<!--                                <div class="badge badge-pill badge-success mb-1 float-right">Feature</div>-->
<!--                                <span class="font-weight-bold">#89754</span>-->
<!--                                <a href="javascript:void(0)">Please add advance table</a>-->
<!--                                <p class="my-1">Hi, can you please add new table for advan...</p>-->
<!--                                <small class="text-muted">Created by <span class="font-weight-bold font-13">John-->
<!--                          Deo</span>-->
<!--                                    &nbsp;&nbsp; - 1 day ago</small>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="support-ticket media pb-1 mb-3">-->
<!--                            <img src="assets/img/users/user-2.png" class="user-img mr-2" alt="">-->
<!--                            <div class="media-body ml-3">-->
<!--                                <div class="badge badge-pill badge-warning mb-1 float-right">Bug</div>-->
<!--                                <span class="font-weight-bold">#57854</span>-->
<!--                                <a href="javascript:void(0)">Select item not working</a>-->
<!--                                <p class="my-1">please check select item in advance form not work...</p>-->
<!--                                <small class="text-muted">Created by <span class="font-weight-bold font-13">Sarah-->
<!--                          Smith</span>-->
<!--                                    &nbsp;&nbsp; - 2 day ago</small>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="support-ticket media pb-1 mb-3">-->
<!--                            <img src="assets/img/users/user-3.png" class="user-img mr-2" alt="">-->
<!--                            <div class="media-body ml-3">-->
<!--                                <div class="badge badge-pill badge-primary mb-1 float-right">Query</div>-->
<!--                                <span class="font-weight-bold">#85784</span>-->
<!--                                <a href="javascript:void(0)">Are you provide template in Angular?</a>-->
<!--                                <p class="my-1">can you provide template in latest angular 8.</p>-->
<!--                                <small class="text-muted">Created by <span class="font-weight-bold font-13">Ashton Cox</span>-->
<!--                                    &nbsp;&nbsp; -2 day ago</small>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="support-ticket media pb-1 mb-3">-->
<!--                            <img src="assets/img/users/user-6.png" class="user-img mr-2" alt="">-->
<!--                            <div class="media-body ml-3">-->
<!--                                <div class="badge badge-pill badge-info mb-1 float-right">Enhancement</div>-->
<!--                                <span class="font-weight-bold">#25874</span>-->
<!--                                <a href="javascript:void(0)">About template page load speed</a>-->
<!--                                <p class="my-1">Hi, John, can you work on increase page speed of template...</p>-->
<!--                                <small class="text-muted">Created by <span class="font-weight-bold font-13">Hasan-->
<!--                          Basri</span>-->
<!--                                    &nbsp;&nbsp; -3 day ago</small>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <a href="javascript:void(0)" class="card-footer card-link text-center small ">View-->
<!--                        All</a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-6 col-lg-12 col-xl-6">-->
<!--                <div class="card">-->
<!--                    <div class="card-header">-->
<!--                        <h4>Books in Demand</h4>-->
<!--                    </div>-->
<!--                    <div class="card-body">-->
<!--                        <div class="table-responsive">-->
<!--                            <table class="table table-hover mb-0">-->
<!--                                <thead>-->
<!--                                <tr>-->
<!--                                    <th>#</th>-->
<!--                                    <th>Client Name</th>-->
<!--                                    <th>Date</th>-->
<!--                                    <th>Payment Method</th>-->
<!--                                    <th>Amount</th>-->
<!--                                </tr>-->
<!--                                </thead>-->
<!--                                <tbody>-->
<!--                                <tr>-->
<!--                                    <td>1</td>-->
<!--                                    <td>John Doe </td>-->
<!--                                    <td>11-08-2018</td>-->
<!--                                    <td>NEFT</td>-->
<!--                                    <td>$258</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>2</td>-->
<!--                                    <td>Cara Stevens-->
<!--                                    </td>-->
<!--                                    <td>15-07-2018</td>-->
<!--                                    <td>PayPal</td>-->
<!--                                    <td>$125</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>3</td>-->
<!--                                    <td>-->
<!--                                        Airi Satou-->
<!--                                    </td>-->
<!--                                    <td>25-08-2018</td>-->
<!--                                    <td>RTGS</td>-->
<!--                                    <td>$287</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>4</td>-->
<!--                                    <td>-->
<!--                                        Angelica Ramos-->
<!--                                    </td>-->
<!--                                    <td>01-05-2018</td>-->
<!--                                    <td>CASH</td>-->
<!--                                    <td>$170</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>5</td>-->
<!--                                    <td>-->
<!--                                        Ashton Cox-->
<!--                                    </td>-->
<!--                                    <td>18-04-2018</td>-->
<!--                                    <td>NEFT</td>-->
<!--                                    <td>$970</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>6</td>-->
<!--                                    <td>-->
<!--                                        John Deo-->
<!--                                    </td>-->
<!--                                    <td>22-11-2018</td>-->
<!--                                    <td>PayPal</td>-->
<!--                                    <td>$854</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>7</td>-->
<!--                                    <td>-->
<!--                                        Hasan Basri-->
<!--                                    </td>-->
<!--                                    <td>07-09-2018</td>-->
<!--                                    <td>Cash</td>-->
<!--                                    <td>$128</td>-->
<!--                                </tr>-->
<!--                                </tbody>-->
<!--                            </table>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!---->
<!---->
<!--        <div class="row">-->
<!--            <div class="col-lg-6 col-md-12 col-12 col-sm-12">-->
<!--                <div class="card mt-sm-5 mt-md-0">-->
<!--                    <div class="card-header">-->
<!--                        <h4>Visitors</h4>-->
<!--                    </div>-->
<!--                    <div class="card-body">-->
<!--                        <canvas id="donutChart"></canvas>-->
<!--                        <ul class="p-t-30 list-unstyled">-->
<!--                            <li class="padding-5"><span><i class="fa fa-circle m-r-5 col-black"></i></span>Search Engines<span-->
<!--                                        class="float-right">30%</span></li>-->
<!--                            <li class="padding-5"><span><i class="fa fa-circle m-r-5 col-green"></i></span>Direct Click<span-->
<!--                                        class="float-right">50%</span></li>-->
<!--                            <li class="padding-5"><span><i class="fa fa-circle m-r-5 col-orange"></i></span>Video Click<span-->
<!--                                        class="float-right">20%</span></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </div>-->

    </section>
    <div class="settingSidebar">
        <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
        </a>
        <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
                <div class="setting-panel-header">Setting Panel
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Select Layout</h6>
                    <div class="selectgroup layout-color w-50">
                        <label class="selectgroup-item">
                            <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                            <span class="selectgroup-button">Light</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                            <span class="selectgroup-button">Dark</span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Sidebar Color</h6>
                    <div class="selectgroup selectgroup-pills sidebar-color">
                        <label class="selectgroup-item">
                            <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                  data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                  data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Color Theme</h6>
                    <div class="theme-setting-options">
                        <ul class="choose-theme list-unstyled mb-0">
                            <li title="white" class="active">
                                <div class="white"></div>
                            </li>
                            <li title="cyan">
                                <div class="cyan"></div>
                            </li>
                            <li title="black">
                                <div class="black"></div>
                            </li>
                            <li title="purple">
                                <div class="purple"></div>
                            </li>
                            <li title="orange">
                                <div class="orange"></div>
                            </li>
                            <li title="green">
                                <div class="green"></div>
                            </li>
                            <li title="red">
                                <div class="red"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                   id="mini_sidebar_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Mini Sidebar</span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                   id="sticky_header_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Sticky Header</span>
                        </label>
                    </div>
                </div>
                <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                    <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                        <i class="fas fa-undo"></i> Restore Default
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once __DIR__. '\footer.php' ?>
