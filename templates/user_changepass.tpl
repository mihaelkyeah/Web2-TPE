{include 'templates/header.tpl'}
    <div class="container">
        <h3>Welcome back, <b>{$recoveryUsername}.</b></h3>
        <form method="POST" action="user/recovery/resetpass/{$recoveryUserID}">
            <div class = "form-group">
                <label>Enter new password</label>
                <input name="newPassword" type="password" placeholder="Enter new password" class="form-control" required>
            </div>
            <div class = "form-group">
                <Label>Confirm new password</label>
                <input name="confirmNewPassword" type="password" placeholder="Confirm new password" class="form-control" required>
            </div>
            {if isset($error)}
                <div class="alert alert-danger">{$error}</div>
            {/if}
            <div class = "centerButton">
                <h4>Warning!</h4>
                <h5>This action cannot be undone.</h5>
                <input type="submit" class="btn btn-warning btn-lrg" value="Reset password">
            </div>
        </form>
    </div>
    {include 'templates/footer.tpl'}