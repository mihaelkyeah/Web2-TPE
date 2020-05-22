{include 'templates/header.tpl'}
    <div class="container">
        <h2>About the {$instrument->ins_name}</h2>
        <img src="img/trebleclef.png" height="100px">
        <h3>Description:</h3>
        <p>{$instrument->ins_desc}</p>
        <h3>Price: {$instrument->price}</h3>
    </div>
{include 'templates/footer.tpl'}