<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/*TAGS*/

foreach ($arResult['PROPERTIES']['PRICE']['VALUE'] as $arPrice){
    $arSelect = Array("ID", "NAME", "PROPERTY_PRICE", "PREVIEW_TEXT");
    $arFilter = Array("IBLOCK_ID"=>$arResult['PROPERTIES']['PRICE']['LINK_IBLOCK_ID'], "ID"=>$arPrice, "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $arResult['PRICE'][$arPrice] =  $arFields;
    }
}
$NAME = $arResult['NAME'];
$NAME = mb_substr($NAME, 0, 40);

if(mb_strlen($arItem['NAME']) > 40){
    $arResult['NAME_IMPLODE'] =  $NAME."... ";
}else{
    $arResult['NAME_IMPLODE'] =  $NAME;
}
?>
		
