<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!isset($arResult['ITEMS'][0]))
	return;

$doctors = array();
foreach ($arResult['ITEMS'] as $key=>$element) {
	$doctors[$element['PROPERTIES']['SH_F_DOCTOR']['VALUE']]=$element['PROPERTIES']['SH_F_DOCTOR']['VALUE'];
}
$DOCTOR_IBLOCK_ID = $arResult['ITEMS'][0]['DISPLAY_PROPERTIES']['SH_F_DOCTOR']['LINK_IBLOCK_ID'];
$SHEDULE_IBLOCK_ID = reset($arResult['ITEMS'][0]['DISPLAY_PROPERTIES']['SH_F_TIME']['LINK_ELEMENT_VALUE']);
$SHEDULE_IBLOCK_ID = $SHEDULE_IBLOCK_ID['IBLOCK_ID'];


$rs = CIBlockElement::GetList(
	array(),
	array(
		"IBLOCK_ID" => $DOCTOR_IBLOCK_ID,
		array("ID" => $doctors),
	),
	false,
	false,
	array("ID","NAME","PROPERTY_STR_SPECIAL","PROPERTY_IB_CLINIC.NAME")
);

while($ar = $rs->GetNext()) {
	$arResult['DOCTORS'][$ar['ID']]['SPEC']=$ar['PROPERTY_STR_SPECIAL_VALUE'];
	$arResult['DOCTORS'][$ar['ID']]['CLINIC']=$ar['PROPERTY_IB_CLINIC_NAME'];
	$arResult['DOCTORS'][$ar['ID']]['NAME']=$ar['NAME'];
}

$times=array();
foreach ($arResult['ITEMS'] as $key=>$element) {
	$times[$key]=$element['PROPERTIES']['SH_F_TIME']['VALUE'];
}
$rs = CIBlockElement::GetList(
	array(),
	array(
		"IBLOCK_ID" => $SHEDULE_IBLOCK_ID,
		array("ID" => $times),
	),
	false,
	false,
	array("ID","PROPERTY_TM_TIME")
);

while($ar = $rs->GetNext()) {
	$arResult['TIMES'][$ar['ID']]=$ar['PROPERTY_TM_TIME_VALUE'];
}