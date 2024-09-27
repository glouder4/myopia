<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
		

                        <div class="col-xs-12 col-sm-6 col-md-3 recent-post-foot foot-widget">
                        	<div class="foot-widget-title"><?=$arResult['IBLOCK_NAME']?></div>
                        	<ul>							
								<?foreach($arResult["ITEMS"] as $arItem):?>
									<?
									$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
									$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
									?>
									<li id="<?=$this->GetEditAreaId($arItem['ID']);?>"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem['NAME_IMPLODE']?><br /><span class="event-date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span></a></li>
								<?endforeach;?>
                            </ul>						
                    </div>
