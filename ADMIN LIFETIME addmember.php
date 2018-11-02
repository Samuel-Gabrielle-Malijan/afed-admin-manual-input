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

<?php

    $queryMem = "SELECT M.MEMBER_ID, M.LASTNAME, M.FIRSTNAME, M.DATE_HIRED, RD.DEPT_NAME FROM MEMBER AS M
                 JOIN REF_DEPARTMENT AS RD ON RD.DEPT_ID = M.DEPT_ID
                 WHERE YEAR(NOW()) - YEAR(DATE_HIRED) >= 10 AND MEMBERSHIP_STATUS = 2 AND USER_STATUS = 1;";

    $resultMem = mysqli_query($dbc, $queryMem);

    if (isset($_POST['submit'])) {

        $_SESSION['lifetime_selected_id'] = $_POST['submit'];

        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/ADMIN LIFETIME appdetails.php");

    }

?>

<body>

    <div id="wrapper">

        <div id = "load">
        </div>
        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Eligible Members for Lifetime
                        </h1>
                    
                    </div>
                    
                </div>
                <!-- alert -->
                <div class="row">
                    <div class="col-lg-12">

                       <div class="row">

                            <div class="col-lg-12">

                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> <!-- SERVER SELF -->

                                <table id="table" class="table table-bordered table-striped">
                                    
                                    <thead>

                                        <tr>

                                        <td align="center"><b>Date Applied</b></td>
                                        <td align="center"><b>ID Number</b></td>
                                        <td align="center"><b>Name</b></td>
                                        <td align="center"><b>Department</b></td>
                                        <td align="center"><b>Actions</b></td>


                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php foreach ($resultMem as $rowMem) { ?>

                                            <?php

                                                $queryLifetime = "SELECT MEMBER_ID FROM LIFETIME 
                                                                  WHERE MEMBER_ID = '{$rowMem['MEMBER_ID']}' AND (APP_STATUS = 2 OR APP_STATUS = 3);";

                                                $resultLifetime = mysqli_query($dbc, $queryLifetime);
                                                $rowLifetime = mysqli_fetch_array($resultLifetime);

                                                if (empty($rowLifetime)) {

                                            ?>

                                            <tr>

                                            <td align="center"><?php echo $rowMem['DATE_HIRED'] ?></td>
                                            <td align="center"><?php echo $rowMem['MEMBER_ID'] ?></td>
                                            <td align="center"><?php echo $rowMem['FIRSTNAME'] . " " . $rowMem['LASTNAME'] ?></td>
                                            <td align="center"><?php echo $rowMem['DEPT_NAME'] ?></td>
                                            <td align="center">&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" class="btn btn-success" value="<?php echo $rowMem['MEMBER_ID'] ?>">Details</button>&nbsp;&nbsp;&nbsp;</td>

                                            </tr>

                                            <?php } ?>

                                        <?php } ?>

                                    </tbody>

                                </table><p>

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
