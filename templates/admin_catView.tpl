{include file='templates/header.tpl'}
{include file='templates/detail_categ.tpl'}
    <h2>Edit category</h2>
    <form method="POST" action="editCateg">
        <input type="text" name="newName" placeholder="New name">
        <textarea name="newDescription" rows="3" cols="25" placeholder="New description"></textarea>
        <input type="submit">
    </form>
    <a href="deleteCateg/{$categID}">Delete category</a>
{include file='templates/footer.tpl'}