{include 'templates/header.tpl'}
    <div class="container">
        <h2>{$category->categ_name}</h2>
        <p>{$category->categ_desc}</p>
        <a href="instruments/{$category->id_categ}">Show instruments of this category</a>
    </div>
    {* Verificación de si es admin *}
    <hr style="width:90%; margin: 30 auto">
    {include 'templates/edit_category.tpl'}
{include 'templates/footer.tpl'}