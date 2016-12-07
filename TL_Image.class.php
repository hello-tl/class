<?php
/**
 * 处理图片类
 * 1.添加文字水印
 * 2.添加图片水印
 * 3.压缩图片
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
class TL_Image{
	private $image;//内存中的图片
	private $info;//图片的基本信息
	/**
	 * 打开一张图片，读取到内存
	 * @param [type] $src [description] 图片路径
	 */
	public function __construct($src){
		$info = getimagesize($src);
		$this->info = array(
			'width' => $info[0],
			'height' => $info[1],
			'type' => image_type_to_extension($info['2'],false),
			'mime' => $info['mime'],
		);
		$fun = "imagecreatefrom{$this->info['type']}";
		$this->image = $fun($src);
	}

	/**
	 * 操作图片(压缩)
	 * @param  [type] $width  [description] 宽
	 * @param  [type] $height [description] 高
	 * @return [type]         [description]
	 */
	public function thumb($width,$height){
		$image_thumb = imagecreatetruecolor($width,$height);
		imagecopyresampled($image_thumb, $this->image, 0, 0, 0, 0, $width, $height, $this->info['width'], $this->info['height']);
		imagedestroy($this->image);
		$this->image = $image_thumb;
	}

	/**
	 * 操作图片(添加文字水印)
	 * [fontMark description]
	 * @param  [type] $content  [description] 设置文字
	 * @param  [type] $font_url [description] 字体文件路径
	 * @param  [type] $size     [description] 字体大小
	 * @param  [type] $color    [description] 字体颜色 []
	 * @param  [type] $local    [description] 位置 []
	 * @param  [type] $angle    [description] 旋转
	 * @return [type]           [description]
	 */
	public function fontMark($content,$font_url,$size,$color,$local,$angle){
		$col = imagecolorallocatealpha($this->image,$color[0],$color[1],$color[2],$color[3]);
		imagettftext($this->image, $size, $angle, $local['x'], $local['y'], $col, $font_url, $content);
	}

	/**
	 * 操作图片(添加图片水印)
	 * @param  [type] $source [description] 水印图片路径
	 * @param  [type] $local  [description] 位置 []
	 * @param  [type] $alpha  [description] 透明
	 * @return [type]         [description] 
	 */
	public function imageMark($source,$local,$alpha){
		$info2 = getimagesize($source);
		$type2 = image_type_to_extension($info2[2],false);
		$fun2 = "imagecreatefrom{$type2}";
		$water = $fun2($source);
		imagecopymerge($this->image, $water,  $local['x'],  $local['y'], 0, 0, $info2[0], $info2[1], $alpha);
		imagedestroy($water);
	}

	/**
	 * 浏览器输出图片
	 */
	public function show(){
		header("Content-Type:" . $this->info['mime']);
		$funs = "image{$this->info['type']}";
		$funs($this->image);
	}

	/**
	 * 保存图片
	 * @param  [type] $newname [description] 保存之后的名字
	 * @return [type]      	   [description]
	 */
	public function save($srcs){
		$funs = "image{$this->info['type']}";
		$funs($this->image,$srcs);
		//move_uploaded_file($this->image, $srcs);
	}

	/**
	 * 销毁图片
	 */
	public function __destruct(){
		imagedestroy($this->image);
	}
}