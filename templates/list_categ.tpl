{* Lista de categorías *}

{include file='templates/header.tpl'}
<div class=container>
    <ul class="list-group list-group-flush">
        {foreach from=$categories item=category}
            <li class="list-group-item">
                <a href="details/category/{$category->id}" class="btn btn-primary">{$category->name}</a>
                <a href="instruments/{$category->id}" class="btn btn-link btn-sm">Show instruments of this category</a>
            </li>
        {/foreach}
    </ul>
</div>
{if (isset($isadmin)) and ({$isadmin} eq 1)}
<div class="centerButton">
    <a href="formnew/category" class="btn btn-warning">Create category</a>
</div>
{/if}
{include file='templates/footer.tpl'}