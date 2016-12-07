<?php
/**
 * 分页类  可以实现 单个表分页 和 联合查询分页
 * QQ:群515448139
 */
//                            _ooOoo_
//                           o8888888o
//                           88" . "88
//                           (| -_- |)
//                            O\ = /O
//                        ____/`---'\____
//                      .   ' \\| |// `.
//                       / \\||| : |||// \
//                     / _||||| -:- |||||- \
//                       | | \\\ - /// | |
//                     | \_| ''\---/'' | |
//                      \ .-\__ `-` ___/-. /
//                   ___`. .' /--.--\ `. . __
//                ."" '< `.___\_<|>_/___.' >'"".
//               | | : `- \`.;`\ _ /`;.`/ - ` : | |
//                 \ \ `-. \_ __\ /__ _/ .-` / /
//         ======`-.____`-.___\_____/___.-`____.-'======
//                            `=---='
//
//         .............................................
//                  佛祖保佑                  永无BUG
//          佛曰:
//                  写字楼里写字间，写字间里程序员；
//                  程序人员写程序，又拿程序换酒钱。
//                  酒醒只在网上坐，酒醉还来网下眠；
//                  酒醉酒醒日复日，网上网下年复年。
//                  但愿老死电脑间，不愿鞠躬老板前；
//                  奔驰宝马贵者趣，公交自行程序员。
//                  别人笑我忒疯癫，我笑自己命太贱；
//                  不见满街漂亮妹，哪个归得程序员？
//地址
//page::$url='';

//每页的条数 默认10
//page::$Page=1;

//每页显示的章 单数 1=1 2=3 4=5
//page::$perPage=8;

//需要查询的数据库
//page::$table='table1';

//需要联合查询的数据库 数组形式
//page::$Union=['table2','table3'];

//条件 数组形式 ['数据表'=>'条件'] where 唯默认
//page::$where=['where'=>'display = 1'];

//排序 数组形式 ['数据表'=>'id desc[升序|降序]'] orderby 唯默认
//page::$order=['orderby'=>'id desc'];

//需要查询的字段 数组形式 ['数据表' => '字段 [字符串形式]'] 默认 *
//page::$fields=['table1'=>'id,title','table2'=>'id,title','table3'=>'id,title'];

//获取分页
//$list = page::page();

//获取数据
//$data=page::$data
class TL_Pagination{
    public static $conn;

    public static $result;                  //数据库资源
    /**
     * @var array mysqli链接配置
     */
    public static $Mysql_config=[
        'server'=>'localhost',              //服务器 链接地址 默认localhost
        'user'=>'root',                     //用户名 默认root
        'pwd'=>'root',                      //密码
        'name'=>'table',                 //数据库名称
        'character' => 'utf8_general_ci',   //数据库字符集
    ];

    public static $links;       //分页资源

    public static $sql;         //被执行的sql

    public static $data;        //数据资源

    public static $url;         //链接地址  处域名之外之后的所有参数 默认此网站域名

    public static $Theurl;      //网站域名

    public static $total=0;     //总条数

    public static $Page=10;      //每页显示的条数

    public static $perPage=11;   //每页显示的章 单数 1=1 2=3 4=5

    public static $count;       //共多少页

    public static $table;       //被分页的表

    /**
     * @var array
     * 使用联合查询 字段必须一样
     * ['需要条件的字段'=>'字符串形式','where-所有的都一样'=>'字符串形式']
     */
    public static $where=[
        'where'=>'0=0'
    ];                           //条件

    /**
     * @var array
     * ['表1','表2']
     */
    public static $Union=[];     //联合查询

    /**
     * @var array
     * 使用联合查询 字段必须一样
     * ['要查询的字段']
     */
    public static $fields=[];    //字段

    /**
     * @var array 数组类型
     * [键值数据表 => 字段 升序|降序]
     * $order['orderby'] 是放在最后的排序
     */
    public static $order = [];   //排序

    public static $firstItemUrlClassno = "<li class='disabled'><span>««</span></li>";//如果没有最前一项
    public static $firstItemUrlClasslt = "<li><a href='";//最前一项标签开始
    public static $firstItemUrl;//最前一项
    public static $firstItemUrlClassgt = "' rel='prev'>««</a></li>";//最前一项标签结尾

    public static $nextPageUrlClassno = "<li class='disabled'><span>«</span></li>";//如果没有上一页
    public static $nextPageUrlClasslt = "<li><a href='";//上一页标签开始
    public static $nextPageUrl;//上一页
    public static $nextPageUrlClassgt = "' rel='prev'>«</a></li>";//上一页标签结尾

