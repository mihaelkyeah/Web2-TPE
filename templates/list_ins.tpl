{* Lista de instrumentos *}

{include file='templates/header.tpl'}
<div class="container">
{* Verifica si $instruments tiene algo o está vacío*}
{if not $instruments}
    <p>There are currently no instruments of the specified category. Please try again later.</p>
{* Si $instruments tiene algo, muestra los instrumentos normalmente *}
{else}
    <ul class="list-group list-group-flush">
        {* Arreglo de instrumentos *}
        {foreach from=$instruments item=instrument}
                {if ($instrument@index mod 3) eq 0}
                    <li class="list-group-item">
                    <div class="row" style="margin: 20px auto">
                {/if}
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <a href="details/instrument/{$instrument->id}" class="card-title">{$instrument->name}</a>
                                <p class="card-text">{$instrument->details}</p>
                            </div>
                        </div>
                    </div>
                {if ($instrument@index mod 3) eq 2}
                    </div>
                    </li>
                {/if}
        {/foreach}
    </ul>
    {if (isset($isadmin)) and ({$isadmin} eq 1)}
        <div class="centerButton">
            <a href="formnew/instrument" class="btn btn-warning">Create instrument</a>
        </div>
    {/if}
{/if}
</div>
{include file='templates/footer.tpl'}