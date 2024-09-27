<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
?>


<!--container end-->
<div class="container" style="margin-top:20px;padding-bottom: 50px;">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <? $APPLICATION->IncludeFile(
                $APPLICATION->GetTemplatePath(SITE_DIR . "include/about_contact.php"),
                Array(),
                Array("MODE" => "html")
            ); ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div class="subtitle col-12">
                <center><?= GetMessage("ADRESA_KLINIK") ?></center>
            </div>
            <div id="imedica-dep-accordion">
                <?
                $len = sizeof($arResult["ITEMS"]);
                foreach ($arResult["ITEMS"] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    --$len;

                    ?>
                    <h3 class="<? if (!$len) { ?>last-child-ac ilast-child-acc<?
                    } ?>"><i class="fa <?=strip_tags($arItem['DISPLAY_PROPERTIES']['CODE_ICO']['DISPLAY_VALUE'])?> dept-icon"></i><span
                            class="dep-txt"><?= $arItem['NAME_IMPLODE'] ?></span></h3>
                    <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>">

                        <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>"
                             class="img-responsive dept-author-img-desk col-md-4"
                             alt="<?= $arItem['PREVIEW_PICTURE']['ALT'] ?>"/>

                        <div class="dept-content pull-left col-md-7 col-lg-8">

                            <p><?= $arItem['PREVIEW_TEXT_IMPLODE'] ?></p>

                            <div class="col-xs-12 col-sm-4 col-md-6">
                                <div class="purchase-strip-blue dept-apponit-butt">
                                    <div class="color-4">
                                        <p class="ipurchase-paragraph">
                                            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                                <button class="fa fa-calendar-o btn btn-4 btn-4a notViewed"><?= GetMessage("CONTACT") ?></button>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="vspacer"></div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>
