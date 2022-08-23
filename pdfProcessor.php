<?php
    include('config.php');
    if(isset($_POST['shortLink']) && isset($_POST['password'])){
        $shortLink = $_POST['shortLink'];
        $password = $_POST['password'];
        $query = "SELECT * FROM report WHERE reportShortLink = '$shortLink' AND reportpassword = '$password' AND publicSharing=1";
        $result = $conn->query($query);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
?>
<div id="adobe-dc-view"></div>
<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
<script type="text/javascript">
document.addEventListener("adobe_dc_view_sdk.ready", function() {
    var adobeDCView = new AdobeDC.View({
        clientId: "8d9d2c8253394985ba06064095761750",
        divId: "adobe-dc-view",
    });
    adobeDCView.previewFile({
        content: {
            location: {
                url: "<?php echo "../".$row['finalDocument']; ?>",
            },
        },
        metaData: {
            fileName: "<?php echo $row['reportid']; ?>"
        },
    }, {});
});
</script>
<?php
        }else{
            echo "101";
        }
    }else{
        echo "404";
    }
?>