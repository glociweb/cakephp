<?php

/**
 * 
 * ClientEngage: ClientEngage Project Platform (http://www.clientengage.com)
 * Copyright 2012, ClientEngage (http://www.clientengage.com)
 *
 * You must have purchased a valid license from CodeCanyon in order to have 
 * the permission to use this file.
 * 
 * You may only use this file according to the respective licensing terms 
 * you agreed to when purchasing this item on CodeCanyon.
 * 
 * 
 * 
 *
 * @author          ClientEngage <contact@clientengage.com>
 * @copyright       Copyright 2012, ClientEngage (http://www.clientengage.com)
 * @link            http://www.clientengage.com ClientEngage
 * @since           ClientEngage - Project Platform v 1.0
 * 
 */
App::uses('HtmlHelper', 'View/Helper');

/**
 * Application-wide HtmlHelper extension
 */
class AppHtmlHelper extends HtmlHelper
{

    /**
     * Inserts the application's default meta tags
     */
    public function appMeta()
    {
        if (AppConfig::read('Misc.showpoweredby') || !empty($this->request->params['admin']))
            echo $this->meta(Router::url('/', true) . 'favicon.ico', Router::url('/', true) . 'favicon.ico?v=1', array('type' => 'icon'));
        echo $this->meta(array('name' => 'robots', 'content' => 'noindex, nofollow, noodp, nocache, noarchive, noydir'));
        echo $this->meta(array('name' => 'generator', 'content' => 'ClientEngage v' . (class_exists('AppVersion') ? AppVersion::Version : '')));
    }

    /**
     * Adapts colour intensities
     * @param string $hexColour The Hex Colour to be modified
     * @param double $percentageChange The percentage change in colour intensity
     * @return string Hex Colour
     */
    public function adaptColor($hexColour = null, $percentageChange = 0)
    {
        if ($hexColour === null || $percentageChange == 0)
            return $hexColour;

        $hexColour = substr($hexColour, 1);
        $rgbOut = '';
        $percentageChange = $percentageChange / 100 * 255;

        if ($percentageChange < 0)
        {
            $percentageChange = abs($percentageChange);
            for ($iX = 0; $iX < 3; $iX++)
            {
                $c = hexdec(substr($hexColour, (2 * $iX), 2)) - $percentageChange;
                $c = ($c < 0) ? 0 : dechex($c);
                $rgbOut .= (strlen($c) < 2) ? '0' . $c : $c;
            }
        } else
            for ($iX = 0; $iX < 3; $iX++)
            {
                $c = hexdec(substr($hexColour, (2 * $iX), 2)) + $percentageChange;
                $c = ($c > 255) ? 'ff' : dechex($c);
                $rgbOut .= (strlen($c) < 2) ? '0' . $c : $c;
            }

        return '#' . $rgbOut;
    }

}