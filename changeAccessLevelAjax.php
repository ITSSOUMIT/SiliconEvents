<?php
    include('config.php');
    if(isset($_POST['adminid'])){
        $adminid = $_POST['adminid'];
        $proquery = "SELECT * FROM adminbase WHERE adminid='$adminid'";
        $proresult = $conn->query($proquery);
        $profile = $proresult->fetch_assoc();
?>
<div class="modal-header">
    <h4 class="modal-title">Change User Details</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="dataHandler" method="POST">
    <input type="hidden" name="intent" value="suAdminChangeAccessLevel">
    <input type="hidden" name="adminid" value="<?php echo $_POST['adminid']; ?>">
    <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" placeholder="Name" name="name" value='<?php echo $profile['name']; ?>' required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" placeholder="Username" name="username" value='<?php echo $profile['username']; ?>' required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" placeholder="Email" name="email" value='<?php echo $profile['email']; ?>' required>
        </div>
        <div class="form-group">
            <label>Department</label>
            <select class="form-control" name="department" required>
                <?php
                    $deptquery = "SELECT * FROM department WHERE status=1";
                    $deptresult = $conn->query($deptquery);
                    while($deptrow = $deptresult->fetch_assoc()){
                ?>
                <option value="<?php echo $deptrow['departmentid']; ?>" <?php if($deptrow['departmentid']==$profile['department']){ echo "selected"; } ?>><?php echo $deptrow['departmentname']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Role</label>
            <select class="form-control" name="accessLevel" required>
                <option value="12" <?php if($profile['accessLevel']==12){ echo "selected"; } ?>>Super Admin</option>
                <option value="1" <?php if($profile['accessLevel']==1){ echo "selected"; } ?>>News Editor</option>
                <option value="0" <?php if($profile['accessLevel']==0){ echo "selected"; } ?>>General User</option>
            </select>
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