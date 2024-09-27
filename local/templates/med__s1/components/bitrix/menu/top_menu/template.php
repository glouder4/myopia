<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if (!empty($arResult)): ?>
<div style="height:66px;display: block;position: relative;">
	<div id="headerstic" style="position: relative;">

		<div class=" top-bar container">
			<div class="row">
				<nav class=" navbar-default">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">

							<button type="button" class="navbar-toggle icon-list-ul fa fa-list-ul" data-toggle="collapse"
							        data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Переключить меню</span>
							</button>
							<a href="<?= SITE_DIR ?>">
								<div
										class="logo"><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/logo.php"), false); ?></div>
							</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-right menu_flex hover" >
								<?
								$previousLevel = 0;
								foreach($arResult as $arItem) {

								if($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
									echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
								}

								if($arItem["IS_PARENT"]) {
								if($arItem["DEPTH_LEVEL"] == 1) {
								?>
								<li class="<?if ($arItem["SELECTED"]):?>active<?endif?>">
									<a class="not_underline" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
									<ul class="dropdown-menu <?=($arItem["DEPTH_LEVEL"]+1)?> <? if($arItem["PARAMS"]["IS_CAT"] != 'Y'): ?>common<? else: ?>grey catalog<? endif; ?>">
										<?
										}
										else {
										?>
										<li class="<?if ($arItem["SELECTED"]):?>active<?endif?>">
											<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
											<ul class="level<?=($arItem["DEPTH_LEVEL"]+1)?> dropdown-menu" style="top: 60px;">
												<?
												}
												}
												else {
													if($arItem["DEPTH_LEVEL"] == 1) {
														?>
														<li class="<?if ($arItem["SELECTED"]):?>active<?endif?>">
															<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
														</li>
														<?
													}
													else {
														?>
														<li class="<? if ($arItem["SELECTED"]): ?>active<?endif ?> <? if($arItem["PARAMS"]["MORE_SECTIONS"] == 'Y'): ?>more_sections<?endif ?>">
															<a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?><? if($arItem["PARAMS"]["MORE_SECTIONS"] == 'Y'): ?> <i class="fa fa-angle-right" aria-hidden="true"></i><?endif ?></a>
														</li>
														<?
													}
												}
												$previousLevel = $arItem["DEPTH_LEVEL"];
												}

												if($previousLevel > 1) { // closing list after last element
													echo str_repeat("</ul></li>", ($previousLevel-1) );
												}
												?>
											</ul>
						</div>
						<!-- /.navbar-collapse -->
					</div>
					<!-- /.container-fluid -->
				</nav>
			</div>
		</div>
		<!--Topbar End-->
	</div>
	<? endif ?>
</div>
