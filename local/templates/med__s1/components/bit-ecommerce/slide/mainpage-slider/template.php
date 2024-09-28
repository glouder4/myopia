<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$frame = $this->createFrame("slide", false)->begin();
?>

            <div class="container full-width-container ihome-banner">
            	<div class="banner col-sm-12 col-xs-12 col-md-12">
                	
                    <ul>
               <?foreach ($arResult["ITEMS"] as $arItems):     

        	   ?>				
                <li data-transition="fade" data-slotamount="1" data-delay="<?=$arItems['PROPERTY_SPEED_VALUE']?>" data-saveperformance="on"  data-title="Intro Slide">
             	<img src="<?=CFile::GetPath ($arItems["DETAIL_PICTURE"])?>"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
				    <?if($arItems["PREVIEW_PICTURE"]){?>
					<div class="tp-caption bluebg-t3 sfr skewtoright imed-sl1"
                        data-x="<?=$arItems['PROPERTY_IMG_POSITION_VALUE']?>"
                        data-y="bottom"
                        data-hoffset="0"
                        data-speed="1000"
                        data-start="1"
                        data-easing="Power1.easeOut"
                        data-endspeed="1000"
                        data-endeasing="Power3.easeInOut"
						data-autoplayonlyfirsttime="false"
						data-nextslideatend="true"
                        ><img src="<?=CFile::GetPath ($arItems["PREVIEW_PICTURE"])?>?>" alt="<?=$arItems["NAME"]?>" class="img-responsive">
                    </div>
					<?}?>
					<div class="tp-caption bluebg-t2 sfr skewtoright imed-sl1 title"
                        data-x="80"
                        data-y="122"
                        data-hoffset="-10"
                        data-speed="1000"
                        data-start="1"
                        data-easing="Back.easeOut"
                        data-endspeed="1000"
                        data-endeasing="Power2.easeIn"
                        ><strong style="color:#<?if($arItems['PROPERTY_COLOR_VALUE']==GetMessage("COLOR")){?>000<?}else{?>fff<?}?>"><?=htmlspecialchars_decode($arItems["NAME"])?></strong>
                    </div>


                    <!-- LAYER NR. 7 -->
                    <div class="tp-caption bluebg-t3 sfr skewtoright imed-sl1 descr"
                        data-x="80"
                        data-y="270"
                        data-hoffset="-60"
                        data-speed="1000"
                        data-start="1"
                        data-easing="Back.easeOut"
                        data-endspeed="1000"
                        data-endeasing="Power3.easeIn"
                        ><strong style="color:#<?if($arItems['PROPERTY_COLOR_VALUE']==GetMessage("COLOR")){?>000<?}else{?>fff<?}?>"><?=$arItems["PREVIEW_TEXT"]?></strong>
						</div>
						
						<?if($arItems["PROPERTY_URL_VALUE"]){?>
						<div class="tp-caption s1-but customin skewtoright imed-sl1 abtn"
                        data-x="left"
                        data-y="385"
                        data-hoffset="80"
                        data-speed="1000"
                        data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                        data-start="10"
                        data-easing="Back.easeOut"
                        data-endspeed="1000"
                        data-endeasing="Power4.easeIn"
                        >						
						<a class="cnopca_slider" href="<?=$arItems['PROPERTY_URL_VALUE']?>"><?=GetMessage("DETAIL")?></a></div>
						<?}?>
                                         
                </li>				   
				<?endforeach;?>
				</ul>
			</div>    
		</div>	
			
	<?$frame->end();?>