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
$this->setFrameMode(true);
?>




<?
$len = sizeof($arResult["ITEMS"]);
$if = ceil($len / 2);
foreach ($arResult["ITEMS"] as $key => $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    --$len;
    if ($key == 0) {
        ?>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

    <? } ?>
    <div class="blog-box wow" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <img alt="" src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" class="img-responsive"/>

        <div style="padding: 15px 15px;" class="blog-box-title"><a
                href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem['NAME'] ?></a></div>
        <p><?= $arItem['PREVIEW_TEXT'] ?></p>

        <div style="width: 90%; margin: 0px 5%;line-height: 50px;height: 50px;border-top: 1px solid #dcddde;"
             class="post-meta">
            <span class="post-date"><? echo $arItem["DISPLAY_ACTIVE_FROM"] ?> </span>
            <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo GetMessage("CT_BNL_GOTO_DETAIL") ?> ></a></div>
    </div>

    <? if ($if == $key + 1) {
        ?>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <? } ?>
    <? if (!$len) { ?>

        </div>
    <? } ?>

<? endforeach ?>
<div class="col-lg-12 col-md-12 col-sm-6 col-xs-6">
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <br/><?= $arResult["NAV_STRING"] ?>
    <? endif; ?>
</div>