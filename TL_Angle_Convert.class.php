<?php
/**
 * 角度换算类
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
class TL_Angle_Convert{
    private $TL_Circle_Circumference = 1;//圆周
    private $TL_Radian = 6.2831855;//弧度
    private $TL_Milli_Radian = 6283.18548;//毫弧度
    private $TL_Degree = 360;//度
    private $TL_Right_Angle = 4;//直角
    private $TL_percentage_Degree = 399.99996;//百分度
    private $TL_Get_Seconds = 1296000;//秒
    private $TL_Get_Minutes = 21600;//分

    //算出圆周  根据圆周换其他
    function __construct($value){
        if(is_array($value)){
            $this->TL_Circle_Circumference = $value[1] / $this->$value[0];
        }else{
            $this->TL_Circle_Circumference = $value;
        }
    }
    function TL_Results(){
        $array = [
            'TL_Circle_Circumference' => $this->TL_Circle_Circumference,
            'TL_Radian' => $this->TL_Radian * $this->TL_Circle_Circumference,
            'TL_Milli_Radian' => $this->TL_Milli_Radian * $this->TL_Circle_Circumference,
            'TL_Degree' => $this->TL_Degree * $this->TL_Circle_Circumference,
            'TL_Right_Angle' => $this->TL_Right_Angle * $this->TL_Circle_Circumference,
            'TL_percentage_Degree' => $this->TL_percentage_Degree * $this->TL_Circle_Circumference,
            'TL_Get_Seconds' => $this->TL_Get_Seconds * $this->TL_Circle_Circumference,
            'TL_Get_Minutes' => $this->TL_Get_Minutes * $this->TL_Circle_Circumference,
        ];
        return $array;
    }
}