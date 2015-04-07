<script>
    var http_path = '<?php echo $HTTP_PATH; ?>';
    var url = http_path +'system/route.php';
    var pagination_count = <?php echo pagination_count; ?>;

    function sendRequestToServer(url,action,controller,variables,callback){
        var var_string = JSON.stringify(variables);
        var request_url = url + '?action=' + action + '&controller=' + controller +'&variables=' + var_string;

        var xmlHttp = new XMLHttpRequest(); 
        xmlHttp.onreadystatechange = function(){
            if (xmlHttp.readyState==4 && xmlHttp.status==200){
                callback(xmlHttp.responseText);
            }
        };
        xmlHttp.open( "GET", request_url, true );
        xmlHttp.send();
    }

    function sendRequestToServerPost(url,action,controller,variables,callback){
        var var_string = JSON.stringify(variables);
            var request_url = 'action=' + action + '&controller=' + controller +'&variables=' + var_string;

            var xmlHttp = new XMLHttpRequest(); 
            xmlHttp.onreadystatechange = function(){
                if (xmlHttp.readyState==4 && xmlHttp.status==200){
                    callback(xmlHttp.responseText);
                }
            };
            xmlHttp.open( "POST", url, true );
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send(request_url);
    }

    function requestLogout(){
        var request_url = url + '?action=requestLogout&controller=login&variables=';

        var xmlHttp = new XMLHttpRequest(); 
        xmlHttp.onreadystatechange = function(){
            if (xmlHttp.readyState==4 && xmlHttp.status==200){
                var res = JSON.parse(xmlHttp.responseText);
                if(res.success){
                    window.location.href = 'login.php';
                }
            }
        };
        xmlHttp.open( "GET", request_url, true );
        xmlHttp.send();
    }
</script>