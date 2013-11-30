<?=form_open($form_action, '', $form_hidden);?>
<?=validation_errors()?>
<table class="mainTable" border="0" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th><?=lang('api_key')?></th>
            <th><?=lang('price_currency_iso')?></th>
        </tr>
    </thead>
    <tbody>
        <tr class="even">
            <td><?=lang('api_key', 'api_key')?></td>
            <td><?=form_input('api_key', $api_key)?></td>
        </tr>
        <tr class="even">
            <td><?=lang('price_currency_iso', 'price_currency_iso')?></td>
            <td><?=form_input('price_currency_iso', $price_currency_iso)?></td>
        </tr>
    </tbody>
</table>
<?=form_submit('submit', lang('submit'), 'class="submit"')?>

<?=form_close()?>