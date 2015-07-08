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
App::uses('TimeHelper', 'View/Helper');

/**
 * Application-wide TimeHelper extension
 */
class AppTimeHelper extends TimeHelper
{

    public function timeAgoInWords($dateTime = null, $options = array())
    {     
        CakeTime::$wordFormat = AppLanguages::getDateFormat(DateFormats::WordFormat);
        if ($dateTime === null)
            return __('never');

        return parent::timeAgoInWords($dateTime, $options);
    }

    public function format($format, $date = null, $invalid = false, $timezone = null)
    {
        return parent::i18nFormat($date, $format, $invalid, $timezone);
        //return parent::format($format, $date, $invalid, $timezone);
    }

    public function nice($dateString = null, $timezone = null, $format = null)
    {
        return parent::i18nFormat($dateString,  AppLanguages::getDateFormat(DateFormats::Nice), false, $timezone);
        //return parent::nice($dateString, $timezone, $format);
    }

    public function niceShort($dateString = null, $timezone = null)
    {
        return parent::i18nFormat($dateString, AppLanguages::getDateFormat(DateFormats::NiceShort), false, $timezone);
        //return parent::niceShort($dateString, $timezone);
    }

    public function toAtom($dateString = null, $timezone = null)
    {
        return parent::toAtom($dateString, $timezone);
    }

    /**
     * Calculates the difference between two dates
     * @param type $start
     * @param type $end
     * @param type $verbose
     * @return type
     */
    public function dateDiffDays($start = null, $end = null, $verbose = true)
    {
        if ($start === null || $end === null)
            return __('N/A');

        $diff = ((strtotime($end) - strtotime($start)) / (60 * 60 * 24));
        if ($verbose)
            return String::insert(__n(':days day', ':days days', round($diff)), array('days' => round($diff)));
        else
            return round($diff);
    }

    /**
     * Calculates the difference to a given date from now
     * @param type $end
     * @param type $verbose
     * @return type
     */
    public function dateDiffDaysFromNow($end = null, $verbose = true)
    {
        if ($end === null)
            return __('N/A');

        $diff = ((strtotime($end) - time()) / DAY);
        if ($verbose)
            if (floor($diff) < 0)
                return String::insert(__n(':days day overdue', ':days days overdue', floor(abs($diff))), array('days' => floor(abs($diff))));
            else
                return String::insert(__n(':days day remaining', ':days days remaining', ceil($diff)), array('days' => ceil($diff)));
        else
            return floor($diff);
    }

    /**
     * Override for faulty CakePHP 2.2 check | TASK: Remove once sorted-out in core
     * @param type $dateString
     * @param type $timezone
     * @return type
     */
    public function isToday($dateString)
    {
        $date = self::fromString($dateString, 'UTC');
        return date('Y-m-d', $date) == date('Y-m-d', time());
    }

}