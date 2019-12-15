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
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

 <h5>Прохождение этого опроса открывает вам дополнительные фильтры при поискее компаний</h5>
    <form  action="/opros/add.php" method="post">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?= $arItem["NAME"]?></a><br />
        <div class="form-check">
            <input name="SLISHAL_<?= $arItem["ID"]?>" type="checkbox" class="form-check-input" id="SLISHAL_<?= $arItem["ID"]?>">
            <label class="form-check-label" for="SLISHAL_<?= $arItem["ID"]?>">Знаю</label>
        </div>
            <div class="form-check">
                <input name="HOTELI_BI_VI_<?= $arItem["ID"]?>" type="checkbox" class="form-check-input" id="HOTELI_BI_VI_<?= $arItem["ID"]?>">
                <label class="form-check-label" for="HOTELI_BI_VI_<?= $arItem["ID"]?>">Хочу работать</label>
            </div>
        <?endforeach;?>
        <button type="submit" class="btn btn-primary">Отправить</button>

    </form>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
