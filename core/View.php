<?php


class View
{

    function render($content_view, $template_view, $data = null){


        include 'views/' . $template_view;
    }


}