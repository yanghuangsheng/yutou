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
        @ob_end_clean();//清除之前的缓冲内容，这是必需的，如果之前的缓存不为空的话，里面可能有http头或者其它内容，导致后面的内容不能及时的输出
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
        $model = new \app\common\model\SpiderNewsCategory;

        $categoryList = $model->where([['status', '=', 1],['parent_id', '=', $id]])->select();

        //dump($categoryList);
        $ruleModel = new \app\common\model\SpiderNewsRule;
        foreach ($categoryList as $key => $value){
            $ruleData = $ruleModel->where('category_id', $value['id'])->where('status', 1)->field('id')->select();
            $news = new \app\spider\service\News;
            foreach ($ruleData as $key => $value){
                $news->categoryNewsRule($value['id'], $ruleModel);
            }
        }

    }

    /**
     * 彩票开奖采集
     * @param $id
     */
    public function lottery($id)
    {
        $model = new \app\common\model\SpiderLotteryCategory;

        $categoryList = $model->where([['status', '=', 1],['parent_id', '=', $id]])->select();

        //dump($categoryList);
        $ruleModel = new \app\common\model\SpiderLotteryRule;
        foreach ($categoryList as $key => $value){
            $ruleData = $ruleModel->where('category_id', $value['id'])->where('status', 1)->field('id')->select();
            $lottery = new \app\spider\service\Lottery;
            foreach ($ruleData as $key => $value){
                $lottery->categoryLotteryRule($value['id'], $ruleModel);
            }
        }


    }



}