    public static $beforeandafterUrlClasslt="<li><a href='";//当前页码之前 和 当前页码之后开始
    public static $beforePageUrlsize=0;//当前页码之前页数
    public static $beforePageUrl;//当前页码之前
    public static $afterPageUrl;//当前页码之后
    public static $afterPageUrlsize=0;//当前页码之后页数
    public static $beforeandafterUrlClassgt="</a></li>";//当前页码之前 和 当前页码之后结尾

    public static $currentPageUrlClasslt = "<li class='active'><span style='color:#ffffff'>";//当前页码标签开始
    public static $currentPage;//当前页码
    public static $currentPageUrl;//当前
    public static $currentPageUrlClassgt = "</span></li>";//当前页码标签结尾

    public static $comprehensiveUrlClasslt="<li><a href='";//如果每页显示的分页数量大于或者等于总数量的时候直接调用他组合
    public static $comprehensiveUrl;//如果每页显示的分页数量大于或者等于总数量的时候直接调用他组合
    public static $comprehensiveUrlClassgt="</a></li>";//如果每页显示的分页数量大于或者等于总数量的时候直接调用他组合

    public static $previousPageUrlClassno = "<li class='disabled'><span>»</span></li>";//如果没有下一页
    public static $previousPageUrlClasslt = "<li><a href='";//下一页标签开始
    public static $previousPageUrl;//下一页
    public static $previousPageUrlClassgt = "' rel='next'>»</a></li>";//下一页标签结尾

    public static $lastItemUrlClassno = "<li class='disabled'><span>»»</span></li>";//如果没有最前一项
    public static $lastItemUrlClasslt = "<li><a href='";//最前一项标签开始
    public static $lastItemUrl;//最后一页
    public static $lastItemUrlClassgt = "' rel='prev'>»»</a></li>";//最后一页标签结尾


    public static $hasMorePages="<li class='disabled'><a href='javascript:;'>...</a></li>";//更多的页码
    public static $hasMorePagesleft; //左侧更多的页码
    public static $hasMorePagesright;//右侧更多的页码
    public static function page(){
        self::$currentPage=isset($_GET['page']) ? $_GET['page'] : "1";
        self::$Theurl = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ;//网址
        self::mysqli();         //链接数据库
        self::data();           //数据资源
        self::total();          //总条数
        self::count();          //共多少页

        self::firstItemUrl();       //最前一项
        self::nextPageUrl();        //上一页
        if(self::$count>self::$perPage){
            self::leftandright();       //左边右边显示多少条处理
            self::beforePageUrl();      //当前页码之前
            self::currentPageUrl();     //当前页码
            self::afterPageUrlsize();   //当前页码之后
        }else{
            self::comprehensive();      //综合全部显示
        }
        self::previousPageUrl();    //下一页
        self::lastItemUrl();        //最后一项

        if(self::$count>self::$perPage){
            return self::combination(); //组合
        }else{
            return self::combinations(); //组合
        }
    }

    public static function combinations(){
        return self::$firstItemUrl .    //最前一项
        self::$nextPageUrl .            //上一页
        self::$comprehensiveUrl .         //中间页码
        self::$previousPageUrl .        //下一页
        self::$lastItemUrl;             //最后一项
    }

    public static function combination(){
        return self::$firstItemUrl .    //最前一项
        self::$nextPageUrl .            //上一页
        self::$hasMorePagesleft .       //左侧更多页码
        self::$beforePageUrl .          //当前页码之前
        self::$currentPageUrl .         //当前页码
        self::$afterPageUrl .           //当前页码之后
        self::$hasMorePagesright .      //右侧更多页码
        self::$previousPageUrl .        //下一页
        self::$lastItemUrl;             //最后一项
    }

    public static function mysqli(){
        self::$conn = mysqli_connect(!empty(self::$Mysql_config['server']) ? self::$Mysql_config['server'] : 'localhost' , !empty(self::$Mysql_config['user']) ? self::$Mysql_config['user'] : 'root' , self::$Mysql_config['pwd']);
        mysqli_select_db(self::$conn,self::$Mysql_config['name']);
        mysqli_query(self::$conn,!empty($Mysql_config['character']) ? $Mysql_config['character'] : 'utf8_general_ci');
    }

