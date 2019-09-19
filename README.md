# GetImgSrc::src 单张获取(可比普通正则获取快3倍)
获取HTML字符串中的图片地址
用法示例： 
   
use lipowei\imgSrc\GetImgSrc;  
$htmlStr = '这里可以是新闻等文章或者html内容';   
//获取首张图片的src   
$imgSrc = GetImgSrc::src($htmlStr, 1);

    /**
     * 提取HTML文章中的图片地址
     * @param string $data
     * @param int $num 第 $num 个图片的src，默认为第一张
     * @param string $order 顺取倒取； 默认为 asc ，从正方向计数。 desc 从反方向计数
     * @param string|array $blacklist 图片地址黑名单，排除图片地址中包含该数据的地址；例如 传入 baidu.com  会排除 src="http://www.baidu.com/img/a.png"
     * @param string $model 默认为字符串模式;可取值 string  preg；string模式处理效率高，PHP版本越高速度越快，可比正则快几倍
     * @return false | null | src  当data为空时返回 false ， src不存在时返回 null ，反之返回src
     */
    public static function src($data = null, $num = 1, $order = 'asc', $blacklist = false, $model = 'string'){...

# GetImgSrc::srcList 多张获取
//从第一张获取，共获取3张  
$srcArr = GetImgSrc::srcList($htmlStr, 1, 3);  
参数解释：

    /**
      * 提取HTML文章中的图片地址
      * @param string $data HTML或者文章
      * @param int $startNum 默认为1，从第一张图片开始抽取
      * @param int $length 从 $startNum 开始抽取，共抽取 $length 张；默认为0，为0则抽取到最后
      * @param string $order 顺取倒取； 默认为 asc ，从正方向计数。 desc 从反方向计数
      * @param string|array $blacklist 图片地址黑名单，排除图片地址中包含该数据的地址；例如 传入 img.baidu.com  会排除 src="img.baidu.com/a.png"
      * @param string $model 抽取集合时，默认为正则模式；可选模式：preg  string，当 $length > 3 或者 $length = 0时，强制使用正则模式，因为取的数量大时，正则速度更快。
      * @return 图片地址的集合数组，若无则返回空数组[]
      */
    public static function srcList($data, $startNum = 1, $length = 0, $order = 'asc', $blacklist = false, $model = 'preg'){
