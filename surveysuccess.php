<?php


$servername = "localhost";
$username = "stumagzc_survey";
$password = "^_X@[sZSvhF2";
$dbname="stumagzc_survey";


$nameErr = $collegeErr = $ratingErr = $q1Err = $q2Err =$q3Err =$q4Err = $q5Err = $q6Err = $expErr = " ";

if (!isset($_POST["name"]) || empty($_POST["name"]))
{
	$nameErr = "Name is required";
} 
else 
{
	$Name =$_POST["name"];
     //check if name only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z ]*$/",$Name)) 
	{
		$nameErr = "Only letters and white space allowed in Name"; 
	}
}


if (!isset($_POST["collegename"]) || empty($_POST["collegename"])) {
	$collegeErr = "College name is required ";
}
else {
	$Collegename =$_POST["collegename"];
    // check if name only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z ]*$/",$Collegename)) {
		$collegeErr = "Only letters and white space allowed in College name"; 
	}
}

if(!isset($_POST["rate"]) || (empty($_POST["rate"]))||(($_POST["rate"]!="1")&&($_POST["rate"]!="2")&&($_POST["rate"]!="3")&&($_POST["rate"]!="4")&&($_POST["rate"]!="5")))
{
	$ratingErr="Please select one on the List";	
}
else {
	$Rating=$_POST["rate"];
}

if(!isset($_POST["create"]) || (empty($_POST["create"]))||(($_POST["create"]!="yes")&&($_POST["create"]!="no")))
{
	$q1Err= "Please select one on the List";
}
else {
	$Q1=$_POST["create"]; 
}


if(!isset($_POST["myboard"]) || (empty($_POST["myboard"]))||(($_POST["myboard"]!="My feed")&&($_POST["myboard"]!="My Board")&&($_POST["myboard"]!="My College")&&($_POST["myboard"]!="Don't know")))
{

	$q2Err= "Please select one on the List";
}
else {
	$Q2=$_POST["myboard"];

}


if(!isset($_POST["follow"]) || (empty($_POST["follow"]))||(($_POST["follow"]!="yes")&&($_POST["follow"]!="no")))
{
	$q3Err= "Please select one on the List";
}
else {
	$Q3=$_POST["follow"];

}


if(!isset($_POST["feed"]) || (empty($_POST["feed"]))||(($_POST["feed"]!="My Board")&&($_POST["feed"]!="My College")&&($_POST["feed"]!="My Feed")&&($_POST["feed"]!="Don't know")))
{ 
	$q4Err= "Please select one on the List";
}
else {
	$Q4=$_POST["feed"];

}


if(!isset($_POST["connect"]) || (empty($_POST["connect"]))||(($_POST["connect"]!="yes")&&($_POST["connect"]!="no")))
{
	$q5Err= "Please select one on the List";
}
else {
	$Q5= $_POST["connect"];

}


if(!isset($_POST["board"]) || (empty($_POST["board"]))||(($_POST["board"]!="yes")&&($_POST["board"]!="no")))
{
	$q6Err= "Please select one on the List";
}
else {
	$Q6=$_POST["board"];

}



if(!isset($_POST["experience"]) || (empty($_POST["experience"]))||(($_POST["experience"]!="Awesome")&&($_POST["experience"]!="Nice and friendly")&&($_POST["experience"]!="confusing")))
{
	$expErr= "Please select one on the List";
}
else {
	$Experience=$_POST["experience"];

}


/*$Name= $_POST["name"];
$Collegename= $_POST["collegename"];
$Rating= $_POST["rate"];
$Q1= $_POST["create"];
$Q2= $_POST["myboard"];
$Q3= $_POST["follow"];
$Q4= $_POST["feed"];
$Q5= $_POST["connect"];
$Q6= $_POST["board"];
$Experience= $_POST["experience"];*/
$Suggestions = isset($_POST["suggestions"]) ? $_POST["suggestions"] : '';


if($nameErr==" "&& $collegeErr==" "&& $ratingErr==" " && $q1Err==" " && $q2Err==" "&& $q3Err==" "&& $q4Err==" " && $q5Err==" "&& $q6Err==" "&& $expErr==" ") 

