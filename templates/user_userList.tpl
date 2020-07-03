{* Panel de control del administrador (lista de usuarios) *}

{include file='templates/header.tpl'}
<div class="container">

    <div class="userContainer">
    <ul class="list-group list-group-flush">
    {foreach from=$users item=user}
        <li class="list-group-item">
            <div class="userListContainer alignLeft">
            {$user->username}
            </div>
            <div class="userListContainer alignRight">
            {if ($user->admin) eq 0}
                <a href="admin/add/{$user->id}"class="btn btn-primary">User</a>
            {else}
                <a href="admin/remove/{$user->id}"class="btn btn-danger">Admin</a>
            {/if}
            </div>
        </li>
    {/foreach}
    </ul>
    </div>

</p>
</div>
{include file='templates/footer.tpl'}