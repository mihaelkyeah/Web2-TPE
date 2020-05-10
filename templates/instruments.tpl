{include file='templates/header.tpl'}
    <div>
    <ul>
        {foreach from $instruments item=instrument}
            <li>
                <a href="details/instrument/{$instrument->id_instrument}">{$instrument->ins_name}</a>
            </li>
        {/foreach}
    </ul>
    </div>
{include file='templates/footer.tpl'}