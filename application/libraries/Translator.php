<?php
/**
 * 翻译API处理类
 */

/**
 * 使用方法 ****
 $text = "Is it appropriate for a man to give CPR to an unconscious woman? Or should it be done by another woman?";

echo "原文:".$text."<br />";

//构造对象：第一个参数表示使用百度的API 第二个是APPID 第三个是SECRET
    $trBaidu = new TranslatorAPI(TranslatorAPI::Baidu,"20161124000032686","BxOJO6LJa6cDgXXX");
    $rs = $trBaidu->translate($text,'auto','zh');//翻译返回结果数组，其中数组[2]是翻译的结果，每个元素是一段；
    $cont = "";
    foreach ($rs[2] as $v) { //提取结果
        $cont .="<p>$v</p>";
    }
    echo $cont;
    
//构造对象：第一个参数表示使用有道的API，第二参数是你申请的有道应用名，第二参数是你申请的有道应的APIKey，有道API只需要这三个参数 
//构造参数是可以扩展的，具体可以看源代码
$trYouDao = new TranslatorAPI(TranslatorAPI::YouDao,"yidook","730781001");
$rs = $trYouDao->translate($text);
$cont = "";
foreach ($rs[2] as $v) {
         $cont .="<p>$v</p>";
}
echo ('<p>有道翻译结果：</p><div id="youdaooutputtext" style="border:1px solid #ccc;overflow:auto;display: block;padding: 12px 12px 12px 12px;height: 200px;width: 650px;margin:5px 12px 12px 12px">'.$cont.'</div>');
 */

