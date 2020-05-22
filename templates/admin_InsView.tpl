{include file='templates/header.tpl'}
{include file='templates/detail_ins.tpl'}
    <h2>Edit instrument</h2>
    <form method="POST" action="editIns">
        <input type="text" name="newName" placeholder="New name">
        <textarea name="newDescription" rows="3" cols="25" placeholder="New description"></textarea>
        <input type="number" name="newPrice" min="0" max="99999.99" step=".01" placeholder="New price">
        <input type="submit">
    </form>
    <a href="deleteIns/{$insID}">Delete instrument</a>
{include file='templates/footer.tpl'}