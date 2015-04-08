<?php
	session_start();
	if(!isset($_SESSION['loggedin'])){
		header('Location: ../login.php');
		die();
	}
	include_once('../../../system/classes/applications.php');
	define('pagination_count',10);
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}else{
		echo 'please select an application from the admin panel to view';
		die();
	}

	$application = new Applications();
	$application_details = $application->getById($id);
?>
<html>
<head>
	<title></title>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:600,800,400' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="../favicon.ico">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
	<script type="text/javascript" src="../../../jquery.min.js"></script>
	<script type="text/javascript">
		var application_details = <?php print_r($application_details[0]['app_data']); ?>;
		var photo = <?php echo "'".$application_details[0]['photo']."'"; ?>;

		var photo = decodeURIComponent(photo);

		var canvas;
	    var ctx;

	    


		$(document).ready(function(){

			canvas = document.getElementById('app-photo-canvas');
			canvas.width = '142.08';
			canvas.height = '179.52';
			ctx = canvas.getContext("2d");

			$('input').attr('disabled', 'disabled');
			$('.form-input').each(function(){
				var id = $(this).attr('id');
				var value = $(this).val(application_details[id]);
			});

			$('.array-row').each(function(){
				var counter = 0
				var id = $(this).attr('id');
				var temp_array = application_details[id];
				$(this).find('.array-input').each(function(){
					var value = $(this).val(temp_array[counter]);
					counter++;
				});
			});

			var radio_variables = application_details['radio'];

			$('input[type="radio"]').each(function(){
				if($(this).attr('name') in radio_variables){
					if($(this).val()==radio_variables[$(this).attr('name')]){
						$(this).prop("checked", true)
					}
				}
			});

			img = new Image;
			img.src = photo;
			ctx.drawImage(img,0,0,canvas.width,canvas.height);
		});
	</script>
<style type="text/css" >


body{
	padding: 0;
	margin: 0;
	font-family: 'Open Sans', sans-serif;
	font-size: 9pt;
}

.no-input-cell{
	font-family: 'Open Sans', sans-serif;
	font-size: 9pt;
}

p{
	font-size: 9pt;
}

.page{
	margin: 0 auto;
	height: 841pt;
	width: 595pt;
}

#header{
	height: 105.8pt;
	width:595pt; 
	position: relative;
	background: url('../../../images/application-filled.jpg');
	background-repeat: no-repeat;
}

#title{
	text-align: center;
}

table, tr, td, div{
	padding: 0;
	border-spacing: 0;
	margin-bottom: 10pt;
	border-collapse: collapse;
	page-break-inside:avoid; 
	font-family: 'Open Sans', sans-serif;
	margin-top: 10pt;
	position: relative;
}


caption{
	text-align: left;
	font-size: 10pt;
}

.table-photo-width{
	width: 460pt;
	border:solid 1pt #000;
}

.table-row-photo{
	height: 19.45pt;
}

.text-input-row{
	background-color:#C6D9F1;
}


.cell{
	padding: 3pt;
	font-size: 9pt;
	border:solid 1pt #000;
}

.detail{
	width: 100%;
}

/*full width table*/

.full-width{
	width: 100%;
	page-break-after:avoid; 
}

.full-width-row{
	height: 19.45pt;
}

#reference-1, #reference-2{
	font-size: 9pt;
}

#reference-1 td, #reference-2 td{
	padding: 5px;
}

input{
	background-color: transparent;
	border: none;
}

@media print {
	#header{
		content:url(../../../images/application-filled.jpg);
	}

	.text-input-row{
		content:#C6D9F1;
	}
}

#printheader {display: none; } /* Makes the print header not visible */

