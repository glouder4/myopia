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
		

                <div class="col-xs-12 col-sm-12" id="news-list">
                    <div class="row">
					    <div class="subtitle col-xs-12 col-sm-11 col-md-12">Новости</div>

						<?foreach($arResult["ITEMS"] as $arItem):?>
    							<?
    							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    							?>

                            <div class="post-item-wrap col-sm-6" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
									<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
                                    	<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" class="img-responsive post-author-img" alt="" />
									</a>
                                </div>                                
                                        	
                                <div class="post-content1 pull-left col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    	            <div class="post-title pull-left"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem['NAME_IMPLODE']?></a></div>
                    	            <div class="post-meta-top pull-left">
                        	            <ul>
                                            <li><i class="fa fa-calendar-o"></i><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></li>
                                        </ul>
                    	            </div>
                                </div>
                                <div class="post-content2">                   
                                   	<p><?=$arItem['PREVIEW_TEXT_IMPLODE']?><br />
                                   	<span class="post-meta-bottom"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo GetMessage("CT_BNL_GOTO_DETAIL")?></a></span></p>
                                </div>
                            </div>
                        </div>					 

						<?endforeach;?>
                    </div>

                    <a href="<?=SITE_DIR?>news/" class="col-xs-12 dept-details-butt pull-right"><?echo GetMessage("CT_BNL_GOTO_NEWS")?></a>
                </div>
