<?php

/**
 * 农历配置 (1891年 ~ 2100年)
 *
 * 每一组数据有4个元素；
 * 第一个元素：当前农历年是否有闰月、闰几月
 * 第二、三个元素：当前农历年正月初一对应的所在的公历月日
 * 第四个元素：当前农历年所有月的天数；
 *           这里使用了十进制表示，使用时将要将其它转为二进制，转换后不足16位的前补0；
 *           然后从头截取12|13长度的字符串，每一位代表了当月的天数+29
 */
return [
    1891 => [0,2,9,21936],
    1892 => [6,1,30,9656],
    1893 => [0,2,17,9584],
    1894 => [0,2,6,21168],
    1895 => [5,1,26,43344],
    1896 => [0,2,13,59728],
    1897 => [0,2,2,27296],
    1898 => [3,1,22,44368],
    1899 => [0,2,10,43856],
    1900 => [8,1,30,19304],
    1901 => [0,2,19,19168],
    1902 => [0,2,8,42352],
    1903 => [5,1,29,21096],
    1904 => [0,2,16,53856],
    1905 => [0,2,4,55632],
    1906 => [4,1,25,27304],
    1907 => [0,2,13,22176],
    1908 => [0,2,2,39632],
    1909 => [2,1,22,19176],
    1910 => [0,2,10,19168],
    1911 => [6,1,30,42200],
    1912 => [0,2,18,42192],
    1913 => [0,2,6,53840],
    1914 => [5,1,26,54568],
    1915 => [0,2,14,46400],
    1916 => [0,2,3,54944],
    1917 => [2,1,23,38608],
    1918 => [0,2,11,38320],
    1919 => [7,2,1,18872],
    1920 => [0,2,20,18800],
    1921 => [0,2,8,42160],
    1922 => [5,1,28,45656],
    1923 => [0,2,16,27216],
    1924 => [0,2,5,27968],
    1925 => [4,1,24,44456],
    1926 => [0,2,13,11104],
    1927 => [0,2,2,38256],
    1928 => [2,1,23,18808],
    1929 => [0,2,10,18800],
    1930 => [6,1,30,25776],
    1931 => [0,2,17,54432],
    1932 => [0,2,6,59984],
    1933 => [5,1,26,27976],
    1934 => [0,2,14,23248],
    1935 => [0,2,4,11104],
    1936 => [3,1,24,37744],
    1937 => [0,2,11,37600],
    1938 => [7,1,31,51560],
    1939 => [0,2,19,51536],
    1940 => [0,2,8,54432],
    1941 => [6,1,27,55888],
    1942 => [0,2,15,46416],
    1943 => [0,2,5,22176],
    1944 => [4,1,25,43736],
    1945 => [0,2,13,9680],
    1946 => [0,2,2,37584],
    1947 => [2,1,22,51544],
    1948 => [0,2,10,43344],
    1949 => [7,1,29,46248],
    1950 => [0,2,17,27808],
    1951 => [0,2,6,46416],
    1952 => [5,1,27,21928],
    1953 => [0,2,14,19872],
    1954 => [0,2,3,42416],
    1955 => [3,1,24,21176],
    1956 => [0,2,12,21168],
    1957 => [8,1,31,43344],
    1958 => [0,2,18,59728],
    1959 => [0,2,8,27296],
    1960 => [6,1,28,44368],
    1961 => [0,2,15,43856],
    1962 => [0,2,5,19296],
    1963 => [4,1,25,42352],
    1964 => [0,2,13,42352],
    1965 => [0,2,2,21088],
    1966 => [3,1,21,59696],
    1967 => [0,2,9,55632],
    1968 => [7,1,30,23208],
    1969 => [0,2,17,22176],
    1970 => [0,2,6,38608],
    1971 => [5,1,27,19176],
    1972 => [0,2,15,19152],
    1973 => [0,2,3,42192],
    1974 => [4,1,23,53864],
    1975 => [0,2,11,53840],
    1976 => [8,1,31,54568],
    1977 => [0,2,18,46400],
    1978 => [0,2,7,46752],
    1979 => [6,1,28,38608],
    1980 => [0,2,16,38320],
    1981 => [0,2,5,18864],
    1982 => [4,1,25,42168],
    1983 => [0,2,13,42160],
    1984 => [10,2,2,45656],
    1985 => [0,2,20,27216],
    1986 => [0,2,9,27968],
    1987 => [6,1,29,44448],
    1988 => [0,2,17,43872],
    1989 => [0,2,6,38256],
    1990 => [5,1,27,18808],
    1991 => [0,2,15,18800],
    1992 => [0,2,4,25776],
    1993 => [3,1,23,27216],
    1994 => [0,2,10,59984],
    1995 => [8,1,31,27432],
    1996 => [0,2,19,23232],
    1997 => [0,2,7,43872],
    1998 => [5,1,28,37736],
    1999 => [0,2,16,37600],
    2000 => [0,2,5,51552],
    2001 => [4,1,24,54440],
    2002 => [0,2,12,54432],
    2003 => [0,2,1,55888],
    2004 => [2,1,22,23208],
    2005 => [0,2,9,22176],
    2006 => [7,1,29,43736],
    2007 => [0,2,18,9680],
    2008 => [0,2,7,37584],
    2009 => [5,1,26,51544],
    2010 => [0,2,14,43344],
    2011 => [0,2,3,46240],
    2012 => [4,1,23,46416],
    2013 => [0,2,10,44368],
    2014 => [9,1,31,21928],
    2015 => [0,2,19,19360],
    2016 => [0,2,8,42416],
    2017 => [6,1,28,21176],
    2018 => [0,2,16,21168],
    2019 => [0,2,5,43312],
    2020 => [4,1,25,29864],
    2021 => [0,2,12,27296],
    2022 => [0,2,1,44368],
    2023 => [2,1,22,19880],
    2024 => [0,2,10,19296],
    2025 => [6,1,29,42352],
    2026 => [0,2,17,42208],
    2027 => [0,2,6,53856],
    2028 => [5,1,26,59696],
    2029 => [0,2,13,54576],
    2030 => [0,2,3,23200],
    2031 => [3,1,23,27472],
    2032 => [0,2,11,38608],
    2033 => [11,1,31,19176],
    2034 => [0,2,19,19152],
    2035 => [0,2,8,42192],
    2036 => [6,1,28,53848],
    2037 => [0,2,15,53840],
    2038 => [0,2,4,54560],
    2039 => [5,1,24,55968],
    2040 => [0,2,12,46496],
    2041 => [0,2,1,22224],
    2042 => [2,1,22,19160],
    2043 => [0,2,10,18864],
    2044 => [7,1,30,42168],
    2045 => [0,2,17,42160],
    2046 => [0,2,6,43600],
    2047 => [5,1,26,46376],
    2048 => [0,2,14,27936],
    2049 => [0,2,2,44448],
    2050 => [3,1,23,21936],
    2051 => [0,2,11,37744],
    2052 => [8,2,1,18808],
    2053 => [0,2,19,18800],
    2054 => [0,2,8,25776],
    2055 => [6,1,28,27216],
    2056 => [0,2,15,59984],
    2057 => [0,2,4,27424],
    2058 => [4,1,24,43872],
    2059 => [0,2,12,43744],
    2060 => [0,2,2,37600],
    2061 => [3,1,21,51568],
    2062 => [0,2,9,51552],
    2063 => [7,1,29,54440],
    2064 => [0,2,17,54432],
    2065 => [0,2,5,55888],
    2066 => [5,1,26,23208],
    2067 => [0,2,14,22176],
    2068 => [0,2,3,42704],
    2069 => [4,1,23,21224],
    2070 => [0,2,11,21200],
    2071 => [8,1,31,43352],
    2072 => [0,2,19,43344],
    2073 => [0,2,7,46240],
    2074 => [6,1,27,46416],
    2075 => [0,2,15,44368],
    2076 => [0,2,5,21920],
    2077 => [4,1,24,42448],
    2078 => [0,2,12,42416],
    2079 => [0,2,2,21168],
    2080 => [3,1,22,43320],
    2081 => [0,2,9,26928],
    2082 => [7,1,29,29336],
    2083 => [0,2,17,27296],
    2084 => [0,2,6,44368],
    2085 => [5,1,26,19880],
    2086 => [0,2,14,19296],
    2087 => [0,2,3,42352],
    2088 => [4,1,24,21104],
    2089 => [0,2,10,53856],
    2090 => [8,1,30,59696],
    2091 => [0,2,18,54560],
    2092 => [0,2,7,55968],
    2093 => [6,1,27,27472],
    2094 => [0,2,15,22224],
    2095 => [0,2,5,19168],
    2096 => [4,1,25,42216],
    2097 => [0,2,12,42192],
    2098 => [0,2,1,53584],
    2099 => [2,1,21,55592],
    2100 => [0,2,9,54560]
];