<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 14:18
 */

namespace app\common\model;


class ForumPostComment extends Base
{
    /**
     * 关联用户模型
     * @return $this
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id')->bind(['user_name'=>'name']);
    }

    /**
     * 关联评论帖子
     * @return $this
     */
    public function forumPost()
    {
        return $this->belongsTo('ForumPost', 'post_id')->bind(['post_title'=>'title']);
    }
}