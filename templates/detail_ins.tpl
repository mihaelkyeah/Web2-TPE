{include 'templates/header.tpl'}
    <div class="container">
        <h2>About the {$instrument->name}</h2>
        <img src="img/trebleclef.png">
        <h3>Category:</h3>
        <a href="details/category/{$instrument->id_categ_fk}">{$categArray[$categIndex]->name}</a>
        <h3>Description:</h3>
        <p class="text-break">{$instrument->details}</p>
        <h3>Price: {$instrument->price}</h3>
        {if $instrument->image <> ""}
            <div class="insImg">
                <img src="./{$instrument->image}" class="img-responsive img-rounded" height=240>
                {if (isset($isadmin) and ($isadmin eq 1))}
                    <br><a href="delete/instrument/image/{$instrument->id}" class="btn btn-danger btn-sm buttonContainer">Delete image</a>
                {/if}
            </div>
        {/if}
    </div>

    <section class="wrapper"  id="user" 
        username="{$user->username}"
        privilege=
        {if (!isset($isadmin))}
            "0"
        {else}
            {if $isadmin eq 0}
                "1"
            {else}
                "2"
            {/if}
        {/if}>
        {include 'templates/vue/rating.vue'}
        {include 'templates/vue/comment-list.vue'}
        {include 'templates/vue/comment-form.vue'}
    </section>

    {* Bloque reservado para administrador *}
    {if (isset($isadmin)) and ($isadmin eq 1)}
        <hr class="divideFormAdmin">
        {include 'templates/edit_instrument.tpl'}
    {/if}
    <script type="text/javascript" src="js/comments.js"></script>
{include 'templates/footer.tpl'}