[中国农历组件]
本组件提供了中国（1891年 - 2100年）的公历与农历互转功能，遵循PSR-4：
 - [公历转农历，公历范围(1891-02-09 ~ 2100-12-31)](#1-公历转农历公历范围1891-02-09--2100-12-31)
 - [农历转公历，农历范围(1891-1-1 ~ 2100-12-29)](#2-农历转公历农历范围1891-1-1--2100-12-29)
 - 其它功能陆续集成中

### 示例：
```php

require __DIR__ . "/../vendor/autoload.php";

use Scort\Lunar\Lunar;

// 农历转换类
$lunar = new Lunar();
```

### 1. 公历转农历，公历范围(1891-02-09 ~ 2100-12-31)
```php
/**
 * 公历转农历，公历范围(1891-02-09 ~ 2100-12-31)
 */
 
// 指定日期
$date = date("Y-m-d");
$date = explode("-", $date);

// 转换
$todayLunar = $lunar->solarToLunar(...$date);
var_dump($todayLunar);
```
结果：
```
array(2) {
  ["status"]=> int(200)
  ["data"]=> array(8) {
    [0]=> int(2024)
    [1]=> string(6) "六月"
    [2]=> string(6) "十五"
    [3]=> string(6) "甲辰"
    [4]=> int(6)
    [5]=> int(15)
    [6]=> string(3) "龙"
    [7]=> int(0)
  }
}

 当status是200时，就有data结果，索引结果解释如下：
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
 
 当status非200时，没有data，只有msg来描述错误信息
 * status: 非200
 * msg: 错误原因
```

### 2. 农历转公历，农历范围(1891-1-1 ~ 2100-12-29)
```php
/**
 * 将农历转换为公历，农历范围(1891-1-1 ~ 2100-12-29)
 *
 * @param $year :农历-年
 * @param $month :农历-月，闰月处理：例如如果当年闰五月，那么第二个五月就传六月，相当于农历有13个月
 * @param $date :农历-日
 */
$lunarYear = 1891;
$lunarMonth = 1;
$lunarDay = 1;
if ($todayLunar['status'] === 200) [$lunarYear, , , , $lunarMonth, $lunarDay] = $todayLunar['data'];
var_dump($lunar->lunarToSolar($todayLunar[0], $todayLunar[4], $todayLunar[5]));
```

结果：
```
array(2) {
  ["status"]=> int(200)
  ["date"]=> array(3) {
    [0]=> string(4) "2024"
    [1]=> string(2) "07"
    [2]=> string(2) "20"
  }
}

 当status是200时，就有data结果，索引结果解释如下：
 * status: 200
 * data: 
 *  [0] 公历年
 *  [1] 公历月
 *  [2] 公历日
 
 当status非200时，没有data，只有msg来描述错误信息
 * status: 非200
 * msg: 错误原因
```