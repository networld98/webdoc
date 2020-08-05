<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Клиники");
?>
<div class="full-screen__filter-bg">
	<section class="container">
		<? $APPLICATION->IncludeComponent(
            "bitrix:catalog.smart.filter",
            "horizontal",
            Array(
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => "horizontal",
                "CONVERT_CURRENCY" => "N",
                "DISPLAY_ELEMENT_COUNT" => "Y",
                "FILTER_NAME" => "arrFilter",
                "FILTER_VIEW_MODE" => "vertical",
                "HIDE_NOT_AVAILABLE" => "N",
                "IBLOCK_ID" => "10",
                "IBLOCK_TYPE" => "content",
                "PAGER_PARAMS_NAME" => "arrPager",
                "PREFILTER_NAME" => "smartPreFilter",
                "SAVE_IN_SESSION" => "N",
                "SECTION_CODE" => "",
                "SECTION_DESCRIPTION" => "-",
                "SECTION_ID" => $_REQUEST["SECTION_ID"],
                "SECTION_TITLE" => "-",
                "SEF_MODE" => "N",
                "TEMPLATE_THEME" => "blue",
                "XML_EXPORT" => "N"
            )
        );
	?>
	</section>
</div>

<section class="container clinic-card">
	<h2 class="title-h2">Оториноларингология (ЛОР) - (8)</h2>
	<div class="clinic-card-item">
		<div class="clinic-card-img">
			<div class="clinic-card-img__img">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/clinic1.svg" alt="">
			</div>
			<div class="clinic-card-img__ratings">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-none-filled.png" alt="">
			</div>
			<a class="clinic-card-img__link"href="">539 отзывов</a>	
		</div>
		<div class="clinic-card-desc">
			<p class="clinic-card-desc__clinic-name">Медицинский центр СМ-Клиника</p>
			<p class="clinic-card-desc__price">Первичная стоимость приёма - <span>средняя</span></p>
			<a class="clinic-card-desc__result-filter" href="">оториноларингология (ЛОР)</a>
			<p class="clinic-card-desc__about">Медицинский центр нового поколения, занимающийся амбулаторным приемом пациентов, а также стационарным обследованием и лечением. Центр проводит профилактические осмотры как в частном порядке, так и для служащих крупных организаций. В клинике проводят стационарное лечение и амбулаторный прием врачи высшей категории, кандидаты наук и профессора. Современная диагностическая аппаратура и большой выбор лабораторных исследований помогут врачу уточнить предполагаемый диагноз и провести качественное лечение.</p>
			<p class="clinic-card-desc__clinic-doctors-title">Врачи-специалисты</p>
			<ul class="clinic-card-desc__spec-list">
				<li><a href="">Невролог</a></li>
				<li><a href="">Онколог</a></li>
				<li><a href="">Оториноларинголог</a></li>
				<li><a href="">Офтальмолог</a></li>
				<li><a href="">Педиатр</a></li>
				<li><a href="">Психотерапевт</a></li>
				<li><a href="">Стоматолог</a></li>
				<li><a href="">Терапевт</a></li>
				<li><a href="">Уролог</a></li>
				<li><a href="">Массажист</a></li>
				<li><a href="">Мануальный терапевт</a></li>
				<li><a href="">Аллерголог</a></li>
				<li><a href="">Гастроэнтеролог</a></li>
			</ul>
			<div class="map-wrapper">
				<div class="doctor-card-location-map popup-link-marker"></div>
				<div class="popup-box">
					<div class="close">X</div>
					<div class="map-popup">
						<h1>hello route</h1>
                    	<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d64142.07179135312!2d30.1815235545136!3d59.84183691332836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x46963ae23261c667%3A0x79da031f42c21fd1!2z0J_RgNC-0YHQv9C10LrRgiDQktC10YLQtdGA0LDQvdC-0LIsINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCDQoNC-0YHRgdC40Y8sIDE5ODIxNw!3m2!1d59.841855599999995!2d30.2517344!5e0!3m2!1sru!2sua!4v1592323274629!5m2!1sru!2sua" width="100%" height="700" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
					<div class="map-popup-marker">
						<h1>hello marker</h1>
                    	<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d64142.07179135312!2d30.1815235545136!3d59.84183691332836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x46963ae23261c667%3A0x79da031f42c21fd1!2z0J_RgNC-0YHQv9C10LrRgiDQktC10YLQtdGA0LDQvdC-0LIsINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCDQoNC-0YHRgdC40Y8sIDE5ODIxNw!3m2!1d59.841855599999995!2d30.2517344!5e0!3m2!1sru!2sua!4v1592323274629!5m2!1sru!2sua" width="100%" height="700" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                	</div>
				</div>
            </div>
		</div>
		<div class="clinic-card-info">
			<div class="clinic-card-info__block">
				<p class="clinic-card-info__title map">Адрес</p>
				<span>Санкт-Петербург, проспект Ударников, 19, корп.1</span>
			</div>
			<div class="clinic-card-info__block">
				<p class="clinic-card-info__title contacts-phone">Контакты</p>
				<span><a href="tel:+7(812)243-1318">+7 (812) 243-1318</a></span>
				<span><a href="tel:+7(812)243-1318">+7 (812) 243-1318</a></span>
			</div>
			<div class="clinic-card-info__block">
				<p class="clinic-card-info__title time">Время работы</p>
				<span>пн.- сб. 09:00-22:00</span>
				<span>вс. 09:00-20:00</span>
			</div>
			<ul class="doctors-list-item_options-list">
				<li class="doctors-list-item_options-list-item">Выезд на дом</li>
				<li class="doctors-list-item_options-list-item">По полису ДМС</li>
			</ul>
			<div class="doctor-card-popUp-group">
				<a id="header-map" class="doctor-card-popUp-group__route popup-link">Проложить маршрут</a>
			</div>
		</div>
	</div>
	<div class="clinic-card-item">
		<div class="clinic-card-img">
			<div class="clinic-card-img__img">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/clinic2.svg" alt="">
			</div>
			<div class="clinic-card-img__ratings">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-none-filled.png" alt="">
			</div>
			<a class="clinic-card-img__link"href="">1539 отзывов</a>	
		</div>
		<div class="clinic-card-desc">
			<p class="clinic-card-desc__clinic-name">Медицинский центр Альфа Мед в Колпино</p>
			<p class="clinic-card-desc__price">Первичная стоимость приёма - <span>средняя</span></p>
			<a class="clinic-card-desc__result-filter" href="">оториноларингология (ЛОР)</a>
			<p class="clinic-card-desc__about">Более 17 лет «АльфаМед» оказывает квалифицированную помощь нашим пациентам! Наши центры расположены в разных районах Санкт-Петербурга (Невский район, Кировский, Фрунзенский, Приморский). Профессионалы высокого уровня, совершенное техническое оснащение клиник, умеренные цены и теплота нашего персонала заставляет наших пациентов возвращаться к нам снова! Нас рекомендуют своим друзьям! Постоянные сезонные скидки и акции позволяют сделать лечение в наших клиниках более приятным!</p>
			<p class="clinic-card-desc__clinic-doctors-title">Врачи-специалисты</p>
			<ul class="clinic-card-desc__spec-list">
				<li><a href="">Невролог</a></li>
				<li><a href="">Онколог</a></li>
				<li><a href="">Оториноларинголог</a></li>
				<li><a href="">Офтальмолог</a></li>
				<li><a href="">Педиатр</a></li>
				<li><a href="">Психотерапевт</a></li>
				<li><a href="">Стоматолог</a></li>
				<li><a href="">Терапевт</a></li>
				<li><a href="">Уролог</a></li>
				<li><a href="">Массажист</a></li>
				<li><a href="">Мануальный терапевт</a></li>
				<li><a href="">Аллерголог</a></li>
				<li><a href="">Гастроэнтеролог</a></li>
			</ul>
			<div class="map-wrapper">
				<div class="doctor-card-location-map popup-link-marker"></div>
				<div class="popup-box">
					<div class="close">X</div>
					<div class="map-popup">
						<h1>hello1 route</h1>
                    	<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d64142.07179135312!2d30.1815235545136!3d59.84183691332836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x46963ae23261c667%3A0x79da031f42c21fd1!2z0J_RgNC-0YHQv9C10LrRgiDQktC10YLQtdGA0LDQvdC-0LIsINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCDQoNC-0YHRgdC40Y8sIDE5ODIxNw!3m2!1d59.841855599999995!2d30.2517344!5e0!3m2!1sru!2sua!4v1592323274629!5m2!1sru!2sua" width="100%" height="700" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
					<div class="map-popup-marker">
						<h1>hello1 marker</h1>
                    	<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d64142.07179135312!2d30.1815235545136!3d59.84183691332836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x46963ae23261c667%3A0x79da031f42c21fd1!2z0J_RgNC-0YHQv9C10LrRgiDQktC10YLQtdGA0LDQvdC-0LIsINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCDQoNC-0YHRgdC40Y8sIDE5ODIxNw!3m2!1d59.841855599999995!2d30.2517344!5e0!3m2!1sru!2sua!4v1592323274629!5m2!1sru!2sua" width="100%" height="700" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                	</div>
				</div>
            </div>
		</div>
		<div class="clinic-card-info">
			<div class="clinic-card-info__block">
				<p class="clinic-card-info__title map">Адрес</p>
				<span>Санкт-Петербург, проспект Ударников, 19, корп.1</span>
			</div>
			<div class="clinic-card-info__block">
				<p class="clinic-card-info__title contacts-phone">Контакты</p>
				<span><a href="tel:+7(812)243-1318">+7 (812) 243-1318</a></span>
				<span><a href="tel:+7(812)243-1318">+7 (812) 243-1318</a></span>
			</div>
			<div class="clinic-card-info__block">
				<p class="clinic-card-info__title time">Время работы</p>
				<span>пн.- сб. 09:00-22:00</span>
				<span>вс. 09:00-20:00</span>
			</div>
			<ul class="doctors-list-item_options-list">
				<li class="doctors-list-item_options-list-item">Детский врач</li>
				<li class="doctors-list-item_options-list-item">По полису ДМС</li>
			</ul>
			<div class="doctor-card-popUp-group">
				<a id="header-map" class="doctor-card-popUp-group__route popup-link">Проложить маршрут</a>
			</div>
		</div>
	</div>
	<div class="clinic-card-item">
		<div class="clinic-card-img">
			<div class="clinic-card-img__img">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/clinic3.svg" alt="">
			</div>
			<div class="clinic-card-img__ratings">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-none-filled.png" alt="">
			</div>
			<a class="clinic-card-img__link"href="">1539 отзывов</a>	
		</div>
		<div class="clinic-card-desc">
			<p class="clinic-card-desc__clinic-name">Медицинский центр Первая семейная клиника Петербурга</p>
			<p class="clinic-card-desc__price">Первичная стоимость приёма - <span>средняя</span></p>
			<a class="clinic-card-desc__result-filter" href="">оториноларингология (ЛОР)</a>
			<p class="clinic-card-desc__about">«Первая Семейная Клиника Петербурга» начала свою работу летом 2011 года. Центр оснащен новейшим оборудованием, что дает возможность получить качественное обслуживание. Предоставляется широкий спектр медицинских услуг, в том числе выдача больничных листов и вызов врача на дом. Функционирует операционный блок и комфортабельная палата дневного стационара. В клинике широкий выбор программ обследования и лечения по разным направлениям.</p>
			<p class="clinic-card-desc__clinic-doctors-title">Врачи-специалисты</p>
			<ul class="clinic-card-desc__spec-list">
				<li><a href="">Невролог</a></li>
				<li><a href="">Онколог</a></li>
				<li><a href="">Оториноларинголог</a></li>
				<li><a href="">Офтальмолог</a></li>
				<li><a href="">Педиатр</a></li>
				<li><a href="">Психотерапевт</a></li>
				<li><a href="">Стоматолог</a></li>
				<li><a href="">Терапевт</a></li>
				<li><a href="">Уролог</a></li>
				<li><a href="">Массажист</a></li>
				<li><a href="">Мануальный терапевт</a></li>
				<li><a href="">Аллерголог</a></li>
				<li><a href="">Гастроэнтеролог</a></li>
			</ul>
            <div class="map-wrapper">
                <div class="doctor-card-location-map popup-link-marker"></div>
                <div class="popup-box">
					<div class="close">X</div>
					<div class="map-popup">
						<h1>hello2 route</h1>
                    	<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d64142.07179135312!2d30.1815235545136!3d59.84183691332836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x46963ae23261c667%3A0x79da031f42c21fd1!2z0J_RgNC-0YHQv9C10LrRgiDQktC10YLQtdGA0LDQvdC-0LIsINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCDQoNC-0YHRgdC40Y8sIDE5ODIxNw!3m2!1d59.841855599999995!2d30.2517344!5e0!3m2!1sru!2sua!4v1592323274629!5m2!1sru!2sua" width="100%" height="700" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
					<div class="map-popup-marker">
						<h1>hello2 marker</h1>
                    	<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d64142.07179135312!2d30.1815235545136!3d59.84183691332836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x46963ae23261c667%3A0x79da031f42c21fd1!2z0J_RgNC-0YHQv9C10LrRgiDQktC10YLQtdGA0LDQvdC-0LIsINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCDQoNC-0YHRgdC40Y8sIDE5ODIxNw!3m2!1d59.841855599999995!2d30.2517344!5e0!3m2!1sru!2sua!4v1592323274629!5m2!1sru!2sua" width="100%" height="700" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                	</div>
				</div>
            </div>

		</div>
		<div class="clinic-card-info">
			<div class="clinic-card-info__block">
				<p class="clinic-card-info__title map">Адрес</p>
				<span>Санкт-Петербург, проспект Ударников, 19, корп.1</span>
			</div>
			<div class="clinic-card-info__block">
				<p class="clinic-card-info__title contacts-phone">Контакты</p>
				<span><a href="tel:+7(812)243-1318">+7 (812) 243-1318</a></span>
				<span><a href="tel:+7(812)243-1318">+7 (812) 243-1318</a></span>
			</div>
			<div class="clinic-card-info__block">
				<p class="clinic-card-info__title time">Время работы</p>
				<span>пн.- сб. 09:00-22:00</span>
				<span>вс. 09:00-20:00</span>
			</div>
			<ul class="doctors-list-item_options-list">
			
				<li class="doctors-list-item_options-list-item">Детский врач</li>
				<li class="doctors-list-item_options-list-item">Выезд на дом</li>
				<li class="doctors-list-item_options-list-item">По полису ДМС</li>
			</ul>
			<div class="doctor-card-popUp-group">
				<a id="header-map" class="doctor-card-popUp-group__route popup-link">Проложить маршрут</a>
			</div>
		</div>
	</div>
	<div class="clinic-card-item">
		<div class="clinic-card-img">
			<div class="clinic-card-img__img">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/clinic3.svg" alt="">
			</div>
			<div class="clinic-card-img__ratings">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-filled.svg" alt="">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/ant-design_star-none-filled.png" alt="">
			</div>
			<a class="clinic-card-img__link"href="">1539 отзывов</a>	
		</div>
		<div class="clinic-card-desc-detail">
			<p class="clinic-card-desc__clinic-name">Медицинский центр Первая семейная клиника Петербурга</p>
			<p class="clinic-card-desc__price">Первичная стоимость приёма - <span>средняя</span></p>
			<a class="clinic-card-desc__result-filter" href="">оториноларингология (ЛОР)</a>
			<p class="clinic-card-desc__about">«Первая Семейная Клиника Петербурга» начала свою работу летом 2011 года. Центр оснащен новейшим оборудованием, что дает возможность получить качественное обслуживание. Предоставляется широкий спектр медицинских услуг, в том числе выдача больничных листов и вызов врача на дом. Функционирует операционный блок и комфортабельная палата дневного стационара. В клинике широкий выбор программ обследования и лечения по разным направлениям.</p>
			<!-- <p class="clinic-card-desc__clinic-doctors-title">Врачи-специалисты</p>
			<ul class="clinic-card-desc__spec-list">
				<li><a href="">Невролог</a></li>
				<li><a href="">Онколог</a></li>
				<li><a href="">Оториноларинголог</a></li>
				<li><a href="">Офтальмолог</a></li>
				<li><a href="">Педиатр</a></li>
				<li><a href="">Психотерапевт</a></li>
				<li><a href="">Стоматолог</a></li>
				<li><a href="">Терапевт</a></li>
				<li><a href="">Уролог</a></li>
				<li><a href="">Массажист</a></li>
				<li><a href="">Мануальный терапевт</a></li>
				<li><a href="">Аллерголог</a></li>
				<li><a href="">Гастроэнтеролог</a></li>
			</ul> -->
			<div class="clinic-card-info-detail">
				<div class="clinic-card-info-detail__block">
					<p class="clinic-card-info-detail__title map">Адрес</p>
					<span>Санкт-Петербург, проспект Ударников, 19, корп.1</span>
				</div>
				<div class="clinic-card-info-detail__block">
					<p class="clinic-card-info-detail__title contacts-phone">Контакты</p>
					<span><a href="tel:+7(812)243-1318">+7 (812) 243-1318</a></span>
					<span><a href="tel:+7(812)243-1318">+7 (812) 243-1318</a></span>
				</div>
				<div class="clinic-card-info-detail__block">
					<p class="clinic-card-info-detail__title time">Время работы</p>
					<span>пн.- сб. 09:00-22:00</span>
					<span>вс. 09:00-20:00</span>
				</div>
				<ul class="doctors-list-item_options-list">
					<li class="doctors-list-item_options-list-item">Детский врач</li>
					<li class="doctors-list-item_options-list-item">Выезд на дом</li>
					<li class="doctors-list-item_options-list-item">По полису ДМС</li>
				</ul>
			</div>
			<div class="doctor-card-popUp-group">
					<a id="header-map" class="doctor-card-popUp-group__route popup-link">Проложить маршрут</a>
			</div>
            <div class="map-wrapper">
                <div class="doctor-card-location-map popup-link-marker"></div>
                <div class="popup-box">
					<div class="close">X</div>
					<div class="map-popup">
						<h1>hello2 route</h1>
                    	<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d64142.07179135312!2d30.1815235545136!3d59.84183691332836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x46963ae23261c667%3A0x79da031f42c21fd1!2z0J_RgNC-0YHQv9C10LrRgiDQktC10YLQtdGA0LDQvdC-0LIsINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCDQoNC-0YHRgdC40Y8sIDE5ODIxNw!3m2!1d59.841855599999995!2d30.2517344!5e0!3m2!1sru!2sua!4v1592323274629!5m2!1sru!2sua" width="100%" height="700" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
					<div class="map-popup-marker">
						<h1>hello2 marker</h1>
                    	<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d64142.07179135312!2d30.1815235545136!3d59.84183691332836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x46963ae23261c667%3A0x79da031f42c21fd1!2z0J_RgNC-0YHQv9C10LrRgiDQktC10YLQtdGA0LDQvdC-0LIsINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCDQoNC-0YHRgdC40Y8sIDE5ODIxNw!3m2!1d59.841855599999995!2d30.2517344!5e0!3m2!1sru!2sua!4v1592323274629!5m2!1sru!2sua" width="100%" height="700" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                	</div>
				</div>
            </div>
		</div>
	</div>
	<div class="load_more">
				Показать ещё
			</div>
