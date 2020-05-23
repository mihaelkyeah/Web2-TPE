{* Autenticación / inicio de sesión *}

{include 'templates/header.tpl'}

<div class="container">
    <form action="verify" method="POST">
        <div class = "form-group">
            <label>User</label>
            <input name="username" type="text" placeholder="Enter username" class="form-control">
        </div>
        <div class = "form-group">
            <label>Password</label>
            <input name="password" type="password" placeholder="Enter password" class="form-control">
        </div>

        {if isset($error)}
            <div class="alert alert-danger" role="alert">
                {$error}
            </div>
        {/if}

        <input type="submit" class="btn btn-primary">
    </form>
</div>

{include 'templates/footer.tpl'}