<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/30
 * Time: 15:32
 */

namespace app\admin\service;


class SpiderNews extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\SpiderNews;
    }

    /**
     * 设置可更新字段
     * @return array
     */
    public function setAllowField()
    {
        return true;
    }

    /**
     * 关联模形
     * @return $this
     */
    protected function setWithOnView()
    {
        return $this->model->with(['spiderNewsCategory'])->order('id', 'desc');
    }

    /**
     * 重置
     * @param $data
     * @return mixed
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value){
            if($value['status']){
                $value['status_txt'] = '<span class="layui-badge layui-bg-green">已转</span>';
            }else{
                $value['status_txt'] = '<span class="layui-badge layui-bg-gray">未转</span>';
            }
        }
        return $data;
    }

    /**
     * 采集文章内容
     * @param $id
     * @return array|null|static
     */
    public function collectionContent($id)
    {
        $spiderData = $this->model->field('rule_id,source_url,status')->get($id);
//        if($spiderData['status']){
//            return ['error' => '该资讯已转发'];
//        }

        $pattern = (new \app\common\model\SpiderNewsRule)->field('name,content')->get($spiderData['rule_id']);

        $spider = new \app\spider\service\News;

        if($data = $spider->getNewsContent($spiderData['source_url'], $pattern)){

            $data['published_time'] = date('Y-m-d H:i:s');
            $data['source_name'] = $pattern['name'];
            $data['source_url'] = $spiderData['source_url'];
            $data['description'] = clean_html($data['content'], 200);

            $data['comment_status'] = 1; //默认允许评论

            //文章图片本地化
            $data['content'] = articleContent($data['content'], '/partal_news/content/images/');
            //删除文章所有a标签
            $data['content'] = preg_replace('/<a[^>]*>(.*?)<\/a>/is', "$1", $data['content']);
            $data['image_url'] = resultThumb(getFirstImg($data['content']), '/partal_news/thumb/', 247, 146);
            return $data;
        }



        return ['error' => $spider->getError()];

    }
}