    //的出sql语句
    public static function data(){
        //判断是否有 条件 如果没有 null
        $order = isset(self::$order[self::$table]) ? " ORDER BY " . self::$order[self::$table]:null;
        //判断是否有 字段 如果没有 *
        $field = isset(self::$fields[self::$table]) ? self::$fields[self::$table] : '*';
        //判断是否有 条件 如果没有 where 0=0
        $where = isset(self::$where[self::$table]) ? self::$where[self::$table] : " WHERE " . self::$where['where'];
        //第一条sql语句
        self::$sql = "(SELECT " . $field . " FROM " . self::$table . $where . $order . ")";
        //循环对接sql
        foreach (self::$Union as $key => $value){
            //判断是否有 条件 如果没有 null
            $order = isset(self::$order[$value]) ? " ORDER BY " . self::$order[$value]:null;
            //判断是否有 条件 如果没有 where 0=0
            $where = isset(self::$where[$value]) ? self::$where[$value] : " WHERE " . self::$where['where'];
            //判断是否有 字段 如果没有 *
            $field = isset(self::$fields[$value]) ? self::$fields[$value] : '*';
            //sql语句拼接
            self::$sql .=" union (SELECT " . $field . " FROM " . $value . $where . $order . ")";
        }

        //判断 是否有排序
        if(isset(self::$order['orderby'])){
            self::$sql .= " ORDER BY " . self::$order['orderby'];
        }
        //执行的sql语句
        self::$sql .= " limit " . ((self::$currentPage-1) * self::$Page) . "," . self::$Page;
        //返回结果
        self::$data = self::Mysql_query(self::$sql);
    }

    //获取总条数
    public static function total(){
        //判断是否有 条件 如果没有 where 0=0
        $where = isset(self::$where[self::$table]) ? self::$where[self::$table]:" WHERE ".self::$where['where'];
        //第一条sql语句
        $sql = "(SELECT count(*) as num FROM " . self::$table . $where .")";
        foreach (self::$Union as $key => $value){
            //判断是否有 条件 如果没有 where 0=0
            $where = isset(self::$where[$value]) ? self::$where[$value]:" WHERE " . self::$where['where'];
            //sql语句拼接
            $sql .=" union (SELECT count(*) as num FROM " . $value . $where . ")";
        }
        $array = self::Mysql_query($sql);
        foreach ($array as $key=>$value){
            self::$total=self::$total+$value['num'];
        }
    }

    //共多少页
    public static function count(){
        $count = self::$total / self::$Page;
        self::$count = ceil($count);
    }

    //最前一页
    public static function firstItemUrl(){
        if(self::$currentPage == 1){
            self::$firstItemUrl = self::$firstItemUrlClassno;
        }else{
            self::$firstItemUrl = self::$firstItemUrlClasslt . self::$Theurl . self::$url . "?page=1". self::$firstItemUrlClassgt;
        }
    }

    //最后一项
    public static function lastItemUrl(){
        if(self::$currentPage == self::$count){
            self::$lastItemUrl = self::$lastItemUrlClassno;
        }else{
            self::$lastItemUrl = self::$lastItemUrlClasslt . self::$Theurl . self::$url . "?page=" . self::$count  . self::$lastItemUrlClassgt;
        }
    }

    //上一页
    public static function nextPageUrl(){
        if(self::$currentPage == 1){
            self::$nextPageUrl = self::$nextPageUrlClassno;
        }else{
            $next = self::$currentPage - 1;
            self::$nextPageUrl = self::$nextPageUrlClasslt . self::$Theurl . self::$url . "?page=" . $next . self::$nextPageUrlClassgt;
        }
    }

    //下一页
    public static function previousPageUrl(){
        if(self::$currentPage == self::$count){
            self::$previousPageUrl = self::$previousPageUrlClassno;
        }else{
            $previous = self::$currentPage + 1;
            self::$previousPageUrl = self::$previousPageUrlClasslt . self::$Theurl . self::$url . "?page=" . $previous . self::$previousPageUrlClassgt;
        }
    }

    //当前页码
    public static function currentPageUrl(){
        self::$currentPageUrl = self::$currentPageUrlClasslt . self::$currentPage . self::$currentPageUrlClassgt;
    }

    //如果每页显示的分页数量大于或者等于总数量的时候直接调用他组合
    public static function comprehensive(){
        for($i=1;$i<self::$count+1;$i++){
            if($i==self::$currentPage){
                self::$comprehensiveUrl .= self::$currentPageUrlClasslt . self::$currentPage . self::$currentPageUrlClassgt;
            }else{
                self::$comprehensiveUrl .= self::$comprehensiveUrlClasslt . self::$Theurl . self::$url . "?page=" . $i . "'>" . $i . self::$comprehensiveUrlClassgt;
            }
        }
    }

