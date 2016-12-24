<?php
/**
 * 压力换算
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
class TL_Pressure_Convert{
    private $TL_Bar = 1;//巴
    private $TL_Kpa = 100;//千帕
    private $TL_Mpa = 1000;//百帕
    private $TL_Millibars = 1000;//毫巴
    private $TL_Pascal = 100000;//帕斯卡
    private $TL_Pressure = 0.9869233;//标准大气压
    private $TL_Hg = 750.0616827;//毫米汞柱(托)
    private $TL_Force = 2088.5435121;//磅力/英尺㎡
    private $TL_Forces = 14.5037744;//磅力/英寸㎡
    private $TL_Mercury = 29.5299875;//英吋汞柱
    private $TL_Kgf = 1.0197162;//公斤力/厘米㎡
    private $TL_Kgfs = 10197.1621298;//公斤力/米㎡
    private $TL_Column = 10197.2;//毫米水柱

    function __construct($value){
        if(is_array($value)){
            $this->TL_Bar = $value[1] / $this->$value[0];
        }else{
            $this->TL_Bar = $value;
        }
    }
    function TL_Results(){
        $array = [
            'TL_Bar' => $this->TL_Bar,
            'TL_Kpa' => $this->TL_Kpa * $this->TL_Bar,
            'TL_Mpa' => $this->TL_Mpa * $this->TL_Bar,
            'TL_Millibars' => $this->TL_Millibars * $this->TL_Bar,
            'TL_Pascal' => $this->TL_Pascal * $this->TL_Bar,
            'TL_Pressure' => $this->TL_Pressure * $this->TL_Bar,
            'TL_Hg' => $this->TL_Hg * $this->TL_Bar,
            'TL_Force' => $this->TL_Hg * $this->TL_Force,
            'TL_Forces' => $this->TL_Hg * $this->TL_Forces,
            'TL_Mercury' => $this->TL_Hg * $this->TL_Mercury,
            'TL_Kgf' => $this->TL_Hg * $this->TL_Kgf,
            'TL_Kgfs' => $this->TL_Hg * $this->TL_Kgfs,
            'TL_Column' => $this->TL_Hg * $this->TL_Column,
        ];
        return $array;
    }
}
