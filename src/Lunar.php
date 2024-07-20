<?php

namespace Scort\Lunar;

/**
 * 农历 节气 节日
 * 1891 - 2100
 **/
class Lunar
{

    const MIN_YEAR = 1891;
    const MAX_YEAR = 2100;
    const MIN_SOLAR_DATE = '1891-2-9';
    const MAX_SOLAR_DATE = '2100-12-31';
    const MIN_LUNAR_DATE = '1891-1-1';
    const MAX_LUNAR_DATE = '2100-12-29';

    public static $config;

    /**
     * 构造函数
     */
    public function __construct()
    {
        self::$config = require __DIR__ . '/config/scort_luanr.php';
    }


    /**
     * 将公历转换为农历，范围(1891-02-09 ~ 2100-12-31)
     *
     * @param int $year 公历-年
     * @param int $month 公历-月
     * @param int $day 公历-日
     * @return array
     */
    public function solarToLunar(int $year, int $month, int $day): array
    {
        $date = strtotime("$year-$month-$day");

        $start = strtotime(self::MIN_SOLAR_DATE);
        $end = strtotime(self::MAX_SOLAR_DATE);
        if ($date < $start || $date > $end) {
            return ['status' => 400, 'msg' => '公历超出范围，支持范围：1891-2-9 ~ 2100-12-31'];
        }

        [, $startMonth, $startDay,] = self::$config[$year];
        return [
            'status' => 200,
            'data' => $this->getLunarByBetween(
                $year,
                $this->getDaysBetweenSolar($year, $month, $day, $startMonth, $startDay)
            )
        ];
    }

    /**
     * 将公历整月转换为农历，范围(1891-02-09 ~ 2100-12-31)
     * @param int $year 公历-年
     * @param int $month 公历-月
     * @param int $day 公历-日
     *
     * @return array
     */
    public function solarToLunarMonth(int $year, int $month, int $day): array
    {
        // 范围检查
        $date = strtotime("$year-$month-$day");

        $start = strtotime(self::MIN_SOLAR_DATE);
        $end = strtotime(self::MAX_SOLAR_DATE);
        if ($date < $start || $date > $end) {
            return ['status' => 400, 'msg' => '公历超出范围，支持范围：1891-2-9 ~ 2100-12-31'];
        }

        // 功能执行
        [, $startMonth, $startDay,] = self::$config[$year];
        $res = [];
        $days = self::getSolarMonthDays($year, $month);
        for ($i = 1; $i < $days; $i++) {
            $tmp = $this->getLunarByBetween($year, $this->getDaysBetweenSolar($year, $month, $i, $startMonth, $startDay));
            $tmp[] = "$year-$month-$i";

            $res[$i] = $tmp;
        }
        return ['status' => 200, 'data' => $res];
    }

    /**
     * 将农历转换为公历，范围(1891-1-1 ~ 2100-12-29)
     *
     * @param $year :农历-年
     * @param $month :农历-月，闰月处理：例如如果当年闰五月，那么第二个五月就传六月，相当于农历有13个月，只是有的时候第13个月的天数为0
     * @param $day :农历-日
     *
     * @return array
     */
    public function lunarToSolar(int $year, int $month, int $day): array
    {
        // 范围检查
        $date = strtotime("$year-$month-$day");

        $start = strtotime(self::MIN_LUNAR_DATE);
        $end = strtotime(self::MAX_LUNAR_DATE);
        if ($date < $start || $date > $end) {
            return ['status' => 400, 'msg' => '农历超出范围，支持范围：1891-1-1 ~ 2100-12-29'];
        }

        // 功能执行
        [, $startMonth, $startDay,] = self::$config[$year];
        $between = $this->getDaysBetweenLunar($year, $month, $day);
        $time = strtotime("$year-$startMonth-$startDay");
        $date = date('Y-m-d', $time + $between * 86400);
        return ['status' => 200, 'date' => explode('-', $date)];
    }

    /**
     * 获取农历每月的天数的数组
     *
     * @param int $year
     * @return array | false
     */
    private function getLunarMonths(int $year)
    {
        $yearData = self::$config[$year] ?? false;
        if (!$yearData) return $yearData;

        $leapMonth = $yearData[0];
        $bit = decbin($yearData[3]);
        // 不足16位，前补0
        $bit = str_repeat('0', 16 - strlen($bit)) . $bit;
        // 字符串转为数组
        $bitArray = str_split($bit);

        // 取当前年对应的月数组列表
        $bitArray = array_slice($bitArray, 0, ($leapMonth == 0 ? 12 : 13));
        return array_map(fn($i) => $i + 29, $bitArray);
    }

    /**
     * 获取农历年的天数
     * @param $year :农历年份
     * @return mixed
     */
    private function getLunarYearDays($year)
    {
        $yearMonth = $this->getLunarYearMonths($year);
        $len = count($yearMonth);
        return $yearMonth[$len - 1] ?: $yearMonth[$len - 2];
    }

    /**
     * 获取月：每个月的天数是本月与前几个月的天数的累加
     * @param $year :农历年份
     * @return array
     */
    private function getLunarYearMonths(int $year): array
    {
        $monthData = $this->getLunarMonths($year);
        $temp = 0;
        return array_map(function ($i) use (&$temp) {
            $temp += $i;
            return $temp;
        }, $monthData);
    }

