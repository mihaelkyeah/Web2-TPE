{* Formulario para crear o editar instrumentos *}

<div class="form-group">
    <label>Name:</label>
    <input type="text" name="insName" id="insName" placeholder="Name" class="form-control"
    {if isset($instrument)}
        value="{$instrument->name}"
    {/if}
    >
</div>
<div class="form-group">
    <label>Category</label>
    <select name="insCateg" id="insCateg" class="form-control">
        {foreach from=$categArray item=category}
            <option value={$category->id}
            {if (isset($instrument)) && ({$instrument->id_categ_fk} eq {$category->id})}
                selected
            {/if}
            >
            {$category->name}
            </option>
        {/foreach}
    </select>
</div>
<div class="form-group">
    <label>Description:</label><br>
    <textarea name="insDetails" id="insDetails" rows="3" cols="25" maxlength="255" placeholder="Description" class="form-control"
    >{if isset($instrument)}{$instrument->details}{/if}</textarea>

    {* TODO: Implementar contador hacia atrás de caracteres para el textarea *}
    {* <p id="charWarning"><span id="categChars">255</span> characters remaining.</p> *}

</div>
<div class="form-group">
    <label>Price:</label>
    <input type="number" name="price" id="price" min="0" max="99999.99" step=".01" placeholder="Price" class="form-control"
    {if isset($instrument)}
        value={$instrument->price}
    {else}
        value="0.00";
    {/if}
    >
</div>
<div class="form-group">
    <label>Image:</label><br>
    <input type="file" name="insImg" id="insImg">
</div>