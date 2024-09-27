<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/*TAGS*/

	foreach ($arResult["ITEMS"] as $i => $arItem)
	{		
		$res = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID']);
		if($ar_res = $res->GetNext())
		$arResult['ITEMS'][$i]['IBLOCK_SECTION_NAME'] = $ar_res['NAME'];
		$PREVIEW_TEXT = $arItem['PREVIEW_TEXT'];
		$array = explode(" ",$PREVIEW_TEXT); 
		$count = count($array);
		$array = array_slice($array,0,17); 
		$newtext = implode(" ",$array); 
		
		if($count > 17){
		$arResult['ITEMS'][$i]['PREVIEW_TEXT_IMPLODE'] =  $newtext."... "; 		
		}else{
		$arResult['ITEMS'][$i]['PREVIEW_TEXT_IMPLODE'] =  $newtext; 	
		}
		
		$NAME = $arItem['NAME'];
		$array = explode(" ",$NAME); 
		$count = count($array);
		$array = array_slice($array,0,6); 
		$newname = implode(" ",$array); 

		if($count > 6){
		$arResult['ITEMS'][$i]['NAME_IMPLODE'] =  $newname."... "; 		
		}else{
		$arResult['ITEMS'][$i]['NAME_IMPLODE'] =  $newname; 	
		}
	
	}
//    $res = CIBlock::GetByID($arParams['IBLOCK_ID']);
//    if($ar_res = $res->GetNext()){
//    $arResult['IBLOCK_NAME'] = $ar_res['NAME'];
//    }

