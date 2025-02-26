<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)die();?>
<?IncludeTemplateLangFile(__FILE__);?>
<?if($curPage != SITE_DIR."index.php"){?>
</div>
									</div>
								 </div>
							 </div>
</div>
<?}?>
	</div>
            <div class="complete-footer">
            <footer id="footer">
            	<div class="container">
                	<div class="row">
					    <div class="col-xs-12 col-sm-6 col-md-3 foot-widget">
                            <div id="footer-column-1">
                                <a href="/">
                                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/logo.php"), false); ?>
                                </a>

                                <div class="text">
                                    <p>Клиника контроля миопии <?=date('Y');?></p>

                                    <a href="https://www.artmax-studio.ru/" target="_blank"  rel="nofollow">
                                        <img src="<?=SITE_TEMPLATE_PATH;?>/images/artmax_logo.svg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
						
                        <!--Foot widget-->
                        <div class="col-xs-12 col-sm-6 col-md-3 foot-widget foot-widget-column-2">
                            <div class="title-wrapper">
                                <span class="title">Меню</span>
                            </div>
                            <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/block_footer.php"), false);?>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 foot-widget foot-widget-column-3">
                            <div class="title-wrapper">
                                <span class="title">Контакты</span>
                            </div>
                            <div class="data">
                                <div class="item">
                                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/footer-adress.php"), false); ?>
                                </div>
                                <div class="item">
                                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/footer-email.php"), false); ?>
                                </div>
                                <div class="item">
                                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/footer-phone.php"), false); ?>
                                </div>
                                <div class="item">
                                    <a data-fancybox data-options='{"touch" : false}' href="#phone_callback-modal">Заказать обратный звонок</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 foot-widget foot-widget-column-4">
                            <div class="title-wrapper">
                                <span class="title">Мы в соцсетях</span>
                            </div>

                            <div class="social-wrap-head col-md-3 no-pad">
                                <?
                                $vkLink = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"]."/include/socnet_vk.php");
                                $tgLink = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"]."/include/socnet_tg.php");
                                $dzenLink = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"]."/include/socnet_dzen.php");
                                $youtubeLink = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"]."/include/socnet_youtube.php");
                                ?>
                                <ul>
                                    <? if ($vkLink): ?>
                                        <li><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/socnet_vk.php"), false); ?></li>
                                    <? endif ?>
                                    <? if ($tgLink): ?>
                                        <li><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/socnet_tg.php"), false); ?></li>
                                    <? endif ?>
                                    <? if ($dzenLink): ?>
                                        <li><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/socnet_dzen.php"), false); ?></li>
                                    <? endif ?>
                                    <? if ($youtubeLink): ?>
                                        <li><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/include/socnet_youtube.php"), false); ?></li>
                                    <? endif ?>
                                </ul>
                            </div>

                            <div class="another-links">
                                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/cookie_modal.php"), false);?>
                                <br/>
                                <? $APPLICATION->IncludeComponent("bit-ecommerce:visually.impaired","",Array()); ?>
                            </div>
                        </div>
					</div>
				</div>
			
			</footer>
            <!-- <div class="bottom-footer">
                <div class="container">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 foot-widget-bottom">
                        <span class="col-lg-3 col-md-3 col-sm-6 col-xs-12 no-pad copyright">
                                <?$APPLICATION->IncludeFile(
                                    $APPLICATION->GetTemplatePath(SITE_DIR."include/copyright.php"),
                                    Array(),
                                    Array("MODE"=>"html")
                                );?>

                        </span>
                        <p class="col-xs-6 col-md-2 no-pad" id="bx-composite-banner"></p>
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:menu",
                                        "footer_menu",
                                        Array(
                                            "COMPONENT_TEMPLATE" => "horizontal_multilevel",
                                            "ROOT_MENU_TYPE" => "top",
                                            "MENU_CACHE_TYPE" => "N",
                                            "MENU_CACHE_TIME" => "3600",
                                            "MENU_CACHE_USE_GROUPS" => "Y",
                                            "MENU_CACHE_GET_VARS" => array(0=>"",),
                                            "MAX_LEVEL" => "1",
                                            "CHILD_MENU_TYPE" => "left",
                                            "USE_EXT" => "N",
                                            "DELAY" => "N",
                                            "ALLOW_MULTI_SELECT" => "N"
                                        )
                                    );?>
                        </div>
                    </div>
                </div>
                </div>
			</div> -->


    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery-ui-1.10.3.custom.min.js"></script>  
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/bootstrap-new/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.scrollUp.min.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.sticky.min.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/wow.min.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.flexisel.min.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.imedica.min.js"></script>
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/custom-imedicajs.min.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/flexmenu.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/imask.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

                <script type='text/javascript'>
		$(window).load(function(){
			$('#loader-overlay').fadeOut(900);
			$("html").css("overflow","visible");
		});
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof Fancybox !== "undefined") {
                Fancybox.defaults.draggable = false;
                Fancybox.bind('[data-fancybox]', {
                    Carousel: {
                        Panzoom: {
                            touch: false,
                        },
                    },
                });
            } else {
                console.error("Fancybox не загружен!");
            }
        });

        <?if(stristr($curPage, 'contact') == true){?>
		$( "#imedica-dep-accordion" ).accordion({ collapsible: true, active: false });
		<?}?>
	</script>
	<div class="banner_warning">
		<div class="maxwidth-theme">
				<span><?= GetMessage("TMPL_ATTENTION") ?></span>
		</div>
	</div>


    <div style="display: none; width: 635px;" id="phone_callback-modal">
        <div class="form-body">
            <div class="logo">
                <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/logo.php"), false); ?>
            </div>
            <h2 class="title">Заказать обратный звонок</h2>
            <p class="desc">
                Наши специалисты проведут консультацию и расскажут о процедуре подбора контактных линз
            </p>
            <div class="form">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:form",
                    "modal-form",
                    array(
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "CACHE_TIME" => "3600",
                        "CACHE_TYPE" => "A",
                        "CHAIN_ITEM_LINK" => "",
                        "CHAIN_ITEM_TEXT" => "",
                        "EDIT_ADDITIONAL" => "N",
                        "EDIT_STATUS" => "Y",
                        "IGNORE_CUSTOM_TEMPLATE" => "N",
                        "NAME_TEMPLATE" => "",
                        "NOT_SHOW_FILTER" => array(
                            0 => "",
                            1 => "",
                        ),
                        "NOT_SHOW_TABLE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "RESULT_ID" => $_REQUEST["RESULT_ID"],
                        "SEF_MODE" => "N",
                        "SHOW_ADDITIONAL" => "N",
                        "SHOW_ANSWER_VALUE" => "N",
                        "SHOW_EDIT_PAGE" => "Y",
                        "SHOW_LIST_PAGE" => "Y",
                        "SHOW_STATUS" => "Y",
                        "SHOW_VIEW_PAGE" => "Y",
                        "START_PAGE" => "new",
                        "SUCCESS_URL" => "",
                        "USE_EXTENDED_ERRORS" => "N",
                        "WEB_FORM_ID" => "2",
                        "COMPONENT_TEMPLATE" => "modal-form",
                        "VARIABLE_ALIASES" => array(
                            "action" => "action",
                        )
                    ),
                    false
                );?>
            </div>
        </div>
    </div>
	</body>
</html>