</section>

<section class="container doctors-lastfeedback">
	<h2 class="title-h2">Аллергологи - последние отзывы</h2>
	<div class="doctors-lastfeedback-list slick-slider1">
		<div class="doctors-lastfeedback-list-item">
			<div class="doctors-lastfeedback-list-item__doctor-info">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
				<div class="doctors-lastfeedback-list-item__doctor-info__content">
					<p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
					<p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
				</div>
			</div>
			<p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
			<p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
		</div>
		<div class="doctors-lastfeedback-list-item">
			<div class="doctors-lastfeedback-list-item__doctor-info">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
				<div class="doctors-lastfeedback-list-item__doctor-info__content">
					<p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
					<p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
				</div>
			</div>
			<p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
			<p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
		</div>
		<div class="doctors-lastfeedback-list-item">
			<div class="doctors-lastfeedback-list-item__doctor-info">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
				<div class="doctors-lastfeedback-list-item__doctor-info__content">
					<p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
					<p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
				</div>
			</div>
			<p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
			<p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
		</div>
		<div class="doctors-lastfeedback-list-item">
			<div class="doctors-lastfeedback-list-item__doctor-info">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
				<div class="doctors-lastfeedback-list-item__doctor-info__content">
					<p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
					<p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
				</div>
			</div>
			<p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
			<p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
		</div>
		<div class="doctors-lastfeedback-list-item">
			<div class="doctors-lastfeedback-list-item__doctor-info">
				<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/doctors-photo-small/kuznetsova.png" alt="photo" class="doctors-lastfeedback-list-item__doctor-info__photo">
				<div class="doctors-lastfeedback-list-item__doctor-info__content">
					<p class="doctors-lastfeedback-list-item__doctor-info__content__name">Кузнецова Светлана Владимировна</p>
					<p class="doctors-lastfeedback-list-item__doctor-info__content__counts">131 отзыв</p>
				</div>
			</div>
			<p class="doctors-lastfeedback-list-item__from">Ольга, 03 апреля 2020</p>
			<p class="doctors-lastfeedback-list-item__feedback">Очень хороший, внимательный и уверенный врач, который внушает доверие. Она осмотрела меня, изучила результаты анализов, назначила новые и дала рекомендации. Я пойду к доктору ещё.</p>
		</div>
	</div>
	



	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="clinic-card-full-desc">
    <div class="clinic-card-full-desc__tabs">
            <ul>
                <li class="active" data-tabs="1">Информация</li>
                <li data-tabs="2">Отзывы<span>168</span></li>
                <li data-tabs="3">Акции<span>6</span></li>
                <li data-tabs="4">Цены<span>172</span></li>
            </ul>
    </div>
    <div class="clinic-card-full-desc__content active" data-tabs="1">
        <div class="clinic-card-full-desc__content__info">
            <div class="clinic-card-full-desc__content__info-left">
                <div class="clinic-card-full-desc__content__info-left__map">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/content-map.png" alt="map">
                </div>
                <div class="clinic-card-full-desc__content__info-left__phone">
                    <span class="clinic-card-full-desc__content__info-left__phone__text">Телефон для записи</span>
                    <a href="tel:+8122456120">(812) 245-61-20</a>
                </div>
                <div class="clinic-card-full-desc__content__info-left__adress">
                    <span class="clinic-card-full-desc__content__info-left__adress__text">наб. Реки Карповки, д. 20</span>
                    <ul class="clinic-card__metro-list">
                        <li class="clinic-card_metro-list-item metro1">Петроградская (443 м)</li>
                        <li class="clinic-card_metro-list-item metro1">Чкаловская (1,2 км)</li>
                        <li class="clinic-card_metro-list-item metro1">Горьковская (1,6 км)</li>
                    </ul>
                </div>
                <div class="clinic-card-full-desc__content__info-left__name">
                    <span class="clinic-card-full-desc__content__info-left__name__text">Официальное название</span>
                    <p>ООО "ММЦ Медикал Он Груп - Санкт-Петербург Восток"</p>
                </div>
                <div class="clinic-card-full-desc__content__info-left__head">
                    <span class="clinic-card-full-desc__content__info-left__head__text">Руководитель</span>
                    <p>Шаповалова Марина Сергеевна</p>
                </div>
                <div class="clinic-card-full-desc__content__info-left__facilities">
                    <ul>
                        <li class="icon1">Гостевая парковка</li>
                        <li class="icon2">Наличные, банковская карта.</li>
                        <li class="icon3">Взрослые</li>
                        <li class="icon4">Официальный сайт</li>
                        <li class="icon5">Лицензия</li>
                    </ul>
                </div>
            </div>
            <div class="clinic-card-full-desc__content__info-right">
                <div class="clinic-card-full-desc__content__info-right__desc">
                    <h4 class="title-h4">Описание</h4>
                    <p>Клиника «Медикал Он Груп» на Карповке дислоцируется в муниципальном округе № 61 Аптекарский остров, на территории Петроградского района города Санкт-Петербурга. Это многопрофильное учреждение, которое занимается решением сложных вопросов, связанных с диагностикой, профилактикой и лечением широкого перечня заболеваний. Клиника была открыта в 1997 году.</p>
                    <p class="clinic-card-full-desc__content__info-right__desc-last">Материально-техническая база медицинского центра «Медикал Он Груп» на Карповке оснащена современными видами оборудования. Индивидуальный подход к каждому пациенту и комфортная атмосфера внутри учреждения помогают пациентам настроиться на выздоровление. Лицензия на медицинскую деятельность была выдана компании 19 ноября 2019 года.</p>
                </div>
                <div class="clinic-card-full-desc__content__info-right__services">
                    <h4 class="title-h4">Услуги</h4>
                    <p>Организацией «Медикал Он Груп» на Карповке услуги оказываются по таким амбулаторно-поликлиническим направлениям, как аллергология-иммунология, хирургия, неврология, ортопедия, оториноларингология, гастроэнтерология, гинекология, дерматология, диетология, кардиология, маммологии, мануальная терапия, проктология, психотерапия, ревматология и терапия. Здесь осуществляется эндоскопия, проводится УЗИ и выполняется забор анализов. На базе клиники функционируют кабинеты физиотерапии и косметологии.</p>
                </div>
                <div class="clinic-card-full-desc__content__info-right__parking">
                    <h4 class="title-h4">Парковка</h4>
                    <p>Осуществлять проезд к компании «Медикал Он Груп» на Карповке удобнее всего будет на метро, которое ходит по Второй линии. Двигаться нужно до станции «Петроградская». Покинув метрополитен, необходимо выйти на Каменноостровский проспект и проследовать по нему до пересечения с набережной Реки Карповки. Повернув налево, необходимо держать путь к зданию № 20.</p>
                </div>
                <div class="clinic-card-full-desc__content__info-right__transit">
                    <h4 class="title-h4">Проезд</h4>
                    <p>Закрытой парковки для посетителей нет. Припарковать автомобиль возможно бесплатно в любом месте Набережной реки Карповки, или непосредственно у клиники. Ближайшая наземная общедоступная организованная парковка на 18 машиномест находится на Набережной реки Карповки у парка Профессора Попова, в 360 метрах от клиники (въезд с Набережной реки Карповки). Круглосуточная платная парковка расположена ​в 500 метрах от клиники на Каменноостровском проспекте, 40 к2, рядом с метро Петроградская</p>
                </div>
            </div>
		</div>
	</div>
	<div class="clinic-card-full-desc__content"  data-tabs="3">
		<div class="clinic-card-full-desc__content__actions">
			<h4 class="title-h4">Акции</h4>
			<div class="clinic-card-full-desc__content__actions-item">
				<p class="clinic-card-full-desc__content__actions-item__title">Акция «Головной боли - нет»</p>
				<div class="clinic-card-full-desc__content__actions-item-range-block">
					<span class="clinic-card-full-desc__content__actions-item-range-block__range">15.06.2020 — 30.06.2020</span>
					<p class="clinic-card-full-desc__content__actions-item-range-block__time">Заканчивается сегодня</p>
				</div>
				<div class="clinic-card-full-desc__content__actions-item__desc">
					<p class="clinic-card-full-desc__content__actions-item__desc__title">В комплексное обследование входит:</p>
					<ul>
						<li>первичный прием врача-невролога,</li>
						<li>дуплексное сканирование сосудов головы и шеи,</li>
						<li>подбор лекарственных средств.</li>
					</ul>
					<p class="clinic-card-full-desc__content__actions-item__desc__price">Цена без скидки: <span>4 920 руб.</span></p>
					<p class="clinic-card-full-desc__content__actions-item__desc__price">Цена со скидкой: <span>3 850 руб.</span></p>
				</div>
				<div class="clinic-card-full-desc__content__actions-item__phone">
					<span class="clinic-card-full-desc__content__actions-item__phone__text">Телефон для записи</span>
					<a href="tel:+812245-61-20">(812) 245-61-20</a>
				</div>
			</div>
			<hr/>
			<div class="clinic-card-full-desc__content__actions-item">
				<p class="clinic-card-full-desc__content__actions-item__title">Акция «Головной боли - нет»</p>
				<div class="clinic-card-full-desc__content__actions-item-range-block">
					<span class="clinic-card-full-desc__content__actions-item-range-block__range">15.06.2020 — 30.06.2020</span>
					<p class="clinic-card-full-desc__content__actions-item-range-block__time">Заканчивается сегодня</p>
				</div>
				<div class="clinic-card-full-desc__content__actions-item__desc">
					<p class="clinic-card-full-desc__content__actions-item__desc__title">В комплексное обследование входит:</p>
					<ul>
						<li>первичный прием врача-невролога,</li>
						<li>дуплексное сканирование сосудов головы и шеи,</li>
						<li>подбор лекарственных средств.</li>
					</ul>
					<p class="clinic-card-full-desc__content__actions-item__desc__price">Цена без скидки: <span>4 920 руб.</span></p>
					<p class="clinic-card-full-desc__content__actions-item__desc__price">Цена со скидкой: <span>3 850 руб.</span></p>
				</div>
				<div class="clinic-card-full-desc__content__actions-item__phone">
					<span class="clinic-card-full-desc__content__actions-item__phone__text">Телефон для записи</span>
					<a href="tel:+812245-61-20">(812) 245-61-20</a>
				</div>
			</div>
			<hr/>
			<div class="clinic-card-full-desc__content__actions-item">
				<p class="clinic-card-full-desc__content__actions-item__title">Акция «Головной боли - нет»</p>
				<div class="clinic-card-full-desc__content__actions-item-range-block">
					<span class="clinic-card-full-desc__content__actions-item-range-block__range">15.06.2020 — 30.06.2020</span>
					<p class="clinic-card-full-desc__content__actions-item-range-block__time">Заканчивается сегодня</p>
				</div>
				<div class="clinic-card-full-desc__content__actions-item__desc">
					<p class="clinic-card-full-desc__content__actions-item__desc__title">В комплексное обследование входит:</p>
					<ul>
						<li>первичный прием врача-невролога,</li>
						<li>дуплексное сканирование сосудов головы и шеи,</li>
						<li>подбор лекарственных средств.</li>
					</ul>
					<p class="clinic-card-full-desc__content__actions-item__desc__price">Цена без скидки: <span>4 920 руб.</span></p>
					<p class="clinic-card-full-desc__content__actions-item__desc__price">Цена со скидкой: <span>3 850 руб.</span></p>
				</div>
				<div class="clinic-card-full-desc__content__actions-item__phone">
					<span class="clinic-card-full-desc__content__actions-item__phone__text">Телефон для записи</span>
					<a href="tel:+812245-61-20">(812) 245-61-20</a>
				</div>
			</div>
			<div class="load_more">
				Показать ещё
			</div>
		</div>
	</div>
	<div class="clinic-card-full-desc__content" data-tabs="4">
		<div class="clinic-card-full-desc__content__price">
			<h4 class="title-h4">Цены на приём специалистов</h4>
			<div class="clinic-card-full-desc__content__price-item">
				<table>
					<thead>
						<tr>
							<td>УЗИ брюшной полости</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>УЗИ брюшной полости</td>
							<td class="clinic-card-full-desc__content__price-item__price">2 000 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
						<tr>
							<td>УЗИ печени</td>
							<td class="clinic-card-full-desc__content__price-item__price">700 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
						<tr>
							<td>УЗИ желчного пузыря</td>
							<td class="clinic-card-full-desc__content__price-item__price">от 7000 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
						<tr>
							<td>УЗИ желчного пузыря</td>
							<td class="clinic-card-full-desc__content__price-item__price">от 700 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
						<tr>
							<td>УЗИ желчного пузыря с определением функции</td>
							<td class="clinic-card-full-desc__content__price-item__price">от 1 500 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
					</tbody>
				</table>
			</div>
			<hr/>
			<div class="clinic-card-full-desc__content__price-item">
				<table>
					<thead>
						<tr>
							<td>УЗИ брюшной полости</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>УЗИ брюшной полости</td>
							<td class="clinic-card-full-desc__content__price-item__price">2 000 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
						<tr>
							<td>УЗИ печени</td>
							<td class="clinic-card-full-desc__content__price-item__price">700 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
						<tr>
							<td>УЗИ желчного пузыря</td>
							<td class="clinic-card-full-desc__content__price-item__price">от 7000 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
						<tr>
							<td>УЗИ желчного пузыря</td>
							<td class="clinic-card-full-desc__content__price-item__price">от 700 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
						<tr>
							<td>УЗИ желчного пузыря с определением функции</td>
							<td class="clinic-card-full-desc__content__price-item__price">от 1 500 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
					</tbody>
				</table>
			</div>
			<hr/>
			<div class="clinic-card-full-desc__content__price-item">
				<table>
					<thead>
						<tr>
							<td>УЗИ брюшной полости</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>УЗИ брюшной полости</td>
							<td class="clinic-card-full-desc__content__price-item__price">2 000 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
						<tr>
							<td>УЗИ печени</td>
							<td class="clinic-card-full-desc__content__price-item__price">700 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
						<tr>
							<td>УЗИ желчного пузыря</td>
							<td class="clinic-card-full-desc__content__price-item__price">от 7000 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
						<tr>
							<td>УЗИ желчного пузыря</td>
							<td class="clinic-card-full-desc__content__price-item__price">от 700 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
						<tr>
							<td>УЗИ желчного пузыря с определением функции</td>
							<td class="clinic-card-full-desc__content__price-item__price">от 1 500 ₽</td>
							<td><button>Запись на услугу</button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="clinic-card-full-desc__content" data-tabs="2">
		<div class="clinic-card-full-desc__content__feedback">
			<h4 class="title-h4">Отзывы о клинике</h4>
			<h4 class="title-h4 clinic-name">«Медикал Он Груп» на Карповке</h4>
			<div class="clinic-card-full-desc__content__feedback__radio-group">
				<ul>
					<li>
						<label class="container-check">Все
							<input type="radio" name="radio">
							<span class="checkmark"></span>
						</label>
						<span class="count white">162</span>
					</li>
					<li>
						<label class="container-check">Положительные
							<input type="radio" name="radio">
							<span class="checkmark"></span>
						</label>
						<span class="count green">162</span>
					</li>
					<li>
						<label class="container-check">Нейтральные
							<input type="radio" name="radio">
							<span class="checkmark"></span>
						</label>
						<span class="count orange">12</span>
					</li>
					<li>
						<label class="container-check">Отрицательные
							<input type="radio" name="radio">
							<span class="checkmark"></span>
						</label>
						<span class="count pink">5</span>
					</li>
				</ul>
			</div>
			<div class="clinic-card-full-desc__content__feedback-item">
					<div class="clinic-card-full-desc__content__feedback-item-left">
						<p class="clinic-card-full-desc__content__feedback-item-left__name">Михалкова Виктория Валерьевна</p>
						<div class="clinic-card-full-desc__content__feedback-item-left__mark green">
							<span class="count">5+</span>
							<span class="text">отлично</span>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-left__visit">
							<span class="clinic-card-full-desc__content__feedback-item-left__visit__text">Посетили врача</span>
							<span class="clinic-card-full-desc__content__feedback-item-left__visit__date">Апрель 2020</span>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-left__from">
							<span class="clinic-card-full-desc__content__feedback-item-left__from__text">Отзыв оставлен через</span>
							<span class="clinic-card-full-desc__content__feedback-item-left__from__source">Сайт</span>
						</div>
					</div>
					<div class="clinic-card-full-desc__content__feedback-item-right">
						<div class="clinic-card-full-desc__content__feedback-item-right__liked">
							<span>Понравилось</span>
							<p>Да, все понравилось. Принимал и оперировал врач Хабибуллин Михаил Анатольевич. Один из лучших докторов, с которыми приходилось иметь дело: такт, вежливость, глубокие знания и опыт. Главное, все, что он прогнозировал, сбылось в точности. Ждать не пришлось, никаких очередей, если приходишь к времени. Короче, клиника и хирург - "Европа класс А".</p>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-right__disliked">
							<span>Не понравилось</span>
							<p>На мой взгляд, дороговато.</p>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-right__comment">
							<span>Комментарий</span>
							<p>Все было сделано, как обещано. Операция была безболезненной и длилась ровно 10 минут. Час отдыха - и домой на амбулаторное долечивание</p>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-right__doctor">
							<span>Лечащий врач:</span>
							<a href="#">Литвинова А. Н.</a>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-right__reply">
							<span class="clinic-card-full-desc__content__feedback-item-right__reply__clinic">«Медикал Он Груп» на Карповке</span>
							<span class="clinic-card-full-desc__content__feedback-item-right__reply__date-time">30 июня 20 в 10:00</span>
							<p>Добрый день! Большое спасибо за высокую оценку нашей работы! Мы будем и дальше стараться сделать все возможное для комфорта наших пациентов. Желаем Вам крепкого здоровья и благополучия! С уважением, ММЦ «Медикал Он Груп -Санкт-Петербург»</p>
						</div>
					</div>
			</div>
			<div class="clinic-card-full-desc__content__feedback-item">
					<div class="clinic-card-full-desc__content__feedback-item-left">
						<p class="clinic-card-full-desc__content__feedback-item-left__name">Михалкова Виктория Валерьевна</p>
						<div class="clinic-card-full-desc__content__feedback-item-left__mark pink">
							<span class="count">-0</span>
							<span class="text">ужасно</span>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-left__visit">
							<span class="clinic-card-full-desc__content__feedback-item-left__visit__text">Посетили врача</span>
							<span class="clinic-card-full-desc__content__feedback-item-left__visit__date">Апрель 2020</span>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-left__from">
							<span class="clinic-card-full-desc__content__feedback-item-left__from__text">Отзыв оставлен через</span>
							<span class="clinic-card-full-desc__content__feedback-item-left__from__source">Сайт</span>
						</div>
					</div>
					<div class="clinic-card-full-desc__content__feedback-item-right">
						<div class="clinic-card-full-desc__content__feedback-item-right__liked">
							<span>Понравилось</span>
							<p>Да, все понравилось. Принимал и оперировал врач Хабибуллин Михаил Анатольевич. Один из лучших докторов, с которыми приходилось иметь дело: такт, вежливость, глубокие знания и опыт. Главное, все, что он прогнозировал, сбылось в точности. Ждать не пришлось, никаких очередей, если приходишь к времени. Короче, клиника и хирург - "Европа класс А".</p>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-right__disliked">
							<span>Не понравилось</span>
							<p>На мой взгляд, дороговато.</p>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-right__comment">
							<span>Комментарий</span>
							<p>Все было сделано, как обещано. Операция была безболезненной и длилась ровно 10 минут. Час отдыха - и домой на амбулаторное долечивание</p>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-right__doctor">
							<span>Лечащий врач:</span>
							<a href="#">Литвинова А. Н.</a>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-right__reply">
							<span class="clinic-card-full-desc__content__feedback-item-right__reply__clinic">«Медикал Он Груп» на Карповке</span>
							<span class="clinic-card-full-desc__content__feedback-item-right__reply__date-time">30 июня 20 в 10:00</span>
							<p>Добрый день! Большое спасибо за высокую оценку нашей работы! Мы будем и дальше стараться сделать все возможное для комфорта наших пациентов. Желаем Вам крепкого здоровья и благополучия! С уважением, ММЦ «Медикал Он Груп -Санкт-Петербург»</p>
						</div>
					</div>
			</div>
			<div class="clinic-card-full-desc__content__feedback-item">
					<div class="clinic-card-full-desc__content__feedback-item-left">
						<p class="clinic-card-full-desc__content__feedback-item-left__name">Михалкова Виктория Валерьевна</p>
						<div class="clinic-card-full-desc__content__feedback-item-left__mark orange">
							<span class="count">4</span>
							<span class="text">нормально</span>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-left__visit">
							<span class="clinic-card-full-desc__content__feedback-item-left__visit__text">Посетили врача</span>
							<span class="clinic-card-full-desc__content__feedback-item-left__visit__date">Апрель 2020</span>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-left__from">
							<span class="clinic-card-full-desc__content__feedback-item-left__from__text">Отзыв оставлен через</span>
							<span class="clinic-card-full-desc__content__feedback-item-left__from__source">Сайт</span>
						</div>
					</div>
					<div class="clinic-card-full-desc__content__feedback-item-right">
						<div class="clinic-card-full-desc__content__feedback-item-right__liked">
							<span>Понравилось</span>
							<p>Да, все понравилось. Принимал и оперировал врач Хабибуллин Михаил Анатольевич. Один из лучших докторов, с которыми приходилось иметь дело: такт, вежливость, глубокие знания и опыт. Главное, все, что он прогнозировал, сбылось в точности. Ждать не пришлось, никаких очередей, если приходишь к времени. Короче, клиника и хирург - "Европа класс А".</p>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-right__disliked">
							<span>Не понравилось</span>
							<p>На мой взгляд, дороговато.</p>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-right__comment">
							<span>Комментарий</span>
							<p>Все было сделано, как обещано. Операция была безболезненной и длилась ровно 10 минут. Час отдыха - и домой на амбулаторное долечивание</p>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-right__doctor">
							<span>Лечащий врач:</span>
							<a href="#">Литвинова А. Н.</a>
						</div>
						<div class="clinic-card-full-desc__content__feedback-item-right__reply">
							<span class="clinic-card-full-desc__content__feedback-item-right__reply__clinic">«Медикал Он Груп» на Карповке</span>
							<span class="clinic-card-full-desc__content__feedback-item-right__reply__date-time">30 июня 20 в 10:00</span>
							<p>Добрый день! Большое спасибо за высокую оценку нашей работы! Мы будем и дальше стараться сделать все возможное для комфорта наших пациентов. Желаем Вам крепкого здоровья и благополучия! С уважением, ММЦ «Медикал Он Груп -Санкт-Петербург»</p>
						</div>
					</div>
			</div>
			<div class="load_more">
				Показать еще отзывы
			</div>
		</div>
	</div>
