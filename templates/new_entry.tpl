{* Nueva entrada (instrumento o categoría) *}

{include 'templates/header.tpl'}
    <div class="container">
        <h2>Create new 
        {if $type eq "instrument"}
            instrument</h2>
            <div class="container">
                {* {include 'templates/form_ins_img.tpl'} *}
                <form method="POST" action="create/instrument">
                    {include 'templates/form_ins.tpl'}
                    <input type="submit" value="Create instrument" class="btn btn-warning">
                </form>
            </div>
        {elseif $type eq "category"}
            category</h2>
            <div class="container">
                <form method="POST" action="create/category">
                    {include 'templates/form_categ.tpl'}
                    <input type="submit" value="Create category" class="btn btn-warning">
                </form>
            </div>
        {/if}
    </div>
{include 'templates/footer.tpl'}