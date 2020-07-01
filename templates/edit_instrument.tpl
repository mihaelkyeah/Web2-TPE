<div class="container">
    <h4>Edit instrument</h4>
    <form method="POST" action="update/instrument/{$instrument->id_instrument}" enctype="multipart/form-data">
        {include 'templates/form_ins.tpl'}
        <input type="submit" value="Update instrument" class="btn btn-info buttonContainer">
        <a href="delete/instrument/{$instrument->id_instrument}" class="btn btn-danger buttonContainer">Delete instrument</a>
    </form>
</div>