</div>

</section>

<section class="container specializations">
	<ul class="nav nav-pills" id="pills-tab" role="tablist">
		<li class="nav-item"><a class="nav-link active" id="pills-home-tab" data-toggle="pill"
								href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Специализации
				врачей</a></li>
		<li class="nav-item"><a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
								role="tab" aria-controls="pills-profile" aria-selected="false">Специализации
				клиник</a></li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
			<div class="row">
				<div class="col">
					<div class="col__heading">
						А
					</div>
					<ul class="col__list">
						<li class="col__item"><a href="#">Акушер</a></li>
						<li class="col__item"><a href="#">Аллерголог</a></li>
						<li class="col__item"><a href="#">Андролог</a></li>
						<li class="col__item"><a href="#">Анестезиолог</a></li>
						<li class="col__item"><a href="#">Аритмолог</a></li>
						<li class="col__item"><a href="#">Артролог</a></li>
					</ul>
				</div>
				<div class="col">
					<div class="col__heading">
						А
					</div>
					<ul class="col__list">
						<li class="col__item"><a href="#">Акушер</a></li>
						<li class="col__item"><a href="#">Аллерголог</a></li>
						<li class="col__item"><a href="#">Андролог</a></li>
						<li class="col__item"><a href="#">Анестезиолог</a></li>
						<li class="col__item"><a href="#">Аритмолог</a></li>
						<li class="col__item"><a href="#">Артролог</a></li>
					</ul>
				</div>
				<div class="col">
					<div class="col__heading">
						А
					</div>
					<ul class="col__list">
						<li class="col__item"><a href="#">Акушер</a></li>
						<li class="col__item"><a href="#">Аллерголог</a></li>
						<li class="col__item"><a href="#">Андролог</a></li>
						<li class="col__item"><a href="#">Анестезиолог</a></li>
						<li class="col__item"><a href="#">Аритмолог</a></li>
						<li class="col__item"><a href="#">Артролог</a></li>
					</ul>
				</div>
				<div class="col">
					<div class="col__heading">
						А
					</div>
					<ul class="col__list">
						<li class="col__item"><a href="#">Акушер</a></li>
						<li class="col__item"><a href="#">Аллерголог</a></li>
						<li class="col__item"><a href="#">Андролог</a></li>
						<li class="col__item"><a href="#">Анестезиолог</a></li>
						<li class="col__item"><a href="#">Аритмолог</a></li>
						<li class="col__item"><a href="#">Артролог</a></li>
					</ul>
				</div>
				<div class="col">
					<div class="col__heading">
						А
					</div>
					<ul class="col__list">
						<li class="col__item"><a href="#">Акушер</a></li>
						<li class="col__item"><a href="#">Аллерголог</a></li>
						<li class="col__item"><a href="#">Андролог</a></li>
						<li class="col__item"><a href="#">Анестезиолог</a></li>
						<li class="col__item"><a href="#">Аритмолог</a></li>
						<li class="col__item"><a href="#">Артролог</a></li>
					</ul>
				</div>
				<div class="col">
					<div class="col__heading">
						А
					</div>
					<ul class="col__list">
						<li class="col__item"><a href="#">Акушер</a></li>
						<li class="col__item"><a href="#">Аллерголог</a></li>
						<li class="col__item"><a href="#">Андролог</a></li>
						<li class="col__item"><a href="#">Анестезиолог</a></li>
						<li class="col__item"><a href="#">Аритмолог</a></li>
						<li class="col__item"><a href="#">Артролог</a></li>
					</ul>
				</div>
			</div>
			<div class="load_more">
				Показать ещё
			</div>
			<div class="specializations__list expand">
				<div class="row">
					<div class="col">
						<div class="col__heading">
							А
						</div>
						<ul class="col__list">
							<li class="col__item"><a href="#">Акушер</a></li>
							<li class="col__item"><a href="#">Аллерголог</a></li>
							<li class="col__item"><a href="#">Андролог</a></li>
							<li class="col__item"><a href="#">Анестезиолог</a></li>
							<li class="col__item"><a href="#">Аритмолог</a></li>
							<li class="col__item"><a href="#">Артролог</a></li>
						</ul>
					</div>
					<div class="col">
						<div class="col__heading">
							А
						</div>
						<ul class="col__list">
							<li class="col__item"><a href="#">Акушер</a></li>
							<li class="col__item"><a href="#">Аллерголог</a></li>
							<li class="col__item"><a href="#">Андролог</a></li>
							<li class="col__item"><a href="#">Анестезиолог</a></li>
							<li class="col__item"><a href="#">Аритмолог</a></li>
							<li class="col__item"><a href="#">Артролог</a></li>
						</ul>
					</div>
					<div class="col">
						<div class="col__heading">
							А
						</div>
						<ul class="col__list">
							<li class="col__item"><a href="#">Акушер</a></li>
							<li class="col__item"><a href="#">Аллерголог</a></li>
							<li class="col__item"><a href="#">Андролог</a></li>
							<li class="col__item"><a href="#">Анестезиолог</a></li>
							<li class="col__item"><a href="#">Аритмолог</a></li>
							<li class="col__item"><a href="#">Артролог</a></li>
						</ul>
					</div>
					<div class="col">
						<div class="col__heading">
							А
						</div>
						<ul class="col__list">
							<li class="col__item"><a href="#">Акушер</a></li>
							<li class="col__item"><a href="#">Аллерголог</a></li>
							<li class="col__item"><a href="#">Андролог</a></li>
							<li class="col__item"><a href="#">Анестезиолог</a></li>
							<li class="col__item"><a href="#">Аритмолог</a></li>
							<li class="col__item"><a href="#">Артролог</a></li>
						</ul>
					</div>
					<div class="col">
						<div class="col__heading">
							А
						</div>
						<ul class="col__list">
							<li class="col__item"><a href="#">Акушер</a></li>
							<li class="col__item"><a href="#">Аллерголог</a></li>
							<li class="col__item"><a href="#">Андролог</a></li>
							<li class="col__item"><a href="#">Анестезиолог</a></li>
							<li class="col__item"><a href="#">Аритмолог</a></li>
							<li class="col__item"><a href="#">Артролог</a></li>
						</ul>
					</div>
					<div class="col">
						<div class="col__heading">
							А
						</div>
						<ul class="col__list">
							<li class="col__item"><a href="#">Акушер</a></li>
							<li class="col__item"><a href="#">Аллерголог</a></li>
							<li class="col__item"><a href="#">Андролог</a></li>
							<li class="col__item"><a href="#">Анестезиолог</a></li>
							<li class="col__item"><a href="#">Аритмолог</a></li>
							<li class="col__item"><a href="#">Артролог</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			<div>
				2
			</div>
			<div class="load_more">
				Показать ещё
			</div>
			<div class="specializations__list expand">
				hide
			</div>
		</div>
	</div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>