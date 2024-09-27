<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div id='shedule_form'>
	<div class='fader'></div>
	<div id="contact-version-two">
		<div class="col-md-8 no-pad">
			<div class='ok_request'>
				<center><?=GetMessage('SH_OK_MESS')?></center>
			</div>
			<div class='voucher_container'>
				<div class='legend'>
					<?=GetMessage('SH_VOUCHER_LEGEND')?>
				</div>
				<div id='voucher'>
					<style type="text/css">
						<?=file_get_contents(__DIR__.'/voucher.css')?>
					</style>
					<div class='voucher_clinic_top'>
						<div class='clinic_logo'>
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/logo.php"));?>
						</div>
						<div class='clinic_address'>
							<div class='clinic_name'>
								<?=$arResult['DOCTOR']['PROPERTY_IB_CLINIC_NAME']?>
							</div>
							<div class='clinic_addr'>
								<?=$arResult['DOCTOR']['PROPERTY_IB_CLINIC_PROPERTY_ADRES_VALUE']?>
							</div>
							<div class='clinic_contacts'>
								<?=$arResult['DOCTOR']['PROPERTY_IB_CLINIC_PROPERTY_PHONE_VALUE'].($arResult['DOCTOR']['PROPERTY_IB_CLINIC_PROPERTY_EMAIL_VALUE'] ? ('; '.$arResult['DOCTOR']['PROPERTY_IB_CLINIC_PROPERTY_EMAIL_VALUE']) : '')?>
							</div>
						</div>
					</div>
					<div class='voucher_clear'>&nbsp;</div>
					<div class='voucher_data'>
						<div class='voucher_top'>
							<div class='voucher_top_left'>
								<?=GetMessage('SH_VOUCHER_NUM')?>
								<span><?=$arResult['NEW_REQ_ID']?></span>
							</div>
							<div class='voucher_top_right'>
								<?=$arResult['DOCTOR']['NAME']?><br/>
								<?=$arResult['SHEDULE_DAY']['NAME']?><br/>
								<?=$arResult['SHEDULE_TIME']['NAME']?>
							</div>
						</div>
						<div class='voucher_clear'>&nbsp;</div>
						<div class='voucher_bottom'>
							<div class='user_info'>
								<?echo $_REQUEST['NAME'];?>
								<br/>
								<?=$_REQUEST['PHONE'].($_REQUEST['EMAIL'] ? ('; '.$_REQUEST['EMAIL']) : '')?>
							</div>
							<div class='voucher_legend_bottom'>
								<?=GetMessage('SH_VOUCHER_LEGEND_BOTTOM')?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
