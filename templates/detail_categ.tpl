{include 'templates/header.tpl'}
    <div class="container">
        <h2>{$category->name}</h2>
        <p class="text-break">{$category->details}</p>
        <a href="instruments/{$category->id}">Show instruments of this category</a>

    {if {$category->image} <> ""}
        <div class="imageDiv">
        <img src="./{$category->image}" class="img-responsive img-rounded" height=240>
        {if (isset($isadmin) and ($isadmin eq 1))}
        <br><a href="image/delete/categ/{$category->id}" class="btn btn-danger btn-sm buttonContainer">Delete image</a>
        {/if}
        </div>
    {/if}
    </div>
    {if (isset($isadmin) and ($isadmin eq 1))}
        <hr class="divideFormAdmin">
        {include 'templates/edit_category.tpl'}

    {/if}
{include 'templates/footer.tpl'}