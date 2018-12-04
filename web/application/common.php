<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


/**
 * 密码加密
 * @param $text 要加密的字符
 * @param string $prefix 加密混淆字符串
 * @return string
 */
function md5Encryption($text, $prefix = 'weChat@20180822')
{
    return md5($prefix . trim($text));
}

/**
 * 将多个一维数组合拼成二维数组
 * @param $keys 定义新二维数组的键值，每个对应一个一维数组
 * @param $arrays 多个一维数组集合
 * @return array
 */
function array_merge_more($keys, $arrays){

    // 检查参数是否正确
    if(!$keys || !is_array($keys) || !$arrays || !is_array($arrays) || count($keys)!=count($arrays)){
        return array();
    }

    // 一维数组中最大长度
    $max_len = 0;

    // 整理数据，把所有一维数组转重新索引
    for($i=0,$len=count($arrays); $i<$len; $i++){
        $arrays[$i] = array_values($arrays[$i]);

        if(count($arrays[$i])>$max_len){
            $max_len = count($arrays[$i]);
        }
    }

    // 合拼数据
    $result = array();

    for($i=0; $i<$max_len; $i++){
        $tmp = array();
        foreach($keys as $k=>$v){
            if(isset($arrays[$k][$i])){
                $tmp[$v] = $arrays[$k][$i];
            }
        }
        $result[] = $tmp;
    }

    return $result;

}
