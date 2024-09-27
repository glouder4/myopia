<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$element = $_REQUEST['ELEMENT_ID'];
?>

			<?foreach($arResult["ELEMENTS"]["META"] as $key=>$arItem){			
			?>
			<?
			if(($element==$arItem['ID']) || ($element==$arItem['CODE'])){
			$APPLICATION->SetPageProperty("keywords", $arItem['KEYWORDS']);
			$APPLICATION->SetPageProperty("description", $arItem['DESCRIPTION']);
			$APPLICATION->SetPageProperty("title", $arItem['NAME']);
			}elseif($element==false && $key==0 ){
			$APPLICATION->SetPageProperty("keywords", $arItem['KEYWORDS']);
			$APPLICATION->SetPageProperty("description", $arItem['DESCRIPTION']);
			$APPLICATION->SetPageProperty("title", $arItem['NAME']);
			}}?>	