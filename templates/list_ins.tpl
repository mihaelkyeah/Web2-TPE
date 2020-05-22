{include file='templates/header.tpl'}
<div>
    <div class="container">
    <ul class="list-group list-group-flush">
        {foreach from=$instruments item=instrument}
            {if ($instrument@index mod 3) eq 0}
                <li class="list-group-item">
                <div class="row" style="margin: 20px auto">
            {/if}
                <div class="col-4">
                    <div class="card">
                        {*<img class="card-img-top" src="img/instrument.png" height=100 width=100 alt="Card image cap">*}
                        <div class="card-body">
                            <a href="details/instrument/{$instrument->id_instrument}" class="card-title">{$instrument->ins_name}</a>
                            <p class="card-text">{$instrument->ins_desc}</p>
                        </div>
                    </div>
                </div>
            {if ($instrument@index mod 3) eq 2}
                </div>
                </li>
            {/if}
        {/foreach}
    </ul>
    </div>
</div>
{include file='templates/footer.tpl'}