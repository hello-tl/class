<?php
/**
 * 常用操作
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
class TL_Functions{
    /**
     * 数组转换对象
     * @param $array 数组
     * @return StdClass 对象
     */
    public function Array_Turn_Object($array){
        if (is_array($array)) {
            $obj = new StdClass();
            foreach ($array as $key => $val){
                $obj->$key = $val;
            }
        }else{
            $obj = $array;
        }
        return $obj;
    }

    /**
     * 对象转换数组
     * @param $object 对象
     * @return mixed 数组
     */
    public function Object_Turn_Array($object){
        if(is_object($object)){
            foreach($object as $key => $value){
                $array[$key] = $value;
            }
        }else{
            $array = $object;
        }
        return $array;
    }

    /**
     * 转换字节大小
     * @param  [type] $size [description] 数值 Byte
     * @return [type]       [description] 返回 大小
     */
    public function Trans_Byte($size='0'){
        //Bytes/KB/MB/GB/TB/EB/
        $arr = array('B','KB','MB','GB','TB','EB');
        $i   = 0;
        while($size>1024){
            $size/=1024;
            $i++;
        }
        $size = round($size,2).$arr[$i];
        return $size;
    }

    /**
     * 返回linux微妙时间戳
     * @return float 时间戳
     */
    public function My_Micro_Time(){
        //microtime 返回linux时间的微妙数
        list($usec, $sec) = explode(" ",microtime());
        return ((float)$usec + (float)$sec);
    }

    /**
     * [transByte description] 转换字节大小
     * @param  [type] $size [description] 数值 Byte
     * @return [type]       [description] 返回 大小
     */
    public function transByte($size='0'){
        //Bytes/KB/MB/GB/TB/EB/
        $arr = array('B','KB','MB','GB','TB','EB');
        $i = 0;
        while($size>1024){
            $size/=1024;
            $i++;
        }
        $size = round($size,2).$arr[$i];
        return $size;
    }

    /**
     * 获取当前网速
     * @return float 网速
     */
    public function Network(){
        //查询文件内容
        $data       = file_get_contents(LONG."network.txt");
        //filesize 返回字节大小
        $fsize      = $this->transByte(filesize(LONG."network.txt"));
        //获取输出前的时间
        $start      = mymicrotime();
        //echo $fsize;
        echo "<!--".$data."-->";
        //获取输出后的时间
        $stop       = self::mymicrotime();
        //输入内容前时间 - 输出内容后时间 s
        $duration   = ($stop-$start);
        //四舍五入
        $speed      = round($fsize/$duration,2);
        return $speed;
    }

    /**
     * [getDistance description] 计算 距离
     * @param  [type] $lat1 [description] 当前位置精度
     * @param  [type] $lng1 [description] 当前位置维度
     * @param  [type] $lat2 [description] 店家位置精度
     * @param  [type] $lng2 [description] 店家位置维度
     * @return [type]       [description] 返回距离长度 单位是
     */
    public function Get_Distance($lat1, $lng1, $lat2, $lng2){
        $earthRadius = 6378138; //近似地球半径米
        // 转换为弧度
        $lat1 = ($lat1 * pi()) / 180;
        $lng1 = ($lng1 * pi()) / 180;
        $lat2 = ($lat2 * pi()) / 180;
        $lng2 = ($lng2 * pi()) / 180;
        // 使用半正矢公式  用尺规来计算
        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;
        return round($calculatedDistance);
    }

    /**
     * [get description] 百度地图地址逆解析
     * @return [type] [description]
     */
    public function Map_Baidu_Inverse($address){
        $address = $address;
        $url='http://api.map.baidu.com/geocoder/v2/?address='.$address.'&output=json&ak=t1DwS0Gq35mHDqd75uGS1bfnMxRdzNqW';
        $html       = file_get_contents($url);
        $arr        = json_decode($html);
        $array['x'] = $arr->result->location->lng;
        $array['y'] = $arr->result->location->lat;
        return json_encode($array);
    }

    /**
     * [get description] 百度地图地址ip解析
     * @return [type] [description]
     */
    public function Map_Baidu_Ip($ip){
        $ip = $ip;
        $url='http://api.map.baidu.com/location/ip?ak=t1DwS0Gq35mHDqd75uGS1bfnMxRdzNqW&ip='.$ip;
        $html       = file_get_contents($url);
        return $html;
    }

    /**
     * 时间差计算
     *
     * @param Timestamp 时间差的时间戳
     * @return String Time Elapsed
     */
    public function Time_Turn_Units ($time){
        $year   = floor($time / 60 / 60 / 24 / 365);
        $time  -= $year * 60 * 60 * 24 * 365;
        $month  = floor($time / 60 / 60 / 24 / 30);
        $time  -= $month * 60 * 60 * 24 * 30;
        $week   = floor($time / 60 / 60 / 24 / 7);
        $time  -= $week * 60 * 60 * 24 * 7;
        $day    = floor($time / 60 / 60 / 24);
        $time  -= $day * 60 * 60 * 24;
        $hour   = floor($time / 60 / 60);
        $time  -= $hour * 60 * 60;
        $minute = floor($time / 60);
        $time  -= $minute * 60;
        $second = $time;
        $elapse = '';
        $unitArr = array(
            '年'  =>'year',
            '个月'=>'month',
            '周'=>'week',
            '天'=>'day',
            '小时'=>'hour',
            '分钟'=>'minute',
            '秒'=>'second'
        );
        foreach($unitArr as $cn => $u){
            if($$u>0){
                $elapse = $$u . $cn;
                break;
            }
        }
        return $elapse;
    }

    /**
     * 模拟提交参数，支持https提交 可用于各类api请求
     * @param string $url ： 提交的地址
     * @param array $data :POST数组
     * @param string $method : POST/GET，默认GET方式
     * @return mixed
     */
    public function getHttps($url, $data = '', $method = 'GET'){
        $curl = curl_init();                                                // 启动一个CURL会话608.69565217391
        curl_setopt($curl, CURLOPT_URL, $url);                              // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);                  // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);                  // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);                      // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);                         // 自动设置Referer
        if($method=='POST'){
            curl_setopt($curl, CURLOPT_POST, 1);                            // 发送一个常规的Post请求
            if ($data != ''){
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);              // Post提交的数据包
            }
        }
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);                            // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0);                              // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);                      // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl);                                        // 执行操作
        curl_close($curl);                                                  // 关闭CURL会话
        return $tmpInfo;                                                    // 返回数据
    }

    /**
     * @param $data 传入时间年月日
     * @return string 本月第一周开始时间
     */
    public function MstartDate($data){
        $startDate = date("Y-m-",strtotime($data))."01";
        $w = date('w',strtotime(date("Y-m-",strtotime($startDate))."01"));
        if($w != "1"){
            $s = 9 - $w;
            $startDate = date("Y-m",strtotime($startDate)) . "-0" . $s;
        }
        return $startDate;
    }

    /**
     * @param $data 传入时间年月日
     * @return false|string 本月最后一周结束时间
     */
    public function MendDate($data){
        $endDate = date("Y-m-",strtotime($data)) . date("t");
        $e = date('w',strtotime(date("Y-m-",strtotime($endDate)) . date("t")))."<br>";
        if($e != "7"){
            $e = 7 - $e;
            $endDate = date('Y-m-d',strtotime($endDate . " +".$e."day"));
        }
        return $endDate;
    }

    /**
     * @param $data 传入时间年月日
     * @return array 本周的开始时间和结束时间
     */
    public function Wee($data){
        //本周的第一天和最后一天
        $date=new DateTime($data);
        $date->modify('this week');
        $first_day_of_week = $date->format('Y-m-d');
        $date->modify('this week +6 days');
        $end_day_of_week = $date->format('Y-m-d');
        return array('first_day_of_week'=>$first_day_of_week,'end_day_of_week'=>$end_day_of_week);
    }
}