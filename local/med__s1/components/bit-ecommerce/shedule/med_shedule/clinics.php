<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div id='shedule_form' class='col-md-8'>
	<div class='clinics'>
		<?foreach($arResult['CLINICS'] as $incClinicID=>$arClinic){?>
			<div class='clinic'>
				<?if(count($arResult['CLINICS'])>1){?>
					<div class='clinic_top'>
						<?if($arClinic['PREVIEW_PICTURE']){?>
							<div class='clinic_ico'>
								<img src='<?=CFile::GetPath($arClinic['PREVIEW_PICTURE'])?>' alt='<?=$arClinic['NAME']?>'/>
							</div>
						<?}?>
						<div class='clinic_info'>
							<h3><?=$arClinic['NAME']?></h3>
							<p><?=$arClinic['~PREVIEW_TEXT']?></p>
							<a href='<?=$arClinic['DETAIL_PAGE_URL']?>'><?=GetMessage('S_MORE')?></a>
							<div class='open_doctors'><?=GetMessage('S_MORE_DOCTORS')?></div>
						</div>
						
					</div>
				<?}?>
				<div class='clinic_doctors'<?if(count($arResult['CLINICS'])==1){?> style='display:block;'<?}?>>
					<?foreach($arClinic['DOCTORS'] as $intDoctorId=>$arDoctor){?>
						<div class='doctor'>
							<div class='doctor_ico'>
								<?if($arDoctor['PREVIEW_PICTURE']){?>
									<a href='?DOCTOR_ID=<?=$intDoctorId?>'><img src='<?=CFile::GetPath($arDoctor['PREVIEW_PICTURE'])?>' alt='<?=$arDoctor['NAME']?>'/></a>
								<?}?>
								<h4><a href='?DOCTOR_ID=<?=$intDoctorId?>'><?=$arDoctor['NAME']?></a></h4>
								<p><?=$arDoctor['PROPERTY_STR_SPECIAL_VALUE'] ? $arDoctor['PROPERTY_STR_SPECIAL_VALUE'] : $arDoctor['~PREVIEW_TEXT']?></p>
								<div class='shedule_to_doc'>
									<a href='?DOCTOR_ID=<?=$intDoctorId?>' class='sheduleLink'><?=GetMessage('MAKE_SHEDULE')?></a>
								</div>
							</div>
							<div class='doctor_info'>
								<p><?=$arDoctor['~DETAIL_TEXT']?></p>
							</div>
							
							<div class='cl_clear'></div>
						</div>
					<?}?>
				</div>
				<div class='cl_clear'></div>
			</div>	
		<?}?>
	</div>
</div>

