{* Autenticación / inicio de sesión *}

{include 'templates/header.tpl'}

<div class="container">
    <form
        {if $formType eq true}
            action="user/register"
        {else if $formType eq false}
            action="user/verify"
        {/if}
        method="POST">
        <div class = "form-group">
            <label>Username</label>
            <input name="username" type="text" placeholder="Enter username" class="form-control" required>
        </div>
        {include 'templates/user_password.tpl'}
        {if $formType eq true}
            {include 'templates/user_questionform.tpl'}    
        {/if}

        {if isset($error)}
            <div class="alert alert-danger" role="alert">
                {$error}
            </div>
        {elseif isset($smarty.get.passreset)}
            <div class="alert alert-success">
                Your password has been successfully changed. You can now log in with your new password.
            </div>
        {/if}

        {if $formType eq true}
            <div class="centerButton">
                <input type="submit" class="btn btn-primary btn-lg" value="Sign up">
            </div>
        {else}
            <a href="user/recovery/step1">(Forgot your password?)</a>
            <div class="centerButton">
                <input type="submit" class="btn btn-primary btn-lg" value="Log in">
            </div>
        {/if}
    </form>
</div>

{include 'templates/footer.tpl'}