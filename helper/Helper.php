<?php

namespace app\helper;

use yii\helpers\Json;

class Helper
{
    public static function changeDateFormat($date)
    {

        if ($date) {
            $time = strtotime("$date");
            return date("d/m/Y H:i", $time);
        }
        return "-";
    }

    public static function formatPhoneThai($data){

        if(  preg_match( '/(\d{3})(\d{3})(\d{4})$/', $data,  $matches ) )
        {
            $result = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
            return $result;
        }
    }

    public static function formatBank($data){

        if(  preg_match( '/(\d{3})(\d{1})(\d{5})(\d{1})$/', $data,  $matches ) )
        {
            $result = $matches[1] . '-' .$matches[2] . '-' . $matches[3]. '-' . $matches[4];
            return $result;
        }
    }

    public static function changeDateFormatCat($date)
    {

        if ($date) {
            $time = strtotime("$date");
            return date("d/m/Y ", $time);
        }
        return "-";
    }

    public static function changeDate($date)
    {

        if ($date) {
            $keep = explode('/', $date);
            $aws = $keep[2] . "-" . $keep[1] . "-" . $keep[0];
            return $aws;

        }
        return "-";
    }





    public static function convertArrayDate($data)
    {
        $tem = $data;
        $arrayDate = [];

        foreach ($tem as $item) {
            $arrayDate[$item['year']][$item['month']][$item['day']] = ['cat_amount' => $item['cat_amount'], 'order_amount' => $item['order_amount'],'date' => self::changeDateFormatCat($item['date'])];
        }
        return $arrayDate;
    }

    public static function changeDateToDateThai($strDate)
    {
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }

}