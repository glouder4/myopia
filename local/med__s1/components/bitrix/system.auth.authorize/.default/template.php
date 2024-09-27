<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-sm-offset-2">
	<?if($arResult["AUTH_SERVICES"]):?>
		<div class="blog-box-title"><a href=""><?echo GetMessage("AUTH_TITLE")?></a></div>
	<?endif?>
	<div class="blog-box-title text-center" style="padding-bottom: 50px;"><a href="" style="font-weight: bold;"><?=GetMessage("AUTH_PLEASE_AUTH")?></a></div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-sm-offset-3">


	<?
	ShowMessage($arParams["~AUTH_RESULT"]);
	ShowMessage($arResult['ERROR_MESSAGE']);
	?>
	<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

		<input type="hidden" name="USER_REMEMBER" value="Y" />
		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<?if (strlen($arResult["BACKURL"]) > 0):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>

		<div class="control-group">
			<input class="contact2-textbox form-control" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>"/>
		</div>
		<div class="control-group">
			<input class="contact2-textbox form-control" type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off" placeholder="<?=GetMessage("AUTH_PASSWORD")?>"/>
		</div>
		<?if($arResult["CAPTCHA_CODE"]):?>
			<div class="control-group">
				<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
				<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:
				<input class="bx-auth-input form-control" type="text" name="captcha_word" maxlength="50" value="" size="15" />
			</div>
		<?endif;?>
		<?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
			<noindex>
				<div class="control-group" style="padding: 18px 0 0 0;">
					<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
				</div>
			</noindex>
		<?endif?>
		<div class="control-group">
				<input class="auth-sumbit btn" type="submit" name="submit" value="<?=GetMessage("AUTH_AUTHORIZE")?>">
		</div>





<?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
		<noindex>
			<div class="control-group text-center">
				<a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow" style="font-weight: bold;color: #2f3232;"><?=GetMessage("AUTH_REGISTER")?></a><br />
				<?//=GetMessage("AUTH_FIRST_ONE")?>
			</div>
		</noindex>
<?endif?>

	</form>


<script type="text/javascript">
<?if (strlen($arResult["LAST_LOGIN"])>0):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>

<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
	array(
		"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
		"CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
		"AUTH_URL" => $arResult["AUTH_URL"],
		"POST" => $arResult["POST"],
		"SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
		"FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
		"AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
	),
	$component,
	array("HIDE_ICONS"=>"Y")
);
?>

<?endif?>
</div>