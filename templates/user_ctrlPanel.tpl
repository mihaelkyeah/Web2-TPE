{* Panel de control del usuario *}

{include file='templates/header.tpl'}
<div class="container">
{if (isset($username)) and (isset($iduser))}
    <h4>Name:</h4>
    <p>{$username}</p>

    <h4>User ID:</h4>
    <p>{$iduser}</p>

    <h4>Is admin:</h4>
        <p>
        {if {$isadmin} eq 0}
            No
        {else}
            Yes
        {/if}
        </p>
{else}
    You're not logged in. You need to be logged in to see the user control panel.
{/if}
</p>
</div>
{include file='templates/footer.tpl'}