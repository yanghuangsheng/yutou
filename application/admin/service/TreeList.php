<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/23
 * Time: 15:47
 */

namespace app\admin\service;

use tree\Tree;

class TreeList
{
    private $tree;

    public function __construct()
    {
        $this->tree = new Tree();
    }

    /**
     * 树形选项
     */
    public function toItems($data, $currentId = 0, $tpl = '')
    {
        $this->tree->icon = ['&nbsp;&nbsp;│', '&nbsp;&nbsp;├─', '&nbsp;&nbsp;└─'];
        $this->tree->nbsp = '&nbsp;&nbsp;';
        if($currentId) {
            $idArr = array_column($data, 'parent_id');
            foreach ($data as $key=>$ro) {
                if(is_array($currentId)){
                    $ro['selected'] = in_array($ro['id'], $currentId)? 'selected="selected"' : '';
                }else{
                    $ro['selected'] = $ro['id'] == $currentId ? 'selected="selected"' : '';
                }
                if(isset($ro['parent_id'])){
                    $ro['disabled'] = ($ro['parent_id'] == 0 && in_array($ro['id'],$idArr))?'disabled="disabled"':'';
                }else{
                    $ro['disabled'] = '';
                }

                $data[$key]     = $ro;
            }
            !$tpl && $tpl = '<option value=\"{$id}\" {$selected} {$disabled}>{$spacer}{$name}</option>';
        } else {
            $idArr = array_column($data, 'parent_id');
            foreach ($data as $key=>$ro) {
                if(isset($ro['parent_id'])){
                    $ro['disabled'] = ($ro['parent_id'] == 0 && in_array($ro['id'],$idArr))?'disabled="disabled"':'';
                }else{
                    $ro['disabled'] = '';
                }

                $data[$key]     = $ro;
            }
            !$tpl && $tpl = '<option value=\"{$id}\" {$disabled}>{$spacer}{$name}</option>';
        }
        $this->tree->init($data);
        return $this->tree->getTree(0, $tpl);
    }

    /**
     * 树形表格
     */
    public function toTable($data, $currentIds = [0], $tpl = '')
    {
        $this->tree->icon = ['&nbsp;&nbsp;│', '&nbsp;&nbsp;├─', '&nbsp;&nbsp;└─'];
        $this->tree->nbsp = '&nbsp;&nbsp;';
        if (!is_array($currentIds)) {
            $currentIds = [$currentIds];
        }
        foreach ($data as $key => $ro) {
            $data[$key]['checked'] = in_array($ro['id'], $currentIds) ? 'checked' : '';
        }
        $this->tree->init($data);
        !$tpl && $tpl = "<div class='layui-form-item'><input type='checkbox' name='category[\$id]' title='\$spacer \$name' value='\$id' data-name='\$name'  lay-skin='primary' \$checked></div>";
        return $this->tree->getTree(0, $tpl);
    }

    /**
     * 树形列表
     */
    public function toList($data, $tpl = '')
    {
        $this->tree->icon = ['&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ '];
        $this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        foreach ($data as $key => $ro) {
            $data[$key]['parent_id_node'] = ($ro['parent_id']) ? ' class="child-of-node-' . $ro['parent_id'] . '"' : '';
            $data[$key]['style']          = empty($ro['parent_id']) ? '' : 'display:none;';
            $data[$key]['str_manage']     = '<a class="layui-btn layui-btn-primary layui-btn-xs" data-events="add" data-id="' . $ro['id'] . '">添加子类</a>  <a class="layui-btn layui-btn-xs" data-events="edit" data-id="' . $ro['id'] . '">编辑</a>  <a class="layui-btn layui-btn-danger layui-btn-xs" data-events="del" data-id="' . $ro['id'] . '">删除</a>';
            $data[$key]['status']         = $ro['status'] ? '显示' : '隐藏';
        }
        $this->tree->init($data);
        if(!$tpl) {
            $tpl = "<tr id='node-\$id' \$parent_id_node style='\$style'>
                    <td style='padding-left:20px;'><input name='list_orders[\$id]' type='text' size='6' value='\$list_order' class='input input-order'></td>
                    <td>\$id</td>
                    <td>\$spacer\$name</td>
                    <td>\$status</td>
                    <td>\$str_manage</td>
                </tr>";
        }
        return $this->tree->getTree(0, $tpl);
    }

    /**
     * 树形选择列表
     */
    public function toCheckList($data, $tpl = '')
    {
        $this->tree->icon = ['│ ', '├─ ', '└─ '];
        $this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $new_data      = [];
        foreach ($data as $ro) {
            $new_data[$ro['id']] = $ro;
        }
        foreach ($data as $key => $ro) {
            $data[$key]['checked']      = $ro['checked'] ? ' checked' : '';
            $data[$key]['level']        = $this->getLevel($ro['id'], $new_data);
            $data[$key]['style']        = empty($ro['parent_id']) ? '' : 'display:none;';
            $data[$key]['parentIdNode'] = ($ro['parent_id']) ? ' class="child-of-node-' . $ro['parent_id'] . '"' : '';
        }
        if(!$tpl) {
            $tpl = "<tr id='node-\$id'\$parentIdNode  style='\$style'>
                    <td style='padding-left:30px;'>\$spacer<input type='checkbox' name='menu_id[\$id]' value='\$id' title='\$title' lay-skin='primary' level='\$level' \$checked></td>
                    </tr>";
        }
        $this->tree->init($data);
        return $this->tree->getTree(0, $tpl);
    }

    /**
     * 获取菜单深度
     * @param $id
     * @param array $array
     * @param int $i
     * @return int
     */
    protected function getLevel($id, $array = [], $i = 0)
    {
        if ($array[$id]['parent_id'] == 0 || empty($array[$array[$id]['parent_id']]) || $array[$id]['parent_id'] == $id) {
            return $i;
        } else {
            $i++;
            return $this->getLevel($array[$id]['parent_id'], $array, $i);
        }
    }

}