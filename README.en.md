## Chinese lunar calendar component

The document is about a Chinese lunar calendar component that provides functions to convert between the Gregorian calendar and the lunar calendar for the years 1891 to 2100. It follows the PSR-4 standard and includes examples of how to use the component.

### Features:
1. **Gregorian to Lunar Conversion (Gregorian range: 1891-02-09 ~ 2100-12-31)**:
    - Example:
    ```php
    require __DIR__ . "/../vendor/autoload.php";
    use Scort\Lunar\Lunar;
    $lunar = new Lunar();
   ```
   
   ```php
    $date = date("Y-m-d");
    $date = explode("-", $date);
    $todayLunar = $lunar->solarToLunar(...$date);
    var_dump($todayLunar);
    ```
    - Result format:
    ```php
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
    ```
    - Explanation:
        - `status: 200` indicates a successful conversion.
        - `data` contains:
            - Lunar year
            - Lunar month
            - Lunar day
            - Heavenly stem and earthly branch
            - Numerical lunar month
            - Numerical lunar day
            - Chinese zodiac year
            - Leap month indicator

2. **Lunar to Gregorian Conversion (Lunar range: 1891-1-1 ~ 2100-12-29)**:
    - Example:
    ```php
    $lunarYear = 1891;
    $lunarMonth = 1;
    $lunarDay = 1;
    if ($todayLunar['status'] === 200) [$lunarYear, , , , $lunarMonth, $lunarDay] = $todayLunar['data'];
    var_dump($lunar->lunarToSolar($todayLunar[0], $todayLunar[4], $todayLunar[5]));
    ```
    - Result format:
    ```php
    array(2) {
      ["status"]=> int(200)
      ["date"]=> array(3) {
        [0]=> string(4) "2024"
        [1]=> string(2) "07"
        [2]=> string(2) "20"
      }
    }
    ```
    - Explanation:
        - `status: 200` indicates a successful conversion.
        - `data` contains:
            - Gregorian year
            - Gregorian month
            - Gregorian day

### Additional Features:
- More features are being integrated.