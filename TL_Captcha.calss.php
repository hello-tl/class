<?php
/**
 * 验证码类
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
 * __construct($new)；构造函数创建一张图片$new->width['宽']->height['高']->r[r]->b[b]->g[g]
 * 添加数字 digital($digital); $digital->length['位数'] -> size['数字大小']
 * 添加字符串 font($font,$data) $font->length['位数'] -> size['数字大小']   $data需要的字符串不能是中文
 * 给验证码添加干扰元素 点 point($lenth) $lenth 多少个
 * 添加干扰元素 线 line($lenth) $lenth 多少个
 * function __destruct() 析构函数保存 session 打印图片 销毁图片
 */

class TL_Captcha{
	private $image; //验证码图片
	private $width; //验证码宽度
	private $height; //验证码高度
	private $captch_code; //验证码信息
	/**
	 * [__construct description] 构造函数创建一张图片
	 * @param [type] $new [description] 图片大小 以及背景颜色 数组形式
	 */
	public function __construct($new){
		session_start();
		$this->width = $new['width'];
		$this->height = $new['height'];
		//创建一张 宽$new['width']，高$new['height']的图片 [默认黑色]
		$this->image = imagecreatetruecolor($this->width, $this->height);
		//设置图片的底图 颜色为 r$new['r'],b$new['b'],g$new['g']
		$bgcolor = imagecolorallocate($this->image, $new['r'], $new['b'], $new['g']);
		//修改图片的底色
		imagefill($this->image,0,0,$bgcolor);
	}

	/**
	 * 添加数字
	 * @param  [type] $digital [description] $digital数字配置 $digital['length'] 数字长度 $digital['size'] 数字大小
	 * @return [type]          [description]
	 */
	public function digital($digital){
		for($i=0;$i<$digital['length'];$i++){

			//设置数字字体大小
			$fontsize = $digital['size'];
			//设置数字颜色
			$fontcolor = imagecolorallocate($this->image, rand(0,120), rand(0,120), rand(0,120));
			//设置数字的值
			$fontcontent = rand(0,9);
			//作用 保存 session
			$this->captch_code = $this->captch_code.$fontcontent;
			//设置放入图片的x轴
			$x = ($i*$this->width/$digital['length']) + rand(5,10);
			//设置放入图片的y轴
			$y = rand(5,10);
			//把数字放入图片
			imagestring($this->image, $fontsize, $x, $y, $fontcontent, $fontcolor);
		}
	}

	/**
	 * 添加字符串
	 * @param  [type] $strings [description] $font数字配置 $strings['length'] 数字长度 $strings['size'] 数字大小
	 * @param  [type] $data [description] 字符串 不能有文字
	 * @return [type]       [description]
	 */
	public function strings($strings,$data){
		for($i=0;$i<$strings['length'];$i++){
			//设置数字字体大小
			$fontsize = $strings['size'];
			//设置数字颜色
			$fontcolor = imagecolorallocate($this->image, rand(0,120), rand(0,120), rand(0,120));
			//截取字符串设置默认字符
			$fontcontent = substr($data, rand(0,strlen($data)),1);
			//作用 保存 session
			$this->captch_code = $this->captch_code.$fontcontent;
			//设置放入图片的x轴
			$x = ($i*$this->width/$strings['length']) + rand(5,10);
			//设置放入图片的y轴
			$y = rand(5,10);
			//把文字放入图片
			imagestring($this->image, $fontsize, $x, $y, $fontcontent, $fontcolor);
		}
		return $this->captch_code;
	}

