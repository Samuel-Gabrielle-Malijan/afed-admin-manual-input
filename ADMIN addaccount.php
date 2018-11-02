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
require_once("mysql_connect_FA.php");
if ($_SESSION['usertype'] == 1||!isset($_SESSION['usertype'])) {

header("Location: http://".$_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF'])."/index.php");

}
$success = null;
if(isset($_POST['submit'])){
    $query="insert into employee(EMP_ID,PASSWORD,FIRSTNAME,LASTNAME,DATE_CREATED,ACC_STATUS,FIRST_CHANGE_PW)
values({$_POST['ID']},password({$_POST['password']}),'{$_POST['First']}','{$_POST['Last']}',date(now()),1,0)";
mysqli_query($dbc,$query);
$success = "yes";
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
                            Add Admin Account
                        </h1>
                    
                    </div>
                    
                </div>
                <!-- alert -->
                <div class="row">
                    <div class="col-lg-12">

                        <p><i>Fields with <big class="req">*</big> are required to be filled out and those without are optional.</i></p>

                        <!--Insert success page--> 
                        <form method="POST" action="ADMIN addaccount.php" id="addAccount" onSubmit="return checkform()">

                            <div class="addaccountdiv">
                                <label class="signfieldlabel">Admin ID Number</label><big class="req"> *</big>
                                <input name = "ID" type="text" id="ID" class="form-control signupfield" placeholder="e.g. 09700000">
                            </div><p>

                            <div class="addaccountdiv">
                                <label class="signfieldlabel">Password</label><big class="req"> *</big>
                                <input name = "password" type="password" id = "password" class="form-control signupfield" placeholder="Enter Password">
                            </div><p>

                            <div class="row">

                            	<div class="col-lg-3">

                            		<b>First Name:</b> <input name = "First" type="text" class="form-control" placeholder="First Name">

                            	</div>

                            	<div class="col-lg-3">

                                    <b>Last Name:</b> <input name = "Last" type="text" class="form-control" placeholder="Last Name">

                            	</div>

                            </div>&nbsp;

                            <div class="row">

                                <div class="col-lg-3">

                                    <div id="subbutton">

                                        <input type="submit" name = "submit" value="Create Admin" class="btn btn-success">

                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>
                </div>


            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
       
        
   
    <?php if (!empty($success)){
    echo "<script type='text/javascript'>alert('Success!');</script>";
}?>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
<script>
     function checkform(){

            
            var ID = document.getElementById("ID").value;
            var pass = document.getElementById("password").value;
            
            if(isEmpty(ID)||isEmpty(pass)){
                alert("A required field is empty!");
                return false;
                
            }
            return true;
            
        }

        function isEmpty(str) {
    return (!str || 0 === str.length);
}

    </script>
</body>

</html>
