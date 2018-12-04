<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/30
 * Time: 14:19
 */

namespace app\spider\controller;


class Task extends Base
{
    protected function initialize()
    {
        ignore_user_abort(true);
        set_time_limit(3600);
        ob_end_clean();//清除之前的缓冲内容，这是必需的，如果之前的缓存不为空的话，里面可能有http头或者其它内容，导致后面的内容不能及时的输出
        header("Connection: close");//告诉浏览器，连接关闭了，这样浏览器就不用等待服务器的响应
        header("HTTP/1.1 200 OK");
    }

    /**
     * 测试定时任务
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 资讯采集
     * @param $id
     */
    public function news($id)
    {
        $model = new \app\admin\model\SpiderNewsCategory;

        $categoryList = $model->where([['status', '=', 1],['parent_id', '=', $id]])->select();

        //dump($categoryList);
        $ruleModel = new \app\admin\model\SpiderNewsRule;
        foreach ($categoryList as $key => $value){
            $ruleData = $ruleModel->where('category_id', $value['id'])->where('status', 1)->field('id')->select();

            foreach ($ruleData as $key => $value){
                $this->categoryNewsRule($value['id'], $ruleModel);
            }
        }
    }

    /**
     * 彩票开奖采集
     * @param $id
     */
    public function lottery($id)
    {
        $model = new \app\admin\model\SpiderLotteryCategory;

        $categoryList = $model->where([['status', '=', 1],['parent_id', '=', $id]])->select();

        //dump($categoryList);
        $ruleModel = new \app\admin\model\SpiderLotteryRule;
        foreach ($categoryList as $key => $value){
            $ruleData = $ruleModel->where('category_id', $value['id'])->where('status', 1)->field('id')->select();

            foreach ($ruleData as $key => $value){
                $this->categoryLotteryRule($value['id'], $ruleModel);
            }
        }

    }


    /**
     * 执行采集任务
     * @param $rule_id
     * @param $model
     * @return bool
     */
    protected function categoryLotteryRule($rule_id, $model)
    {
        $pattern = $model->find($rule_id);
        //dump($pattern);

        $this->url = $pattern['api_url'];

        if($this->curlGet() === false){
            echo '获取数据出错';
            return false;
        }

        if($data = json_decode($this->result, true)){
            //dump($data['data']);
            $newData = [];
            //补充数据
            foreach ($data['data'] as $key => $value){
                $newData[] = [
                    'category_id' => $pattern['category_id'],
                    'lottery_no' => $value['expect'],
                    'open_code' => $value['opencode'],
                    'open_time' => $value['opentimestamp'],
                ];
            }

            $this->saveAddLottery($newData);

        }

    }

    /**
     * 保存数据
     * @param $data
     * @return bool
     */
    protected function saveAddLottery($data)
    {
        $model = new \app\admin\model\SpiderLottery;

        //存放新的数据
        $newAddData = [];
        foreach ($data as $key => $value){
            if(0 == $model->where('open_time', $value['open_time'])->where('category_id', $value['category_id'])->count()){
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






    /**
     * 执行采集任务
     * @param $rule_id 规则ID
     * @param $model 数据源
     * @return bool
     */
    protected function categoryNewsRule($rule_id, $model)
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
        }

        $this->saveAddNews($data);

    }

    /**
     * 保存数据
     * @param $data
     * @return bool
     */
    protected function saveAddNews($data)
    {
        $model = new \app\admin\model\SpiderNews;

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