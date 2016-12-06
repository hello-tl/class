<?php
namespace App\Http\Controllers\libraries;
use Illuminate\Support\Facades\DB;
class page{
    public static $total;//总条数

    public static $perPage=5;//每页显示的章数

    public static $count;//共多少页

    public static $firstItem;//最前一项

    public static $nextPageUrl;//上一页

    public static $currentPage;//当前页码

    public static $previousPageUrl;//下一页

    public static $lastItem;//最后一页

    public static $hasMorePages;//更多的页码

    public static $table;//被分页的表

    /**
     * @var array
     * 使用联合查询 字段必须一样
     * ['需要条件的字段'=>'字符串形式','where-所有的都一样'=>'字符串形式']
     */
    public static $where=['where'=>'0=0'];//条件

    /**
     * @var array
     * ['表1','表2']
     */
    public static $Union=[];//联合查询

    /**
     * @var array
     * 使用联合查询 字段必须一样
     * ['要查询的字段']
     */
    public static $fields=[];//字段

    /**
     * @var array 数组类型
     * [键值数据表 => 字段 升序|降序]
     * $order['orderby'] 是放在最后的排序
     */
    public static $order = [];//排序

    public static function items(){
        $field = isset(self::$fields[self::$table])?self::$fields[self::$table]:'*';
        $sql = "(SELECT ".$field." FROM ".self::$table.")";
        foreach (self::$Union as $key => $value){
            //判断是否有 条件 如果没有 where 0=0
            $order = isset(self::$order[$value])?" ORDER BY ".self::$order[$value]:null;
            //判断是否有 条件 如果没有 where 0=0
            $where = isset(self::$where[$value])?self::$where[$value]:" WHERE ".self::$where['where'];
            //判断是否有 字段 如果没有 *
            $field = isset(self::$fields[$value])?self::$fields[$value]:'*';
            //sql语句拼接
            $sql .=" union (SELECT ".$field." FROM ".$value . $where . $order .")";
        }

        //判断 是否有排序
        if(isset(self::$order['orderby'])){
            $sql .= " ORDER BY ".self::$order['orderby'];
        }
        return $sql;
    }
}


