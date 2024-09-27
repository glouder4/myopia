<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

if($arCurrentValues["IBLOCK_ID"] > 0)
{
	$arIBlock = CIBlock::GetArrayByID($arCurrentValues["IBLOCK_ID"]);

	$bWorkflowIncluded = ($arIBlock["WORKFLOW"] == "Y") && CModule::IncludeModule("workflow");
	$bBizproc = ($arIBlock["BIZPROC"] == "Y") && CModule::IncludeModule("bizproc");
}
else
{
	$bWorkflowIncluded = CModule::IncludeModule("workflow");
	$bBizproc = false;
}

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arProperty_LNSF = array(
//	"NAME" => GetMessage("IBLOCK_ADD_NAME"),
//	"TAGS" => GetMessage("IBLOCK_ADD_TAGS"),
//	"DATE_ACTIVE_FROM" => GetMessage("IBLOCK_ADD_ACTIVE_FROM"),
//	"DATE_ACTIVE_TO" => GetMessage("IBLOCK_ADD_ACTIVE_TO"),
//	"IBLOCK_SECTION" => GetMessage("IBLOCK_ADD_IBLOCK_SECTION"),
//	"PREVIEW_TEXT" => GetMessage("IBLOCK_ADD_PREVIEW_TEXT"),
//	"PREVIEW_PICTURE" => GetMessage("IBLOCK_ADD_PREVIEW_PICTURE"),
//	"DETAIL_TEXT" => GetMessage("IBLOCK_ADD_DETAIL_TEXT"),
//	"DETAIL_PICTURE" => GetMessage("IBLOCK_ADD_DETAIL_PICTURE"),
);
$arVirtualProperties = $arProperty_LNSF;

$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
while ($arr=$rsProp->Fetch())
{
	$arProperty[$arr["ID"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S", "F")))
	{
		$arProperty_LNSF[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}

$arGroups = array();
$rsGroups = CGroup::GetList($by="c_sort", $order="asc", Array("ACTIVE" => "Y"));
while ($arGroup = $rsGroups->Fetch())
{
	$arGroups[$arGroup["ID"]] = $arGroup["NAME"];
}

if ($bWorkflowIncluded)
{
	$rsWFStatus = CWorkflowStatus::GetList($by="c_sort", $order="asc", Array("ACTIVE" => "Y"), $is_filtered);
	$arWFStatus = array();
	while ($arWFS = $rsWFStatus->Fetch())
	{
		$arWFStatus[$arWFS["ID"]] = $arWFS["TITLE"];
	}
}
else
{
	$arActive = array("ANY" => GetMessage("IBLOCK_STATUS_ANY"), "INACTIVE" => GetMessage("IBLOCK_STATUS_INCATIVE"));
	$arActiveNew = array("N" => GetMessage("IBLOCK_ALLOW_N"), "NEW" => GetMessage("IBLOCK_ACTIVE_NEW_NEW"), "ANY" => GetMessage("IBLOCK_ACTIVE_NEW_ANY"));
}

$arAllowEdit = array("CREATED_BY" => GetMessage("IBLOCK_CREATED_BY"), "PROPERTY_ID" => GetMessage("IBLOCK_PROPERTY_ID"));

$arComponentParameters = array(
	"GROUPS" => array(
		"PARAMS" => array(
			"NAME" => GetMessage("IBLOCK_PARAMS"),
			"SORT" => "200"
		),
		"FIELDS" => array(
			"NAME" => GetMessage("IBLOCK_FIELDS"),
			"SORT" => "300",
		),
	),

	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),

		"IBLOCK_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_IBLOCK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),

		"PROPERTY_CODES" => array(
			"PARENT" => "FIELDS",
			"NAME" => GetMessage("IBLOCK_PROPERTY"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_LNSF,
		),

		"PROPERTY_CODES_REQUIRED" => array(
			"PARENT" => "FIELDS",
			"NAME" => GetMessage("IBLOCK_PROPERTY_REQUIRED"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arProperty_LNSF,
		),
        "STATUS_NEW" => array(
			"PARENT" => "PARAMS",
			"NAME" => $bWorkflowIncluded? GetMessage("IBLOCK_STATUS_NEW"): ($bBizproc? GetMessage("IBLOCK_BP_NEW"): GetMessage("IBLOCK_ACTIVE_NEW")),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"VALUES" => $bWorkflowIncluded ? $arWFStatus : $arActiveNew,
		),
	),
);
//Тип почтовых событий
$arEventName = Array();
$rs = CEventType::GetList(array("LID"=> LANGUAGE_ID));
while($ar = $rs->GetNext()){
    $arEventName[$ar["EVENT_NAME"]] = $ar["NAME"];
}
if(empty($arCurrentValues["EVENT_NAME"])){
    $arCurrentValues["EVENT_NAME"] = "FEEDBACK_FORM_MAIN";
}
//почтовые шаблоны
$arEvent = Array();
$arFilter = array("TYPE_ID" => $arCurrentValues["EVENT_NAME"]);
$dbType = CEventMessage::GetList($by="ID", $order="DESC", $arFilter);
while($arType = $dbType->GetNext())
    $arEvent[$arType["ID"]] = "[".$arType["ID"]."] ".$arType["SUBJECT"];

$arComponentParameters["PARAMETERS"]["EVENT_NAME"] = array(
    "NAME" => GetMessage("EVENT_NAME"),
    "TYPE"=>"LIST",
    "VALUES" => $arEventName,
    "MULTIPLE"=>"N",
    "COL" => 25,
    "PARENT" => "PARAMS",
    "REFRESH" => "Y",
    "DEFAULT" => "FEEDBACK_FORM_MAIN"
);
$arComponentParameters["PARAMETERS"]["EVENT_MESSAGE_ID"] = array(
    "NAME" => GetMessage("EVENT_MESSAGE_ID"),
    "TYPE"=>"LIST",
    "VALUES" => $arEvent,
    "MULTIPLE"=>"Y",
    "COL" => 25,
    "PARENT" => "PARAMS",
);
$arComponentParameters["PARAMETERS"]["USE_CAPTCHA"] = array(
	"PARENT" => "PARAMS",
	"NAME" => GetMessage("IBLOCK_USE_CAPTCHA"),
	"TYPE" => "CHECKBOX",
);

$arComponentParameters["PARAMETERS"]["USER_MESSAGE_ADD"] = array(
	"PARENT" => "PARAMS",
	"NAME" => GetMessage("IBLOCK_USER_MESSAGE_ADD"),
	"TYPE" => "TEXT",
);


foreach ($arVirtualProperties as $key => $title)
{
	$arComponentParameters["PARAMETERS"]["CUSTOM_TITLE_".$key] = array(
		"PARENT" => "TITLES",
		"NAME" => $title,
		"TYPE" => "STRING",
	);
}

?>