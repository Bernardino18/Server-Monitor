<?php
/*$msg = server_connect();
$iphlist = explode(":", $msg);
$host = 0;
$cip = explode("\\", $iphlist[$host]);
$msg = connect($cip[1]);
$msgsplt = explode(":", $msg);
for($i=0; $i<sizeof($msgsplt); $i++){
	$msgsplt[$i] = explode("*", $msgsplt[$i]);
}*/
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!--<meta http-equiv="refresh" content="5;url=/">-->
  <title>Admin Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="icon" type="image/png" href="img/favicon.png" />

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top" >

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading 
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
	  </div>-->
      <div style="display:inline-block;margin:10px;" class="text-center container align-items-right">
        <h1 id="pcn" style="display:inline-block;width:50%;" class="h3 mb-0 text-grey-800">Unable to connect to server</h1>
        <input id="droplist" list="hostlist" style="display:inline-block;width:49%;text-align:right;" name="host" onsubmit="h2ip($(#hostlist).value)">
        <datalist id="hostlist">
        </datalist>
      </div>
          <div class="row">
            <div id="error" class="col-md-4 col-md-offset-2 text-center">
              <img src="img/error.gif" alt="Error">
            </div>
            <!-- Area Chart -->
            <div id="ada0" class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 id="ethdesc0" class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart0"></canvas>
                    </div>
                </div>
              </div>
            </div>
            
            <!-- Area Chart -->
            <div id="ada1" class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 id="ethdesc1" class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart1"></canvas>
                    </div>
                </div>
              </div>
            </div>

            <!-- Area Chart -->
            <div id="ada2" class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 id="ethdesc2" class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart2"></canvas>
                    </div>
                </div>
              </div>
            </div>

            <!-- Area Chart -->
            <div id="ada3" class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 id="ethdesc3" class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart3"></canvas>
                    </div>
                </div>
              </div>
            </div>

            <!-- Area Chart -->
            <div id="ada4" class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 id="ethdesc4" class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart4"></canvas>
                    </div>
                </div>
              </div>
            </div>

             <!-- Area Chart -->
             <div id="ada5" class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 id="ethdesc5" class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart5"></canvas>
                    </div>
                </div>
              </div>
            </div>
    
            
            <!-- Pie Chart -->
            <div class="col-xl-6 col-lg-6" id="divpie_cpu">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6  class="m-0 font-weight-bold text-primary">CPU</h6>
                  <div id="verification"></div>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Menu:</div>
                      <a class="dropdown-item" data-toggle="modal" data-target="#cpu_modal" href="#">Create Action</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="pie_cpu"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                      <span class="mr-2">
                          <i class="fas fa-circle text-primary"></i> Used
                      </span>
                      <span class="mr-2">
                          <i class="fas fa-circle text-success"></i> Available
                      </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 mb-6" id="divpie_ram">
                <!-- Pie Chart -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">RAM</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Menu:</div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#ram_modal" href="#">Create Action</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="pie_ram"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Used
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Available
                            </span>
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4" id="div_cpuram_progress">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Max Values</h6>
                </div>
                <div id="maxvalues" class="card-body">
                  <h4 class="small font-weight-bold">CPU Max <span id="cpumaxt" class="float-right">20%</span></h4>
                  <div class="progress mb-4">
                    <div id="cpumax" class="progress-bar bg-success" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Ram Max <span id="rammaxt" class="float-right">40%</span></h4>
                  <div class="progress mb-4">
                    <div id="rammax" class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>

              

            
          </div>
            
            </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <div class="modal fade" id="cpu_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">CPU Actions</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row" style="margin:10px">
                <div class="col-md-6">
                  <select name="action-operation" id="cpu_action-operation" class="form-control">
                    <option value="BT">></option>
                    <option value="ST"><</option>
                    <option value="ET">=</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <input id="cpu_value" type="number" min="0" max="100" class="form-control">
                </div>
                
              </div>
              <br>
              <div class="row">

                <div class="col-md-12">
                  <input type="text" id="cpu_command" class="form-control" placeholder="command">
                </div>
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="cpu_submit" data-dismiss="modal" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="ram_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">RAM Actions</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row" style="margin:10px">
                <div class="col-md-6">
                  <select name="action-operation" id="ram_action-operation" class="form-control">
                    <option value="BT">></option>
                    <option value="ST"><</option>
                    <option value="ET">=</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <input id="ram_value" type="number" value="0" min="0" class="form-control">
                </div>
                
              </div>
              <br>
              <div class="row">

                <div class="col-md-12">
                  <input type="text" id="ram_command" class="form-control" placeholder="command">
                </div>
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="ram_submit" data-dismiss="modal" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Bernardino Sousa and Alexandre Alves 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/balls.js"></script>
</body>

</html>
