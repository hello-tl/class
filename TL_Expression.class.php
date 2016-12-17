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
    public function Verify_Phone($phone = null){
        $ret = false;
        //判断是否有值
        if($phone){
		$phone_preg = '/^1[34578]{1}\d{9}$/';
            	//判断是否是正确手机号
            	if(preg_match($phone_preg,$phone)){
                	$ret = true;
            	}
        }
        return $ret;
    }

    /**
     * [verifyPhone description] 效验邮箱地址 是否合法
     * @param null $email_address 邮箱地址
     * @return bool
     */
    public function Verify_Email_Address($email_address = null){
        $ret = false;
        //判断是否有值
        if($email_address){
		$email_preg = '/^([0-9A-Za-z\\-_\\.]+)@([163,]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i';
            	//判断是否是正确手机号
            	if(preg_match($email_preg,$email_address)){
                	$ret = true;
            	}
        }
        return $ret;
    }
}