    //当前页之前
    public static function beforePageUrl(){
        for($i=(self::$currentPage-self::$beforePageUrlsize);$i<self::$currentPage&&$i>0;$i++){
            self::$beforePageUrl .= self::$beforeandafterUrlClasslt . self::$Theurl . self::$url . "?page=" . $i . "'>" . $i . self::$beforeandafterUrlClassgt;
        }
        if((self::$currentPage-self::$beforePageUrlsize-1)>1){
            self::$hasMorePagesleft=self::$hasMorePages;
        }
    }

    //当前页之后
    public static function afterPageUrlsize(){
        for($i=(self::$currentPage+1);$i<(self::$currentPage+self::$afterPageUrlsize+1)&&$i<self::$count+1;$i++){
            self::$afterPageUrl.=self::$beforeandafterUrlClasslt. self::$Theurl . self::$url . "?page=" . $i . "'>" . $i . self::$beforeandafterUrlClassgt;
        }
        if((self::$currentPage+self::$afterPageUrlsize+1)<self::$count){
            self::$hasMorePagesright=self::$hasMorePages;
        }
    }

    //左边右边显示多少条处理
    public static function leftandright(){
        if(self::$perPage%2 == 0) self::$perPage++;
        $perPage = (self::$perPage-1) / 2;
        $beforePageUrl = $perPage;
        $afterPageUrl = $perPage;
        //左边
        if(self::$currentPage == 1){
            //给右边页码 + $afterPageUrl
            $afterPageUrl = $afterPageUrl + $beforePageUrl;
            //左边0
            $beforePageUrl = 0;
        }elseif(self::$currentPage - $beforePageUrl > 0){
            $beforePageUrl = $beforePageUrl;
        }elseif(self::$currentPage == $beforePageUrl) {
            $beforePageUrl = $beforePageUrl - 1;
            $afterPageUrl = $afterPageUrl + 1;
        }else{
            $afterPageUrl = $afterPageUrl + ($beforePageUrl - ($beforePageUrl-self::$currentPage));
            $beforePageUrl = $beforePageUrl + (self::$currentPage - $beforePageUrl-1);
        }
        //右边
        if(self::$currentPage == self::$count){
            //给右页码 + $afterPageUrl
            $beforePageUrl = $beforePageUrl + $afterPageUrl;
            $afterPageUrl = 0;
        }elseif(self::$currentPage+$afterPageUrl < self::$count){
            $afterPageUrl = $afterPageUrl;
        }elseif(self::$currentPage + $afterPageUrl == self::$count){
            $afterPageUrl = $afterPageUrl;
        }else{
            $beforePageUrl = $afterPageUrl - (self::$count - ($afterPageUrl + self::$currentPage));
            $afterPageUrl = ($afterPageUrl + self::$currentPage) - self::$count;
        }
        self::$beforePageUrlsize = $beforePageUrl;
        self::$afterPageUrlsize = $afterPageUrl;

    }

    /**
     * 执行一条sql语句
     * @param  [type] $sql [description] sql语句
     * @return [type]      [description]
     */
    public static function Mysql_query($sql=""){
        if(!empty($sql)){
            $result=mysqli_query(self::$conn,$sql);
            self::$result = $result;
            return self::Mysql_array(self::$result);
        }
    }

    /**
     * 返回一个二维数组
     * @param [type] $array [description] 执行过的sql语句
     */
    public static function Mysql_array($array=""){
        if(!empty($array)){
            $result=array();
            while($row = mysqli_fetch_array($array,MYSQLI_ASSOC)){
                $result[] = $row;
            }
            return self::conversion($result,'gb2312','utf-8');
        }
    }
    /**
     * [encodeConvert description] 字符集转换
     * @param  [type] $str      [description] 数组
     * @param  [type] $fromCode [description] gb2312
     * @param  [type] $toCode   [description] utf-8
     * @return [type]           [description]
     */
    public static function conversion($str,$fromCode,$toCode){
        if(strtoupper($toCode) == strtoupper($fromCode)) return $str;
        if(is_string($str)){
            if(function_exists('mb_convert_encoding')){
                return mb_convert_encoding($str,$toCode,$fromCode);
            }
            else{
                return iconv($fromCode,$toCode,$str);
            }
        }elseif(is_array($str)){
            foreach($str as $k=>$v){
                $str[$k] = self::conversion($v,$fromCode,$toCode);
            }
            return $str;
        }
        return $str;
    }

    //释放资源
    public static function Mysql_rows_result(){
        return mysqli_free_result(self::$result);
    }

    //析构函数，自动关闭数据库,垃圾回收机制
    public function __destruct(){
        if(!empty(self::$result)){
            self::Mysql_rows_result();
        }
        return mysqli_close(self::$conn);
    }
}