<div class="modal fade" id="modalChangePassword">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Old Password</label>
                            <input type="password" class="form-control" id="oldPassword"
                                placeholder="Old Password" name="oldPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" class="form-control" id="newPassword" placeholder="New Password"
                                name="newPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Retype New Password</label>
                            <input type="password" class="form-control" id="newPasswordRe"
                                placeholder="Retype New Password" onkeyup="enableBtn(this)" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="changepasswordbtn" onclick="changePassword()" disabled>Change Password</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>