{* Formulario para crear o editar categorías *}
<div class="form-group">
    <input type="text" name="categName" id="categName" placeholder="Name" class="form-control"
    {if isset($category)}
        value={$category->name}
    {/if}>
</div>
<div class="form-group">
    <textarea name="categDetails" id="categDetails" rows="3" cols="25" maxlength="255" placeholder="Description" class="form-control" 
    >{if isset($category)}{$category->details}{/if}</textarea>
</div>
<div class="form-group">
    <label>Add image:</label><br>
    <input type="file" name="insImg" id="insImg">
</div>