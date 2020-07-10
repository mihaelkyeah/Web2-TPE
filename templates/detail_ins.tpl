{include 'templates/header.tpl'}
    <div class="container">
        <h2>About the {$instrument->name}</h2>
        <img src="img/trebleclef.png">
        <h3>Category:</h3>
        <a href="details/category/{$instrument->id_categ_fk}">{$categArray[$categIndex]->name}</a>
        <h3>Description:</h3>
        <p class="text-break">{$instrument->details}</p>
        <h3>Price: {$instrument->price}</h3>
        {if (isset($images))}
            <div class="imageDiv">
                {foreach from=$images item=image}
                <div class="eachImage">
                    <img src="./{$image->image}" class="img-responsive img-rounded" height=240>
                        {if (isset($isadmin) and ($isadmin eq 1))}
                    <br><a href="image/delete/instr/{$instrument->id}/img/{$image->id}" class="btn btn-danger btn-sm buttonContainer">Delete image</a>
                        {/if}
                </div>
                {/foreach}
            </div>
        {/if}
    </div>

    <section class="wrapper"  id="commentSection" 
        insID="{$instrument->id}"
        {if (isset($user))}
            userID="{$user->id}"
            username="{$user->username}"
        {/if}
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