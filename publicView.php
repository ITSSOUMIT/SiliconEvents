<?php
    if(isset($_GET['short'])){
        include('config.php');
        $shortlink = $_GET['short'];
        $query = "SELECT * FROM report WHERE reportShortLink='$shortlink' AND publicSharing=1";
        $result = $conn->query($query);

        if($result->num_rows == 1){
?>
<html>
<body>
    <div id="krishna">

    </div>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script>
    (function () {
        var link = '<?php echo $shortlink; ?>';
        var promptAnswer = prompt("Please enter the password to view the report");
        if(promptAnswer != null){
            console.log(promptAnswer);
            var dataString = "shortLink="+link+"&password="+promptAnswer;
            $.ajax({
                url: '../pdfProcessor.php',
                type: 'post',
                data: dataString,
                success: function(response) {
                    if(response=='404'){
                        location.reload();
                    }else if(response=='101'){
                        alert('The requested resource has been turned off for file sharing. Please contact the team for access to this resource.');
                    }else{
                        console.log(response);
                        $('#krishna').html(response);
                    }
                }
            });
        }
    })();
</script>
</body>
</html>
<?php

        }else{
            include('404/prettyindex.php');
        }
    }
?>