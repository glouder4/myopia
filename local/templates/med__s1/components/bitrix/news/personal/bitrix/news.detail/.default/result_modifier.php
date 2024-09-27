<?php
$arResult['SECTION_SELECTED'] = false;
unset($arResult["SECTION"]["PATH"]);
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