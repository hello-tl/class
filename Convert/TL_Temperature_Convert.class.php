<?php
/**
 * 温度换算
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
class TL_Temperature_Convert{
    private $TL_C = 1;//摄氏度
    private $Fahrenheit = 1;//华氏度
    private $TL_Kelvin = 1;//开氏度
    private $TL_Change = 1;//兰氏度
    private $TL_Column_Fahrenheit = 1;//列氏度

    function __construct($value){
        if(is_array($value)){
            $this->TL_C = $value[1] / $this->$value[0];
        }else{
            $this->TL_C = $value;
        }
    }
    function TL_Results(){
        $array = [
            'TL_C' => $this->TL_C,
            'Fahrenheit' => $this->Fahrenheit * $this->TL_C,
            'TL_Kelvin' => $this->TL_Kelvin * $this->TL_C,
            'TL_Change' => $this->TL_Change * $this->TL_C,
            'TL_Column_Fahrenheit' => $this->TL_Column_Fahrenheit * $this->TL_C,
        ];
        return $array;
    }
}
