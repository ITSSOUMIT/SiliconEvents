<?php
    if(isset($_POST['adminid'])){
?>
<div class="modal-header">
    <h4 class="modal-title">Change Password</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="dataHandler" method="POST">
<input type="hidden" name="intent" value="suAdminPasswordChange">
<input type="hidden" name="adminid" value="<?php echo $_POST['adminid']; ?>">
<div class="modal-body">
    <div class="form-group">
        <label for="exampleInputEmail1">New Password</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter New Password" name="password" required>
    </div>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
<?php
    }
?>