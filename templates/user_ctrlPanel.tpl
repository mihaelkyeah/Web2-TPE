{* Panel de control del usuario *}

{include file='templates/header.tpl'}
<div class="container">
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
</p>
</div>
{include file='templates/footer.tpl'}