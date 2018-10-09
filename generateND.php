<?php
session_start();
require('fpdf/fpdf.php');
 if ($_SESSION['usertype'] == 1||!isset($_SESSION['usertype'])) {

        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
            
    }
class PDF extends FPDF
{
	var $row = 0;
// Page header
function Header()
{
    // Logo
    $this->Image('FA Logo.jpg',0,10,20);
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Move to the right
	$this->Cell(15);
	 $this->Cell(30,10,'Faculty Association,Inc.',0,0,'C');
	 $this->Ln(5);
	 $this->Cell(19);
	 $this->SetFont('Arial','',10);
	$this->Cell(30,10,'De La Salle University - Manila',0,0,'C');
    $this->Cell(80);
    // Title
   
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-20);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,5,'Page '.$this->PageNo().' of {nb}',0,0,'C');
	$this->ln();
	 $this->SetFont('Arial','',8);
	$this->Cell(0,5,'FACULTY ASSOCIATION',0,1,'C');
	$this->Cell(0,5,'2401 Taft Avenue, Malate, Manila Philippines',0,1,'C');
	$this->Cell(0,5,'(632) 524-4611 Ext. 332',0,1,'C');
}


}
if(isset($_SESSION['date'])){
     $date = $_SESSION['date'];
        
        $month = substr($date,0,strpos($date,"-"));
        $year = substr($date,strpos($date,"-")+1);

            if($month=="1"){
                $month = "January";
            }
            else if($month=="2"){
                $month = "February";
            }
            else if($month=="3"){
                $month = "March";
            }
            else if($month=="4"){
                $month = "April";
            }
            else if($month=="5"){
                $month = "May";
            }
            else if($month=="6"){
                $month = "June";
            }
            else if($month=="7"){
                $month = "July";
            }
            else if($month=="8"){
                $month = "August";
            }
            else if($month=="9"){
                $month = "September";
            }
            else if($month=="10"){
                $month = "October";
            }
            else if($month=="11"){
                $month = "November";
            }
            else if($month=="12"){
                $month = "December";
            }
        }
// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',10);
$pdf->Cell(0	,5,"Completed Deductions"	,0,1,'C');
date_default_timezone_set('Singapore');
$pdf->SetFont('Times','',10);
if($_SESSION['date']!="0")
    $pdf->Cell(0    ,5,"For ".$_SESSION['daystart']."-".$_SESSION['dayend']." of ".$month." ".$year ,0,1,'C');
$pdf->Cell(0	,5,"Generated by Melton at ".date("m/d/Y")." ".date("h:i:s a")	,0,1,'C');
$pdf->ln();
$pdf->SetFont('Times','B',10);
$pdf->Cell(15);
$pdf->Cell(20,5,''	,'L,T,R',0);
$pdf->Cell(50	,5,' '	,'L,T,R',0);
$pdf->Cell(30	,5,''	,'L,T,R',0);
$pdf->Cell(30   ,5,''   ,'L,T,R',0);
$pdf->Cell(35   ,5,''   ,'L,T,R',0);
$pdf->ln();
$pdf->Cell(15);
$pdf->Cell(20,5,'ID Number '	,'L,B,R',0,'C');
$pdf->Cell(50	,5,'Full Name'	,'L,B,R',0,'L');
$pdf->Cell(30	,5,'Loan Type'	,'L,B,R',0,'C');
$pdf->Cell(30   ,5,'Deduction Amount' ,'L,B,R',0,'R');
$pdf->Cell(35   ,5,'Deduction Frequency' ,'L,B,R',0,'L');

$pdf->ln();
$pdf->SetFont('Times','',10);
require_once('mysql_connect_FA.php');
$flag=0;
if($_SESSION['date'] != "0"){
        $date = $_SESSION['date'];
        $daystart = $_SESSION['daystart'];
        $dayend = $_SESSION['dayend'];
        $month = substr($date,0,strpos($date,"-"));
        $year = substr($date,strpos($date,"-")+1);
        $query="SELECT m.member_ID as 'ID', firstname as 'First',lastname as 'Last',middlename as 'Middle',l.per_payment as 'Amount'
        from member m  
        join loans l
        on l.member_id = m.member_id
        where loan_detail_id =1 and $month = Month(l.date_applied) AND $year = Year(l.date_applied) AND DAY(l.date_applied) between {$daystart} and {$dayend}
        group by m.member_ID";
    }
    else{
        $query="SELECT m.member_ID as 'ID', firstname as 'First',lastname as 'Last',middlename as 'Middle',l.per_payment as 'Amount'
        from member m
        
        
        join loans l
        on l.member_id = m.member_id
        join (SELECT max(date_applied) as 'Date' from loans where loan_detail_id = 1) latest
        where loan_detail_id =1 and date(latest.Date) = date(l.DATE_APPLIED)
        group by m.member_ID";
    }
	
$result=mysqli_query($dbc,$query);


while($row=mysqli_fetch_assoc($result)){
$last = $row['Last'];
$first = $row['First'];
$middle = $row['Middle'];





$pdf->Cell(15);
$pdf->Cell(20,5,$row['ID']	,'L,B,R',0,'C');
$pdf->Cell(50	,5,"$last, $first $middle"	,'L,B,R',0,'L');
$pdf->Cell(30   ,5,"FALP",'L,B,R',0,'L');
$pdf->Cell(30  ,5,sprintf("%.2f",(float)$row['Amount']),'L,B,R',0,'R');



        $pdf->Cell(35   ,5,"Per Payday" ,'L,B,R',0,'L');
        

$total= 0.00;	

$pdf->ln();



}

$pdf->SetFont('Times','B',12);


$pdf->Cell(0	,5,"--END OF REPORT--"	,0,0,'C');
$pdf->Output();
?>