<?php

class View {
    /**
     * @desc 
     * @param <String> content_view - Шаблон для каждой страницы
     * @param <String> template_view - Главный Шаблон
     * @param <Array> param - Настройки для страницы
     * @param <Array> data - Информация(lang)
     * @param <Array> i18n - Локализация на сайте
     *
     */
	public function generate($content_view, $template_view, $param, $data = null, $i18n = null) {
                $param['is_auth'] = (isset($_SESSION['user_id'])) ? true : false;
        if(!$template_view) {  
            if($content_view) {
                include 'application/views/'.$content_view;
            }
        } else {
            include 'application/views/'.$template_view;	
        }
	}

}