</style>
</head>
<body>

	<div class="page">
		<div id="header">
		</div>
		<div id="title"><h2>Application Form for Seafarers</h2></div>
		<table>
			<tr>
				<td style="width:570pt;">
					<table class="table-photo-width">
						<caption>1. Personal Data (Name should be as per the Passport)</caption>
						<tr class="table-row-photo">
							<td class="cell">Surname</td>
						</tr>
						<tr class="table-row-photo text-input-row">
							<td class="cell"><input type="text" class="detail form-input" id="surname"/></td>
						</tr>

					</table>

					<table class="table-photo-width">
						<tr class="table-row-photo">
							<td class="cell">Other Names</td>
						</tr>
						<tr class="table-row-photo text-input-row">
							<td class="cell"><input type="text" class="detail form-input" id="other-names"/></td>
						</tr>

					</table>

					<table class="table-photo-width">
						<tr class="table-row-photo">
							<td class="cell">Nationality</td>
							<td class="cell">Date of Birth (DD/MM/YYYY)</td>
							<td class="cell">Place/City of Birth</td>
						</tr>
						<tr class="table-row-photo text-input-row">
							<td class="cell"><input type="text" class="detail form-input" id="nationality"/></td>
							<td class="cell"><input type="text" class="detail form-input" id="dob"/></td>
							<td class="cell"><input type="text" class="detail form-input" id="place-birth"/></td>
						</tr>

					</table>

					<table class="table-photo-width">
						<tr class="table-row-photo">
							<td class="cell">Marital Status</td>
							<td class="cell">Gender (Male/Female)</td>
							<td class="cell">Religion</td>
						</tr>
						<tr class="table-row-photo text-input-row">
							<td class="cell"><input type="text" class="detail form-input" id="martial-status"/></td>
							<td class="cell"><input type="text" class="detail form-input" id="gender"/></td>
							<td class="cell"><input type="text" class="detail form-input" id="religion"/></td>
						</tr>

					</table>

				</td>
				<td style="vertical-align: middle; text-align: center">
					<table style="width:100pt; margin:0 10pt 0 10pt;">
						<tr>
							<td style="background-color: #C6D9F1; height: 100pt; text-align: center">
								<canvas id="app-photo-canvas" style="" height="134.64pt" width="106.56pt"></canvas>
							</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>
		<table class="full-width">
			<tr class="full-width-row">
				<td class="cell">Rank Applied for</td>
				<td class="cell" rowspan=2 style="width:20%">Whilling to accept lower Rank<br/>Yes<input type="radio" value="Yes" name="accept-rank" checked="checked"/>No<input type="radio" value="No" name="accept-rank"/></td>
				<td class="cell" colspan=8 style="width:30%">Available from (Date)</td>
			</tr>
			<tr class="full-width-row text-input-row array-row"  id="available-from-date">
				<td class="cell"><input type="text" class="detail form-input" id="rank-applied"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
		</table>

		<table class="full-width">
			<tr class="full-width-row" style="height:38.9pt;">
				<td class="cell" style="width:20%">Permanent Address</td>
				<td class="cell" colspan=3><input type="text" class="detail form-input" id="permanent-address"/></td>
			</tr>
			<tr class="full-width-row text-input-row">
				<td class="cell">City</td>
				<td class="cell"><input type="text" class="detail form-input" id="city"/></td>
				<td class="cell" style="width:10%">Country</td>
				<td class="cell"><input type="text" class="detail form-input" id="country"/></td>
			</tr>
			<tr class="full-width-row text-input-row">
				<td class="cell">Home Tel</td>
				<td class="cell"><input type="text" class="detail form-input" id="home-tel"/></td>
				<td class="cell" style="width:10%">Mobile No</td>
				<td class="cell"><input type="text" class="detail form-input" id="mobile-no"/></td>
			</tr>
			<tr class="full-width-row text-input-row">
				<td class="cell">Fax</td>
				<td class="cell"><input type="text" class="detail form-input" id="fax"/></td>
				<td class="cell" style="width:10%">E Mail</td>
				<td class="cell"><input type="text" class="detail form-input" id="email"/></td>
			</tr>
		</table>

		<table class="full-width">
			<tr class="full-width-row">
				<td class="cell">Collar (cm)</td>
				<td class="cell">Chest (cm)</td>
				<td class="cell">Waist (cm)</td>
				<td class="cell">Inside Leg (cm)</td>
				<td class="cell">Cap (cm)</td>
			</tr>
			<tr class="full-width-row text-input-row">
				<td class="cell"><input type="text" class="detail form-input" id="collar" /></td>
				<td class="cell"><input type="text" class="detail form-input" id="chest" /></td>
				<td class="cell"><input type="text" class="detail form-input" id="waist" /></td>
				<td class="cell"><input type="text" class="detail form-input" id="inside-leg" /></td>
				<td class="cell"><input type="text" class="detail form-input" id="cap" /></td>

			</tr>
		</table>

		<table class="full-width">
			<tr class="full-width-row" style="height:38.9pt;">
				<td class="cell">Overall Size</td>
				<td class="cell">Safety Shoe Size</td>
				<td class="cell">Height (cm)</td>
				<td class="cell">Weight (kg)</td>
				<td class="cell">BMI = { Weight in (kg) / Height in (m) x Height in (m) }</td>
			</tr>
			<tr class="full-width-row text-input-row">
				<td class="cell"><input type="text" class="detail form-input" id="overall-size" /></td>
				<td class="cell"><input type="text" class="detail form-input" id="safety-shoe-size" /></td>
				<td class="cell"><input type="text" class="detail form-input" id="height" /></td>
				<td class="cell"><input type="text" class="detail form-input" id="weight" /></td>
				<td class="cell"><input type="text" class="detail form-input" id="bmi" /></td>
			</tr>
		</table>

		<table class="full-width">
			<caption>2. Personal ID / Document / Visa (Please refer the note below)</caption>
			<tr class="full-width-row" style="height:38.9pt;">
				<td class="cell">Type of Document / ID</td>
				<td class="cell">Country of Issue</td>
				<td class="cell">Number</td>
				<td class="cell">Date of Issue (DD/MM/YY)</td>
				<td class="cell">Valid Until (DD/MM/YY)</td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="seamans-book">
				<td class="cell">Seaman’s Book (National)</td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="passport">
				<td class="cell">Passport</td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="us-visa">
				<td class="cell">US Visa C1/D</td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="yellow-fever">
				<td class="cell">Yellow Fever</td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="national-id">
				<td class="cell">National ID</td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
			</tr>
		</table>
		
		<table class="full-width">
			<caption>2. Nominee/Next of Kin and Family Details</caption>
			<tr class="full-width-row">
				<td class="cell" colspan=2>Full Name of Nominee for compensation in any case</td>
				<td class="cell">Relationship*</td>
				<td class="cell" rowspan=2>Gender<br/><br/>Male<input checked="checked" type="radio" name="next-kin-gender" value="male"/>Female<input type="radio" name="next-kin-gender" value="female"/></td>
				<td class="cell" colspan=2>Nationality</td>
			</tr>
			<tr class="full-width-row text-input-row">
				<td class="cell" colspan=2><input type="text" class="detail form-input" id="next-kin-full-name" /></td>
				<td class="cell"><input type="text" class="detail form-input" id="next-kin-relationship" /></td>
				<td class="cell" colspan=2><input type="text" class="detail form-input" id="next-kin-nationality" /></td>
			</tr>
			<tr class="full-width-row text-input-row">
				<td class="cell" style="background-color:#fff">Address</td>
				<td class="cell" colspan=5><input type="text" class="detail form-input" id="next-kin-address" /></td>
			</tr>
			<tr class="full-width-row text-input-row">
				<td class="cell" style="background-color:#fff">City</td>
				<td class="cell"><input type="text" class="detail form-input" id="next-kin-city" /></td>
				<td class="cell" colspan=2 style="background-color:#fff">Country</td>
				<td class="cell" colspan=2><input type="text" class="detail form-input" id="next-kin-country" /></td>
			</tr>
			<tr class="full-width-row text-input-row">
				<td class="cell" style="background-color:#fff">E-mail</td>
				<td class="cell"><input type="text" class="detail form-input" id="next-kin-email" /></td>
				<td class="cell" style="background-color:#fff">Tel</td>
				<td class="cell"><input type="text" class="detail form-input" id="next-kin-tel" /></td>
				<td class="cell" style="background-color:#fff">Mobile</td>
				<td class="cell"><input type="text" class="detail form-input" id="next-kin-mobile" /></td>
			</tr>
			
		</table>
		<p>*Select from: *Spouse	*Child	*Grand Parent	*Other Relative (Please Specify)</p>

		<table class="full-width">
			<caption>3.1 Family Data</caption>
			<tr class="full-width-row">
				<td class="cell" style="width:15%">Relationship</td>
				<td class="cell">First Name</td>
				<td class="cell">Last Name</td>
				<td class="cell">Date of Birth</td>
				<td class="cell">Passport No.</td>
				<td class="cell">Place of Issue</td>
				<td class="cell">Date of Issue</td>
				<td class="cell">Date of Expiry</td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="father">
				<td class="cell">Father</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="mother">
				<td class="cell">Mother</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="spouse">
				<td class="cell">Spouse</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="child-1">
				<td class="cell">Child M<input type="radio" name="child-gender-1" value="M" checked="checked" />F<input type="radio" name="child-gender-1" value="F" /></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="child-2">
				<td class="cell">Child M<input type="radio" name="child-gender-2" value="M" checked="checked" />F<input type="radio" name="child-gender-2" value="F" /></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="child-3">
				<td class="cell">Child M<input type="radio" name="child-gender-3" value="M" checked="checked" />F<input type="radio" name="child-gender-3" value="F" /></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
		</table>

		<p>4. STCW – 1978 (amended 1995) Compliant Certificates/Courses and other Qualifications</p>

		<table class="full-width">
			<caption>4.1 Pre-Sea Training</caption>
			<tr class="full-width-row">
				<td class="cell">Certificate No.</td>
				<td class="cell">Qualification</td>
				<td class="cell">Training Institute</td>
				<td class="cell">From</td>
				<td class="cell">To</td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="sea-training-1">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="sea-training-2">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="sea-training-3">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
		</table>

		<table class="full-width">
			<caption>4.2 Certificate of Competency & Rating Watch-Keeping Certificate</caption>
			<tr class="full-width-row">
				<td class="cell" style="width:15%" colspan=2>Qualifications</td>
				<td class="cell">Type/Grade/Class of License/Country of Issue</td>
				<td class="cell">Number</td>
				<td class="cell">Date of Issue</td>
				<td class="cell">Date of Expiry</td>
				<td class="cell">Issuing Authority / Institute</td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="certificate-of-competency">
				<td class="cell" rowspan=2 style="background-color:#fff">Reg 1</td>
				<td class="cell">Certificate of Competency</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="watch-keeping-certificate">
				<td class="cell">Watch keeping certificate</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="endorsement-oil">
				<td class="cell" rowspan=8 style="background-color:#fff">Reg VI/1</td>
				<td class="cell">Endorsement - Oil</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="endorsement-chemical">
				<td class="cell">Endorsement - Chemical</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="endorsement-gas">
				<td class="cell">Endorsement - Gas</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="endorsement-other">
				<td class="cell">Endorsement - Other</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="special-oil">
				<td class="cell">Special Tanker Safety (Oil) Para 2</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="special-chemical">
				<td class="cell">Special Tanker Safety (Chemical) Para 2</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="special-gas">
				<td class="cell">Special Tanker Safety (Gas) Para 2</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="special-other">
				<td class="cell">Special Tanker Safety (Other) Para 2</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
		</table>

		<table class="full-width">
			<caption>4.3 Other Compliant Certificates</caption>
			<tr class="full-width-row">
				<td class="cell" style="width:15%" colspan=2>Description of Certificate / Course</td>
				<td class="cell">Number</td>
				<td class="cell">Country of Issue</td>
				<td class="cell">Date of Issue</td>
				<td class="cell">Date of Expiry</td>
				<td class="cell">Issuing Authority / Institute</td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="personal-training-record">
				<td class="cell" rowspan=2 style="background-color:#fff">Reg 1</td>
				<td class="cell">Personal Training Record Reg 1/14</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="medical-fitness-certificate">
				<td class="cell">Medical Fitness Cert Reg 1/9</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="personal-survival-techniques">
				<td class="cell" rowspan=4 style="background-color:#fff">Reg VI/1</td>
				<td class="cell">Personal Survival Techniques</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="elementary-first-aid">
				<td class="cell">Elementary First Aid</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="fire-fighting">
				<td class="cell">Fire Prevention & Fire Fighting</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="personal-safety">
				<td class="cell">Personal Safety & Social Resp.</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="proficiency-in-survival">
				<td class="cell" rowspan=5 style="background-color:#fff">Reg VI/2</td>
				<td class="cell">Proficiency in Survival Craft & Rescue Boat</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="fast-rescue-boats">
				<td class="cell">Fast Rescue Boats</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="advance-fire-fighting">
				<td class="cell">Advance Fire Fighting</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="medical-first-aid">
				<td class="cell">Medical First Aid</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="medical-care">
				<td class="cell">Medical Care (Master/Ch Off)</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
		</table>

		<table class="full-width">
			<caption>4.4 Other Mandatory / Recommended Certificates / Courses – (as applicable)</caption>
			<tr class="full-width-row">
				<td class="cell" style="width:15%">Description of Certificate / Course</td>
				<td class="cell">Number</td>
				<td class="cell">Country of Issue</td>
				<td class="cell">Date of Issue</td>
				<td class="cell">Date of Expiry</td>
				<td class="cell">Issuing Authority / Institute</td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="dmdss">
				<td class="cell">GMDSS</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="ecdis">
				<td class="cell">ECDIS (Module 1.27)</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="arpa">
				<td class="cell">ARPA (Reg 11/1 + Solas)</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="radar-simulator">
				<td class="cell">Radar Simulator</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="bridge-team-management">
				<td class="cell">Bridge Team Management</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="bridge-resource-management">
				<td class="cell">Bridge Resource Management</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="ship-board-security-officer">
				<td class="cell">Ship Board Security Officer</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="ship-security-awareness">
				<td class="cell">Ship Security Awareness</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="designated-security-duties">
				<td class="cell">Designated Security Duties</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="tanker-familiarization">
				<td class="cell">Tanker Familiarization</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="other-mandatory-other">
				<td class="cell">Other</td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
			</tr>
		</table>

		<table class="full-width">
			<caption>5. Sea Experience: (Last 5 years. start the listing below with the most recent experience) All fields are mandatory</caption>
			<tr class="full-width-row">
				<td class="cell" style="width:15%">Company Name</td>
				<td class="cell" style="width:15%">Vessel Name</td>
				<td class="cell">Flag</td>
				<td class="cell">IMO Number</td>
				<td class="cell">Date of Expiry</td>
				<td class="cell">Vessel Type*</td>
				<td class="cell">GRT</td>
				<td class="cell">DWT</td>
				<td class="cell">Main Engine Type</td>
				<td class="cell">BHP/KW</td>
				<td class="cell">UMSY/N</td>
				<td class="cell">Rank</td>
				<td class="cell">Date from<br/>dd/mm/yy</td>
				<td class="cell">Date to<br/>dd/mm/yy</td>
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-1">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-2">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-3">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-4">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-5">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-6">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-7">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-8">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-9">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-10">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-11">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-12">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-13">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-14">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
			<tr class="full-width-row text-input-row array-row" id="company-15">
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>
				<td class="cell"><input type="text" class="detail array-input"/></td>				
			</tr>
		</table>
		<p>***Nomenclature-CC-Completed contract, VS-Vessel Sold, MG-Medical Grounds (Please specify), OR-Other Reason (Please Specify)</p>
		<p>*Use only the following Abbreviations for vessel types</p>
		<table class="full-width">
			<tr>
				<td class="no-input-cell">B/C</td>
				<td class="no-input-cell">Bulk Carrier</td>
				<td class="no-input-cell">MLP</td>
				<td class="no-input-cell">Multi-Purpose</td>
				<td class="no-input-cell">PAS</td>
				<td class="no-input-cell">Passenger Ship</td>
				<td class="no-input-cell">YAT</td>
				<td class="no-input-cell">Yacht</td>
			</tr>
			<tr>
				<td class="no-input-cell">CON</td>
				<td class="no-input-cell">Cellular Container</td>
				<td class="no-input-cell">GCD</td>
				<td class="no-input-cell">General Cargo</td>
				<td class="no-input-cell">RFG</td>
				<td class="no-input-cell">Reefer Vessel</td>
				<td class="no-input-cell">TNB</td>
				<td class="no-input-cell">Tanker (Bitumen)</td>
			</tr>
			<tr>
				<td class="no-input-cell">HLV</td>
				<td class="no-input-cell">Heavy Lift Vsl</td>
				<td class="no-input-cell">R/R</td>
				<td class="no-input-cell">Ro/Ro Carrier</td>
				<td class="no-input-cell">TNC</td>
				<td class="no-input-cell">Tanker (Crude)</td>
				<td class="no-input-cell">CH3</td>
				<td class="no-input-cell">Chem.Carrier IMO 111</td>
			</tr>
			<tr>
				<td class="no-input-cell">RIG</td>
				<td class="no-input-cell">Offshore Oil Rig</td>
				<td class="no-input-cell">PRR</td>
				<td class="no-input-cell">RoRo-Pax</td>
				<td class="no-input-cell">TNP</td>
				<td class="no-input-cell">Tanker (Product)</td>
				<td class="no-input-cell">LIV</td>
				<td class="no-input-cell">Live Stock Carrier</td>
			</tr>
			<tr>
				<td class="no-input-cell">OSV</td>
				<td class="no-input-cell">Offshore Supply Vsl</td>
				<td class="no-input-cell">TNS</td>
				<td class="no-input-cell">Tanker (Storage)</td>
				<td class="no-input-cell">OBO</td>
				<td class="no-input-cell">Ore/Bulk/Oil Carrier</td>
				<td class="no-input-cell">TNV</td>
				<td class="no-input-cell">Tanker (VLCC/ULCC)</td>
			</tr>
			<tr>
				<td class="no-input-cell">FSH</td>
				<td class="no-input-cell">Fishing Vsl</td>
				<td class="no-input-cell">LOG</td>
				<td class="no-input-cell">Log/Timber</td>
				<td class="no-input-cell">O/O</td>
				<td class="no-input-cell">Ore/Oil Carrier</td>
				<td class="no-input-cell">SUL</td>
				<td class="no-input-cell">Self-Unloader</td>
			</tr>
			<tr>
				<td class="no-input-cell">LPG</td>
				<td class="no-input-cell">LPG Carrier</td>
				<td class="no-input-cell">TUG</td>
				<td class="no-input-cell">Tug</td>
				<td class="no-input-cell">OTH</td>
				<td class="no-input-cell">Other</td>
				<td class="no-input-cell">&nbsp;</td>
				<td class="no-input-cell">&nbsp;</td>
			</tr>
		</table>
		<table class="full-width">
			<tr class="full-width-row">
				<td class="cell">Nationalities Sailed With: <br/>(eg: Chinese, Filipino, etc)</td>
				<td class="cell"><input type="text" class="detail form-input" id="nationalities-sailed"/></td>
			</tr>
		</table>
		
		<table class="full-width">
			<caption>6.Medical History</caption>
			<tr>
				<td class="no-input-cell">All previous illnesses other than minor affliction should be stated below or updated.		
