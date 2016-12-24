<?php
/**
 * 功率换算
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
class TL_Power_Convert{
    private $TL_Horsepower = 1;//米制马力
    private $TL_Kilocalorie = 0.1757842;//千卡/秒
    private $TL_Kw = 0.7354987;//千瓦
    private $TL_Bhp = 0.9863201;//英制马力
    private $TL_Feet = 542.4760385;//英尺·磅/秒
    private $TL_Joule = 735.49875;//焦耳/秒
    private $TL_Btu = 0.6971183;//英热单位/秒
    private $TL_Kg = 75;//公斤·米/秒/秒
    private $TL_Newton = 735.49875;//牛顿·米/秒

    //算出米制马力 根据米制马力换其他
    function __construct($value){
        if(is_array($value)){
            $this->TL_Horsepower = $value[1] / $this->$value[0];
        }else{
            $this->TL_Horsepower = $value;
        }
    }
    function TL_Results(){
        $array = [
            'TL_Horsepower' => $this->TL_Horsepower,
            'TL_Kilocalorie' => $this->TL_Kilocalorie * $this->TL_Horsepower,
            'TL_Kw' => $this->TL_Kw * $this->TL_Horsepower,
            'TL_Bhp' => $this->TL_Bhp * $this->TL_Horsepower,
            'TL_Feet' => $this->TL_Feet * $this->TL_Horsepower,
            'TL_Joule' => $this->TL_Joule * $this->TL_Horsepower,
            'TL_Btu' => $this->TL_Btu * $this->TL_Horsepower,
            'TL_Kg' => $this->TL_Kg * $this->TL_Horsepower,
            'TL_Newton' => $this->TL_Newton * $this->TL_Horsepower,
        ];
        return $array;
    }
}
