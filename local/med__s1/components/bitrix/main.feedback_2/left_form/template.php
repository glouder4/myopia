<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="sidebar-wrap-dept col-md-4 col-sm-4 col-xs-12 no-pad wow animated">
<div class="appointment-form no-pad dept-form">
<div class="appointment-form-title"><i class="icon-hospital2 appointment-form-icon"></i><?=GetMessage("TITLE")?></div>
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>

<form class="appt-form" action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>


		<input class="appt-form-txt" type="text" name="user_name" placeholder="<?=GetMessage("MFT_NAME")?>" value="<?=$arResult["AUTHOR_NAME"]?>">


		<input class="appt-form-txt" type="text" name="user_tel" placeholder="<?=GetMessage("MFT_TEL")?>">
		

		<input class="appt-form-txt" type="text" name="user_email" placeholder="<?=GetMessage("MFT_EMAIL")?>" value="<?=$arResult["AUTHOR_EMAIL"]?>">

		<textarea class="appt-form-txt" style="height: 150px;" name="MESSAGE" placeholder="<?=GetMessage("MFT_MESSAGE")?>" cols="40"><?=$arResult["MESSAGE"]?></textarea> 


	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<div class="mf-captcha">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
		<input class="appt-form-txt" type="text" name="captcha_word" size="30" maxlength="50" value="">
	</div>
	<?endif;?>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">	
	            <section class="color-7" id="btn-click">
                <button class="icon-mail btn2-st2 btn-7 btn-7b iform-button"><input style="background-color:transparent; border: 0;padding: 0;" type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>"></button>
				
                </section>
</form>
</div>
</div>