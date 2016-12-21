<?php
/**
 * 面积换算
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
class TL_Area_Convert{
    private $TL_Square_Kilometers = 1;//平方公里
    private $TL_Ha = 100;//公顷
    private $TL_Mu = 1500;//市亩
    private $TL_Square_Meters = 1000000;//平方米
    private $TL_Square_Dm = 100000000;//平方分米
    private $TL_Square_Centimeter = 10000000000;//平方厘米
    private $TL_Square_Millimeter = 1000000000000;//平方毫米
    private $TL_Square_Miles = 0.3861;//平方英里
    private $TL_Acres = 247.1;//英亩
    private $TL_Square_Rod = 39536.9;//平方竿
    private $TL_Square_Yards = 1195990;//平方码
    private $TL_Square_Feet = 9000000;//平方英尺
    private $TL_Square_Inch = 900000000;//平方英寸
    function TL_Convert($value){
        if(is_array($value)){
            $this->TL_Km = $value[1] / $this->$value[0];
        }else{
            $this->TL_Km = $value;
        }
    }
    function TL_Results(){
        $array = [
            'TL_Square_Kilometers' => $this->TL_Square_Kilometers,
            'TL_Ha' => $this->TL_Ha * $this->TL_Square_Kilometers,
            'TL_Mu' => $this->TL_Mu * $this->TL_Square_Kilometers,
            'TL_Square_Meters' => $this->TL_Square_Meters * $this->TL_Square_Kilometers,
            'TL_Square_Dm' => $this->TL_Square_Dm * $this->TL_Square_Kilometers,
            'TL_Square_Centimeter' => $this->TL_Square_Centimeter * $this->TL_Square_Kilometers,
            'TL_Square_Millimeter' => $this->TL_Square_Millimeter * $this->TL_Square_Kilometers,
            'TL_Square_Miles' => $this->TL_Square_Miles * $this->TL_Square_Kilometers,
            'TL_Acres' => $this->TL_Acres * $this->TL_Square_Kilometers,
            'TL_Square_Rod' => $this->TL_Square_Rod * $this->TL_Square_Kilometers,
            'TL_Square_Yards' => $this->TL_Square_Yards * $this->TL_Square_Kilometers,
            'TL_Square_Feet' => $this->TL_Square_Feet * $this->TL_Square_Kilometers,
            'TL_Square_Inch' => $this->TL_Square_Inch * $this->TL_Square_Kilometers,
        ];
        return $array;
    }
}
