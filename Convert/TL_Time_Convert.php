<?php
/**
 * 时间换算 
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
class TL_Time_Convert{
    private $TL_Years = 0.0027397260273973;//年
    private $TL_Weeks = 0.1428571428571429;//周
    private $TL_Day = 1;//天
    private $TL_Hours = 24;//时
    private $TL_Min = 1440;//分
    private $TL_Seconds = 86400;//秒
    private $TL_Ms = 8640000;//毫秒
    //算出天数  根据圆周换其他
    function __construct($value){
        if(is_array($value)){
            $this->TL_Day = $value[1] / $this->$value[0];
        }else{
            $this->TL_Day = $value;
        }
    }
    function TL_Results(){
        $array = [
            'TL_Day' => $this->TL_Day,
            'TL_Years' => $this->TL_Years * $this->TL_Day,
            'TL_Weeks' => $this->TL_Weeks * $this->TL_Day,
            'TL_Hours' => $this->TL_Hours * $this->TL_Day,
            'TL_Min' => $this->TL_Min * $this->TL_Day,
            'TL_Seconds' => $this->TL_Seconds * $this->TL_Day,
            'TL_Ms' => $this->TL_Ms * $this->TL_Day,
        ];
        return $array;
    }
}