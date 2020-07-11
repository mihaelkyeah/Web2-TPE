{include 'templates/header.tpl'}
    <div class="container">
        <form method="POST" action="user/recovery/step1/verify">
            <div class = "form-group">
            <label>Username</label>
                <input name="username" type="text" placeholder="Enter username" class="form-control" required>
            </div>
            {include 'templates/user_questionform.tpl'}
            {if isset($error)}
                <div class="alert alert-danger">{$error}</div>
            {/if}
            <div class = "centerButton">
                <input type="submit" class="btn btn-primary" value="Submit answer">
            </div>
        </form>
    </div>
{include 'templates/footer.tpl'}