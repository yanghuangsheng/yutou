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
    protected $b;
    protected function initialize()
    {
        $this->b = new \app\spider\service\Base;
    }
    /**
     * 采集测试
     */
    public function index($id)
    {

        $model = new \app\common\model\SpiderNewsRule;
        $pattern = $model->find($id);
        //dump($pattern);

        $this->b->setUrl($pattern['url']);

        if($this->b->curlGet() === false){
            echo '获取网页出错了 url='.$this->b->getUrl();
            return false;
        }

        if($this->b->getOneContent($pattern['route']['block']) === false){
            echo '获取区块内容出错了';
            return false;
        }

        $data = [
            'next_depth' => [], //最终页地址
            'title_depth' => [], //标题
            'result' => [], //要存放的内容
        ];

        if(!$pattern['route']['depth']['url']){
            echo $this->b->getResult();
            exit();
        }
        if($result = $this->b->getAllContent($pattern['route']['depth']['url'])){
            $data['next_depth'] = $result;
        }
        if(!$pattern['route']['depth']['title']){
            print_r($data);
            exit();
        }
        if($result = $this->b->getAllContent($pattern['route']['depth']['title'])){
            $data['title_depth'] = $result;
        }


        //dump(array_merge_more(['url','title'],[$data['next_depth'],$data['title_depth']]));
        //exit();

        $this->foreachGetItem($data, $pattern['content']);

        print_r($data);
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
            $value = $this->b->isSplicing($value);
            //exit($value);
            $item = [
                'source_url' => $value,
            ];

            $this->b->setUrl($value);

            if($this->b->curlGet() === false){
                echo '获取网页出错了2';
                return false;
            }

            if($pattern['block'] && $this->b->getOneContent($pattern['block']) === false){
                echo '获取区块内容出错了2<br>';
                echo $this->b->getResult();
                exit();
            }else{
                if(!$pattern['title']){
                    echo $this->b->getResult();
                    exit();
                }



                $pattern['title'] && $item['title'] = $this->b->getOneContentTo($pattern['title']);
                $pattern['details'] && $item['details'] = $this->b->getOneContentTo($pattern['details']);
            }

            //print_r($item);


            $data['result'][] = $item;
        }
    }

}