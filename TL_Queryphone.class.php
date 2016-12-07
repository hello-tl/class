<?php
/**
 * 淘宝借口 获取 手机归属地
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
/**
 * areaVid:"30499"          区号
 * carrier:"河北移动"         省
 * catName:"中国移动"         运营商
 * ispVid:"3236139"         互联网服务提供商
 * mts:"1529756"            手机号前七位
 * province:"河北"           省
 * telString:"15297566833"  电话
 */
class TL_Queryphone{
    const TAOBO_API = 'https://tcc.taobao.com/cc/json/mobile_tel_segment.htm';

    public static function query($phone){
        $response = self::request(self::TAOBO_API, ['tel' => $phone]);
        if ($response){
            $data = self::formatData($response);
            return $data;
        } else {
            return 0;
        }
    }

    /**
     * [formatData description] 格式化API请求回来的数据---成数组
     * @param  [type] $data [description] API返回的值
     * @return [type]       [description]
     */
    public static function formatData($data = null){
        $ret = false;
        if ($data) {
            preg_match_all("/(\w+):'([^']+)/", $data, $res);
            //转换数组
            $ret = array_combine($res[1], $res[2]);
            //转换utf-8
             foreach ($ret as $key => $val){
             	$ret[$key] = iconv('GB2312', 'UTF-8', $val);
             }
        }
        return $ret;
    }

    /**
     * HTTPS 请求
     * @param $url
     * @param $params
     * @param string $method
     * @return mixed|null
     */
    public static function request($url, $params, $method = 'GET'){
        $response = false;
        if ($url) {
            $method = strtoupper($method);
            if ($method == 'POST') {

            } else if ($method == 'PUT') {

            } else if ($method == 'DELETE') {

            } else {
                if (is_array($params) and count($params)){
                    if (strrpos($url, '?')) {
                        $url = $url . '&' . http_build_query($params);
                    } else {
                        $url = $url . '?' . http_build_query($params);
                    }

                    // 初始化一个 cURL 对象
                    $curl = curl_init();
                    // 设置你需要抓取的URL
                    curl_setopt($curl, CURLOPT_URL, $url);
                    // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    //是否检测服务器的证书是否由正规浏览器认证过的授权CA颁发的
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                    //是否检测服务器的域名与证书上的是否一致
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                    // 设置header
                    curl_setopt($curl, CURLOPT_HEADER, 0);
                    // 运行cURL，请求网页
                    $response = curl_exec($curl);
                    // 关闭URL请求
                    curl_close($curl);
                    // $response = file_get_contents($url);
                }
            }
            return $response;
        }
    }
}