If not previously disclosed, the company is entitled to refuse any reimbursement of medical
Costs claim for treatment or for any other insured benefits.
				</td>
				<td class="cell">Blood Type <br/><input type="text" class="detail form-input" id="blood-type"/></td>
			</tr>
		</table>

		<table class="full-width">
			<tr>
				<td class="no-input-cell">(A) Have you ever signed off a ship due to medical reasons?</td>
				<td class="cell">Yes<input type="radio" value="Yes" name="accept-sign-off" checked="checked"/>No<input type="radio" value="No" name="accept-sign-off"/></td>
			</tr>
		</table>

		<table class="full-width">
			<caption>If yes, please provide following details</caption>
			<tr class="full-width-row">
				<td class="cell">Name of the Vessel</td>
				<td class="cell">Date of Occurrence</td>
				<td class="cell">Place of Occurrence</td>
			</tr>
			<tr class="full-width-row">
				<td class="cell"><input type="text" class="detail form-input" id="sign-off-vessel"/></td>
				<td class="cell"><input type="text" class="detail form-input" id="sign-off-date"/></td>
				<td class="cell"><input type="text" class="detail form-input" id="sign-off-place"/></td>
			</tr>
			<tr class="full-width-row">
				<td class="cell" colspan=3>Brief Description of illness/Injury/accident <br/><input type="text" class="detail form-input" id="sign-off-desc"/></td>
			</tr>
		</table>

		<table class="full-width">
			<tr>
				<td class="no-input-cell">(B) Have you undergone any surgical operation in the past?</td>
				<td class="cell">Yes<input type="radio" value="Yes" name="accept-operations" checked="checked"/>No<input type="radio" value="No" name="accept-operations"/></td>
			</tr>
		</table>

		<table class="full-width">
			<caption>If yes, please provide following details</caption>
			<tr class="full-width-row">
				<td class="cell">Details of Operations</td>
				<td class="cell">Date</td>
				<td class="cell">Period of disability</td>
				<td class="cell">Present Condition</td>
			</tr>
			<tr class="full-width-row array-row" id="operation-1">
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
			</tr>
			<tr class="full-width-row array-row" id="operation-2">
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
			</tr>
			<tr class="full-width-row array-row" id="operation-3">
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
				<td class="cell"><input type="text" class="detail array-input" /></td>
			</tr>
		</table>

		<table class="full-width">
			<caption>7.General</caption>
			<tr>
				<td class="no-input-cell">(A) Have you ever been denied a foreign visa</td>
				<td class="cell">Yes<input type="radio" value="Yes" name="accept-visa" checked="checked"/>No<input type="radio" value="No" name="accept-visa"/></td>
			</tr>
			<tr>
				<td class="no-input-cell" colspan=2 >If yes, please which country and reason (if known) </td>
			</tr>
			<tr>
				<td class="cell" colspan=2><input type="text" class="detail form-input" id="visa-reason"/></td>
			</tr>
			<tr>
				<td class="no-input-cell">(B) Have you been the subject of a court enquiry of involved in a maritime accident?</td>
				<td class="cell">Yes<input type="radio" value="Yes" name="maritime-accident" checked="checked"/>No<input type="radio" value="No" name="maritime-accident"/></td>
			</tr>
			<tr>
				<td class="no-input-cell" colspan=2>If yes, please attach details</td>
			</tr>
			<tr>
				<td class="cell" colspan=2><input type="text" class="detail form-input" id="maritime-accident-details"/></td>
			</tr>
			<tr>
				<td class="no-input-cell">(C) Please refer page 2 of attached addendum & complete the details of two recent employers for reference.</td>
				<td class="no-input-cell">&nbsp;</td>
			</tr>
		</table>

		<table class="full-width">
			<tr class="full-width-row" >
				<td class="no-input-cell">Do you know any seafarer, sailing through Manaco Marine or Known to our employees?</td>
				<td class="cell"><input type="text" class="detail form-input" id="manaco-known-employee"/></td>
			</tr>
		</table>

		<p>Declaration to be signed by the applicant</p>

		<p>I hereby certify that the information contained in this form is correct and I understand that the company may terminate my services at any time if any of the above information is found to be false.</p>

		<p>I understand that a medical examination at my own cost is a condition precedent to selection for appointment and I express my willingness to be so examine (if required) and to furnish the company doctor with full details of my previous medical history.</p>

		<table class="full-width">
			<tr class="full-width-row" >
				<td class="no-input-cell" width="25%">Date:</td>
				<td class="cell" width="25%">&nbsp;</td>
				<td class="no-input-cell" width="25%">Signature of the Applicant:</td>
				<td class="cell" width="25%">&nbsp;</td>
			</tr>
		</table>

		<table class="full-width">
			<tr>
				<td class="no-input-cell">(D) Authenticity of COC and Document checked?</td>
				<td class="cell">Yes<input type="radio" value="Yes" name="document-checked" checked="checked"/>No<input type="radio" value="No" name="document-checked"/></td>
			</tr>
		</table>

		<table class="array-row" id="reference-1">
			<caption>REFERENCE :</caption>
			<tr>
				<td>Last Employer</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Company Name</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Name of Ship</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Rank</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Name of the person in charge of crewing</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Telephone Numbers</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Local Agents</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Name of the person in charge of crewing</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Telephone Numbers</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>E-mail</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
		</table>

		<table class="array-row" id="reference-2">
			<caption>REFERENCE :</caption>
			<tr>
				<td>Last Employer</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Company Name</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Name of Ship</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Rank</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Name of the person in charge of crewing</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Telephone Numbers</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Local Agents</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Name of the person in charge of crewing</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>Telephone Numbers</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
			<tr>
				<td>E-mail</td>
				<td><input type="text" class="detail array-input" /></td>
			</tr>
		</table>
	</div>
</body>
</html>