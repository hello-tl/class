<?php
/**
 * 常用表达式
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
class TL_Expression{
    /**
     * [verifyPhone description] 效验手机号码合法性
     * @param  [type] $phone [description] 手机号
     * @return [type]        [description]
     */
    public static function Verify_Email($Email = null){
        global $dArr;
        $dArr = array(
            '163.com','126.com','sina.com','yahoo.com.cn','yahoo.com','sohu.com','yeah.net','139.com',
            'tom.com','21cn.com','qq.com','foxmail.com','gmail.com','hotmail.com','263.net',
            'vip.qq.com','vip.163.com','vip.sina.com','vip.sina.com.cn','vip.foxmail.com',
        );
        if( empty($Email) ){
            return false;
        }
        list($e,$d) = explode('@', $Email);
        if( !empty($e) && !empty($d) ){
            $d = strtolower($d);
            if( !in_array($d,$dArr) ) {return false;}
            return preg_match('/^[a-z0-9]+([\+_\-\.]?[a-z0-9]+)*/i', $e);
        }
        return false;
    }

    /**
     * [verifyPhone description] 效验手机号码合法性
     * @param  [type] $phone [description] 手机号
     * @return [type]        [description]
     */
    public static function Verify_Phone($Phone = null){
        /**
         * 移动：134、135、136、137、138、139、150、151、152、157、158、159、182、183、184、187、188、178(4G)、147(上网卡);
         * 联通：130、131、132、155、156、185、186、176(4G)、145(上网卡);
         * 电信：133、153、180、181、189 、177(4G);
         * 卫星通信：1349;
         * 虚拟运营商：170;
         * 130、131、132、133、134、135、136、137、138、139
         * 145、147
         * 150、151、152、153、155、156、157、158、159
         * 170、176、177、178
         * 180、181、182、183、184、185、186、187、188、189
         */
        $ret = false;
        //判断是否有值
        if($Phone){
            $Phone_preg = '#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#';
            //判断是否是正确手机号
            if(preg_match($Phone_preg,$Phone)){
                $ret = true;
            }
        }
        return $ret;
    }
}
