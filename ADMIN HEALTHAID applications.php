<!DOCTYPE html>
<html lang="en">

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
    session_start();
    require_once('mysql_connect_FA.php');
    if ($_SESSION['usertype'] == 1||!isset($_SESSION['usertype'])) {

header("Location: http://".$_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF'])."/index.php");
}
     //Test value
    //$_SESSION['idnum']=1141231234;
    $_SESSION['showHAID'] = NULL;   // Health ID
    $_SESSION['showHAMID'] = NULL;  // Member ID of the loan

    $query = "SELECT MEMBER_ID FROM LOANS WHERE LOAN_ID = '{$_SESSION['showHAID']}'";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);

    $_SESSION['showHAMID'] = $row['MEMBER_ID'];

    If(isset($_POST['details'])){
        $_SESSION['showHAID'] = $_POST['details'];
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/ADMIN HEALTHAID appdetails.php");
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
                            Pending Health Aid Applications
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

                                        <?php 


                                            $query = "SELECT HA.DATE_APPLIED, M.MEMBER_ID, M.FIRSTNAME, M.LASTNAME, RD.DEPT_NAME FROM MEMBER M JOIN HEALTH_AID HA ON M.MEMBER_ID = HA.MEMBER_ID JOIN REF_DEPARTMENT RD ON M.DEPT_ID = RD.DEPT_ID WHERE HA.APP_STATUS='1';";
                                            $result = mysqli_query($dbc, $query);
                                            
                                            foreach ($result as $resultRow) {
                                                echo"
                                                    <tr>
                                                        <td align='center'>". $resultRow['DATE_APPLIED'] ."</td>
                                                        <td align='center'>". $resultRow['MEMBER_ID'] ."</td>
                                                        <td align='center'>". $resultRow['FIRSTNAME'] . " " .$resultRow['LASTNAME'] ."</td>
                                                        <td align='center'>". $resultRow['DEPT_NAME'] ."</td>
                                                        <td align='center'>&nbsp;&nbsp;&nbsp;<button type='submit' class='btn-xs btn-success' name='details' value='". $resultRow['MEMBER_ID'] ."'>Details</button>&nbsp;&nbsp;&nbsp;</td>
                                                    </tr>
                                                ";
                                            }
                                        ?>
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