{

	$conn = new mysqli($servername, $username,$password,$dbname);
	if($conn -> connect_errno) {
		echo "Sorry, " . $conn -> connect_error . " error occured . Please try again later! :(";
		session_destroy(); 
		exit;
	}
	$stmt = $conn->prepare("INSERT INTO `survey`(`Name`,`College_Name`,`Rating`,`Q1`,`Q2`,`Q3`,`Q4`,`Q5`,`Q6`,`Experience`,`Suggestions`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param("sssssssssss", $Name,$Collegename,$Rating,$Q1,$Q2,$Q3,$Q4,$Q5,$Q6,$Experience,$Suggestions);
	$er=$stmt->execute();
	if(!$er) {
		echo "Sorry, " . $conn -> error . " error occured . Please try again later! :(";
		session_destroy(); 
		mysqli_close($conn);
		exit;
	}
	else
	{
		session_destroy(); 
		mysqli_close($conn);
		?>
		<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>success</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
			<style type="text/css">
				@import url("http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css");

				header {
					text-align: center;
					color: #fff;
					background: #18bc9c;
					position: relative;
					width:100%;
					z-index: 1;
					height:500px;
					overflow: hidden;
					top: 0;
					left: 0;
				}
				header .container {
					padding-top: 60px;
					padding-bottom: 60px;
				}
				label
				{
					font-family: Helvetica;

				}
				.form_interns
				{

					font-family: Helvetica;

				}
				header img {
					display: block;
					margin: 0 auto 20px;
				}

				header .intro-text .name {
					display: block;
					text-transform: uppercase;
					font-family: Montserrat,"Helvetica Neue",Helvetica,Arial,sans-serif;
					font-size: 2em;
					font-weight: 700;
				}

				header .intro-text .skills {
					font-size: 1.25em;
					font-weight: 400;
				}

				hr.star-light,
				hr.star-primary {
					margin: 25px auto 30px;
					padding: 0;
					max-width: 250px;
					border: 0;
					border-top: solid 5px;
					text-align: center;
				}

				hr.star-light:after,
				hr.star-primary:after {
					content: "\f005";
					display: inline-block;
					position: relative;
					top: -.8em;
					padding: 0 .25em;
					font-family: FontAwesome;
					font-size: 2em;
				}

				hr.star-light {
					border-color: #fff;
				}

				hr.star-light:after {
					color: #fff;
					background-color: #18bc9c;
				}

				hr.star-primary {
					border-color: #2c3e50;
				}

				hr.star-primary:after {
					color: #2c3e50;
					background-color: #fff;
				}

				.stu-img
				{

					height:40px;
				}

				section {
					padding: 50px 0;
					width: 100%;
				}

				section h2 {
					margin: 0;
					font-size: 3em;
				}

				.submit:hover
				{
					color:#fff;
				}
				.logo
				{
					height:50px;margin:40px;
				}
				.goto,.goto:hover,.goto:focus
				{
					cursor:pointer;
					text-decoration:none;
					color:#fff;
					font-size:18px;
					margin:40px;
				}
				.flex_content
				{
					height: 500px;
					display:flex;
				}
				.child
				{
					margin:auto;
					display: flex;
				}
				h2
				{
					text-align: center;
					font-size: 40px;
					color: #fff;
					font-family: Montserrat,"Helvetica Neue",Helvetica,Arial,sans-serif;
				}
				.check
				{
					height:100px;
					margin:auto;
				}
				@media only screen and (max-width:767px)
				{
					.check
					{
						height:60px;
						margin:auto;
					}

					h2
					{
						font-size:28px;
					}
					header .container {
						padding-top: 0px;
						padding-bottom: 50px;
					}
					.goto,.goto:hover,.goto:focus
					{
						cursor:pointer;
						text-decoration:none;
						color:#fff;
						margin:20px;
						font-size:12px;
					}
					.logo
					{
						height: 30px;
						margin:15px;
					}
				}
				.input-field input
				{
					color:rgba(0,0,0,0.75);
				}
				.input-field label
				{
					font-weight: 500;
				}
			</style>

			<script
			src="https://code.jquery.com/jquery-3.1.1.min.js"
			integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
			crossorigin="anonymous"></script>
		</head>
		<body style="background: #18bc9c;">
			<div class="container-fluid" style="height:100px;background:#18bc9c;">
				<a href="https://www.stumagz.com" style="cursor:pointer">
					<img class="logo pull-left" src="stumagz.svg">
				</a>
				<a href="https://www.stumagz.com" class="goto pull-right">Go to stumagz.com</a>
			</div>

			<div class="container">
				<div class="col-xs-12 col-lg-12">
					<div class="flex_content">
						<div class="child">
							<img class="check" src="check_white.svg" style="">
							<h2>Thank You</h2>
						</div>
					</div>
				</div>
			</div>

		</body>
		<div class="container-fluid hidden-lg" style="background:#18bc9c">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<div class="text-center" style="color:#fff;text-align:center;vertical-align:middle;margin-top:55px;font-size:12px;">© 2015 Right Process Infotech Pvt Ltd. All Rights Reserved</div>
				</div>
			</div>
		</div>

		</html>
		<?php 
	}

} 
else {
	
	session_start();
	$_SESSION['name']=isset($name) ? $name : '';
	$_SESSION['collegename']=isset($Collegename) ? $Collegename : '';
	$_SESSION['rate']=isset($Rating) ? $Rating : null;
	$_SESSION['create']=isset($Q1) ? $Q1 : null;
	$_SESSION['myboard']=isset($Q2) ? $Q2 : null;
	$_SESSION['follow']=isset($Q3) ? $Q3 : null;
	$_SESSION['feed']=isset($Q4) ? $Q4 : null;
	$_SESSION['connect']=isset($Q5) ? $Q5 : null;
	$_SESSION['board']=isset($Q6) ? $Q6 : null;
	$_SESSION['experience']=isset($Experience) ? $Experience : null;
	$_SESSION['nameError']=$nameErr;
	$_SESSION['collegeError']=$collegeErr;
	$_SESSION['ratingError']=$ratingErr;
	$_SESSION['q1Error']=$q1Err;
	$_SESSION['q2Error']=$q2Err;
	$_SESSION['q3Error']=$q3Err;
	$_SESSION['q4Error']=$q4Err;
	$_SESSION['q5Error']=$q5Err;
	$_SESSION['q6Error']=$q6Err;
	$_SESSION['expError']=$expErr;
	header('Location: /');
	// exit;
	// echo $nameErr;
	// echo "<br>";
	// echo $collegeErr;
	// echo "<br>";
	// echo $ratingErr;
	// echo "<br>";
	// echo $q1Err;
	// echo "<br>";
	// echo $q2Err;
	// echo "<br>";
	// echo $q3Err;
	// echo "<br>";
	// echo $q4Err;
	// echo "<br>";
	// echo $q5Err;
	// echo "<br>";
	// echo $q6Err;
	// echo "<br>";
	// echo $expErr;
}
?>