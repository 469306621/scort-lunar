<?php

require __DIR__ . "/../vendor/autoload.php";

use Scort\Lunar\Lunar;

// 农历转换类
$lunar = new Lunar();

// 今天日期
$date = date("Y-m-d");
$date = explode("-", $date);

// 1. 公历转农历
/**
 * 将公历转农历
 * 1891-02-09 ~ 2100-12-31
 *
 * 公历转农历，结果：
 *
 * status: 200
 * data:
 *  [0] 农历年
 *  [1] 农历月
 *  [2] 农历日
 *  [3] 天干地支
 *  [4] 农历月的数字
 *  [5] 农历日的数字
 *  [6] 生肖年
 *  [7] 闰几月
 *
 *
 * status: 非200
 * msg: 错误原因
 */
$todayLunar = $lunar->solarToLunar(...$date);
var_dump($todayLunar);


// 2. 农历转公历
$lunarYear = 1891;
$lunarMonth = 1;
$lunarDay = 1;
if ($todayLunar['status'] === 200) [$lunarYear, , , , $lunarMonth, $lunarDay] = $todayLunar['data'];
/**
 * 将农历转换为公历
 * 1891-1-1 ~ 2100-12-29
 *
 * @param $year :农历-年
 * @param $month :农历-月，闰月处理：例如如果当年闰五月，那么第二个五月就传六月，相当于农历有13个月
 * @param $date :农历-日
 */
var_dump($lunar->lunarToSolar($lunarYear, $lunarMonth, $lunarDay));