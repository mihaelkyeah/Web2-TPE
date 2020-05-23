<div class="container">
    <h4>Edit instrument</h4>
    <form method="POST" action="update/instrument/{$instrument->id_instrument}">
        {include 'templates/form_ins.tpl'}
        <input type="submit" value="Update instrument">
    </form>
    <a href="delete/instrument/{$instrument->id_instrument}">Delete instrument</a>
</div>