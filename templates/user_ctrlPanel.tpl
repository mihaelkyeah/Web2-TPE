{include file='templates/header.tpl'}
<h2>Lorem ipsum dolor sit amet</h2>
{*
<h2>Name:</h2>
<p>{$user->username}</p>
*}

<h4>Is admin:</h4>
<p>
{if {$isadmin} eq 0}
    No
{else}
    Yes
{/if}
</p>

{*
<a class="btn btn-primary" href=changePass/{$user->id_user}>Change password</a>
<a class="btn btn-danger" href=deleteUser/{$user->id_user}>Delete user</a>
*}
{include file='templates/footer.tpl'}