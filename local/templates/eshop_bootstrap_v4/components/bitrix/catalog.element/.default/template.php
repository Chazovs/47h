<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

/*echo "<pre>";
print_r($arResult['PROPERTIES']['SLISHAL']['VALUE']);
echo "</pre>";*/
?>


    <div class="py-5 text-center">
            Слышало: <?=$arResult['PROPERTIES']['SLISHAL']['VALUE']?>
            Хочет работать: <?=$arResult['PROPERTIES']['HOTELI_BI_VI']['VALUE']?>
    </div>

<h3>Вакансии</h3>
    <div class="jumbotron">
        <h2>middle PHP-developer</h2>
        <p class="lead">Мы выпустили новый продукт: <a href="">REST API для телефонии</a>. Ваша задача найти идеи ( и желательно реализовать их на уроне прототипа (без дийзайна и т.д.)) о том, как можно использовать этот инструмент в бизнесе</p>
        <a class="btn btn-lg btn-primary" href="/cases/1/" role="button">Подробнее »</a>
    </div>

<?
unset($actualItem, $itemIds, $jsParams);
