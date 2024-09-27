<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<div class="row">
	<div class="form col-lg-8 col-md-8 col-sm-12 col-xs-12">
	<ul class="left-menu col-md-12">

	<?
	foreach($arResult as $arItem):
		if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
			continue;
	?>
		<?if($arItem["SELECTED"]):?>
			<li class="selected col-lg-4 col-md-4 col-sm-12 col-xs-12 no-pad text-center"><a href="<?=$arItem["LINK"]?>" class="col-md-12 col-xs-12 col-sm-12"><?=$arItem["TEXT"]?></a></li>
		<?else:?>
			<li class="col-lg-4 col-md-4 col-sm-12 col-xs-12 no-pad text-center"><a href="<?=$arItem["LINK"]?>" class="col-md-12 col-xs-12 col-sm-12"><?=$arItem["TEXT"]?></a></li>
		<?endif?>

	<?endforeach?>

	</ul>
	</div>
	</div>
<?endif?>