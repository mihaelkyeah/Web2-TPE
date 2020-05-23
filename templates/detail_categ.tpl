{include 'templates/header.tpl'}
    <div class="container">
        <h2>{$category->categ_name}</h2>
        <p>{$category->categ_desc}</p>
        <a href="instruments/{$category->id_categ}">Show instruments of this category</a>
    </div>
    
    {* Bloque reservado para administrador *}
    {if (isset($isadmin)) and ($isadmin eq 1)}

        <hr class="divideFormAdmin">
        {include 'templates/edit_category.tpl'}

    {/if}
{include 'templates/footer.tpl'}