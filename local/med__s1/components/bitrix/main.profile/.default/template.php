<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (strlen($arResult["strProfileError"]) > 0) {
	?>
	<script>
		notificationOpen('message', {'message': '<?= $arResult["strProfileError"] ?>'});
	</script>
	<?
}
if ($arResult['DATA_SAVED'] == 'Y') {
	?>
	<script>
		notificationOpen('message', {'message': '<?= GetMessage('PROFILE_DATA_SAVED') ?>'});
	</script>
	<?
}
?>

<div class="form col-lg-8 col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
	<form method="post" action="<?= $arResult["FORM_TARGET"] ?>" name="form1" enctype="multipart/form-data">
		<?= $arResult["BX_SESSION_CHECK"] ?>
		<input type="hidden" name="lang" value="<?= LANG ?>" />
		<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />
		<div class="form__section">
			<div class="form__section-caption"><?= GetMessage("USER_PERSONAL_INFO") ?></div>
			<div class="control-group">
				<label class="form__label"><?= GetMessage("LAST_NAME") ?></label>
				<input type="text" class="contact2-textbox form-control" name="LAST_NAME" value="<?= $arResult["arUser"]["LAST_NAME"] ?>" />
			</div>
			<div class="control-group">
				<label class="form__label"><?= GetMessage("NAME") ?></label>
				<input type="text" class="contact2-textbox form-control" name="NAME" value="<?= $arResult["arUser"]["NAME"] ?>" />
			</div>
			<div class="control-group">
				<label class="form__label"><?= GetMessage("SECOND_NAME") ?></label>
				<input type="text" class="contact2-textbox form-control" name="SECOND_NAME" value="<?= $arResult["arUser"]["SECOND_NAME"] ?>" />
			</div>
			<div class="control-group">
				<label class="form__label"><?= GetMessage("USER_PHONE") ?></label>
				<input type="tel" class="contact2-textbox form-control" name="PERSONAL_PHONE" id="phone-mask" value="<?= $arResult["arUser"]["PERSONAL_PHONE"] ?>" />
			</div>
		</div>
		<div class="form__section">
			<div class="form__section-caption"><?= GetMessage("REG_INFO") ?></div>
			<div class="control-group">
				<label class="form__label"><?= GetMessage("LOGIN") ?></label>
				<input type="text" class="contact2-textbox form-control" name="LOGIN" value="<?= $arResult["arUser"]["LOGIN"] ?>" disabled />
			</div>
			<div class="control-group">
				<label class="form__label"><?= GetMessage("EMAIL") ?></label>
				<input type="text" class="contact2-textbox form-control _required _validate" name="EMAIL" value="<?= $arResult["arUser"]["EMAIL"] ?>" required pattern="^[^@]{1,}@.{2,}\..{2,}$"/>
			</div>
			<div class="control-group">
				<label class="form__label"><?= GetMessage("NEW_PASSWORD") ?></label>
				<?
				$password_lookahead = '';
				$password_lookahead .= ($arResult["GROUP_POLICY"]['PASSWORD_DIGITS'] == 'Y' ? '(?=.*[0-9])': '');
				$password_lookahead .= ($arResult["GROUP_POLICY"]['PASSWORD_LOWERCASE'] == 'Y' ? '(?=.*[a-z])' : '');
				$password_lookahead .= ($arResult["GROUP_POLICY"]['PASSWORD_UPPERCASE'] == 'Y' ? '(?=.*[A-Z])' : '');
				$password_lookahead .= ($arResult["GROUP_POLICY"]['PASSWORD_PUNCTUATION'] == 'Y' ? '(?=.*[' . htmlentities(',.<>/?;:\'"\[\]\{\}\\|`~!@#$%^&*()_+=-') . '])': '');
				$password_pattern = '0-9a-zA-Z' . htmlentities(',.<>/?;:\'"\[\]\{\}\\|`~!@#$%^&*()_+=-');
				?>
				<input type="password" name="NEW_PASSWORD" id="profilePassword" class="contact2-textbox form-control form__input-password _required _validate" pattern="^<?= $password_lookahead ?>[<?= $password_pattern ?>]{<?= $arResult["GROUP_POLICY"]['PASSWORD_LENGTH'] ?>,}$" value="" rel="profilePasswordConfirm" />
			</div>
			<div class="control-group">
				<label class="form__label"><?= GetMessage("NEW_PASSWORD_CONFIRM") ?></label>
				<input type="password" name="NEW_PASSWORD_CONFIRM" id="profilePasswordConfirm" class="contact2-textbox form-control form__input-password _required" value="" data-password-confirmation="true" rel="profilePassword" />
			</div>
			<div class="control-group">
				<span class="form__hint"><?= $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"] ?></span>
			</div>
		</div>
		<div class="control-group">
			<input class="auth-sumbit btn" type="submit" name="save" value="<?= GetMessage("MAIN_SAVE") ?>">
		</div>

	</form>
</div>
<script>
	//formInit();
</script>