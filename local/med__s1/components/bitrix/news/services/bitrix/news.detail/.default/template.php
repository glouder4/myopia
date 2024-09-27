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
    <div style="min-height:366px;" class="fade tab-pane active in" id="<?= $arResult['ID'] ?>">
        <img alt="<?= $arResult['DETAIL_PICTURE']['ALT'] ?>" class="img-responsive"
             src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>"/>

        <p id="<?= $this->GetEditAreaId($arResult['ID']); ?>"><?= $arResult['DETAIL_TEXT'] ?></p>
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 accordion-element">
                <div class="collapse-widget-side">
                    <div id="imedica-dep-accordion" class="ui-accordion ui-widget ui-helper-reset" role="tablist">
                        <?
                        $len = sizeof($arResult['PRICE']);
                        foreach($arResult['PRICE'] as $Price):
                            --$len;
                            ?>


                            <h3 class="<?if(!$len) {?>last-child-ac ilast-child-acc<?}?> ui-state-default" id="ui-accordion-imedica-dep-accordion-header-<?=$Price['ID']?>"  aria-controls="ui-accordion-imedica-dep-accordion-panel-<?=$Price['ID']?>" aria-selected="true"><i class="collapse-cheveron"></i><span class="blog-collapse-title"><span class="col-1"><?=$Price['NAME']?> </span><span class="col-2"><?=$Price['PROPERTY_PRICE_VALUE']?> p.</span></span></h3>
                            <div id="ui-accordion-imedica-dep-accordion-panel-<?=$Price['ID']?>" aria-labelledby="ui-accordion-imedica-dep-accordion-header-<?=$Price['ID']?>" role="tabpanel" aria-expanded="true" aria-hidden="false">
                                <div class="collapse-widget-content pull-left">
                                    <p><?=$Price['PREVIEW_TEXT']?></p>

                                </div>
                            </div>


                        <?endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