    /**
     * 计算农历日期与正月初一相隔的天数
     *
     * @param int $year
     * @param int $month
     * @param int $date
     * @return int
     */
    private function getDaysBetweenLunar(int $year, int $month, int $date): int
    {
        $yearMonth = $this->getLunarMonths($year);
        $yearMonth = array_slice($yearMonth, 0, $month - 1);
        $nums = array_sum($yearMonth);
        $nums += $date - 1;
        return $nums;
    }

    /**
     * 计算2个公历日期之间的天数
     *
     * @param int $year 公历年
     * @param int $cmonth 公历月
     * @param int $cdate 公历日
     * @param int $dmonth 公历月（正月对应）
     * @param int $ddate 公历日（初一对应）
     * @return int
     */
    private function getDaysBetweenSolar(int $year, int $cmonth, int $cdate, int $dmonth, int $ddate): int
    {
        $a = strtotime("$year-$cmonth-$cdate");
        $b = strtotime("$year-$dmonth-$ddate");
        return (int)ceil(($a - $b) / 86400);
    }

    /**
     * 根据距离正月初一的天数计算农历日期
     * @param $year :公历年
     * @param $between :天数
     * @return array
     */
    private function getLunarByBetween(int $year, int $between): array
    {
        $t = 1;
        $e = 1;
        $leapMonth = 0;
        $m = '正月';

        if ($between != 0) {
            $year = $between > 0 ? $year : ($year - 1);
            $yearMonth = $this->getLunarYearMonths($year);
            $leapMonth = $this->getLeapMonth($year);
            $between = $between > 0 ? $between : ($this->getLunarYearDays($year) + $between);
            for ($i = 0; $i <= count($yearMonth); $i++) {
                if ($between == $yearMonth[$i]) {
                    $t = $i + 2;
                    break;
                }
                if ($between < $yearMonth[$i]) {
                    $t = $i + 1;
                    $e = $between - ($yearMonth[$i - 1] ?? 0) + 1;
                    break;
                }
            }
            $m = ($leapMonth != 0 && $t == $leapMonth + 1)
                ? ('闰' . $this->getLunarMonthName($t - 1))
                : $this->getLunarMonthName(
                    ($leapMonth != 0 && $leapMonth + 1 < $t ? ($t - 1) : $t)
                );
        }

        return [
            // 农历年
            $year,
            // 农历月
            $m,
            // 农历日
            $this->getLunarDayName($e),
            // 天干地支
            $this->getLunarYearName($year),
            // 农历月的数字
            $t,
            // 农历日的数字
            $e,
            // 生肖年
            $this->getLunarYearZodiacName($year),
            // 闰几月
            $leapMonth
        ];
    }

    /**
     * 判断是否是闰年
     *
     * @param int $year
     * @return bool
     */
    public function isLeapYear(int $year): bool
    {
        return (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0));
    }

    /**
     * 获取闰月
     * @param int $year :农历年份
     *
     * @return int
     */
    private function getLeapMonth(int $year): int
    {
        return self::$config[$year][0] ?? 0;
    }

    /**
     * 获取农历月份的天数
     * @param int $year :农历-年
     * @param int $month :农历-月，从一月开始
     * @return int
     */
    private function getLunarMonthDays(int $year, int $month): int
    {
        return $this->getLunarMonths($year)[$month - 1] ?? 0;
    }

    /**
     * 获取公历月份的天数
     * @param int $year :公历-年
     * @param int $month :公历-月
     * @return int
     */
    private function getSolarMonthDays(int $year, int $month): int
    {
        $data = [
            1 => 31,
            2 => $this->isLeapYear($year) ? 29 : 28,
            3 => 31,
            4 => 30,
            5 => 31,
            6 => 30,
            7 => 31,
            8 => 31,
            9 => 30,
            10 => 31,
            11 => 30,
            12 => 31
        ];
        return $data[$month] ?? 0;
    }

    /**
     * 获取月数字的农历叫法
     * 比如：12 -> 腊月
     *
     * @param $num string|int 月份的数字
     * @return string
     */
    public function getLunarMonthName(int $num): string
    {
        $data = ['正月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '冬月', '腊月'];
        return $data[$num - 1] ?? '';
    }

    /**
     * 获取日数字的农历叫法
     * 比如：1 -> 初一
     *
     * @param $num :数字
     * @return string
     */
    public function getLunarDayName(int $num): string
    {
        $data = [
            '初一', '初二', '初三', '初四', '初五', '初六', '初七', '初八', '初九', '初十',
            '十一', '十二', '十三', '十四', '十五', '十六', '十七', '十八', '十九', '二十',
            '廿一', '廿二', '廿三', '廿四', '廿五', '廿六', '廿七', '廿八', '廿九', '三十'
        ];
        return $data[$num - 1] ?? '';
    }


    /**
     * 获取干支纪年
     *
     * @param int $year
     * @return string
     */
    public function getLunarYearName(int $year): string
    {
        $sky = ['庚', '辛', '壬', '癸', '甲', '乙', '丙', '丁', '戊', '己'];
        $earth = ['申', '酉', '戌', '亥', '子', '丑', '寅', '卯', '辰', '巳', '午', '未'];
        return $sky[((string)$year)[3]] . $earth[$year % 12];
    }

    /**
     * 根据农历年获取生肖
     * @param int $year :农历年
     * @return string
     */
    public function getLunarYearZodiacName(int $year): string
    {
        $data = ['猴', '鸡', '狗', '猪', '鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊'];
        return $data[$year % 12] ?? '';
    }

}