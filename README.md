# getImgSrc
获取HTML字符串中的图片地址
用法示例：  
use lipowei\imgSrc\GetImgSrc;  
$htmlStr = '这里可以是新闻、公告等字符串，想在该字符串中提取出图片的src';  
$imgSrc = GetImgSrc::src($htmlStr, 1);//获取首张图片的src

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
