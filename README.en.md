# Chinese Lunar Calendar Component

#### [中文版 ReadMe](README.md) | [English ReadMe](README.en.md)

This component provides functionality for converting between the Gregorian and Lunar calendars in China (from 1891 to 2100), following PSR-4:

- [Gregorian to Lunar, Gregorian range (1891-02-09 ~ 2100-12-31)](#1-gregorian-to-lunar-gregorian-range-1891-02-09--2100-12-31)
- [Lunar to Gregorian, Lunar range (1891-1-1 ~ 2100-12-29)](#2-lunar-to-gregorian-lunar-range-1891-1-1--2100-12-29)
- [Get Leap Month of a Specified Lunar Year](#3-get-leap-month-of-a-specified-lunar-year-result-0-no-leap-month-in-the-specified-year-1~12-specific-leap-month-number)
- [Determine if a Gregorian Year is a Leap Year](#4-determine-if-a-gregorian-year-is-a-leap-year)
- [Get the Zodiac Name for a Lunar Year](#5-get-the-zodiac-name-for-a-lunar-year)
- Other functions will be integrated continuously

### Installation

In the root directory of your project, use `composer` to install this component:

```composer
composer require scort/lunar
```

### Usage in Your Project

```php
// Import
use Scort\Lunar\Lunar;

// Lunar conversion class
$lunar = new Lunar();
```

### 1. Gregorian to Lunar, `Gregorian range (1891-02-09 ~ 2100-12-31)`

```php
/**
 * Convert Gregorian to Lunar, Gregorian range (1891-02-09 ~ 2100-12-31)
 */

// Specify date
$date = date("Y-m-d");
$date = explode("-", $date);

// Convert
$todayLunar = $lunar->solarToLunar(...$date);
var_dump($todayLunar);
```

Result:

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

When the status is 200, data results are available. The index results are explained as follows:
* status: 200
* data:
*  [0] Lunar year
*  [1] Lunar month
*  [2] Lunar day
*  [3] Heavenly Stems and Earthly Branches
*  [4] Lunar month number
*  [5] Lunar day number
*  [6] Zodiac year
*  [7] Leap month

When the status is non-200, there is no data, only a msg describing the error information:
* status: non-200
* msg: Error reason
```

### 2. Lunar to Gregorian, `Lunar range (1891-1-1 ~ 2100-12-29)`

```php
/**
 * Convert Lunar to Gregorian, Lunar range (1891-1-1 ~ 2100-12-29)
 *
 * @param $year : Lunar year
 * @param $month : Lunar month, handling leap month: for example, if there is a leap May in that year, the second May is passed as June, equivalent to 13 lunar months
 * @param $date : Lunar day
 */
$lunarYear = 1891;
$lunarMonth = 1;
$lunarDay = 1;
if ($todayLunar['status'] === 200) [$lunarYear, , , , $lunarMonth, $lunarDay] = $todayLunar['data'];
var_dump($lunar->lunarToSolar($todayLunar[0], $todayLunar[4], $todayLunar[5]));
```

Result:

```
array(2) {
  ["status"]=> int(200)
  ["date"]=> array(3) {
    [0]=> string(4) "2024"
    [1]=> string(2) "07"
    [2]=> string(2) "20"
  }
}

When the status is 200, data results are available. The index results are explained as follows:
* status: 200
* data:
*  [0] Gregorian year
*  [1] Gregorian month
*  [2] Gregorian day

When the status is non-200, there is no data, only a msg describing the error information:
* status: non-200
* msg: Error reason
```

### 3. Get Leap Month of a Specified Lunar Year, Result: `0`: No leap month in the specified year; `1~12`: Specific leap month number

```php
// Get leap month for 2024
$leapMonth_2024 = $lunar->getLeapMonth(2024);
// Get leap month for 2025
$leapMonth_2025 = $lunar->getLeapMonth(2025);
var_dump(
    $leapMonth_2024, // int 0
    $leapMonth_2025  // int 6
);
```

### 4. Determine if a Gregorian Year is a Leap Year

```php
$isLeapYear_2024 = $lunar->isLeapYear(2024);
$isLeapYear_2025 = $lunar->isLeapYear(2025);
var_dump(
    $isLeapYear_2024, // bool true
    $isLeapYear_2025  // bool false
);
```

### 5. Get the Zodiac Name for a Lunar Year

```php
$lunarYearZodiacName = $lunar->getLunarYearZodiacName(2024);
var_dump(
    $lunarYearZodiacName // string  "龙"
);
```