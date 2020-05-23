<div class="container">
    <h4>Edit category</h4>
    <form method="POST" action="update/category/{$category->id_categ}">
        {include 'templates/form_categ.tpl'}
        <input type="submit" value="Update category" class="btn btn-info buttonContainer">
        <a href="delete/category/{$category->id_categ}" class="btn btn-danger buttonContainer">Delete category</a>
    </form>
</div>