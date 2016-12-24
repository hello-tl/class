<?php
/**
 * 数据存储换算
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
    private $TL_Petabytes = 1;//拍字节
    private $TL_Bit = 9007386056566384;//比特
    private $TL_Byte = 1125923257070798;//字节
    private $TL_Gigabyte = 1048639.8847054583;//千兆字节
    private $TL_Kilobytes = 1099801837506.7556;//千字节
    private $TL_Megabytes = 1073770491.8032787;//兆字节
    private $TL_Terabytes = 1024.049720771032;//太字节

    //算出pd 根据pd换其他
    function __construct($value){
        if(is_array($value)){
            $this->TL_Petabytes = $value[1] / $this->$value[0];
        }else{
            $this->TL_Petabytes = $value;
        }
    }
    function TL_Results(){
        $array = [
            'TL_Petabytes' => $this->TL_Petabytes,
            'TL_Bit' => $this->TL_Bit * $this->petabytes,
            'TL_Byte' => $this->TL_Byte * $this->petabytes,
            'TL_Gigabyte' => $this->TL_Gigabyte * $this->petabytes,
            'TL_Kilobytes' => $this->TL_Kilobytes * $this->petabytes,
            'TL_Megabytes' => $this->TL_Megabytes * $this->petabytes,
            'TL_Terabytes' => $this->TL_Terabytes * $this->petabytes,
        ];
        return $array;
    }
}
