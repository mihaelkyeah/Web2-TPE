<div class = "form-group">
    <label>Password</label>
    <input name="password" type="password" placeholder="Enter password" class="form-control" required>
</div>
{if $formType eq true}
<div class = "form-group">
    <Label>Confirm password</label>
    <input name="confirmPassword" type="password" placeholder="Confirm password" class="form-control" required>
</div>
{/if}