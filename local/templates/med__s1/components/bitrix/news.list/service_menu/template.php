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
//echo $arResult["CURRENT_DIR"];
?>
<div class="side-blog-title"><?=GetMessage("TITLE2")?></div>
<ul class="nav nav-tabs" style="width: 100%; margin-bottom: 30px;">
	<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
		<li <?=($arItem['DETAIL_PAGE_URL'] === $arResult["CURRENT_DIR"])?'class="active 1"':'';?>>
			<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
				<?$renderImage = CFile::ResizeImageGet($arItem["DISPLAY_PROPERTIES"]["ICONIMG"]["FILE_VALUE"], Array("width" => 35, "height" => 35), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);?>
				<?
				if($renderImage["src"]):
					echo '<i class="fa dept-tabs-icon"><img alt="'.$arItem["NAME"].'" src="'.$renderImage["src"].'"/></i>';
				else:
					?>
					<i class="fa <?=strip_tags($arItem['DISPLAY_PROPERTIES']['CODE_ICO']['DISPLAY_VALUE'])?> dept-tabs-icon"></i>
				<?endif;?>
				<span class="tabs-heads"><?=$arItem['NAME_IMPLODE']?></span>
				<i class="right-arr"></i>
			</a>
		</li>
	<?endforeach;?>
</ul>