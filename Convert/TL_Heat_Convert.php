<?php
/**
 * 热量换算
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
class TL_Heat_Convert{
    private $TL_Card = 1;//卡
    private $TL_Kilocalorie = 0.001;//千卡
    private $TL_Kw = 0.0000011627;//千瓦·时
    private $TL_Bhp = 0.0000015593;//英制马力·时
    private $TL_Horsepower = 0.0000015809;//米制马力·时
    private $TL_Kg = 0.4269569; //公斤·米
    private $TL_Btu = 0.0039674;//英热单位
    private $TL_Feet = 3.0874843;//英尺·磅

    //算出卡 根据卡换其他
    function __construct($value){
        if(is_array($value)){
            $this->TL_Card = $value[1] / $this->$value[0];
        }else{
            $this->TL_Card = $value;
        }
    }
    function TL_Results(){
        $array = [
            'TL_Card' => $this->TL_Card,
            'TL_Kilocalorie' => $this->TL_Kilocalorie * $this->TL_Card,
            'TL_Kw' => $this->TL_Kw * $this->TL_Card,
            'TL_Bhp' => $this->TL_Bhp * $this->TL_Card,
            'TL_Horsepower' => $this->TL_Horsepower * $this->TL_Card,
            'TL_Kg' => $this->TL_Kg * $this->TL_Card,
            'TL_Btu' => $this->TL_Btu * $this->TL_Card,
            'TL_Feet' => $this->TL_Feet * $this->TL_Card,
        ];
        return $array;
    }
}