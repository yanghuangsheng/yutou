<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/22
 * Time: 16:05
 */

namespace app\admin\model;

use think\Model;
use think\model\concern\SoftDelete;

class Base extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
}