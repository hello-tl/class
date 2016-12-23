<?php
/**
 * 文件上传类
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
class TL_Update_File{
    private $file = null;//接受图片名称
    private $files = [];//图片属性
    public $size = null;//上传文件大小限制
    public $save_path = null;//保存路径
    public $mime = null;//文件上传支持类型
    private $error = null;//图片不符合要求者
    //接受图片
    function __construct($file=null){
        $this->save_path = str_replace("\\","/",dirname(__FILE__))."/";
        $this->file = $file;
        if($file){
            $this->files = $_FILES[$file];
        }else{
            $this->files = $_FILES;
        }
    }
    //一系列属性向
    private function attribute(){
        if($this->file){
            $this->empty_ture();
        }else{
            $this->empty_false();
        }
        if($this->size){
            if($this->file){
                $this->Size_ture();
            }else{
                $this->Size_false();
            }
        }
        if($this->mime){
            if($this->file){
                $this->mime_ture();
            }else{
                $this->mime_false();
            }
        }
    }
    //判断图片是否为空
    function empty_false(){
        foreach ($this->files as $key => $value){
            if($this->files[$key]['error']){
                $this->error[$key] = $value;
                $this->error[$key]['tl_error'] = "改图片为空";
                unset($this->files[$key]);
            }else{
                $this->files[$key]['mime'] = substr($value['name'], strrpos($value['name'], ".")+1);
            }
        }
    }
    //判断图片是否为空
    function empty_ture(){
        if($this->files['error']) {
            $this->error[$this->file] = $this->files;
            $this->error[$this->file]['tl_error'] = "改图片为空";
            $this->files=[];
        }else{
            $this->files['mime'] = substr($this->files['name'], strrpos($this->files['name'], ".") + 1);
        }
    }
    //文件后缀名是否受限制
    function mime_ture(){
        if($this->files){
            if(!in_array($this->files['mime'],$this->mime)){
                $this->error[$this->file] = $this->files;
                $this->error[$this->file]['tl_error'] = "不支持改后缀名";
                $this->files=[];
            }
        }
    }
    //文件后缀名是否受限制
    function mime_false(){
        foreach ($this->files as $key => $value){
            if(!in_array($this->files[$key]['mime'],$this->mime)){
                $this->error[$key] = $value;
                $this->error[$key]['tl_error'] = "不支持改后缀名";
                unset($this->files[$key]);
            }
        }
    }
    //文件大小是否受限制
    function Size_ture(){
        if($this->files['size'] > $this->size){
            $this->error[$this->file] = $this->files;
            $this->error[$this->file] = $this->files;
            $this->error[$this->file]['tl_error'] = "文件过大";
            $this->files=[];
        }
    }
    //文件大小是否受限制
    function Size_false(){
        foreach ($this->files as $key => $value){
            if($this->files[$key]['size'] > $this->size){
                $this->error[$key] = $value;
                $this->error[$key]['tl_error'] = "文件过大";
                unset($this->files[$key]);
            }
        }
    }
    //保存图片
    function save_file(){
        if($this->files){
            $file_path_dir = date('Ym',time()) ."/";
            $file_name = time() . rand(00000,99999) . "." . $this->files["mime"];
            $this->is_dir_on_off($this->save_path . date('Ym',time()) ."/");
            if($this->file){
                $this->save_file_ture($file_path_dir,$file_name);
            }else{
                $this->save_file_false($file_path_dir,$file_name);
            }
        }
    }
    //保存图片
    function save_file_ture($file_path_dir,$file_name){
        move_uploaded_file($this->files["tmp_name"] , $this->save_path . $file_path_dir . $file_name);
    }
    //保存图片
    function save_file_false($file_path_dir,$file_name){
        foreach ($this->files as $key => $value){
            move_uploaded_file($this->files[$key]["tmp_name"] , $this->save_path . $file_path_dir . $file_name);
        }
    }
    //创建目录
    function is_dir_on_off($file_path){
        if(!is_dir($file_path)){
            mkdir($file_path,0777);
        }
    }
    //保存文件
    function move(){
        $this->attribute();
        $this->save_file();

    }
}
//if(
//    isset($_POST['sub'])){
//    $obj = new TL_Update_File('img');
//    $obj->mime=['png','jpg','mp4'];
//    $obj->move();
//    print_r($obj);
//}
//echo '<!doctype html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"><meta http-equiv="X-UA-Compatible" content="ie=edge"><title>Document</title></head><body><form action="" method="post" enctype="multipart/form-data"><input type="file" name="img"><input type="file" name="imgs"><input type="submit" name="sub"></form></body></html>';