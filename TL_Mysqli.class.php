<?php
/**
 * mysqli类
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
/**
 * __construct($Mysql_config) 构造函数 $Mysql_config['server']服务器-$Mysql_config['user']用户名-$Mysql_config['pwd']密码-$Mysql_config['name']数据库名字-$Mysql_config['character']字符集
 * Mysql_alter_drop($table,$name) 删除一个字段 $table表明 $name字段名
 * Mysql_alter_add($table,$name,$type) 添加一个字段 $table表明 $name字段名 $type字段类型
 * Mysql_instert($data="",$name="") 添加一条数据 $data数组格式的数据简直跟数据库字段一致 $name表明
 * Mysql_insert_id() 取得上一步 INSERT 操作产生的 ID
 * Mysql_delete($name="",$where="") 删除数据 $name表明 $where条件
 * Mysql_update($name="",$data="",$where="") 修改一条语句 $name 表明 $data数组格式的数据简直跟数据库字段一致 $where条件
 * Mysql_query($sql="") 执行一条sql语句 $sql 语句
 * Mysql_array($array="") 返回一个二维数组 $array 上一条查询的返回值
 * Mysql_json_encode($数组,$fromCode="gb2312",$toCode="utf-8") 数组转换json 
 * Mysql_rows() 返回相应的条数
 * Mysql_rows_result() 释放资源
 * function __destruct() 析构函数 自动关闭书库
 */
class Mysql{
	private $conn;
	private $result;

	/*构造函数*/
	public function __construct($Mysql_config){
		if(is_array($Mysql_config)){
			$this->conn = mysqli_connect(!empty($Mysql_config['server'])?$Mysql_config['server']:'localhost',!empty($Mysql_config['user'])?$Mysql_config['user']:'root',$Mysql_config['pwd']);
			mysqli_select_db($this->conn,$Mysql_config['name']);
			mysqli_query($this->conn,!empty($Mysql_config['character'])?$Mysql_config['character']:'utf8_general_ci');
		}
    }

    /**
     * 删除一个字段
     * @param [type] $table [description] 表明
     * @param [type] $name  [description] 字段名
     */
    public function Mysql_alter_drop($table,$name){
    	$sql = "alter table ".$table." drop column ".$name."";
    	$this->Mysql_query($sql);
    	return $sql;
    }

    /**
     * 添加一个字段
     * @param [type] $table [description] 表明
     * @param [type] $name  [description] 字段名
     * @param [type] $type  [description] 类型/位数
     */
    public function Mysql_alter_add($table,$name,$type){
    	$sql = "alter table ".$table." add ".$name." ".$type." ";
    	$this->Mysql_query($sql);
    	return $sql;
    }

    /**
     * 添加一条数据 
     * @param  [type] $data  [description] 数据
     * @param  [type] $name  [description] 数据库名字
     * @return [type]        [description]
     */
    public function Mysql_instert($data="",$name=""){
    	if(is_array($data) && !empty($name)){
    		$key = "";
			$value = "";
			foreach ($data as $keys => $values){
				$key = $key . "`" . $keys . "`,";
				$value = $value . "'" . $values. "',";
			}
			$key = substr($key,0,-1);
			$value = substr($value,0,-1);

			$sql = "INSERT INTO ".$name." (".$key.") VALUES (".$value.")";
			$this->Mysql_query($sql);
			return $sql;
    	}else{
    		$sql = "Mysql_instert(不是一个数组,表名称)";
    		return $sql;
    	}
    }

    /*取得上一步 INSERT 操作产生的 ID*/
    public function Mysql_insert_id() {
        return mysqli_insert_id($this->conn);
    }

    /**
     * 删除数据
     * @param [type] $name  [description] 表名称
     * @param [type] $where [description] 条件
     */
    public function Mysql_delete($name="",$where=""){
    	if(!empty($name) && !empty($where)){
			$sql = "delete from ".$name." where ".$where;
	    	$this->Mysql_query($sql);
			return $sql;
    	}else{
    		$sql = "Mysql_delete(表名称,数据库条件)";
    		return $sql;
    	}
    	
    }

    /**
     * 修改一条语句
     * @param [type] $name  [description] 表名称
     * @param [type] $data  [description] 数据
     * @param [type] $where [description] 条件
     */
    public function Mysql_update($name="",$data="",$where=""){
    	if(is_array($data)){
    		$datas = "";
			foreach ($data as $keys => $values){
				$datas = $datas . $keys . "='" . $values ."',";
			}
	    	$sql = "update ".$name." set ".substr($datas,0,-1)." where ".$where;
	    	$this->Mysql_query($sql);
	    	return $sql;
    	}else{
    		$sql = "Mysql_update(表名称,数据,条件)";
    		return $sql;
    	}
    }

    /**
     * 执行一条sql语句
     * @param  [type] $sql [description] sql语句
     * @return [type]      [description]
     */
    public function Mysql_query($sql=""){
    	if(!empty($sql)){
	    	$result=mysqli_query($this->conn,$sql);
	    	return $this->result = $result;
    	}else{
    		$result = "Mysql_query(mysql语句)";
    		return $result;
    	}
    }

    /**
     * 返回一个二维数组
     * @param [type] $array [description] 执行过的sql语句
     */
    public function Mysql_array($array=""){
    	if(!empty($array)){
            $result=array();
	    	while($row = mysqli_fetch_array($array,MYSQLI_ASSOC)){
				$result[] = $row;
			}
			return $result;
    	}else{
    		$_array = array('Mysql_array(执行过的sql语句)');
    		return $_array;
    	}
    }

    /**
     * [encodeConvert description] 转换json
     * @param  [type] $str      [description] 数组
     * @param  [type] $fromCode [description] gb2312
     * @param  [type] $toCode   [description] utf-8
     * @return [type]           [description]
     */
    function Mysql_json_encode($str,$fromCode,$toCode){
        if(strtoupper($toCode) == strtoupper($fromCode)) return $str;
        if(is_string($str)){
            if(function_exists('mb_convert_encoding')){  
                return mb_convert_encoding($str,$toCode,$fromCode);  
            }  
            else{  
                return iconv($fromCode,$toCode,$str);  
            }  
        }
        elseif(is_array($str)){           
            foreach($str as $k=>$v){               
                $str[$k] = $this->Mysql_json_encode($v,$fromCode,$toCode);
            }  
            return $str;
        }  
        return $str;  
    }
    
    /**
     * 返回受相应的条数
     */
    public function Mysql_rows(){
    	return mysqli_affected_rows($this->conn);
    }

    //释放资源
    public function Mysql_rows_result(){
       return mysqli_free_result($this->result);
    }

    //析构函数，自动关闭数据库,垃圾回收机制
    public function __destruct() {
        if (!empty($this->result)) {
            $this->Mysql_rows_result();
        }
        return mysqli_close($this->conn);
    }
}
$Mysql_config = array(
	'server' => 'localhost',//规定要连接的服务器。
	'user' => 'root',//用户名。默认值是服务器进程所有者的用户名。
	'pwd' => '9803164',//密码。默认值是空密码。
	'name' => 'test',//数据库名字
	'character' => 'utf8_general_ci',//字符集
);
$Mysql = new Mysql($Mysql_config);