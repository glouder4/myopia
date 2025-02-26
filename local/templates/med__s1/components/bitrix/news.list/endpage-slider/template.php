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

<div class="container">
    <div class="owl-carousel">
        <? foreach ($arResult["ITEMS"] as $key=>$arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

            $link = $arItem['PROPERTIES']['sldier_link']['VALUE'];
            if( empty($link) ) $link = '#';
            ?>
            <a href="<?=$link;?>" class="item"  rel="nofollow" target="_blank">
                <img src="<?=$arItem['DISPLAY_PROPERTIES']['slider_image']['FILE_VALUE']['SRC']?>" alt="<?=$arItem['NAME'];?>">
            </a>
        <?

        endforeach; ?>
    </div>
</div>