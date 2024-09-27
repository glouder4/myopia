<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 pull-left doctors-3col-tabs no-pad">
           
           		
            <div class="content-tabs tabs col-xs-12 col-sm-12">
			
			<?=$arItem['ID']?><br>
                      <ul class="nav nav-tabs tab-acc" >
					    <li <?if($_REQUEST['SECTION_ID']==false){?>class="active"<?}?>><a href="<?=SITE_DIR?>personal/" ><?=GetMessage("OLD")?></a></li>
					  <?foreach($arResult["SECTION"] as $i=>$arItem):?>
                        <li <?if(($_REQUEST['SECTION_ID']==$arItem['ID'] && $_REQUEST['SECTION_ID']==true) || ($_REQUEST['SECTION_ID']==$arItem['CODE'] && $_REQUEST['SECTION_ID']==true)){?>class="active"<?}?>><a href="<?=SITE_DIR?>personal/<?=$arItem['CODE']?>/" ><?=$arItem['NAME']?></a></li>

					  <?endforeach;?>
                      </ul>			
			

                      
                      
                        <div class="tab-pane fade fade-slow in active" >                        			   
							<?foreach($arResult["ITEMS"] as $arItem):?>
								<?
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								?>
                        <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><div class="doctor-box col-md-4 col-sm-6 col-xs-12" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        
                        	<div class="zoom-wrap">
                          <div class="zoom-icon"></div>
                        	<img alt="" class="img-responsive" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" />
                          </div>
                      	<div class="doc-name">
                      		<?/*   fix issue 57.16
                          	<div class="doc-name-class"><?=$arItem['IBLOCK_SECTION_NAME']?></div>
							 * 
							 */?>
                          	<span class="doc-title"><?=$arItem['NAME']?></span>
                          	<hr />
                          	<p><?=$arItem['DISPLAY_PROPERTIES']['STR_SPECIAL']['DISPLAY_VALUE'] ? $arItem['DISPLAY_PROPERTIES']['STR_SPECIAL']['DISPLAY_VALUE'] : $arItem['~PREVIEW_TEXT']?></p>
                          	<div class='clinic_block'>
                          		<?=$arItem['DISPLAY_PROPERTIES']['IB_CLINIC']['DISPLAY_VALUE']?>
                          	</div>
                          </div>
                         </div>	</a>						

							<?endforeach;?>
                          </div>
                         

			</div>
						
		</div>
					 <div class="col-xs-12 col-sm-12 col-md-12">	
						<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
							<br /><?=$arResult["NAV_STRING"]?>
						<?endif;?>
					</div></div>