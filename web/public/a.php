<?php

$str = 'sign=iurgfdjsjbcb84764hdhueuye&time=82929374';
parse_str($str, $parse);

print_r($parse);

echo getMillisecond();

function getMillisecond() {
    list($t1, $t2) = explode(' ', microtime());
    return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
}