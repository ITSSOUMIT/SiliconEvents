<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>
<body id="mod" height="100%">
<?php
if(isset($_GET['shortlink'])){
        include('config.php');
        $shortlink = $_GET['shortlink'];
        $query = "SELECT * FROM report WHERE reportShortLink='$shortlink' AND publicSharing='1'";
        $result = $conn->query($query);
        if($result->num_rows==1){
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    var password = prompt("Please enter the password to view the report");
    if(password!= null){
        var shortlink = "<?php echo $shortlink; ?>";
        var dataString = `shortlink=${shortlink}&password=${password}`;

        //AJAX Call
        $.ajax({
            url: '../verify.php',
            type: 'post',
            data: dataString,
            success: function(response){
                // Add response in Modal body
                $('#mod').html(response);

		console.log(response);
            }
        });
    }
</script>
</body>
</html>
<?php }} ?>
