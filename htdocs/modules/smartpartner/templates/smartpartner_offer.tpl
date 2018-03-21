<{if !$nointro}>
    <div><{$lang_offer_intro}></div><{/if}><{foreach item=category from=$offers}>
    <b><{$category.name}></b>
    :
    <br>
    <{foreach key=key item=partner from=$category.partners}><{foreach item=offer from=$partner.offers}>
        <a href="<{$xoops_url}>/modules/smartpartner/partner.php?id=<{$key}>"><{$offer.title}></a>
        <table>
        <tr>
            <td width="60">
                <a href="<{$xoops_url}>/modules/smartpartner/partner.php?id=<{$key}>">
                    <img src="<{$xoops_url}>/uploads/smartpartner/offer/<{$offer.image}>"></a>
            </td>
            <td align="left">
                <{$offer.description}><br> <{if $offer.url}>
                    <a href='<{$offer.url}>' target='_blank'><{$lang_offer_click_here}></a>
                    <br>
                <{/if}>
            </td>
        </tr>
        </table><{/foreach}>
        <br>
    <{/foreach}><{if $category.subcats}>
        <div style="padding-left:15px;">
        <{include file='db:smartpartner_offer.tpl' offers=$category.subcats nointro=1}>
        </div><{/if}>

<{/foreach}>
<hr><br><br>
