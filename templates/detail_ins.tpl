{include 'templates/header.tpl'}
    <div class="container">
        <h2>About the {$instrument->ins_name}</h2>
        <img src="img/trebleclef.png" height="100px">
        <h3>Category:</h3>
        <a href="details/category/{$instrument->id_categ_fk}">{$categArray[$categIndex]->categ_name}</a>
        <h3>Description:</h3>
        <p>{$instrument->ins_desc}</p>
        <h3>Price: {$instrument->price}</h3>
    </div>

    {* Bloque reservado para administrador *}
    {if (isset($isadmin)) and ($isadmin eq 1)}
        <hr class="divideFormAdmin">
        {include 'templates/edit_instrument.tpl'}
    {/if}
{include 'templates/footer.tpl'}