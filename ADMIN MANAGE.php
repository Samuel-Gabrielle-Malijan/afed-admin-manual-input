<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
require_once("mysql_connect_FA.php");
if ($_SESSION['usertype'] == 1||!isset($_SESSION['usertype'])) {

header("Location: http://".$_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF'])."/index.php");

}
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <link href="css/montserrat.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> 
    </script>

     <script> $(function(){
        $('#load').load('navBar.php');
     });
    </script>
</head>

<body>

    <div id="wrapper">

        <div id = "load">
        </div>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Admin Management
                        </h1>
                    
                    </div>
                    
                </div>
                <!-- alert -->
                <div class="row">

                    <div class="col-lg-12">

                        <div class="alert alert-info">

                            <strong>Here, you can edit what modules that other admins of the system could access</strong>

                        </div>

                       <div class="row">

                            <div class="col-lg-12">

                                <form action="ADMIN MANAGE acl.php" method="POST"> <!-- SERVER SELF -->

                                <table id="table" class="table table-bordered table-striped">
                                    
                                    <thead>

                                        <tr>

                                        <td align="center" width="300px"><b>Admin ID Number</b></td>
                                        <td align="center" width="600px"><b>Name</b></td>
                                        <td align="center"><b>Manage Access Control List</b></td>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr>

                                        <td align="center">11436786</td>
                                        <td align="center">Patrick Mijares </td>
                                        <td align="center">&nbsp;&nbsp;&nbsp;<input type="submit" name="details" class="btn btn-success" value="Details">&nbsp;&nbsp;&nbsp;</td>

                                        </tr>

                                        <tr>

                                        <td align="center">11436786</td>
                                        <td align="center">Patrick Mijares </td>
                                        <td align="center">&nbsp;&nbsp;&nbsp;<input type="submit" name="details" class="btn btn-success" value="Details">&nbsp;&nbsp;&nbsp;</td>

                                        </tr>

                                        <tr>

                                        <td align="center">11436786</td>
                                        <td align="center">Patrick Mijares </td>
                                        <td align="center">&nbsp;&nbsp;&nbsp;<input type="submit" name="details" class="btn btn-success" value="Details">&nbsp;&nbsp;&nbsp;</td>

                                        </tr>

                                    </tbody>

                                </table>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <script>

        $(document).ready(function(){
    
            $('#table').DataTable();

        });

    </script>

</body>

</html>
