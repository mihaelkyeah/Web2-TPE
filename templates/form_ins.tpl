{* Formulario para crear o editar instrumentos *}

<div class="form-group">
    <label>Name:</label>
    <input type="text" name="insName" placeholder="Name" class="form-control">
</div>
<div class="form-group">
    <label>Category</label>
    <select name="insCateg" class="form-control">
        {foreach from=$categArray item=category}
            <option value={$category->id_categ}>{$category->categ_name}</option>
        {/foreach}
        {*
        En un principio había usado el índice del arreglo $category para las option value=...'s,
        pero nuevamente me encontré con el problema de que los id's no guardan relación
        con las posiciones de las categorías en el arreglo.
        Por ende, los valores a elegir en el select van a ser
        los id's correspondientes a cada categoría por la que pasa el foreach.
        *}
    </select>
</div>
<div class="form-group">
    <label>Description:</label><br>
    <textarea name="insDesc" rows="3" cols="25" placeholder="Description" class="form-control"></textarea>
</div>
<div class="form-group">
    <label>Price:</label>
    <input type="number" name="price" min="0" max="99999.99" step=".01" placeholder="Price" class="form-control">
</div>