<div class="container">
    <h4>Edit instrument</h4>
    {include 'templates/form_ins_img.tpl'}
    <form method="POST" action="update/instrument/{$instrument->id}">
        {include 'templates/form_ins.tpl'}
        <input type="submit" value="Update instrument" class="btn btn-info buttonContainer">
        <a href="delete/instrument/{$instrument->id}" class="btn btn-danger buttonContainer">Delete instrument</a>
    </form>
</div>