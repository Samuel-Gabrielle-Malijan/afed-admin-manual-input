<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
require_once("mysql_connect_FA.php");
if ($_SESSION['usertype'] == 1) {

header("Location: http://".$_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF'])."/index.php");

}
if(isset($_POST['action'])){
    if($_POST['action']=="Add Health Aid"){
        $_SESSION['memberID'] = $_POST['details'];
        header("Location: http://".$_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF'])."/ADMIN MEMBERS HA application.php");
    }
    else{
        if($_POST['action']=="Reactivate Account"){
            $query1 = "UPDATE member
                      set USER_STATUS = 1
                      where MEMBER_ID = {$_POST['details']}  ";
        }
        else if($_POST['action']=="Deactivate Account"){
            $query1 = "UPDATE member
                      set USER_STATUS = 4
                      where MEMBER_ID = {$_POST['details']}  ";
                      
    }
     mysqli_query($dbc,$query1);
   
}

}
$query = "SELECT * FROM member m join ref_department d
          on m.dept_id = d.dept_id 
          join civ_status c
          on m.civ_status = c.status_id
          where m.member_id = {$_POST['details']}";
$result = mysqli_query($dbc,$query);
$ans = mysqli_fetch_assoc($result);
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
                        <form method = "POST" action = "ADMIN MEMBERS viewdetails.php">
                        <h1 class="page-header">
                            View Member Details
                           
                        </h1>
                    
                    </div>
                    
                </div>
                <!-- alert -->
                <div class="row">
                    <div class="col-lg-12">

                       <div class="row">

                            <div class="col-lg-12">

                                    <div class="panel panel-green">

                                        <div class="panel-heading">

                                            <b>Personal Information</b>

                                        </div>

                                        <div class="panel-body"><p>

                                            <b>ID Number: <?php echo $ans['MEMBER_ID']?></b> <p>
                                            <b>First Name: <?php echo $ans['FIRSTNAME']?></b> <p>
                                            <b>Last Name: <?php echo $ans['LASTNAME']?></b> <p>
                                            <b>Middle Name: <?php echo $ans['MIDDLENAME']?></b> <p>
                                            <b>Civil Status: <?php echo $ans['STATUS']?></b> <p>
                                            <b>Date of Birth: <?php echo $ans['BIRTHDATE']?></b> <p>
                                            <b>Sex:<?php if($ans['SEX']=="1")
                                                            echo "Male";
                                                            else
                                                                echo "Female";?></b> <p>
                                            
                                        </div>

                                    </div>

                                    <div class="panel panel-green">

                                        <div class="panel-heading">

                                            <b>Employment Information</b>

                                        </div>

                                        <div class="panel-body"><p>

                                            <b>Date of Hiring: <?php echo $ans['DATE_HIRED']?></b> <p>
                                            <b>Department: <?php echo $ans['DEPT_NAME']?></b> <p>

                                        </div>

                                    </div>

                                    <div class="panel panel-green">

                                        <div class="panel-heading">

                                            <b>Contact Information</b>

                                        </div>

                                        <div class="panel-body"><p>

                                            <b>Contact Number:</b> <p>
                                            <b>Home Phone Number: <?php echo $ans['HOME_NUM']?></b> <p>
                                            <b>Business Phone Number: <?php echo $ans['BUSINESS_NUM']?></b> <p>
                                            <b>Home Address: <?php echo $ans['HOME_ADDRESS']?></b> <p>
                                            <b>Business Address: <?php echo $ans['BUSINESS_ADDRESS']?></b> <p>
                                            <input type = "text" name = "details" value = <?php echo $_POST['details']?> hidden>
                                        </div>

                                    </div>

                                    <div class="panel panel-primary">

                                        <div class="panel-heading">

                                            <b>Actions</b>

                                        </div>

                                        <div class="panel-body"><p>
                                            <?php if($ans['USER_STATUS']=="4"){ 
                                                echo '<input type="submit" class="btn btn-success" name="action" value="Reactivate Account">';
                                                
                                            

                                            } else{
                                            echo '<input type="submit" class="btn btn-success" name="action" value="Add Health Aid"><p>';
                                            echo '<input type="submit" class="btn btn-danger" name="action" value="Deactivate Account">';
                                             }?>
                                        </div>

                                    </div>
                                </form>
                                    <a href="ADMIN MEMBERS viewmembers.php" class="btn btn-default">Go Back</a><p><p>&nbsp;

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
