<?php
/**
 * 速度转换
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
class TL_Speed_Convert{
    private $TL_M = 1;//米/秒
    private $TL_Km_H = 3.6;//千米/时
    private $TL_inches = 39.370079;//英寸/秒
    private $TL_Km_S = 0.001;//千米/秒
    private $TL_Speed_Of_Light = 299796138.6257345;//光速
    private $TL_Mach = 0.0029386;//马赫
    private $TL_Miles = 2.236936;//英里/时
    function TL_Convert($value){
        if(is_array($value)){
            $this->TL_Speed_Of_Light = $value[1] / $this->$value[0];
        }else{
            $this->TL_Speed_Of_Light = $value;
        }
    }
    function TL_Results(){
        $array = [
            'TL_Speed_Of_Light' => $this->TL_Speed_Of_Light,
            'TL_Km_H' => $this->TL_Km_H * $this->TL_Speed_Of_Light,
            'TL_inches' => $this->TL_inches * $this->TL_Speed_Of_Light,
            'TL_Km_S' => $this->TL_Km_S * $this->TL_Speed_Of_Light,
            'TL_M' => $this->TL_M * $this->TL_Speed_Of_Light,
            'TL_Mach' => $this->TL_Mach * $this->TL_Speed_Of_Light,
            'TL_Miles' => $this->TL_Miles * $this->TL_Speed_Of_Light,
        ];
        return $array;
    }
}
