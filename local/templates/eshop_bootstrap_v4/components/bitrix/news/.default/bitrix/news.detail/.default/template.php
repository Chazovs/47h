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
<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?><br />
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>

    <h3>Ваша Идея</h3>
    <form>
        <div class="form-group">
            <label for="exampleFormControlInput1">Ваш e-mail</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Как вас зовут (хотя бы имя и фамилию)</label>
            <input type="" class="form-control" id="exampleFormControlInput1" >
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Описание вашей идеи</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">О вас</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Файлы с решением кейса</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
    </form>

    <script type="text/javascript" src='/megafon/jsonrpcws.js'></script>
    <script type="text/javascript">
        if (window.WebSocket) {
            window.onload = () => {
                let conf_session = null;
                connection.onclick = () => {
                    if (connection.innerText == 'Позвонить HR специалисту прямо сейчас') {
                        const protocol = location.protocol.replace('http', 'ws');
                        client = new JsonRpcWs(`${protocol}//79286266488:gE7b9m@testapi.megafon.ru/v1/api`);
                        client.handle('OnOpen', () => {
                            connection.innerText = 'Закончить разговор';
                            client.request('callMake', { bnum: "79085139060" });

                        });
                        client.handle('onCallAnswer', (params) => {
                            if (params.call_session) {
                                client.request('callFilePlay', { call_session: params.call_session, filename: 'welcome.pcm' });
                            }
                        });
                        client.handle('onConfMake', (params) => {
                            if (params.conf_session) {
                                conf_session = params.conf_session
                                client.request('confBroadcastConnect', { conf_session: conf_session, url: "shout://icecast.vgtrk.cdnvideo.ru/vestifm_mp3_64kbps" });
                                client.request('callMake', { bnum: destination.value });
                            }
                        });
                        client.handle('onCallFilePlay', (params) => {
                            if (conf_session) {
                                client.request('confAdd', { conf_session: conf_session, call_session: params.call_session });
                            } else {
                                client.request('callTerminate', { call_session: params.call_session });
                            }
                        });
                        client.handle('onCallIncoming', (params) => {
                            if (params.call_session) {
                                client.request('callAnswer', { call_session: params.call_session });
                            }
                        });
                        client.handle('onCallTerminate', () => {
                            console.log('call terminated');
                        });
                        client.handle('OnClose', () => {
                            connection.innerText = 'Позвонить HR специалисту прямо сейчас';
                        });
                        client.open();
                    } else {
                        client.close();
                    }
                }


            }
        } else {
            console.log('Your browser does not support websockets and promises');
        }
    </script>

    <h4 align="center">Хотите поделиться своими идеями при личной встрече?<br><br>
<button type="button" class="btn btn-success" id='connection'>Позвонить HR специалисту прямо сейчас</button>
    <br><br>
    </h4>




















   <!-- <script type="text/javascript" src='/megafon/jsonrpcws.js'></script>
    <script type="text/javascript">
        if (window.WebSocket) {
            window.onload = () => {
                let conf_session = null;
                connection.onclick = () => {
                    if (connection.innerText == 'Позвонить HR специалисту прямо сейча') {
                        const protocol = location.protocol.replace('http', 'ws');
                        client = new JsonRpcWs(`${protocol}//79286266488:gE7b9m@testapi.megafon.ru/v1/api`);
                        client.handle('OnOpen', () => {
                            connection.innerText = 'Закончить разговор';
                            client.request('callMake', { bnum: "79085139060"});
                        });
                        client.handle('onCallAnswer', (params) => {
                            if (params.call_session) {
                                client.request('callFilePlay', { call_session: params.call_session, filename: 'welcome.pcm' });
                            }
                        });
                        client.handle('onConfMake', (params) => {
                            if (params.conf_session) {
                                conf_session = params.conf_session
                                client.request('confBroadcastConnect', { conf_session: conf_session, url: "shout://icecast.vgtrk.cdnvideo.ru/vestifm_mp3_64kbps" });
                                client.request('callMake', { bnum: destination.value });
                            }
                        });
                        client.handle('onCallFilePlay', (params) => {
                            if (conf_session) {
                                client.request('confAdd', { conf_session: conf_session, call_session: params.call_session });
                            } else {
                                client.request('callTerminate', { call_session: params.call_session });
                            }
                        });
                        client.handle('onCallIncoming', (params) => {
                            if (params.call_session) {
                                client.request('callAnswer', { call_session: params.call_session });
                            }
                        });
                        client.handle('onCallTerminate', () => {
                            console.log('call terminated');
                        });
                        client.handle('OnClose', () => {
                            connection.innerText = 'Позвонить HR специалисту прямо сейча';
                        });
                        client.open();
                    } else {
                        client.close();
                    }
                }
            }
        } else {
            console.log('Your browser does not support websockets and promises');
        }
    </script>
<h4 align="center">Хотите поделиться своими идеями при личной встрече?<br><br>
    <button type="button" class="btn btn-success" id='connection'>Позвонить HR специалисту прямо сейчас</button>
    <br><br>
</h4>-->


   <!-- <input id='login' placeholder='Login'>
    <input id='password' placeholder='Password'>
    <button id='connection'>Connect</button>
    <br><br>
    <div id='actions' style='display:none'>
        <input id='destination' placeholder='Destination'>
        <button id='call'>Call</button>
        <button id='conference'>Conference</button>
    </div>-->


</div>
