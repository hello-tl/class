<?php
/**
 * 长度换算
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
class TL_Length_Convert{
    private $TL_Km = 1;//公里
    private $TL_M = 1000;//米
    private $TL_Dm = 10000;//分米
    private $TL_Cm = 100000;//厘米
    private $TL_Mm = 1000000;//毫米
    private $TL_Silk = 10000000;//丝
    private $TL_Micron = 1000000000;//微米
    private $TL_In_The = 2;//里
    private $TL_Zhang = 300;//丈
    private $TL_Chi = 3000;//尺
    private $TL_Cun = 30000;//寸
    private $TL_Points = 300000;//分
    private $TL_Li = 3000000;//厘
    private $TL_Sea = 0.54;//海里
    private $TL_Fathom = 546.8066;//英寻
    private $TL_Miles = 0.6214000000000001;//英里
    private $TL_Furlong = 4.971;//弗隆
    private $TL_Code = 1093.6133;//码
    private $TL_Feet = 3280.8399;//英尺
    private $TL_Inches = 39370.0787;//英寸
    private $TL_Nano = 1000000000000;//纳米
    //算出公里  根据公里换其他
    function __construct($value){
        if(is_array($value)){
            $this->TL_Km = $value[1] / $this->$value[0];
        }else{
            $this->TL_Km = $value;
        }
    }
    function TL_Results(){
        $array = [
            'TL_Km' => $this->TL_Km,
            'TL_M' => $this->TL_M * $this->TL_Km,
            'TL_Dm' => $this->TL_Dm * $this->TL_Km,
            'TL_Cm' => $this->TL_Cm * $this->TL_Km,
            'TL_Mm' => $this->TL_Mm * $this->TL_Km,
            'TL_Silk' => $this->TL_Silk * $this->TL_Km,
            'TL_Micron' => $this->TL_Micron * $this->TL_Km,
            'TL_In_The' => $this->TL_In_The * $this->TL_Km,
            'TL_Zhang' => $this->TL_Zhang * $this->TL_Km,
            'TL_Chi' => $this->TL_Chi * $this->TL_Km,
            'TL_Cun' => $this->TL_Cun * $this->TL_Km,
            'TL_Points' => $this->TL_Points * $this->TL_Km,
            'TL_Li' => $this->TL_Li * $this->TL_Km,
            'TL_Sea' => $this->TL_Sea * $this->TL_Km,
            'TL_Fathom' => $this->TL_Fathom * $this->TL_Km,
            'TL_Miles' => $this->TL_Miles * $this->TL_Km,
            'TL_Furlong' => $this->TL_Furlong * $this->TL_Km,
            'TL_Code' => $this->TL_Code * $this->TL_Km,
            'TL_Feet' => $this->TL_Feet * $this->TL_Km,
            'TL_Inches' => $this->TL_Inches * $this->TL_Km,
            'TL_Nano' => $this->TL_Nano * $this->TL_Km,
        ];
        return $array;
    }
}