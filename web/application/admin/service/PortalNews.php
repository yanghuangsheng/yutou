<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/5
 * Time: 15:03
 */

namespace app\admin\service;


class PortalNews extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\PortalNews;
        $this->order = ['id', 'desc'];
    }

    /**
     * 采集转发数据
     * @param $data
     * @return bool
     */
    public function toRelayAdd($data)
    {
        return $this->save($data);
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
     * 列表view
     */
    protected function setWithOnView()
    {
        return $this->model->view('PortalNews', 'id,title,category_id,status,hot,top,recommended,source_url,published_time')
            ->view('PortalNewsInCategory', ['category_id'=>'o_category_id'], 'PortalNewsInCategory.news_id = PortalNews.id', 'LEFT')
            ->view('PortalNewsAttr', 'browse_num,praise_num,collect_num,comment_num', 'PortalNewsAttr.news_id = PortalNews.id', 'LEFT')
            ->group('id');
    }

    /**
     * 列表view
     */
    protected function setOneWithOnView()
    {
        return $this->model->view('PortalNews', '*')
            ->view('PortalNewsInCategory', ['category_id'=>'o_category_id'], 'PortalNewsInCategory.news_id = PortalNews.id', 'LEFT')
            ->view('PortalNewsAttr', 'browse_num,praise_num,collect_num,comment_num', 'PortalNewsAttr.news_id = PortalNews.id', 'LEFT');
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
                $value['status_txt'] = '<span class="layui-badge layui-bg-green">已发布</span>';
            }else{
                $value['status_txt'] = '<span class="layui-badge layui-bg-gray">未发布</span>';
            }
            if($value['hot']){
                $value['status_txt'] .= ' <span class="layui-badge layui-bg-green">已热门</span>';
            }else{
                $value['status_txt'] .= ' <span class="layui-badge layui-bg-gray">未热门</span>';
            }
            if($value['recommended']){
                $value['status_txt'] .= ' <span class="layui-badge layui-bg-green">已推荐</span>';
            }else{
                $value['status_txt'] .= ' <span class="layui-badge layui-bg-gray">未推荐</span>';
            }

            $value['category_name'] = $this->newsCategory($value['category_id']);
            $value['published_txt'] = date('Y-m-d H:i:s', $value['published_time']);

            $value['browse_num'] || $value['browse_num'] = 0;
            $value['praise_num'] || $value['praise_num'] = 0;
            $value['collect_num'] || $value['collect_num'] = 0;
            $value['comment_num'] || $value['comment_num'] = 0;

        }
        return $data;
    }

    /**
     * 配分类列表
     * @param $category
     * @return array|string
     */
    public function newsCategory($category){
        static $data = [];
        if(!$data){
            $data = (new \app\common\model\PortalNewsCategory)->column('name','id');
        }
        if(!$category){
            return '';
        }
        $re = '';
        foreach (explode(',',$category) as $key => $value ){
            $re .= '<span class="layui-badge layui-bg-green">'. $data[$value] .'</span> ';
        }

        return $re;
    }

    /**
     * 额外数据查询
     * @param $data
     * @return mixed
     */
    protected function resetFindData($data)
    {
        $data['content'] = (new \app\common\model\PortalNewsContent)->where('news_id', $data['id'])->value('content');

        return $data;
    }

    /**
     * 额外删除
     * @param $id
     */
    protected function setDelete($id)
    {
        $oTime = time();
        (new \app\common\model\PortalNewsContent)->where('news_id', 'IN', $id)->data(['delete_time' => $oTime])->update();
    }

    /**
     * 额外新增
     * @param $data
     */
    protected function setSaveAdd($data)
    {
        $content = new \app\common\model\PortalNewsContent;
        $content->news_id = $data['id'];
        $content->content = $data['content'];
        $content->save();

        if(isset($data['category_id'])){
            $InCategory = new \app\common\model\PortalNewsInCategory;
            $addData = [];
            foreach (explode(',',$data['category_id']) as $key => $value) {
                $addData[] = ['news_id' => $data['id'], 'category_id' => $value];
            }
            $InCategory->saveAll($addData);

        }

    }

    /**
     * 额外修改
     * @param $data
     */
    protected function setSaveUpdate($data)
    {
        $content = new \app\common\model\PortalNewsContent;
        $content->save(['content' => $data['content']], ['news_id' => $data['id']]);

        $InCategory = new \app\common\model\PortalNewsInCategory;
        $addData = [];
        foreach (explode(',',$data['category_id']) as $key => $value) {
            $addData[] = ['news_id' => $data['id'], 'category_id' => $value];
        }
        $InCategory->where('news_id', $data['id'])->delete();
        $InCategory->saveAll($addData);
    }

}