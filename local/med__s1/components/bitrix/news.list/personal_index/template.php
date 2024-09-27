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
		

			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>


					     <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><div class="doctor-box col-md-4 col-sm-6 col-xs-12 wow animated"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        
                        	<div class="zoom-wrap">
                          <div class="zoom-icon"></div>
                        	<img alt="" class="img-responsive" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" />
                          </div>
                      	<div class="doc-name">
                          	<div class="doc-name-class"><?=$arItem['IBLOCK_SECTION_NAME']?></div><span class="doc-title"><?=$arItem['NAME_IMPLODE']?></span>
                          
                          </div>
                         </div></a>


				<?endforeach;?>
				</div>
