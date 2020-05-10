{*
Esto debería ser un template para editar un instrumento, pero en el form no sé a qué php apuntar...
O si estoy bien encaminado para empezar. Ya veremos.
*}

{include file='templates/header.tpl'}
{include file='templates/insDetail'}
    <form method="POST" action="">
        <input type="text" name="newName" placeholder="Nombre nuevo">
        <textarea name="newDescription" rows="3" cols="25" placeholder="Descripción nueva"></textarea>
        <input type="submit">
    </form>
{include file='templates/footer.tpl'}