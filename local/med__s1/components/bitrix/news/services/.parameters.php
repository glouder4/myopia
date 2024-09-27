<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\ModuleManager;
CModule::IncludeModule("iblock");

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["FB_IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
    $arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["FB_IBLOCK_ID"]));
while ($arr=$rsProp->Fetch())
{
    $arProperty[$arr["ID"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
    if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S", "F")))
    {
        $arProperty_LNSF[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
    }
}

//$arEvent = Array();
//$dbType = CEventMessage::GetList($by="ID", $order="DESC", $arFilter);
//while($arType = $dbType->GetNext())
//    $arEvent[$arType["ID"]] = "[".$arType["ID"]."] ".$arType["SUBJECT"];
//
//$arTemplateParameters["FB_EVENT_MESSAGE_ID"] = array(
//    "NAME" => GetMessage("MFP_EMAIL_TEMPLATES"),
//    "TYPE"=>"LIST",
//    "VALUES" => $arEvent,
//    "MULTIPLE"=>"Y",
//    "COL" => 25,
//    "PARENT" => "PARAMS",
//);
$arTemplateParameters["FB_USE_CAPTCHA"] = array(
    "NAME" => GetMessage("IBLOCK_USE_CAPTCHA"),
    "TYPE" => "CHECKBOX",
    "DEFAULT" => "N",
);
$arTemplateParameters["FB_IBLOCK_TYPE"] = array(
//    "PARENT" => "DATA_SOURCE",
    "NAME" => GetMessage("IBLOCK_TYPE"),
    "TYPE" => "LIST",
    "ADDITIONAL_VALUES" => "Y",
    "VALUES" => $arIBlockType,
    "REFRESH" => "Y",
);
$arTemplateParameters["FB_IBLOCK_ID"] = array(
//    "PARENT" => "DATA_SOURCE",
    "NAME" => GetMessage("IBLOCK_IBLOCK"),
    "TYPE" => "LIST",
    "ADDITIONAL_VALUES" => "Y",
    "VALUES" => $arIBlock,
    "REFRESH" => "Y",
);

$arTemplateParameters["FB_PROPERTY_CODES"] = array(
    "NAME" => GetMessage("IBLOCK_PROPERTY"),
    "TYPE" => "LIST",
    "MULTIPLE" => "Y",
    "VALUES" => $arProperty_LNSF,
);

$arTemplateParameters["FB_PROPERTY_CODES_REQUIRED"] = array(
    "NAME" => GetMessage("IBLOCK_PROPERTY_REQUIRED"),
    "TYPE" => "LIST",
    "MULTIPLE" => "Y",
    "ADDITIONAL_VALUES" => "N",
    "VALUES" => $arProperty_LNSF,
);