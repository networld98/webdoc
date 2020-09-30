<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
?>
<section class="container page-404">
	<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/404.svg" alt="404-pic">
	<span class="page-404__accent-text">ошибка</span>
	<p class="page-404__desc">Кажеться что-то пошло не так!</br> Страница, которую вы запрашиваете, не существует. Возможно она устарела, была удалена, или был введён неверный в адресной строке</p>
	<a href="/" class="page-404__toHome">Перейти на главную</a>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>