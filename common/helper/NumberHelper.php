<?php
namespace common\helper;

class NumberHelper {

    public static function percent($molecule, $denominator, $decimal = 1)
    {
        if($denominator == 0)
        {
            return number_format(0, $decimal);
        }

        return round($molecule / $denominator * 100, $decimal);
    }

    public static function division($molecule, $denominator, $decimal = 1)
    {
        return round(self::percent($molecule, $denominator, $decimal) / 100, $decimal);
    }

    /**
     *      把秒数转换为时分秒的格式
     *      @param Int $times 时间，单位 秒
     *      @return String
     */
    function secToTime($times){
        $result = '00:00';
        if($times < 60)
        {
            $result = '00:'.str_pad($times, 2, '0',STR_PAD_LEFT);
        }
        elseif ($times < 3600)
        {
            $minute = floor($times/60);
            $second = floor(($times - 60 * $minute) % 60);
            $result = str_pad($minute, 2, '0',STR_PAD_LEFT).':'.str_pad($second, 2, '0',STR_PAD_LEFT);
        }
        else
        {
            $hour = floor($times/3600);
            $minute = floor(($times-3600 * $hour)/60);
            $second = floor((($times-3600 * $hour) - 60 * $minute) % 60);
            $result = $hour.':'.str_pad($minute, 2, '0',STR_PAD_LEFT).':'.str_pad($second, 2, '0',STR_PAD_LEFT);
        }
        return $result;
    }

    /**
     * 求两个已知经纬度之间的距离,单位为米
     *
     * @param lng1 $ ,lng2 经度
     * @param lat1 $ ,lat2 纬度
     * @return float 距离，单位米
     * @author www.Alixixi.com
     */
    function getdistance($lng1, $lat1, $lng2, $lat2) {
        // 将角度转为狐度
        $radLat1 = deg2rad($lat1); //deg2rad()函数将角度转换为弧度
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137 * 1000;
        return $s;
    }
}
?>