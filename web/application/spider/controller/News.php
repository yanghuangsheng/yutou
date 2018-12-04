<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/29
 * Time: 14:33
 */

namespace app\spider\controller;



class News extends Base
{

    /**
     * 采集测试
     */
    public function index($id)
    {

        $model = new \app\admin\model\SpiderNewsRule;
        $pattern = $model->find($id);
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
        //echo $this->result;
        $data = [
            'next_depth' => [], //最终页地址
            'title_depth' => [], //标题
            'result' => [], //要存放的内容
        ];


        if($result = $this->getAllContent($pattern['route']['depth']['url'])){
            $data['next_depth'] = $result;
        }

        if($result = $this->getAllContent($pattern['route']['depth']['title'])){
            $data['title_depth'] = $result;
        }

        print_r($data);
        dump(array_merge_more(['url','title'],[$data['next_depth'],$data['title_depth']]));
        exit();

        $this->foreachGetItem($data, $pattern['content']);

        print_r($data['result']);
    }




    /**
     * 获取详情内容
     * @param $data
     * @param $pattern
     * @return bool
     */
    protected function foreachGetItem(&$data, $pattern)
    {
        foreach ($data['next_depth'] as $key => $value){
            $value = $this->isSplicing($value);
            $item = [
                'source_url' => $value,
            ];

            $this->url = $value;

            if($this->curlGet() === false){
                echo '获取网页出错了2';
                return false;
            }

            if($pattern['block'] && $this->getOneContent($pattern['block']) === false){
                echo '获取区块内容出错了2';
                return false;
            }else{

                $pattern['title'] && $item['title'] = $this->getOneContentTo($pattern['title']);
                $pattern['details'] && $item['details'] = $this->getOneContentTo($pattern['details']);
            }



            $data['result'][] = $item;
        }
    }

}