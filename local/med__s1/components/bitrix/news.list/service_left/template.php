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
<div class="side-blog-title"><?= GetMessage("TITLE2") ?></div>
<ul class="nav nav-tabs" style="width: 100%; margin-bottom:25px;">
    <? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
        <li>
            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                <i class="fa <?=strip_tags($arItem['DISPLAY_PROPERTIES']['CODE_ICO']['DISPLAY_VALUE'])?> dept-tabs-icon"></i>
                <span class="tabs-heads"><?= $arItem['NAME_IMPLODE'] ?></span>
                <i class="right-arr"></i>
            </a>
        </li>
    <? endforeach; ?>
</ul>
				
				
				
		

