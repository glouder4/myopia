<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
CJSCore::Init(array("BX","ajax","popup","window"));
?>
<div class="news-list col-md-12">

	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$arItem['NAME'] = str_replace(' ', '', $arItem['NAME']);
		$arItem['EL'] = explode('-',$arItem['NAME']);
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

		$past_visit = false;
		if($arResult['TIMES'][$arItem['PROPERTIES']['SH_F_TIME']['VALUE']]<time()) {
			$past_visit = true;
		}
		?>

		<div class="row visit-history id<?=$arItem['ID'];?> <?if($past_visit) echo "past";?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="col-md-3 text-center">
				<p class="history-date"><?=$arItem['EL'][2]?> - <?=$arItem['EL'][3]?></p>
				<p class="history-time"><?=$arItem['EL'][4]?></p>
			</div>
			<div class="col-md-9" style="">
				<div class="col-md-9 col-sm-12">
					<a href="#" class="history-clinic"><?=$arResult['DOCTORS'][$arItem['PROPERTIES']['SH_F_DOCTOR']['VALUE']]['CLINIC']?></a>
					<span class="history-name"><?=$arResult['DOCTORS'][$arItem['PROPERTIES']['SH_F_DOCTOR']['VALUE']]['NAME']?> - <?=$arResult['DOCTORS'][$arItem['PROPERTIES']['SH_F_DOCTOR']['VALUE']]['SPEC']?></span>
				</div>
				<div class="col-md-3 col-sm-12" style="">
					<?if(!$past_visit && \COption::GetOptionString('firstbit.med','FIRSTBIT_MED_USER_DELETE_BOOK')=='Y'):?>
						<a href="#" onclick="return false" class="history-cancel col-md-12 col-xs-12 col-sm-12 text-center cancel" dataid="<?=$arItem['ID'];?>"><?=GetMessage('CANCEL_BOOKING')?></a>
					<?endif;?>
				</div>
			</div>
		</div>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
</div>
<div id="ajax-add-schema"></div>
<script type="text/javascript">
	<!--
		BX.ready(function(){
			var schema = new BX.PopupWindow("schema", null, {
				content: BX('ajax-add-schema'),
				title: '<?= GetMessage("CANCEL_BOOKING_AJAX")?>',
				head: '<?= GetMessage("CANCEL_BOOKING2_AJAX")?>',
				overlay: {backgroundColor: 'black', opacity: '80' },
				closeIcon: {right: "7px", top: "10px"},
				content: '<h3 class="text-center"><?= GetMessage("CANCEL_BOOKING_AJAX")?></h3><p class="text-center" style="padding-top: 18px;text-indent: inherit;font-size: 16px;text-align: center;"><?= GetMessage("CANCEL_BOOKING2_AJAX")?></p>',
				zIndex: 0,
				offsetLeft: 0,
				offsetTop: 0,
				draggable: {restrict: false},
				buttons: [
					new BX.PopupWindowButton({
						text: '<?= GetMessage("ACCEPT_CANCEL_BOOKING_AJAX")?>',
						className: "inner-page-butt-blue",
						events: {click: function(e){
							var post = {};
							var idrecord = $('.inner-page-butt-blue').attr('dataid')
							post['ajax'] = 'y';
							post['delete'] = 'y';
							post['id'] = idrecord;
							BX.ajax.post(
								'<?=$APPLICATION->GetCurPage(false);?>',
								post,
								function (data) {
									if(data==='yes') {
										$('div#popup-window-content-schema').html('<p style="text-align: center;font-size: 20px;margin-top: 74px;"><?= GetMessage("SUCCESS_BOOKING_DEL")?></p>');
										$('.popup-window-buttons').remove();
										$('.id'+idrecord).fadeOut();
									}
								});
						}}
					}),
				]
			});
			$('.cancel').click(function(e){
				schema.show(e);
				$('.inner-page-butt-blue').attr('dataid',$(this).attr('dataid'));
			});
		});
</script>
