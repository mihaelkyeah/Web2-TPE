{include file='templates/header.tpl'}
<div>
    <ul class="list-group list-group-flush">
        {foreach from=$categories item=category}
            <li class="list-group-item">
                <a href="details/category/{$category->id_categ}" class="btn btn-primary">{$category->categ_name}</a>
                <a href="instruments/{$category->id_categ}" class="btn btn-link btn-sm">Show instruments of this category</a>
            </li>
        {/foreach}
    </ul>
    <a href="formnew/category">Create category</a>
</div>
{include file='templates/footer.tpl'}