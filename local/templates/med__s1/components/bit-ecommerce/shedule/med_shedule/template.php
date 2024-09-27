<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
if(!is_array($arResult['DOCTOR'])) {
	return;
}
?>

<a href='<?=SITE_DIR?>appointments/?DOCTOR_ID=<?=$arParams['DOCTOR_ID']?>' class='shedule2doc' data-doctorId='<?=$arParams['DOCTOR_ID']?>'><?=GetMessage('SHEDULE2DOC')?></a>