class Translator {
    public $out = "";
    public $default = 1;
    public $optarr = NULL;
    const YouDao = 1;
    const Baidu = 2;
    const Google = 3;
    const Bing = 4;
    /**
     * 构造方法传参范例：目前支持有道和百度翻译API
     *
     * @param
     *          有道翻译AIP传参范例：(TranslatorAPI::YouDao,"yidook","730781001")
     * @param
     *          百度翻译AIP传参范例：(TranslatorAPI::Baidu,"fONDcYK99GbcAc3C2wRtC28L")
     * 
     */
    function __construct($type, $v1 = NULL, $v2 = NULL, $v3 = "json", $v4 = "1.1", $v5 = NULL) { // 定义构造函数
        $this->default = $type;
        $this->optarr = array (
                $v1,
                $v2,
                $v3,
                $v4,
                $v5 
        );
    }
    /**
     * 把内容字符串翻译成需求的内容返回，结果数组
     * @param string $content  要翻译的内容，必须提供
     * @param string $from  原文所属语言，默认为英文en
     * @param string $to 目标翻译文所属语言，默认为中文 zh_CN
     * @return array 返回array对象array[0]=错误代码，array[1]=错误字符串，array[2]=翻译结果数组，array[3]=原文段落数组，array[4,5,..]缺省备用
     */
    function translate($content = "", $from = "en", $to = "zh_CN") {
        $this->out = "";
        $text = urlencode ( $content ); // 要翻译的单词
        if ($this->default == self::YouDao) {
            $url = "http://fanyi.youdao.com/openapi.do?keyfrom={$this->optarr[0]}&key={$this->optarr[1]}&type=data&doctype={$this->optarr[2]}&version={$this->optarr[3]}&q=$text";
            $rs = $this->postPage ( array (
                    "url" => $url 
            ) );
            $json = json_decode ( $rs, true );
            if ($json ['errorCode'] == 0) {
                $rs = array (
                        0,
                        "正常",
                        array (),
                        array () 
                );
                if (isset ( $json ['translation'] )) {
                    foreach ( $json ['translation'] as $v ) {
                        array_push ( $rs [2], $v );
                    }
                }
                if (isset ( $json ['query'] )) {
                    if (is_array ( $json ['query'] ))
                        foreach ( $json ['query'] as $v ) {
                            array_push ( $rs [3], $v );
                        }
                    else
                        $rs [3] = $json ['query'];
                }
            } elseif ($json ['errorCode'] == 20) {
                $rs = array (
                        20,
                        "要翻译的文本过长",
                        array (
                                "[errorCode=20]要翻译的文本过长" 
                        ),
                        array (
                                "[errorCode=20]要翻译的文本过长" 
                        ) 
                );
            } elseif ($json ['errorCode'] == 30) {
                $rs = array (
                        30,
                        "无法进行有效的翻译",
                        array (
                                "[errorCode=30]无法进行有效的翻译" 
                        ),
                        array (
                                "[errorCode=30]无法进行有效的翻译" 
                        ) 
                );
            } elseif ($json ['errorCode'] == 40) {
                $rs = array (
                        40,
                        "不支持的语言类型",
                        array (
                                "[errorCode=40]不支持的语言类型" 
                        ),
                        array (
                                "[errorCode=40]不支持的语言类型" 
                        ) 
                );
            } elseif ($json ['errorCode'] == 50) {
                $rs = array (
                        50,
                        "无效的key",
                        array (
                                "[errorCode=50]无效的key" 
                        ),
                        array (
                                "[errorCode=50]无效的key" 
                        ) 
                );
            } elseif ($json ['errorCode'] == 60) {
                $rs = array (
                        60,
                        "无词典结果，仅在获取词典结果生效",
                        array (
                                "[errorCode=60]无词典结果，仅在获取词典结果生效" 
                        ),
                        array (
                                "[errorCode=60]无词典结果，仅在获取词典结果生效" 
                        ) 
                );
            } else {
                $rs = array (
                        - 1,
                        "非正常传参",
                        array (
                                "[errorCode=-1]非正常传参" 
                        ),
                        array (
                                "[errorCode=-1]非正常传参" 
                        ) 
                );
            }
            $this->out = $rs;
        } elseif ($this->default == self::Baidu) {

            $json = $this->bdtranslate($content, $from, $to,$this->optarr[0],$this->optarr[1]);
            if (!empty($json) && empty($json['error_code'])) {
                $rs = array (
                        0,
                        "正常",
                        array (),
                        array (),
                        $json ['from'],
                        $json ['to'] 
                );
                foreach ( $json['trans_result'] as $v ) {
                    array_push ( $rs [2], $v ['dst'] );
                    array_push ( $rs [3], $v ['src'] );
                }
                
            }else {
                $rs = array (
                        $json ['error_code'],
                        $json ['error_msg'],
                        array (
                                $json ['error_msg'] 
                        ),
                        array (
                                $json ['error_msg'] 
                        ),
                        $json ['from'],
                        $json ['to'] 
                );
            }
            $this->out = $rs;
        } elseif ($this->default == self::Bing) {
            $url = "";
        } elseif ($this->default == self::Google) {
            $url = "http://translate.google.cn/translate_a/t?client=t&text=$text&sl=$from&tl=$to";
            
        } else
            $url = "";
        
        return $this->out;
    }
    private function postPage($opts) {
        $html = "";
        if ($opts ["url"] != "") {
            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $opts ["url"] );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
            $rs = curl_exec ( $ch );
            if (curl_errno ( $ch ))
                $html = "";
            else
                $html = curl_multi_getcontent ( $ch );
            curl_close ( $ch );
        }
        return $html;
    }



    //百度翻译入口
    function bdtranslate($query, $from, $to,$appid,$secret)
    {
        $args = array(
            'q' => $query,
            'appid' => $appid,
            'salt' => rand(10000,99999),
            'from' => $from,
            'to' => $to,

        );
        $args['sign'] = $this->buildSign($query, $appid, $args['salt'], $secret);
        $ret = $this->call("http://api.fanyi.baidu.com/api/trans/vip/translate", $args);
        $ret = json_decode($ret, true);
        return $ret; 
    }

    //加密
    function buildSign($query, $appID, $salt, $secKey)
    {/*{{{*/
        $str = $appID . $query . $salt . $secKey;
        $ret = md5($str);
        return $ret;
    }/*}}}*/

    //发起网络请求
    function call($url, $args=null, $method="post", $testflag = 0, $timeout = 10, $headers=array())
    {/*{{{*/
        $ret = false;
        $i = 0; 
        while($ret === false) 
        {
            if($i > 1)
                break;
            if($i > 0) 
            {
                sleep(1);
            }
            $ret = $this->callOnce($url, $args, $method, false, $timeout, $headers);
            $i++;
        }
        return $ret;
    }/*}}}*/

    function callOnce($url, $args=null, $method="post", $withCookie = false, $timeout = 10, $headers=array())
    {/*{{{*/
        $ch = curl_init();
        if($method == "post") 
        {
            $data = $this->convert($args);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        else 
        {
            $data = convert($args);
            if($data) 
            {
                if(stripos($url, "?") > 0) 
                {
                    $url .= "&$data";
                }
                else 
                {
                    $url .= "?$data";
                }
            }
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(!empty($headers)) 
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if($withCookie)
        {
            curl_setopt($ch, CURLOPT_COOKIEJAR, $_COOKIE);
        }
        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }/*}}}*/

    function convert(&$args)
    {/*{{{*/
        $data = '';
        if (is_array($args))
        {
            foreach ($args as $key=>$val)
            {
                if (is_array($val))
                {
                    foreach ($val as $k=>$v)
                    {
                        $data .= $key.'['.$k.']='.rawurlencode($v).'&';
                    }
                }
                else
                {
                    $data .="$key=".rawurlencode($val)."&";
                }
            }
            return trim($data, "&");
        }
        return $args;
    }/*}}}*/


}