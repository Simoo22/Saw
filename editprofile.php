<!DOCTYPE html>
<?php

$path = $_SERVER["DOCUMENT_ROOT"];
require_once($path."/db/mysql_credentials.php");
require($path."/php/header.php");

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
	$user_city = $row['comune'];
	$user_province = $row['provincia'];
	$user_CAP = $row['CAP'];
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
	<div id="user-profile" class="container mx-5">
		<div class="row">
			<div class="col-xs-12 col-sm-3 text-center">
				<div class="mx-auto mt-3 d-block mydivouter">
					<img class="img-thumbnail img-fluid img-dim" alt=" Avatar" id="avatar2" src="/images/users/
					<?php if($user_image != null) echo $user_image;
					else echo "default-avatar.jpg";?>">
					<button type="button" class="mybuttonoverlap btn btn-secondary btn-sm" onclick="return selectImage();">Aggiorna Immagine</button>
					<form action="/php/upadate_profileimage.php" method="post" enctype="multipart/form-data">
    				<input type="file" name="fileToUpload" id="fileToUpload" oninput="return imageupload();" hidden="hidden">
    				<input type="submit" class="mybuttonoverlap btn btn-secondary btn-sm" hidden="hidden" name="uploadSubmit" id="uploadSubmit">
					</form>
				</div>
			</div>
			<div class="col-sm-9">
				<form class="needs-validation" action="/php/update_profile.php" method="post" novalidate>
					<div class="form-group row ml-5" style="">
						<label for="nome" class="col-sm-1 col-form-label text-right text-muted">Nome</label>
						<div class="col-md-3">
							<input class="form-control text-dark" type="text" name="nome" value="<?php echo $first_name ?>" required>
						</div>
						<label for="cognome" class="col-sm-2 col-form-label text-right text-muted">Cognome</label>
						<div class="col-md-3">
							<input class="form-control text-dark" type="text" name="cognome" value="<?php echo $last_name ?>" required>
						</div>
					</div>
					<hr>
					<div class="form-group row">
						<label for="nazione" class="col-sm-2 col-form-label text-right text-muted" onselect="return check_indirizzo();">Nazione</label>
						<div class="form-group col-md-4">
							<select id="nazione" class="form-control" name="nazione" required>
								<?php if($user_country != null) echo "<option value='$user_country' selected>$user_country</option>";
								else echo "<option value='Italia' selected>Italia</option>";?>
								<?php include($path."/html/countries.html"); ?>
							</select>
						</div>
					</div>
					<hr>
					<div class="form-group row">
						<label for="nome" class="col-sm-2 col-form-label text-right text-muted">Città</label>
						<div class="form-group col-md-4" >
							<input class="form-control text-dark" type="text" name="city" value="<?php if($user_city != null) echo $user_city; ?>">
							</select>
						</div>
						<label for="inputProvince" class="col-sm-1 col-form-label text-right text-muted">Provincia</label>
						<div class="form-group col-md-3">
							<select id="provincia" class="form-control" name="provincia" required>
								<?php include($path."/html/province.html") ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="address" class="col-sm-2 col-form-label text-right text-muted">Via</label>
						<div class="form-group col-md-5">
							<input class="form-control text-dark" type="text" name="address" value="<?php if($user_address != null) echo $user_address; ?>" required>
						</div>
						<label for="CAP" class="col-sm-1 col-form-label text-right text-muted">CAP</label>
						<div class="form-group col-md-2">
							<input class="form-control text-dark" type="text" id='CAP' name="CAP" value="<?php if($user_CAP != null) echo $user_CAP; ?>" required>
						</div>
					</div>
					<hr>
					<div class="form-group row">
						<label for="date" class="col-sm-2 col-form-label text-right text-muted">Data di nascita</label>
						<div class="form-group col-md-3">
							<input type="date" class="form-control" name="date" value="<?php if($user_birthday != null) echo $user_birthday;
							else echo "2000-01-01"; ?>" min="1900-01-01" max="<?php echo date('Y-m-d'); ?>" required>
						</div>
					</div>
					<hr>
					<label class="col-sm-2 col-form-label text-right text-muted">Sesso</label>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="customRadioUomo" name="sesso" value="Uomo" class="custom-control-input" <?php if($user_gender == 'Uomo') echo "checked";?>>
						<label class="custom-control-label" for="customRadioUomo">Uomo</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="customRadioDonna" name="sesso" value="Donna" class="custom-control-input" <?php if($user_gender == 'Donna') echo "checked";?>>
						<label class="custom-control-label" for="customRadioDonna">Donna</label>
					</div>
					<div class="invalid-feedback">
						Select one.
					</div>
					<hr>
					<div class="form-group">
    				<label for="textarea" class="col-form-label text-right text-muted">Breve descrizione</label>
    				<textarea class="form-control" id="textarea" name="textarea" rows="5" maxlength="255" required><?php echo $describe_user; ?></textarea>
  				</div>
					<div class="text-right">
						<button class="btn btn-secondary" type="submit" name="update">Salva</button>
						<a class="btn btn-light" href="/show_profile.php" name="annulla" >Annulla</a>
					</div>
				</div>
			</form>

			<script>
			// Example starter JavaScript for disabling form submissions if there are invalid fields
			(function() {
				'use strict';
				window.addEventListener('load', function() {
					// Fetch all the forms we want to apply custom Bootstrap validation styles to
					var forms = document.getElementsByClassName('needs-validation');
					// Loop over them and prevent submission
					var validation = Array.prototype.filter.call(forms, function(form) {
						form.addEventListener('submit', function(event) {
							if (form.checkValidity() === false) {
								event.preventDefault();
								event.stopPropagation();
							}
							form.classList.add('was-validated');
						}, false);
					});
				}, false);
			})();

			</script>

		</div>
		<br>
		<br>
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
