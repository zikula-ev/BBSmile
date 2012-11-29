{ajaxheader modname=BBSmile filename='dosmilie.js'}
{ajaxheader modname=BBSmile filename='control_modal.js'}

{* add the javascript file  *}

<noscript>
    <p class="noscript">{gt text='Your browser does not support javascript or you turned it off. The BBSmile interface has been disabled.'}</p>
</noscript>

<div id="bbsmile_{$counter}" class="bbsmile_smilies">
    {bbsmile_smilie_list assign="smilies" type="standard"}
    <div class="bb_standardsmilies">
        {* default smilies *}
        {foreach item=smilie from=$smilies}
        <a href="javascript:void(0);" onclick="AddSmilie('{$textfieldid}', ' {$smilie.short} ')" title="{$smilie.short}">
            <img class="bb_smilie" src="{getbaseurl}{$modvars.BBSmile.smiliepath}/{$smilie.imgsrc}" alt='Smilie {$smilie.alt}' />
        </a>
        {/foreach}
    </div>

    {if $modvars.BBSmile.activate_auto}
    <div class="bb_showhidesmilies">
        <a href="{getbaseurl}ajax.php?module=BBSmile&amp;func=loadsmilies&amp;textfieldid={$textfieldid}" id="smiliemodal">{gt text='More Smilies'}</a>&nbsp;<img class="hidden" id="loadsmilieindicator" src="images/ajax/indicator.white.gif" alt="ajaxindicator" />
    </div>
    {/if}
</div>

