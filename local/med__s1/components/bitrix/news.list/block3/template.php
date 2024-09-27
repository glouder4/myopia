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
	<div class="row">
		<? foreach ($arResult["ITEMS"] as $key=>$arItem): ?>
			<?
			if($key % 4 == 0)
				echo '<div style="width:100%;height: 0; clear: both;"></div>'; 
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>

			<div class="col-sm-5 col-xs-12 col-md-3 col-lg-3 service-box no-pad wow "
			     id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<div class="service-title">
					<div class="service-icon-container rot-y">
						<?$renderImage = CFile::ResizeImageGet($arItem["DISPLAY_PROPERTIES"]["ICONIMG"]["FILE_VALUE"], Array("width" => 40, "height" => 40), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);?>
						<?
						if($renderImage["src"]):
							echo '<img alt="'.$arItem["NAME"].'" src="'.$renderImage["src"].'"/>';
						else:
							?>
							<i class="fa <?=strip_tags($arItem['DISPLAY_PROPERTIES']['CODE_ICO']['DISPLAY_VALUE'])?> panel-icon"></i>
						<?endif;?>
					</div>
					<span><?= $arItem['NAME_IMPLODE'] ?></span></div>
				<p><?= $arItem['PREVIEW_TEXT_IMPLODE'] ?></p>
				<? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
					<a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo GetMessage("CT_BNL_GOTO_DETAIL") ?></a>
				<?endif; ?>
			</div>
			<?

		endforeach; ?>
	</div>
</div>