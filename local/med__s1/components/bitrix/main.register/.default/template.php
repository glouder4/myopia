<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
$module_id = "firstbit.med";
if(!CModule::IncludeModule($module_id)) {
	return;
}
$firstBitMedOptions = new CFirstbitMedOptions();
$currentUserConsend = $firstBitMedOptions->options['FIRSTBIT_MED_USER_CONSENT'];
?>
<div class="bx-auth-reg">

	<?if(!$USER->IsAuthorized()):?>
		<form method="post" action="<?=POST_FORM_ACTION_URI?>" class="Form" name="regform" enctype="multipart/form-data" data-form-submitted="true">
			<?
			if ($arResult["BACKURL"] <> '') {
				?>
				<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
				<?
			}
			?>
			<input type="hidden" name="REGISTER[LOGIN]" value="login_<?= rand(10000,99999) ?>" />
			<?
			if ($arResult["BACKURL"] <> '') {
				?>
				<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
				<?
			}
			?>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-sm-offset-2">

				<div class="blog-box-title text-center" style="padding-bottom: 50px;"><a href="" style="    font-weight: bold;"><?=GetMessage("AUTH_REGISTER_TITLE")?></a></div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-sm-offset-3">
				<?if($USER->IsAuthorized()):?>

					<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

				<?else:?>
					<div class="col-md-12">
						<?
						if (count($arResult["ERRORS"]) > 0):
							foreach ($arResult["ERRORS"] as $key => $error)
								if (intval($key) == 0 && $key !== 0)
									$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

							ShowError(implode("<br />", $arResult["ERRORS"]));

						elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
							?>
							<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
						<?endif?>
					</div>
				<?endif?>
				<div class="col-md-12">
					<div class="control-group">
						<input type="text" required="" name="REGISTER[LAST_NAME]" placeholder="<?= GetMessage("REGISTER_FIELD_LAST_NAME") ?>" class="contact2-textbox form-control" value="<?= $arResult["VALUES"]["LAST_NAME"] ?>">
					</div>
					<div class="control-group">
						<input type="text" required="" name="REGISTER[NAME]" placeholder="<?= GetMessage("REGISTER_FIELD_NAME") ?>" class="contact2-textbox form-control" value="<?= $arResult["VALUES"]["NAME"] ?>">
					</div>
					<div class="control-group">
						<input type="text" required="" name="REGISTER[EMAIL]" placeholder="<?= GetMessage("REGISTER_FIELD_EMAIL") ?>" class="contact2-textbox form-control" value="<?= $arResult["VALUES"]["EMAIL"] ?>">
					</div>
					<div class="control-group">
						<input type="text" required="" name="REGISTER[PERSONAL_PHONE]" placeholder="<?= GetMessage("REGISTER_FIELD_PERSONAL_PHONE") ?>" id="phone-mask" class="contact2-textbox form-control" value="<?= $arResult["VALUES"]["PERSONAL_PHONE"] ?>">
					</div>
					<div class="control-group">
						<input type="password" required="" name="REGISTER[PASSWORD]" placeholder="<?= GetMessage("REGISTER_FIELD_PASSWORD") ?>" class="contact2-textbox form-control" value="<?= $arResult["VALUES"]["PASSWORD"] ?>">
					</div>
					<div class="control-group">
						<input type="password" required="" name="REGISTER[CONFIRM_PASSWORD]" placeholder="<?= GetMessage("REGISTER_FIELD_CONFIRM_PASSWORD") ?>" class="contact2-textbox form-control" value="<?= $arResult["VALUES"]["CONFIRM_PASSWORD"] ?>">
					</div>

					<?
					if ($arResult['USE_CAPTCHA'] == 'Y') {
						?>
						<?
						if ($arResult["CAPTCHA_CODE"]) {
							?>
							<div class="control-group"><h4><?= GetMessage("REGISTER_CAPTCHA_PROMT") ?></h4></div>
							<label class="FormField" data-width="50%" id="data-captcha-wrapper" data-captcha-wrapper>
								<input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>" data-captcha-sid/>
								<img class="captcha__image" src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" alt="CAPTCHA" data-captcha-image/>
							</label>
							<label class="FormField" data-width="50%">
								<input class="contact2-textbox form-control" type="text" name="captcha_word" value="" required pattern="^[A-z0-9]{5}$" data-captcha-word/>
							</label>
							<?
						}
					}
					?>
					<?if($currentUserConsend>0):?>
						<label class="FormField FormField_align_center" data-width="50%">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.userconsent.request",
								"",
								array(
									"ID" => $currentUserConsend,
									"IS_CHECKED" => "Y",
									"AUTO_SAVE" => "Y",
									"IS_LOADED" => "Y",
									"REPLACE" => array(
										'button_caption' => GetMessage("AUTH_REGISTER"),
										'fields' => array(GetMessage("REGISTER_FIELD_LAST_NAME"), GetMessage("REGISTER_FIELD_NAME"), GetMessage("REGISTER_FIELD_SECOND_NAME"), GetMessage("REGISTER_FIELD_EMAIL"), GetMessage("REGISTER_FIELD_PERSONAL_PHONE"))
									),
								)
							);?>
						</label>
					<?endif;?>
					<div class="control-group">
						<input class="auth-sumbit btn" type="submit" name="register_submit_button" value="<?= GetMessage("AUTH_REGISTER") ?>">
					</div>
				</div>
		</form>
		</form>
	<?endif?>
</div>