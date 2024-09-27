<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) { die(); }
$arDoctor=$arResult['DOCTOR'];
$firstBitMed = new CFirstbitMedOptions();
if(isset($arResult['LOGIN_DATA'])) {

	$fields = ['LAST_NAME', 'NAME', 'SECOND_NAME', 'PHONE', 'EMAIL'];
	foreach ($fields as $field) {
		if(!isset($_REQUEST[$field]))
			$cur[$field] = $arResult['LOGIN_DATA'][$field];
		else
			$cur[$field] = $_REQUEST[$field];
	}
}
?>
<div id='shedule_form'>
	<div class='fader'></div>
	<div id="contact-version-two">
		<div class="col-md-8 no-pad">
			<div style="padding-bottom:25px;" class="blog-box-title"><?=GetMessage("MFT_LAST_STEP_NAME")?></div>
			<form name="form" id='make_request_form' class="contact2-page-form" action="<?=POST_FORM_ACTION_URI?>" method="POST">
				<div class="control-group doctor_group">
					<div class='doctor'>
						<div class='doctor_ico'>
							<?if($arDoctor['PREVIEW_PICTURE']){?>
								<a href='<?=$arDoctor['DETAIL_PAGE_URL']?>'><img src='<?=CFile::GetPath($arDoctor['PREVIEW_PICTURE'])?>' alt='<?=$arDoctor['NAME']?>'/></a>
							<?}?>
							<h4><a href='<?=$arDoctor['DETAIL_PAGE_URL']?>'><?=$arDoctor['NAME']?></a></h4>
							<p><?=$arDoctor['PROPERTY_STR_SPECIAL_VALUE'] ? $arDoctor['PROPERTY_STR_SPECIAL_VALUE'] : $arDoctor['~PREVIEW_TEXT']?></p>
						</div>
						<div class='doctor_info'>
							<div class='shedule_day'>
								<?=$arResult['SHEDULE_DAY']['NAME']?>
							</div>
							<div class='shedule_time'>
								<?=$arResult['SHEDULE_TIME']['NAME']?>
							</div>
						</div>
						<input type='hidden' name='DAY_TIME' value='<?=$arResult['SHEDULE_TIME']['ID']?>' />
					</div>
				</div>
				<div class="control-group">
					<input class="contact2-textbox" type="text" name="LAST_NAME" placeholder="<?=GetMessage("MFT_LAST_NAME")?>" value="<?=$cur["LAST_NAME"]?>">
				</div>
                <div class="control-group">
                    <input class="contact2-textbox" type="text" name="NAME" placeholder="<?=GetMessage("MFT_NAME")?>" value="<?=$cur["NAME"]?>">
                </div>
                <div class="control-group">
                    <input class="contact2-textbox" type="text" name="SECOND_NAME" placeholder="<?=GetMessage("MFT_SECOND_NAME")?>" value="<?=$cur["SECOND_NAME"]?>">
                </div>
				<div class="control-group">
					<input class="contact2-textbox" type="text" name="PHONE" id="phone-mask" placeholder="<?=GetMessage("MFT_TEL")?>" value='<?=$cur["PHONE"]?>'>
				</div>
				<div class="control-group">
					<input class="contact2-textbox" type="text" name="EMAIL" placeholder="<?=GetMessage("MFT_EMAIL")?>" value="<?=$cur["EMAIL"]?>">
				</div>
				<div class="control-group">
					<textarea class="contact2-textarea" style="height: 150px;" name="COMMENT" placeholder="<?=GetMessage("COMMENT")?>" cols="40"><?=$_REQUEST["COMMENT"]?></textarea>
				</div>
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<?if(count($arResult['ERRORS'])){?>
						<div class='err_m'>
							<?=implode('<br/>',$arResult['ERRORS'])?>
						</div>
					<?}?>
				</div>
				<input type='hidden' name='MAKE_RECORD' value='yes'/>
                <?if($firstBitMed->getChBoxStatus()):?>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 control-group">
                        <label><input type="checkbox" value="Y" name="AGREEMENT">
                            <?=$firstBitMed->getLegalText()?>
                        </label>
                    </div>
                <?endif;?>
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<section class="color-7" id="btn-click">
						<button class="icon-mail btn2-st2 btn-7 btn-7b" >
							<input style="background-color:transparent; border: 0;padding: 0;width: 100%;" type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
						</button>
					</section>
				</div>
			</form>
			<div class="column-element">
				<center>
					<b class="mf-ok-text"><?=GetMessage("TEXT")?></b>
				</center>
			</div>
		</div>
	</div>
</div>
