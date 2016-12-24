<?php
/**
 * 密度换算
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
class TL_Density_Convert{
    private $TL_G = 1;//克/立方厘米
    private $TL_Kg = 1;//千克/立方厘米
    private $TL_Kgs = 1;//千克/立方分米
    private $TL_Gs = 1;//克/立方米
    private $TL_Gss = 1;//克/立方分米
    private $TL_KGss = 1;//千克/立方米

    function __construct($value){
        if(is_array($value)){
            $this->TL_G = $value[1] / $this->$value[0];
        }else{
            $this->TL_G = $value;
        }
    }
    function TL_Results(){
        $array = [
            'TL_G' => $this->TL_G,
            'TL_Kg' => $this->TL_Kg * $this->TL_G,
            'TL_Kgs' => $this->TL_Kgs * $this->TL_G,
            'TL_Gs' => $this->TL_Gs * $this->TL_G,
            'TL_Gss' => $this->TL_Gss * $this->TL_G,
            'TL_KGss' => $this->TL_KGss * $this->TL_G,
        ];
        return $array;
    }
}
