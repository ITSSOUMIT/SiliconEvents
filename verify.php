<?php
    if(isset($_POST['shortlink']) && isset($_POST['password'])){
        include('config.php');
        $shortlink = $_POST['shortlink'];
        $password = $_POST['password'];

        $query = "SELECT * FROM report WHERE reportShortLink='$shortlink' AND reportpassword='$password'";
        $result = $conn->query($query);

        if($result->num_rows==1){
	    $row = $result->fetch_assoc();
            $final = $row['finalDocument'];
            $title = $row['title'];
?>
<div id="adobe-dc-view"></div>
<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
<script type="text/javascript">
        document.addEventListener("adobe_dc_view_sdk.ready", function(){ 
                var adobeDCView = new AdobeDC.View({clientId: "4009dfca2cfb4f559e9b90efa9c83b0d", divId: "adobe-dc-view"});
                adobeDCView.previewFile({
                        content:{location: {url: "../<?php echo $final; ?>"}},
                        metaData:{fileName: "<?php echo $title; ?>"}
                }, {});
        });
</script>
<?php
        }else{
?>
        INVALID
<?php
        }
    }
?>
