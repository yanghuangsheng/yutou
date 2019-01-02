<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 10:42
 */

namespace app\common\model;


class PortalNewsComment extends Base
{
    /**
     * 关联用户模型
     * @return $this
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id')
            ->bind(['user_name'=>'name', 'avatar']);
    }

    /**
     * 关联评论新闻
     * @return $this
     */
    public function news()
    {
        return $this->belongsTo('PortalNews', 'news_id')->bind(['news_title'=>'title']);
    }
}