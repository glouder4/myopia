<?php
unset($arResult["SECTION"]["PATH"]);
$arResult['SECTION_SELECTED'] = false;
CModule::IncludeModule("iblock");
$arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"]);
$rsSect = CIBlockSection::GetList(array('sort' => 'asc'),$arFilter);
while ($arSect = $rsSect->GetNext())
{
    if(intval($arParams["SECTION_ID"]) && $arParams["SECTION_ID"] == $arSect['ID']){
        $arSect["SELECTED"] = true;
        $arResult['SECTION_SELECTED'] = $arSect['ID'];
    } elseif(strval($arParams["SECTION_CODE"]) && $arParams["SECTION_CODE"] == $arSect['CODE']){
        $arSect["SELECTED"] = true;
        $arResult['SECTION_SELECTED'] = $arSect['ID'];
    }
    $arResult['SECTION'][$arSect['ID']] = $arSect;
}
if(intval($arResult['SECTION_SELECTED'])){
    $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
        $arParams['IBLOCK_ID'], // ID инфоблока
        $arResult['SECTION_SELECTED'] // ID элемента
    );
    $arResult['SECTION_META_PROPERTY'] = $ipropValues->getValues();
    $cp = $this->__component;
    $cp->SetResultCacheKeys(array("SECTION_META_PROPERTY"));
}