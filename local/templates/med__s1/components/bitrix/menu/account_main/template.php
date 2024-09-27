<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
	<div class="container">
		<div class="row">
			<div class="no-pad icon-boxes-1">
			<?$infoMenu = array(
					0=>array(
							'icon'=>'fa-address-card-o',
							'text'=>GetMessage('ACCOUNT_MAIN_MY_ACCOUNT'),
							'buttontext'=>GetMessage('ACCOUNT_MAIN_MORE')
					),
					1=>array(
							'icon'=>'fa-history',
							'text'=>GetMessage('ACCOUNT_MAIN_HISTORY'),
							'buttontext'=>GetMessage('ACCOUNT_MAIN_MORE')
					),
					2=>array(
							'icon'=>'fa-ambulance',
							'text'=>GetMessage('ACCOUNT_MAIN_BOOKING'),
							'buttontext'=>GetMessage('ACCOUNT_MAIN_BOOK')
					)

			);
			foreach($arResult as $key=>$arItem):
				if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
					continue;?>
				<div class="col-sm-6 col-xs-12 col-md-4 col-lg-4">
					<div class="icon-box-3 wow col-md-12">
						<div class="icon-boxwrap2">
							<i class="fa <?=$infoMenu[$key]['icon']?> icon-box-back2"></i>
						</div>
						<div class="icon-box2-title"><a href="<? echo $arItem["LINK"] ?>"><?=$arItem['TEXT']?></a></div>
						<p><?=$infoMenu[$key]['text']?></p>
						<div class="iconbox-readmore">
							<a href="<? echo $arItem["LINK"] ?>"><?=$infoMenu[$key]['buttontext']?></a>
						</div>
					</div>
				</div>
			<?endforeach?>
			</div>
		</div>
	</div>
<?endif?>