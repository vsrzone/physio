<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Physio - Admin panel</title> 

	<link href="{{URL::to('/')}}/resources/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{URL::to('/')}}/resources/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{URL::to('/')}}/resources/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{URL::to('/')}}/resources/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 	
	</head>

	<h1>Physio</h1>
	<div class="container">
		<div class="row">
			@yield('content')
		</div>		
	</div>
</html>