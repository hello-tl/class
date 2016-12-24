<?php
/**
 * 体积算类
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
    //公制
    private $TL_Cubic_Meters = 1;//立方米
    private $TL_Male_Stone = 10;//公石
    private $TL_Ten_Litres = 100;//十升
    private $TL_CDM = 1000;//立方分米
    private $TL_Dl = 10000;//分升
    private $TL_Centiliter = 100000;//厘升
    private $TL_Cubic_Centimeter = 1000000;//立方厘米
    private $TL_Cubic_Millimeter = 1000000000;//立方毫米

    //美制干量
    private $TL_Barrel = 8.6484898;//桶
    private $TL_Bushels = 28.3775933;//蒲式耳
    private $TL_Peck = 113.510373;//配克
    private $TL_Quart = 908.0829843;//夸脱
    private $TL_Pint = 1816.1659685;//品脱

    //英制液量和干量
    private $TL_Barrels = 6.1102569;//桶
    private $TL_Bushelss = 27.496156;//蒲式耳
    private $TL_Gallons = 219.9692483;//加仑
    private $TL_Pints = 1759.7539864;//品脱
    private $TL_Fl_Oz = 35195.0797279;//液量盎司

    //公制烹调制式
    private $TL_A_Spoon = 66666.6666667;//汤勺
    private $TL_Spoon = 200000;//调羹

    //美制烹调制式
    private $TL_A_Spoons = 67628.0454037;//汤勺
    private $TL_Spoons = 202884.1362111;//调羹
    private $TL_A_Cup_Of = 4226.7528377;//杯

    //美制液量
    private $TL_Barrelx = 6.2898108;//桶
    private $TL_Gallonss = 264.1720524;//加仑
    private $TL_Quarts = 1056.6882094;//夸脱
    private $TL_Pintx = 2113.3764189;//品脱
    private $TL_And_The_Ear = 8453.5056755;//及耳
    private $TL_Fl_Ozs = 33814.0227018;//液量盎司
    private $TL_Fluid_Volume_DRAM = 270512.1816147;//液量打兰
    private $TL_Min = 2077533554.801234;//量滴

    //美英同制体积计量
    private $TL_Mu_Feet = 0.0008107;//亩英尺
    private $TL_Cubic_Yards = 1.3079506;//立方码
    private $TL_Cubic_Feet = 35.3146667;//立方英尺
    private $TL_Cubic_Inch = 61023.7440947;//立方英寸


    function __construct($value){
        if(is_array($value)){
            $this->TL_Cubic_Meters = $value[1] / $this->$value[0];
        }else{
            $this->TL_Cubic_Meters = $value;
        }
    }
    function TL_Results(){
        $array = [
            'TL_Cubic_Meters' => $this->TL_Cubic_Meters,
            'TL_Male_Stone' => $this->TL_Male_Stone * $this->TL_Cubic_Meters,
            'TL_Ten_Litres' => $this->TL_Ten_Litres * $this->TL_Cubic_Meters,
            'TL_CDM' => $this->TL_CDM * $this->TL_Cubic_Meters,
            'TL_Dl' => $this->TL_Dl * $this->TL_Cubic_Meters,
            'TL_Centiliter' => $this->TL_Centiliter * $this->TL_Cubic_Meters,
            'TL_Cubic_Centimeter' => $this->TL_Cubic_Centimeter * $this->TL_Cubic_Meters,
            'TL_Cubic_Millimeter' => $this->TL_Cubic_Millimeter * $this->TL_Cubic_Meters,
            'TL_Barrel' => $this->TL_Barrel * $this->TL_Cubic_Meters,
            'TL_Bushels' => $this->TL_Bushels * $this->TL_Cubic_Meters,
            'TL_Peck' => $this->TL_Peck * $this->TL_Cubic_Meters,
            'TL_Quart' => $this->TL_Quart * $this->TL_Cubic_Meters,
            'TL_Pint' => $this->TL_Pint * $this->TL_Cubic_Meters,
            'TL_Barrels' => $this->TL_Barrels * $this->TL_Cubic_Meters,
            'TL_Bushelss' => $this->TL_Bushelss * $this->TL_Cubic_Meters,
            'TL_Gallons' => $this->TL_Gallons * $this->TL_Cubic_Meters,
            'TL_Pints' => $this->TL_Pints * $this->TL_Cubic_Meters,
            'TL_Fl_Oz' => $this->TL_Fl_Oz * $this->TL_Cubic_Meters,
            'TL_A_Spoon' => $this->TL_A_Spoon * $this->TL_Cubic_Meters,
            'TL_Spoon' => $this->TL_Spoon * $this->TL_Cubic_Meters,
            'TL_A_Spoons' => $this->TL_A_Spoons * $this->TL_Cubic_Meters,
            'TL_Spoons' => $this->TL_Spoons * $this->TL_Cubic_Meters,
            'TL_A_Cup_Of' => $this->TL_A_Cup_Of * $this->TL_Cubic_Meters,
            'TL_Barrelx' => $this->TL_Barrelx * $this->TL_Cubic_Meters,
            'TL_Gallonss' => $this->TL_Gallonss * $this->TL_Cubic_Meters,
            'TL_Quarts' => $this->TL_Quarts * $this->TL_Cubic_Meters,
            'TL_Pintx' => $this->TL_Pintx * $this->TL_Cubic_Meters,
            'TL_And_The_Ear' => $this->TL_And_The_Ear * $this->TL_Cubic_Meters,
            'TL_Fl_Ozs' => $this->TL_Fl_Ozs * $this->TL_Cubic_Meters,
            'TL_Fluid_Volume_DRAM' => $this->TL_Fluid_Volume_DRAM * $this->TL_Cubic_Meters,
            'TL_Min' => $this->TL_Min * $this->TL_Cubic_Meters,
            'TL_Mu_Feet' => $this->TL_Mu_Feet * $this->TL_Cubic_Meters,
            'TL_Cubic_Yards' => $this->TL_Cubic_Yards * $this->TL_Cubic_Meters,
            'TL_Cubic_Feet' => $this->TL_Cubic_Feet * $this->TL_Cubic_Meters,
            'TL_Cubic_Inch' => $this->TL_Cubic_Inch * $this->TL_Cubic_Meters,
        ];
        return $array;
    }
}