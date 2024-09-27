<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 dept-tabs-wrap wow animated animated" style="visibility: visible;">
		<div class="tabbable tabs-left">
			<?=GetMessage("RECOVERY_TITLE")?>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-sm-offset-2">
				<div class="blog-box-title text-center" style="padding-bottom: 50px;"><a href="" style="font-weight: bold;"><?=GetMessage("AUTH_AUTH")?></a></div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-sm-offset-3">
				<?=ShowMessage($arParams["~AUTH_RESULT"]);?>

				<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
					<?
					if (strlen($arResult["BACKURL"]) > 0)
					{
						?>
						<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
						<?
					}
					?>
					<input type="hidden" name="AUTH_FORM" value="Y">
					<input type="hidden" name="TYPE" value="SEND_PWD">

					<div class="control-group">
						<input class="contact2-textbox form-control" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>">
					</div>
					<div class="control-group">
						<input class="contact2-textbox form-control" type="text" name="USER_EMAIL" maxlength="255" autocomplete="off" placeholder="<?=GetMessage("AUTH_EMAIL")?>">
					</div>
					<?if($arResult["USE_CAPTCHA"]):?>

						<h4><?echo GetMessage("system_auth_captcha")?></h4>
						<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" style="float: left;"/>
						<input type="text" class="contact2-textbox form-control" name="captcha_word" maxlength="50" value="" style="width: auto;float: left;margin-left: 3px;"/>

					<?endif?>
					<div class="control-group">
						<input class="auth-sumbit btn" type="submit" name="send_account_info" value="<?=GetMessage("AUTH_GET_CHECK_STRING")?>">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	document.bform.USER_LOGIN.focus();
</script>
