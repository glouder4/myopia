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

<div id="contact-version-two">
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 accordion-element">
        <div class="collapse-widget-side">
            <div id="imedica-dep-accordion" class="ui-accordion ui-widget ui-helper-reset" role="tablist">
                <?
                $len = sizeof($arResult["ITEMS"]);
                foreach($arResult["ITEMS"] as $arItem):

                    $demands = is_array($arItem['PROPERTIES']['DEMANDS']['~VALUE']) ? $arItem['PROPERTIES']['DEMANDS']['~VALUE']['TEXT'] : '';
                    $duties = is_array($arItem['PROPERTIES']['DUTIES']['~VALUE']) ? $arItem['PROPERTIES']['DUTIES']['~VALUE']['TEXT'] : '';
                    $conditions = is_array($arItem['PROPERTIES']['CONDITIONS']['~VALUE']) ? $arItem['PROPERTIES']['CONDITIONS']['~VALUE']['TEXT'] : '';

                    --$len;

                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                    ?>

                    <h3 class="<?if(!$len) {?>last-child-ac ilast-child-acc<?}?> ui-state-default" id="ui-accordion-imedica-dep-accordion-header-<?=$arItem['ID']?>"  aria-controls="ui-accordion-imedica-dep-accordion-panel-<?=$arItem['ID']?>" aria-selected="true"><i class="collapse-cheveron"></i><span class="blog-collapse-title"><?=$arItem['NAME']?><span style="float:right"><strong><?=$arItem['PROPERTIES']['ZP']['NAME']?>:</strong>  <?=$arItem['PROPERTIES']['ZP']['~VALUE']?> p.</span> </span></h3>
                    <div id="ui-accordion-imedica-dep-accordion-panel-<?=$arItem['ID']?>" aria-labelledby="ui-accordion-imedica-dep-accordion-header-<?=$arItem['ID']?>" role="tabpanel" aria-expanded="true" aria-hidden="false">
                        <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="collapse-widget-content pull-left">

                            <strong><?=$arItem['PROPERTIES']['IB_CLINIC']['NAME']?>:</strong>
                            <p><?=$arItem['DISPLAY_PROPERTIES']['IB_CLINIC']['DISPLAY_VALUE']?></p>

                            <strong><?=$arItem['PROPERTIES']['DEMANDS']['NAME']?>:</strong>
                            <p><?=$demands?></p>

                            <strong><?=$arItem['PROPERTIES']['DUTIES']['NAME']?>:</strong>
                            <p><?=$duties?></p>

                            <strong><?=$arItem['PROPERTIES']['CONDITIONS']['NAME']?>:</strong>
                            <p><?=$conditions?></p>

                        </div>
                    </div>



                <?endforeach;?>
            </div>
        </div>
    </div>
            <div class="col-xs-12 col-sm-12 col-md-12 pull-left Testiminal-page-wrap no-pad wow " >

						<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
							<br /><?=$arResult["NAV_STRING"]?>
						<?endif;?>
            </div>
    </div>
