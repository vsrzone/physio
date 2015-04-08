<?php
    include_once('../../config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manaco|Admin|Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="login key" type="password" id="login_key">
                                </div>
                                <div id="login_button" class="btn btn-lg btn-success btn-block">Login</div>
                            </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">
    function requestLogin(){
        var key = {key : $('#login_key').val()};
        key = JSON.stringify(key);
        var http_path = <?php echo "'".$HTTP_PATH."'"; ?>;
        var url = http_path + 'system/route.php'
        var request_url = url + '?action=requestLogin&controller=login&variables='+key;

        var xmlHttp = new XMLHttpRequest(); 
        xmlHttp.onreadystatechange = function(){
            if (xmlHttp.readyState==4 && xmlHttp.status==200){
                var res = JSON.parse(xmlHttp.responseText);
                if(res.success){
                    window.location.href = 'index.php'
                }else{
                    alert('incorrect password');
                }
            }
        };
        xmlHttp.open( "GET", request_url, true );
        xmlHttp.send();
    }


    $('#login_button').click(function(){requestLogin();});
    </script>


</body>

</html>
