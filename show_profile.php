<!DOCTYPE html>
<?php
$path = $_SERVER["DOCUMENT_ROOT"];
require_once($path."/db/mysql_credentials.php");
require($path."/includes/header.php");

if(!isset($_SESSION['email'])){
	header("location: /index.php");
}

$con = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);
if(isset($_SESSION['email'])) {

	$email = $_SESSION['email'];
	$query = "SELECT * from Utenti WHERE email ='$email'";

	$res = mysqli_query($con,$query);
	mysqli_close($con);
	$row= mysqli_fetch_array($res);
	mysqli_free_result($res);
	$first_name = $row['nome'];
	$last_name = $row['cognome'];
	$describe_user = $row['descrizione'];
	$user_country = $row['nazione'];
	$user_gender = $row['sesso'];
	$user_birthday = $row['data_nascita'];
	$user_image = $row['immagine_profilo'];
	$register_date = $row['reg_date'];
	$user_address =$row['address'];
}
?>

<html>
<head>
	<title><?php
	echo $first_name." ".$last_name; ?></title>
	<meta charset="utf-8">
	<meta content="author" name="Caruso Simone">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>
</head>
<body>
<style media="screen">
.img-dim{
	width: 200px;
	height: 200px;
}

.mydivouter{
position:relative;
	width: 200px;
	height: 200px;
	margin: 0 auto;
}
.mydivoverlap{
	position: relative;
	z-index: 1;
}
.mybuttonoverlap{
position: absolute;
	z-index: 2;
	bottom: 10px;
	display: none;
	left: 30px;
}
.mydivouter:hover .mybuttonoverlap{
display:block;
}
</style>

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<div id="user-profile" class="container mx-5" style="min-height: 100%;">
		<div class="row">
			<div class="col-xs-12 col-sm-3 text-center">
				<div class="mx-auto mt-3 d-block mydivouter">
					<img class="img-thumbnail img-fluid img-dim" alt=" Avatar" id="avatar2" src="/images/users/
					<?php if($user_image != null) echo $user_image;
					else echo "default-avatar.jpg";?>">
					<button type="button" class="mybuttonoverlap btn btn-secondary btn-sm" onclick="return selectImage();">Aggiorna Immagine</button>
					<form action="/php/update_profileimage.php" method="post" enctype="multipart/form-data">
    				<input type="file" name="fileToUpload" id="fileToUpload" oninput="return imageupload();" hidden="hidden">
    				<input type="submit" class="mybuttonoverlap btn btn-secondary btn-sm" hidden="hidden" name="uploadSubmit" id="uploadSubmit">
					</form>
				</div>
				</div>
				<div class="col-sm-9">
					<div class="row ml-3">
						<h4 class="col-9">
							<div><?php echo $first_name.' '.$last_name;?></div>
						</h4>
						<div class="text-right">
							<a href="/editprofile.php" style="font-size:14px;">Edit Profile</a>
						</div>
					</div>
					<div class="mt-2 ml-2">
						<div class="row" style="height: 10px;">
							<div class="col-2 text-secondary text-right">
								Nazione
							</div>
							<div class="col">
								<?php if($user_country != null) echo '<i class="fa fa-map-marker"></i>'.' '.$user_country;
								else  echo '-';?>
							</div>
						</div>
						<hr>
						<div class="row" style="height: 10px;">
							<div class="col-2 text-secondary text-right">
								Residente a
							</div>
							<div class="col">
								<div><?php echo $user_address; ?></div>
							</div>
						</div>
						<hr>
						<div class="row" style="height: 10px;">
							<div class="col-2 text-secondary text-right">
								Data di nascita
							</div>
							<div class="col">
								<div><?php if($user_birthday != null) echo $user_birthday;
								else  echo '-';?></div>
							</div>
						</div>
						<hr>
						<div class="row" style="height: 10px;">
							<div class="col-2 text-secondary text-right">
								Sesso
							</div>
							<div class="col">
								<?php if($user_gender != null) echo $user_gender;
								else  echo '-';?>
							</div>
						</div>
						<hr>
						<div class="row" style="height: 10px;">
							<div class="col-2 text-secondary text-right">
								Membro dal
							</div>
							<div class="col">
								<?php echo $register_date; ?>
							</div>
						</div>
						<hr>
					</div>
				</div>
				<div class="ml-5 mt-3">
					<h4 class="ml-3">
						<i class="ace-icon fa fa-check-square-o bigger-110"></i>
						Little About Me
					</h4>
					<div class="">
						<?php if($describe_user != null) echo $describe_user;
						else  echo '-';?>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="mt-5" >
			<?php include($path."/includes/footer.html"); ?>
		</div>
	</body>
	</html>

	<script type="text/javascript">
		function selectImage() {
	 		document.getElementById("fileToUpload").click();
		}

		function imageupload() {
				document.getElementById("uploadSubmit").click();
		}
	</script>
