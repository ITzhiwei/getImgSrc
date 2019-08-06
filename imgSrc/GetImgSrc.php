<?php
   
namespace lipowei\imgSrc;

class GetImgSrc{
   
    /**
     * 提取HTML文章中的图片地址
     * @param string $data
     * @param int $num 第 $num 个图片的src，默认为第一张
     * @param string $order 顺取倒取； 默认为 asc ，从正方向计数。 desc 从反方向计数
     * @param string|array $blacklist 图片地址黑名单，排除图片地址中包含该数据的地址；例如 传入 baidu.com  会排除 src="http://www.baidu.com/img/a.png"
     * @param string $model 默认为字符串模式;可取值 string  preg；string模式处理效率高，PHP版本越高速度越快，可比正则快几倍
     * @return false | null | src  当data为空时返回 false ， src不存在时返回 null ，反之返回src
     */
    public static function src($data = null, $num = 1, $order = 'asc', $blacklist = false, $model = 'string'){
        
        if(isset($data)){
            if($model === 'preg'){
                $imgSrc = self::pregModel($data, $num-1, $order);    
            }else{
                $imgSrc = self::strModel($data, $num, $order);
            }
            if($blacklist === false){
                return $imgSrc;
            }else{
                if(is_array($blacklist)){
                    foreach($blacklist as $value){
                        if(strpos($imgSrc, $value) !== false){
                            return self::src($data, $num+1, $order, $blacklist, $model);   
                        };
                    }
                    return $imgSrc;
                }else{
                    if(strpos($imgSrc, $blacklist) === false){
                        return $imgSrc;
                    }else{
                        return self::src($data, $num+1, $order, $blacklist, $model);   
                    }
                }
            }
        }else{
            return false;
        }
        
    }
    
    public static function strModel($str, $num, $order){
      
        $topStr = null;
        if($order != 'asc'){
            $funcStr = 'strrpos';
        }else{
            $funcStr = 'strpos';
        }
        for($i=1; $i<=$num; $i++){
            $firstNum = $funcStr($str, '<img');
            if($firstNum !== false){
                if($order != 'asc'){
                    $topStr = $str;
                    $str = substr($str, 0, $firstNum);
                }else{
                    $str = substr($str, $firstNum+4);
                }
            }else{
                return null;
            }
        }
        $str = $order=='asc'?$str:$topStr;
        $firstNum1 = $funcStr($str, 'src=');
        $type = substr($str, $firstNum1+4, 1);
        $str2 = substr($str, $firstNum1+5);
        if($type == '\''){
            $position = strpos($str2, "'");
        }else{
            $position = strpos($str2, '"');
        }
        $imgPath = substr($str2, 0, $position);
        return $imgPath;
        
    }
    
    public static function pregModel($str, $num, $order){
        
        preg_match_all("/<img.*>/isU", $str, $ereg);
        $img = $ereg[0];
        if($order != 'asc'){
            $img = array_reverse($img);
        };
        if(!empty($img[$num])){
            $imgStr = $img[$num];
            $pregModel = "/src=('|\")(.*)('|\")/isU";
            preg_match_all($pregModel, $imgStr, $img1);
            return $img1[2][0];
        }else{
            return null;
        }
        
    }   
    
}
    
    /*
    $str = '<div>
                <p>这里是普通文字</p>
                <p>这里是干扰元素测试''"""</p>
                <img src="src1.png"/>
                <img src='src2.png'/>
                <img src="src3.jpg"/>
            </div>';
    
    $src = GetImgSrc::src($str, 1);  
    
    */
    

    

    


?>
