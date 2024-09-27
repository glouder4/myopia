<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arDoctor=$arResult['DOCTOR'];
?>

<div id='shedule_form' class='col-md-8 no-pad' data-interval='<?=$arParams['SHEDULE_INTERVAL']?>'>
	<div class='fader'></div>
	<div class='top_doctor_info'>
		<div class='left_doctor_info'>
			<?if($arDoctor['PREVIEW_PICTURE']){?>
				<a href='<?=$arDoctor['DETAIL_PAGE_URL']?>'><img src='<?=CFile::GetPath($arDoctor['PREVIEW_PICTURE'])?>' /></a>
			<?}?>
			<h3><a href='<?=$arDoctor['DETAIL_PAGE_URL']?>'><?=$arDoctor['NAME']?></a></h3>
			<p><?=$arDoctor['PROPERTY_STR_SPECIAL_VALUE'] ? $arDoctor['PROPERTY_STR_SPECIAL_VALUE'] : $arDoctor['~PREVIEW_TEXT']?></p>
		</div>
		<div class='right_doctor_info'>
			<p>
				<?=$arDoctor['~DETAIL_TEXT']?>
			</p>
		</div>
	</div>
	<div class='bottom_shedule'>
		<div class='shedule_right_legend'>
			<div class='legends'>
				<span class='legend_cont'>
					<span class='legend_free free'></span> - <?=GetMessage('S_FREE_TIME')?>
				</span>
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				<span class='legend_cont'>
					<span class='legend_no_free no_free'></span> - <?=GetMessage('S_NO_FREE_TIME')?>
				</span>
			</div>
			<p><?=GetMessage('SH_FREE_NO_FREE_LEGEND')?></p>
			<?if(count($arResult['ERRORS'])>0):?>
				<p class="error" id="error" style="color: #f00;font-size: 14px;"><?=GetMessage('ERRORBOOK')?></p>
				<script>setTimeout(function(){ document.getElementById("error").remove(); }, 3000);</script>
			<?endif;?>
		</div>
		<div class='cl_clear'></div>
		<div class='shedule_left'>
			<?if($arResult['CAN_LESS']){?>
				<div class='move_top glyphicon glyphicon-arrow-up interval_change' data-interval='<?=$arResult['PREV_INTERVAL']?>'>
					&nbsp;
				</div>
			<?}?>
			<div class='days_list'>
				<ul id='doc_days'>
					<?foreach($arDoctor['DAYS'] as $intDayID=>$arDay){$dayCount++;?>
						<li <?if($dayCount==1){$FirstDay=$intDayID;?>class='active'<?}?> data-dayid='<?=$intDayID?>'>
							<div class='day_info'>
								<div class='day_date'>
									<?=date('d',$arDay['UF_D_DATE'])?>,&nbsp;<?=GetMessage('S_MD_'.((int)date('m',$arDay['UF_D_DATE'])))?>
								</div>
								<div class='day_week'>
									<?=GetMessage('S_WD_'.((int)date('w',$arDay['UF_D_DATE'])))?>
								</div>
							</div>
						</li>
					<?}?>
				</ul>
			</div>
			<?if($arResult['CAN_MORE']){?>
				<div class='move_down glyphicon glyphicon-arrow-down interval_change' data-interval='<?=$arResult['NEXT_INTERVAL']?>'>
					&nbsp;
				</div>
			<?}?>
		</div>
		<div class='shedule_right'>
			<div class='shedule_right_bottom'>
				<?foreach($arDoctor['DAYS'] as $intDayID=>$arDay){?>
					<?foreach($arDay['TIME'] as $intTimeID=>$arTime){?>
						<span class='time <?if($FirstDay==$intDayID){?> visible_time<?}?> <?=($arTime['PROPERTY_B_FREE_VALUE']=='Y')?'free':'no_free'?>' rel='day_<?=$intDayID?>' <?if($arTime['PROPERTY_B_FREE_VALUE']=='Y'){?> data-daytimeid='<?=$intTimeID?>'<?}?>>
							<?=$arTime['NAME']?>
						</span>
					<?}?>
				<?}?>
			</div>
		</div>
	</div>
</div>

