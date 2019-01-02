<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/30
 * Time: 17:59
 */

namespace app\spider\service;


class News extends Base
{
    /**
     * 执行采集任务
     * @param $rule_id 规则ID
     * @param $model 数据源
     * @return bool
     */
    public function categoryNewsRule($rule_id, $model)
    {
        $pattern = $model->find($rule_id);
        //dump($pattern);
        $this->url = $pattern['url'];

        if($this->curlGet() === false){
            echo '获取网页出错了 url='.$this->url;
            return false;
        }

        if($this->getOneContent($pattern['route']['block']) === false){
            echo '获取区块内容出错了';
            return false;
        }

        $data = [
            'next_depth' => [], //最终页地址
            'title_depth' => [], //标题
        ];


        if($result = $this->getAllContent($pattern['route']['depth']['url'])){
            $data['next_depth'] = $result;
        }

        if($result = $this->getAllContent($pattern['route']['depth']['title'])){
            $data['title_depth'] = $result;
        }


        $data = (array_merge_more(['source_url','title'],[$data['next_depth'],$data['title_depth']]));

        //补充数据
        foreach ($data as $key => &$value){
            $value['source_url'] = $this->isSplicing($value['source_url']);
            $value['index'] = md5($value['source_url']);//判断key值
            $value['category_id'] = $pattern['category_id'];
            $value['rule_id'] = $rule_id; //规则ID
        }

        $this->saveAddNews($data);

    }

    /**
     * 获取一条新闻内容
     * @param $url
     * @param $pattern
     * @return array
     */
    public function getNewsContent($url, $pattern)
    {
        $this->url = $url;
        $pattern = $pattern['content'];

        if($this->curlGet() === false){
            $this->error = '获取网页出错了';
            return false;
        }

        if($pattern['block'] && $this->getOneContent($pattern['block']) === false){
            $this->error = '获取区块内容出错了';
            return false;
        }


        $data['title'] = trim($this->getOneContentTo($pattern['title']));
        $data['content'] =  trim($this->getOneContentTo($pattern['details']));



        return $data;
    }


    /**
     * 保存数据
     * @param $data
     * @return bool
     */
    protected function saveAddNews($data)
    {
        $model = new \app\common\model\SpiderNews;

        //存放新的数据
        $newAddData = [];
        foreach ($data as $key => $value){
            if(0 == $model->where('index', $value['index'])->count()){
                $newAddData[] = $value;
            }else{
                break;
            }
        }

        if($model->saveAll($newAddData)){
            return true;
        }

        return false;

    }
}