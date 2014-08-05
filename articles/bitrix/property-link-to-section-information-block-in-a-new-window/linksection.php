<?
namespace Custom\IBlock\Properties;

use CIBlockSection;

/**
 * Class LinkSection
 * @package Custom\IBlock\Properties
 */

class LinkSection
{
    public function GetUserTypeDescription()
    {
        $className = get_called_class();
        return array(
            "PROPERTY_TYPE" => "E",
            "DESCRIPTION" => "Привязка к разделам (в новом окне)",
            "GetPropertyFieldHtml" => array($className, "GetPropertyFieldHtml"),
            "GetPropertyFieldHtmlMulty" => array($className, "GetPropertyFieldHtmlMulty"),
        );
    }

    /**
     * @param int $id
     * @return string
     */
    public function getSectionName($id)
    {
        $name = "";
        if(empty($id)){
            return $name;
        }
        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        $dbRes = CIBlockSection::GetList(
            array("ID" => "ASC"),
            array("ID" => $id),
            false,
            array("ID", "NAME"),
            array("nTopCount" => 1)
        );
        if($arRes = $dbRes->Fetch()){
            $name = $arRes["NAME"];
        }
        return $name;
    }

    /**
     * @param array $arProperty
     * @param array $value
     * @param array $strHTMLControlName
     * @return string
     */
    public function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        $n = preg_replace("/[^a-zA-Z0-9_\\[\\]]/", "", $strHTMLControlName["VALUE"]);
        $md5 = md5($n);
        ob_start();?>
        <input type="text" name="<?=$strHTMLControlName["VALUE"]?>" id="<?=$n;?>" value="<?=$value['VALUE']?>" size="5">
        <input type="button" value="..." onclick="jsUtils.OpenWindow('/bitrix/admin/iblock_section_search_custom.php?lang=<?=LANG;?>&IBLOCK_ID=<?=$arProperty["LINK_IBLOCK_ID"];?>&n=<?=$n;?>&k=n0', 800, 600);">
        <span id="sp_<?=$md5;?>_n0"><?if(!empty($value['VALUE'])):?><?=self::getSectionName($value['VALUE'])?><?endif;?></span>
        <?return ob_get_clean();
    }

    public function GetPropertyFieldHtmlMulty($arProperty, $value, $strHTMLControlName)
    {
        ob_start();?>
        </td></tr>
        <?$md5 = md5($strHTMLControlName["VALUE"]);?>
        <?foreach ($value as $id => $v):?>
        <tr>
            <td>
                <input type="text" name="<?=$strHTMLControlName["VALUE"]?>[<?=$id;?>][VALUE]" id="<?=$strHTMLControlName["VALUE"]?>[<?=$id?>]" value="<?=$v["VALUE"];?>" size="5">
                <input type="button" value="..." onclick="jsUtils.OpenWindow('/bitrix/admin/iblock_section_search_custom.php?lang=<?=LANG;?>&IBLOCK_ID=<?=$arProperty["LINK_IBLOCK_ID"];?>&n=<?=$strHTMLControlName["VALUE"]?>&k=<?=$id;?>', 800, 600);">
                <span id="sp_<?=$md5;?>_<?=$id?>"><?if(!empty($v['VALUE'])):?><?=self::getSectionName($v['VALUE'])?><?endif;?></span>
                <br>
            </td>
        </tr>
    <?endforeach;?>
        <?for ($i = 0; $i < (int)$arProperty["MULTIPLE_CNT"]; $i++):?>
        <tr>
            <td>
                <input type="text" name="<?=$strHTMLControlName["VALUE"]?>[n<?=$i;?>][VALUE]" id="<?=$strHTMLControlName["VALUE"]?>[n<?=$i;?>]" size="5">
                <input type="button" value="..." onclick="jsUtils.OpenWindow('/bitrix/admin/iblock_section_search_custom.php?lang=<?=LANG;?>&IBLOCK_ID=<?=$arProperty["LINK_IBLOCK_ID"];?>&n=<?=$strHTMLControlName["VALUE"]?>&k=n<?=$i;?>', 800, 600);">
                <span id="sp_<?=$md5;?>_n<?=$i?>"></span>
                <br>
            </td>
        </tr>
    <?endfor;?>
        <tr>
        <td>
        <input type="button" value="Добавить..."
               onclick="jsUtils.OpenWindow('/bitrix/admin/iblock_section_search_custom.php?lang=<?=LANG;?>&IBLOCK_ID=<?=$arProperty["LINK_IBLOCK_ID"];?>&n=<?=$strHTMLControlName["VALUE"];?>&m=y&k=n<?=$i;?>', 800, 600);">
        <span id="sp_<?=$md5?>_n<?=$i;?>"></span>
        <script type="text/javascript">
            var MV_<?=$md5;?> = <?=($i);?>;
            function InS<?=$md5;?>(id, name){
                oTbl=document.getElementById('tb<?=$md5;?>');
                oRow=oTbl.insertRow(oTbl.rows.length-1);
                oCell=oRow.insertCell(-1);
                oCell.innerHTML='<input name="<?=$strHTMLControlName["VALUE"];?>[n'+MV_<?=$md5;?>+'][VALUE]" value="'+id+'" size="5" type="text">&nbsp;'+
                '<input type="button" value="..." '+
                'onClick="jsUtils.OpenWindow(\'/bitrix/admin/iblock_section_search_custom.php?lang=<?=LANG;?>&IBLOCK_ID=<?=$arProperty["LINK_IBLOCK_ID"];?>&n=<?=$strHTMLControlName["VALUE"]?>&k='+MV_<?=$md5;?>+'\', '+
                ' 800, 600);">' + '<span id="sp_<?=$md5;?>_'+MV_<?=$md5;?>+'" >'+name+'</span><br />';MV_<?=$md5;?>++;}
        </script>
        <?return ob_get_clean();
    }
}
?>