	/**
	 * 中文验证码
	 * @param  [type] $fontface [description] 文字路径
	 * @param  [type] $strdb    [description] 随机的中文字符串
	 * @param  [type] $length   [description] 验证码长度
	 * @param  [type] $size     [description] 字体大小
	 * @return [type]           [description]
	 */
	public function text($fontface,$strdb,$length,$size){
		//转换数组
		$strdbs = str_split($strdb,3);
		for($i=0;$i<$length;$i++){
			//设置文字颜色
			$fontcolor = imagecolorallocate($this->image, rand(0,120), rand(0,120), rand(0,120));
			//获取随机数组中的数字
			$cn = $strdbs[rand(0,count($strdbs)-1)];
			//写入session
			$this->captch_code = $this->captch_code.$cn;
			$x = (($i*$this->width/$length))+rand(5,10);
			$y = rand(30,35);
			imagettftext($this->image, $size, mt_rand(-60,60), $x, $y, $fontcolor, $fontface, $cn);
		}
	}

	/**
	 * 给验证码添加干扰元素 点
	 * @param  [type] $lenth [description] 添加点的数量
	 * @return [type]        [description]
	 */
	public function point($lenth){
		for($i=0;$i<$lenth;$i++){
			//设置点的颜色
			$pointcolor = imagecolorallocate($this->image, rand(50,200), rand(50,200), rand(50,200));
			//放入验证码
			imagesetpixel($this->image, rand(1,$this->width), rand(1,$this->height), $pointcolor);
		}
	}

	/**
	 * 添加干扰元素 线
	 * @param  [type] $lenth [description] 添加点的数量
	 * @return [type]        [description]
	 */
	public function line($lenth){
		for($i=0;$i<$lenth;$i++){
			//设置线的颜色
			$linecolor = imagecolorallocate($this->image, rand(80,220), rand(80,220), rand(80,220));
			//放入验证码
			imageline($this->image,rand(1,$this->width),rand(1,$this->height),rand(1,$this->width),rand(1,$this->height),$linecolor);
		}
	}
	/**
	 * 构造函数打印图片并且销毁
	 */
	public function __destruct() {
		header('content-type:image/png');
		//创建SESSION
		$_SESSION['authcode'] = $this->captch_code;
		//打印图片
        imagepng($this->image);
        //销毁图片
        imagedestroy($this->image);
    }
}
$new = array(
	'width' => 200,
	'height' => 50,
	'r' => 255,
	'b' => 255,
	'g' => 255
);
$Captcha = new Captcha($new);

//随机数字
// $digital = array(
// 	'length' => 5,
// 	'size' => 6,
// );
// $Captcha->digital($digital);
// 
// 
// 
//随机字符串 不能有中文
// $strings = array(
// 	'length' => 5,
// 	'size' => 6,
// );
// $data = "qweqwewqewqeewqe1545616545446";
// $Captcha->strings($strings,$data);

//随机文字验证吗
//字体文件
// $fontface = "STXINGKA.TTF";
// $strdb = '晨起微风吹拂迎着第一缕朝阳绽放的方向踩着清凉的露珠沐着微醉的晨风静静漫行在清爽舒适的田野上欣喜盈怀云很轻风很静万物生灵大多还沉浸在黎明前的宁静里酣睡只有几只晨起的粉蝶在花中轻舞寂静的清晨给人一种恬淡安然温润祥和的柔美韵致令人陶醉其中流恋忘返沿着那条潺潺流动的小溪蜿蜒而下聆听溪水欢快地吟唱心变得无比的愉悦慢行几步稍加留意就能看到小鱼们在浅水里欢乐地舞蹈顽皮的小虾们在溪边的水草丛里追逐嬉戏若是你够幸运的话兴许还能撞上小乌龟在堤脚下的缝隙间探出半个头来欣喜地打量着这个神奇的世界呢然而这静好的一切随着一群大白鹅和一群小花鸭的介入而结束在鹅与鸭的叫声响起的一刹那小鱼小虾们早已屏声静气地藏匿好了身影那胆小怕事的小乌龟更是吓得立马缩回那才稍稍探出小半截的头颅瞬间整条小溪便盈满了鹅与鸭的嘹亮歌声';
// $length = "5";
// $Captcha->text($fontface,$strdb,$length,"14");

//加干扰元素 点
// $Captcha->point('200');

//加干扰元素线
// $Captcha->line('5');