<?php
/**
 * 力换算
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
class TL_Force_Convert{
    private $TL_Kg_Force = 1;//千克力
    private $TL_N = 9.80665;//牛
    private $TL_K_N = 0.0098067;//千牛
    private $TL_Kg = 999.9999971;//克力
    private $TL_Bg = 2.2046226;//磅力
    private $TL_K_Bg = 0.0022046;//千磅力
    private $TL_Tf = 0.001;//公吨力
    function __construct($value){
        if(is_array($value)){
            $this->TL_Kg_Force = $value[1] / $this->$value[0];
        }else{
            $this->TL_Kg_Force = $value;
        }
    }
    function TL_Results(){
        $array = [
            'TL_Kg_Force' => $this->TL_Kg_Force,
            'TL_N' => $this->TL_N * $this->TL_Kg_Force,
            'TL_K_N' => $this->TL_K_N * $this->TL_Kg_Force,
            'TL_Kg' => $this->TL_Kg * $this->TL_Kg_Force,
            'TL_Bg' => $this->TL_Bg * $this->TL_Kg_Force,
            'TL_K_Bg' => $this->TL_K_Bg * $this->TL_Kg_Force,
            'TL_Tf' => $this->TL_Tf * $this->TL_Kg_Force,
        ];
        return $array;
    }
}
