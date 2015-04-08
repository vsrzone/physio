<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">

		<link href="{{URL::to('/')}}/resources/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	    <!-- MetisMenu CSS -->
	    <link href="{{URL::to('/')}}/resources/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

	    <!-- Custom CSS -->
	    <link href="{{URL::to('/')}}/resources/dist/css/sb-admin-2.css" rel="stylesheet">

	    <!-- Custom Fonts -->
   	 	<link href="{{URL::to('/')}}/resources/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


		<title>Physio - Admin panel</title>  	

	</head>
	<body>
		<div>
			<h2>Physio - Admin panel</h2>
		</div>
		<div id="wrapper">
	    	<!-- Navigation -->
	        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	    	<!--header-->
		    	<div class="navbar-header">
				    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				    </button>
				    <a class="navbar-brand" href="#">Admin Panel Ingens</a>

				</div>
				<!-- /.navbar-header -->
		 	
				<ul class="nav navbar-top-links navbar-right">
				    <li class="dropdown">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
				            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
				        </a>
				        <ul class="dropdown-menu dropdown-user">
				          	{{ Form::open(array('url' => 'admin/member/edit')) }}
				            <li><div id="logout_button" onclick="document.forms[0].submit()" style="cursor:pointer;"><i class="fa fa-sign-out fa-fw"></i> Update Profile</div>
					          	{{ Form::hidden('id', Auth::user()->member_id)}}
					        	{{ Form::close() }}
				            </li>
				            {{ Form::open(array('url' => 'admin/logout', 'method' => 'GET')) }}

				            <li><div id="logout_button" onclick="document.forms[1].submit()" style="cursor:pointer;"><i class="fa fa-sign-out fa-fw"></i> Logout</div>
				        		{{ Form::close() }}
				            </li>
				        </ul>
				        <!-- /.dropdown-user -->
				    </li>
				    <!-- /.dropdown -->
				</ul>
				<!-- /.navbar-top-links -->

		        <!-- Navigation -->
		   
		        
			        <div class="navbar-default sidebar" role="navigation">
					    <div class="sidebar-nav navbar-collapse">
					        <ul class="nav" id="side-menu">
					            <li>
					                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Members<span class="fa arrow"></span></a>
					                <ul class="nav nav-second-level">
					                    <li>
					                        <a href="{{URL::to('/')}}/admin/member">View</a>
					                    </li>
					                    <li>
					                        <a href="{{URL::to('/')}}/admin/member/create">Create</a>
					                    </li>
					                </ul>
					            </li>  
					            <li>
					                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Categories<span class="fa arrow"></span></a>
					                <ul class="nav nav-second-level">
					                    <li>
					                        <a href="{{URL::to('/')}}/admin/category">View</a>
					                    </li>
					                    <li>
					                        <a href="{{URL::to('/')}}/admin/category/create">Add</a>
					                    </li>
					                </ul>
					            </li>                        
					            <li>
					                <a href="#"><i class="fa fa-files-o fa-fw"></i>News<span class="fa arrow"></span></a>
					                <ul class="nav nav-second-level">
					                    <li>
					                        <a href="{{URL::to('/')}}/admin/news">View</a>
					                    </li>
					                    <li>
					                        <a href="{{URL::to('/')}}/admin/news/create">Add</a>
					                    </li>
					                </ul>
					                <!-- /.nav-second-level -->
					            </li>
					        </ul>
					    </div>
				    <!-- /.sidebar-collapse -->
					</div>
		<!-- /.navbar-static-side -->
	        </nav>
	        <div id="page-wrapper">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                    <div class = "row-fluid content">
                    	<div class="flex-container">
	                    	<div class="row">
				        		@yield('content')
					    	</div>
	                	</div>
	                <!-- /.col-lg-12 -->
	            	</div>
		        </div>
		        <!-- /#page-wrapper -->
		    </div>
		</div>
	    <!-- /#wrapper -->

	    <!-- jQuery -->
	    <script src="{{URL::to('/')}}/resources/bower_components/jquery/dist/jquery.min.js"></script>

	    <!-- Bootstrap Core JavaScript -->
	    <script src="{{URL::to('/')}}/resources/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	    <!-- Metis Menu Plugin JavaScript -->
	    <script src="{{URL::to('/')}}/resources/bower_components/metisMenu/dist/metisMenu.min.js"></script>


	    <!-- Custom Theme JavaScript -->
	    <script src="{{URL::to('/')}}/resources/dist/js/sb-admin-2.js"></script>
	</body>

</html>