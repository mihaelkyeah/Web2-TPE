{include file='templates/header.tpl'}
    <div>
    <ul>
        {foreach from $categories item=category}
            <li>
                <a href="details/category/{$category->id_categ}">{$category->categ_name}</a>
            </li>
        {/foreach}
    </ul>
    </div>
{include file='templates/footer.tpl'}