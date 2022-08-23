<?php
    include('config.php');
    include('const/check.php');
    include('functions.php');
    if(isset($_POST['reportid'])){
        $reportid = $_POST['reportid'];
?>
<div class="modal-header">
    <h4 class="modal-title">Upload Final Report</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="dataHandler" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="intent" value="uploadFinalReport">
    <div class="modal-body viewDesc">
        <div class="form-group">
            <label for="exampleInputEmail1">Report ID :</label>
            <input type="text" name="reportid" class="form-control" value="<?php echo $reportid; ?>" readonly required>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Final Report :</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" accept="application/pdf"
                        name="finalReport">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<script>
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    var fileName = document.getElementById("exampleInputFile").files[0].name;
    var nextSibling = e.target.nextElementSibling
    nextSibling.innerText = fileName
})
</script>
<?php } ?>