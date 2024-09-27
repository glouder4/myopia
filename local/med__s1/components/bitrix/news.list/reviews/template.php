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
		

            <div class="col-xs-12 col-sm-12 col-md-12 pull-left Testiminal-page-wrap no-pad wow " >
						<?foreach($arResult["ITEMS"] as $arItem):?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>

						 
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 test-box" style="min-height: 205px;" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
											<div class="testi-author-info">
										<img alt="" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" class="img-responsive testi-img" />
											<div class="testi-author-name"><?=$arItem['NAME']?></div>
											<div class="testi-author-website"><?=$arItem['CODE']?></div>
										</div>
											<p><?=$arItem['PREVIEW_TEXT']?></p>
							 </div>


						<?endforeach;?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 pull-left Testiminal-page-wrap no-pad wow " >                            

						<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
							<br /><?=$arResult["NAV_STRING"]?>
						<?endif;?>						
            </div>
