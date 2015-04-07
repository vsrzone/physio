<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manaco|Admin|Vacancies</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <?php
        include_once('../../config.php');

        $view = 'view';

        if(isset($_GET['view'])){
            if($_GET['view'] == 'add'){
                $view = 'add';
            }
            if($_GET['view'] == 'edit'){
                $view = 'edit';
            }
        }
    ?>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php include('includes/header.php'); ?>

            <?php include('includes/navigation.php'); ?>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Vacancies</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- table -->
        <?php 
            if($view == 'view'){ 
                include('vacancies/view.php');
            }elseif($view == 'add' || $view == 'edit'){
                include('vacancies/add.php');
            }
        ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <?php include_once('js/js_config.php') ?>

    <script TYPE="text/javascript" src="js/vacancies.js"></script>

    <?php   if($view == 'view'){     ?>
    <script type="text/javascript">
    $(document).ready(function(){
        populateTable(curr_page);
        drawPagination();

        $(document).on( "click",".paginate_button", function(){ curr_page = $(this).data('page'); populateTable(curr_page); } );

        $(document).on("click",".delete-icon",function(){ var element = $(this).parent().parent(); deleteRecord(element.data('id'),element); });

        $(document).on("click",".edit-icon",function(){ var element = $(this).parent().parent(); window.location.href += '?view=edit&id='+element.data('id'); });
    });
    </script>
    <?php   }elseif ($view == 'add' ) {  ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#accept-form').click(function(){
            addRecord();
        });
    });
    </script>
    <?php   }elseif ($view == 'edit') {  ?>
    <script type="text/javascript">
    var record_id = <?php echo $_GET['id'] ?>;
    $(document).ready(function(){
        populateEditForm();
        $('#accept-form').click(function(){
            updateRecord();
        });
    });
    </script>
    <?php }                          ?>

</body>

</html>
