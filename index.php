<?php

//To Handle Session Variables on This Page
session_start();


//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cakri Portal</title>

    <!-- favicon    -->
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">

    <!-- <a target="_blank" href="https://icons8.com/icon/49502/permanent-job">Permanent Job</a> icon by <a target="_blank"
        href="https://icons8.com">Icons8</a> -->

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <!-- Custom -->
    <link rel="stylesheet" href="css/custom.css">
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
</head>

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

        <header class="main-header" style="background-color:white !important; position:fixed !important; width:100% !important;
  box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2) !important;
  ">

            <!-- Logo -->
            <a href="index.php" class="logo logo-bg">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <!-- <span class="logo-mini"><b>J</b>P</span> -->
                <!-- logo for regular state and mobile devices -->
                <!-- <span class="logo-lg"><b>Cakri <span style="color:white;
      font-style:italic;
      "
      > Portal</span></b></span> -->
                <!-- <span class="logo-lg"> -->
                <img class='cakri-logo' src="./img/CakriPortal.png" alt="">
                <!-- </span> -->

            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" style="padding:0.5rem !important">
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="jobs.php">
                                Jobs

                            </a>
                        </li>
                        <li>
                            <a href="#candidates">


                                Candidates

                            </a>
                        </li>
                        <li>
                            <a href="#company">


                                Company

                            </a>
                        </li>
                        <li>
                            <a href="#about">


                                About Us

                            </a>
                        </li>
                        <?php if (empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
                        <li>
                            <a href="login.php">


                                Login

                            </a>
                        </li>
                        <li>
                            <a href="sign-up.php">


                                Sign Up

                            </a>
                        </li>
                        <li>
                            <a href="admin/index.php">


                                Admin

                            </a>
                        </li>
                        <?php } else {

              if (isset($_SESSION['id_user'])) {
              ?>
                        <li>
                            <a href="user/index.php">Dashboard</a>
                        </li>
                        <?php
              } else if (isset($_SESSION['id_company'])) {
              ?>
                        <li>
                            <a href="company/index.php">Dashboard</a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="logout.php">Logout</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-left: 0px;">

            <section class="content-header bg-main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center index-head">
                            <h1 style="font-family: 'Montserrat', sans-serif !important;">Look for jobs on
                                <strong>Cakri<span style="color:#199FD9 !important;">Portal</span></strong>
                            </h1>
                            <p style="border-bottom: medium solid #fff;
            padding-bottom: 1rem;">Get your desired job through one search</p>
                            <p><a class="btn btn-success btn-lg" href="jobs.php" role="button" style="background-color: #199FD9 !important;
    color: white !important;
    border-radius: 8px;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2) !important;
    padding:14px !important;
    ">Search Jobs</a></p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 latest-job margin-bottom-20">
                            <h1 class="text-center" style="
            text-align: center !important;
            font-weight: 600 !important;

            ">Recent <span style="color: #199FD9 !important;">Jobs</span></h1>
                            <?php
              /* Show any 4 random job post
           *
           * Store sql query result in $result variable and loop through it if we have any rows
           * returned from database. $result->num_rows will return total number of rows returned from database.
          */
              $sql = "SELECT * FROM job_post Order By Rand() Limit 4";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
                  $result1 = $conn->query($sql1);
                  if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
              ?>
                            <div style="
              background-color: rgba(88, 85, 87, 0.8) !important;
              color: white !important;
                border-radius: 10px !important;
                padding: 9px !important;
              " class="attachment-block clearfix">

                                <img class="attachment-img" src="uploads/logo/<?php echo $row1['logo']; ?>"
                                    alt="companylogo" style="height: 50px !important; width:50px !important;">
                                <div class="attachment-pushed">
                                    <h4 style="color: white !important;" class="attachment-heading"><a style="text-transform: capitalize !important;
                color: white !important;
                " href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a>
                                        <span class="attachment-heading pull-right">Tk
                                            <?php echo $row['maximumsalary']; ?> /Month</span>
                                    </h4>
                                    <div style="color: white !important;" class="attachment-text">
                                        <div><strong><?php echo $row1['companyname']; ?> | <?php echo $row1['city']; ?>
                                                | Experience <?php echo $row['experience']; ?> Years</strong></div>
                                    </div>
                                </div>
                            </div>
                            <?php
                    }
                  }
                }
              }
              ?>

                        </div>
                    </div>
                </div>
            </section>

            <section id="candidates" class="content-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center latest-job margin-bottom-20

          ">
                            <h1 style=" font-weight: 600 !important;
            color: #199FD9 !important;
            ">Candidates</h1>
                            <p style="font-size:2rem !important;">Finding a job just got easier. Create a profile and
                                apply with single mouse click.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div style="border-radius: 8px !important;" class="col-sm-4 col-md-4">
                            <div class="thumbnail candidate-img">
                                <img src="img/browse.jpg" alt="Browse Jobs">
                                <div class="caption">
                                    <h3 class="text-center" style="color: #199FD9 !important;
                 font-weight: 600 !important;
                ">Browse <span style="color:black">Jobs</span></h3>
                                </div>
                            </div>
                        </div>
                        <div style="
         border-radius: 8px !important;
          " class="col-sm-4 col-md-4">
                            <div class="thumbnail candidate-img">
                                <img src="img/interviewed.jpeg" alt="Apply & Get Interviewed">
                                <div class="caption">
                                    <h3 style="color: #199FD9 !important;
                 font-weight: 600 !important;
                " class="text-center">Apply & <span style="color:black">Get Interviewed</span></h3>
                                </div>
                            </div>
                        </div>
                        <div style="
        border-radius: 8px !important;
          " class="col-sm-4 col-md-4">
                            <div class="thumbnail candidate-img">
                                <img src="img/office.jpg" alt="Start A Career">
                                <div class="caption">
                                    <h3 style="color: #199FD9 !important;
                 font-weight: 600 !important;
                " class="text-center">Start <span style="color:black">Career</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="company" class="content-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center latest-job margin-bottom-20">
                            <h1 style=" font-weight: 600 !important;
            margin-top:5rem !important;
            padding-bottom: 2rem !important;
            border-bottom: 2.5px solid black !important;
            ">Companies</h1>
                            <p style="font-size:2rem !important;
            color: #199FD9 !important;
            margin-top:4rem !important;
            margin-bottom:2rem !important;
            "> <span style="color:black">Hiring? </span>Register your company for free, browse our talented pool, post
                                and track job applications</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="thumbnail company-img">
                                <img src="img/hiring.jpg" alt="Browse Jobs">
                                <div class="caption">
                                    <h3 class="text-center" style="color: #199FD9 !important;
                 font-weight: 600 !important;
                ">Post A <span style="color:black">Job<span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="thumbnail company-img">
                                <img src="img/track.jpg" alt="Apply & Get Interviewed">
                                <div class="caption">
                                    <h3 class="text-center" style="color: #199FD9 !important;
                 font-weight: 600 !important;
                ">Manage & <span style="color:black">Track</span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="thumbnail company-img">
                                <img src="img/hired.jpg" alt="Start A Career">
                                <div class="caption">
                                    <h3 class="text-center" style="color: #199FD9 !important;
                 font-weight: 600 !important;
                ">Hire</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="statistics" class="content-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center latest-job margin-bottom-20">
                            <h1 style=" font-weight: 600 !important;
           color: black !important;
           ">Our <span style="color:#199FD9 !important;">Statistics</span></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <?php
                  $sql = "SELECT * FROM job_post";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    $totalno = $result->num_rows;
                  } else {
                    $totalno = 0;
                  }
                  ?>
                                    <h3><?php echo $totalno; ?></h3>

                                    <p>Job Offers</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-paper"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <?php
                  $sql = "SELECT * FROM company WHERE active='1'";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    $totalno = $result->num_rows;
                  } else {
                    $totalno = 0;
                  }
                  ?>
                                    <h3><?php echo $totalno; ?></h3>

                                    <p>Registered Company</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-briefcase"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <?php
                  $sql = "SELECT * FROM users WHERE resume!=''";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    $totalno = $result->num_rows;
                  } else {
                    $totalno = 0;
                  }
                  ?>
                                    <h3><?php echo $totalno; ?></h3>

                                    <p>CV'S/Resume</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-list"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <?php
                  $sql = "SELECT * FROM users WHERE active='1'";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    $totalno = $result->num_rows;
                  } else {
                    $totalno = 0;
                  }
                  ?>
                                    <h3><?php echo $totalno; ?></h3>

                                    <p>Daily Users</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-stalker"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>
            </section>

            <section id="about" class="content-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center latest-job margin-bottom-20">
                            <h1 style=" font-weight: 600 !important;
           color: black !important;
           ">About <span style="color:#199FD9 !important;">Us</span></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="img/browse.jpg" class="img-responsive">
                        </div>
                        <div class="col-md-6 about-text margin-bottom-20" style="margin-bottom:8rem !important;">
                            <p>The CakriPortal application allows job seekers and recruiters to connect. The application
                                provides the ability for job seekers to create their accounts, upload their profile and
                                resume, search for jobs, apply for jobs, view different job openings. The application
                                provides the ability for companies to create their accounts, search candidates, create
                                job postings, and view candidates applications.
                            </p>
                            <p>
                                This website is used to provide a platform for potential candidates to get their dream
                                job and excel in yheir career.
                                This site can be used as a paving path for both companies and job-seekers for a better
                                life .

                            </p>

                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer" style="margin-left: 0px;">
            <div style="font-size:2rem !important;
    font-weight: 400 !important;
    " class="text-center">
                <strong>Copyright &copy; 2022 <a href="index.php">Cakri Portal</a>.</strong> All rights
                reserved.
            </div>
        </footer>

        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="js/adminlte.min.js"></script>
</body>

</html>