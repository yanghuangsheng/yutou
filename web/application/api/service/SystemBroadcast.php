<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/1
 * Time: 13:45
 */

namespace app\api\service;


class SystemBroadcast extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\SystemBroadcast;
    }

    /**
     * 广播触发器
     * @param $type 0资讯 1论坛
     * @param $event put comment_num browse_num praise_num collect_num
     * @param $data ['name','id','title','num']
     */
    public function trigger($type, $event, $data)
    {
        $template = new \app\common\model\SystemBroadcastTemplate;
        $tplData = $template->where([['trigger_type', '=', $type], ['trigger_field', '=', $event]])->field('condition,content')->find();
        if($tplData){
            switch($event){
                case 'put':
                    $content = str_replace(['{#userName}','{#title}'], [$data['name'], $data['title']], $tplData['content']);
                    break;
                default:
                    if($tplData['condition'] == $data['num']){
                        $content = str_replace(['{#userName}','{#title}'], [$data['name'], $data['title']], $tplData['content']);
                    }
            }
            $tplUrl = ($type?'/forum/item':'/news/item') . '?id=' . $data['id'];
            isset($content) && $this->save(['content'=>"<a href=\"{$tplUrl}\" target=\"_blank\">{$content}</a>", 'o_id'=>$data['id'], 'type'=>0]);
        }

    }
}