{include 'templates/header.tpl'}
    <div class="container">
        <h2>{$category->name}</h2>
        <p class="text-break">{$category->details}</p>
        <a href="instruments/{$category->id}">Show instruments of this category</a>
    </div>
    
    {* Bloque reservado para administrador *}
    {if (isset($isadmin)) and ($isadmin eq 1)}

        <hr class="divideFormAdmin">
        {include 'templates/edit_category.tpl'}

    {/if}
{include 'templates/footer.tpl'}