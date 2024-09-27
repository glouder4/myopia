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
            <div class="col-xs-12 col-lg-12  col-sm-12 col-md-12 pull-left contact2-wrap no-pad">
                <!--contact widgets-->
                <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12 pull-left no-pad">
                    <!--Contact form-->
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-pad wow">
                        <div></div> 
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-pad">
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

<form class="contact2-page-form col-lg-12 col-sm-12 col-md-12 col-xs-12 no-pad contact-v1" action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>

		<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 control-group">
		<input class="contact2-textbox" type="text" name="user_name" placeholder="<?=GetMessage("MFT_NAME")?>" value="<?=$arResult["AUTHOR_NAME"]?>">
        </div> 
		
		<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 control-group">
		<input class="contact2-textbox" type="text" name="user_tel" placeholder="<?=GetMessage("MFT_TEL")?>">
        </div> 
		
		<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 control-group">
		<input class="contact2-textbox" type="email" name="user_email" placeholder="<?=GetMessage("MFT_EMAIL")?>" value="<?=$arResult["AUTHOR_EMAIL"]?>">
        </div> 
		
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">		
		<textarea class="contact2-textarea" style="height: 150px;" name="MESSAGE" placeholder="<?=GetMessage("MFT_MESSAGE")?>" cols="40"><?=$arResult["MESSAGE"]?></textarea> 
        </div> 

	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 control-group">
	<div class="mf-captcha">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
		
		<input class="contact2-textbox" type="text" name="captcha_word" size="30" maxlength="50" value="">
		</div>
	</div>
	<?endif;?>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">	
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
	        <section class="color-7" id="btn-click">
             <button class="icon-mail btn2-st2 btn-7 btn-7b" ><input style="background-color:transparent; border: 0;padding: 0;width: 100%;" type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>"></button>				
             </section>
        </div> 
</form>
</div>
</div>
</div>
</div>