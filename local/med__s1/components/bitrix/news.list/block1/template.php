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
		<div class="no-pad icon-boxes-1">
			<? foreach ($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>

				<div class="col-sm-6 col-xs-12 col-md-3 col-lg-3" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="icon-box-3 wow">
						<?$renderImage = CFile::ResizeImageGet($arItem["DISPLAY_PROPERTIES"]["ICONIMG"]["FILE_VALUE"], Array("width" => 47, "height" => 47), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);?>
						<div class="icon-boxwrap2" <?if($renderImage["src"]) echo 'style="background: none;"';?>>
							<i class="fa <?if(!$renderImage["src"]) echo $arItem['CODE'] ?> icon-box-back2" style="">
								<?
								if($renderImage["src"])
									echo '<img alt="'.$arItem["NAME"].'" src="'.$renderImage["src"].'" style="padding:15px;"/>';
								?>
							</i>
						</div>
						<div class="icon-box2-title"><?= $arItem['NAME_IMPLODE'] ?></div>
						<p><?= $arItem['PREVIEW_TEXT'] ?></p>
						<? if ($arItem["DETAIL_TEXT"]): ?>
							<div class="iconbox-readmore">
								<a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo GetMessage("CT_BNL_GOTO_DETAIL") ?></a>
							</div>
						<? endif; ?>
					</div>
				</div>


			<? endforeach; ?>
		</div>
	</div>
</div><!--Icon Boxes 1 end-->
