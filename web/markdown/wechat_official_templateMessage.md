### 微信公众号-模板消息通用接口封装
近期做了微信公众号的消息通知，微信方面模板越来越规范化，跟测试的平台相差甚远（fuck，谁让人家要办硬）。

话不多说，进入代码
```php
class OfficialSystem
{
    public $tmplateConf;
    private $accessToken;       //微信accessToken

    public function __construct( $tmplateConf ,$accessToken ){
        $this->tmplateConf = $tmplateConf;
        $this->accessToken = $accessToken;
    }

    /**
    * 返回结果
    * @param $error bool 1 代表错误，0 无错误
    * @parame $msg string   返回信息
    * @param $data Array    返回内容
    * @param $isJson bool  1 返回json， 0 否
    **/
    public function returnResult( $error,$msg ,$data=[],$isJson=0 ){
        $result = [
            'error' => $error,
            'msg' => $msg,
            'data' => $data,
        ];
        if( $isJson ){
            echo json_encode($result);
            exit();
        }
        return $result;
    }

    /**
    * 发送消息
    * @param $modelId sting  微信模板id
    * @param $touser string  微信openid（公众号）
    * @param $url string    跳转地址
    * @param $miniPagepath string 小程序跳转路径
    * @param $miniAppid  string   小程序Appid
    * @param $list  Array   模板数据，如：[ ['value'=>'您好，您有新的订单','color'=>'blue',...] ]
    **/
    public function Sendmsg( $modelId,$touser,$url,$miniPagepath,$miniAppid,$list=[] ){
        if( empty($modelId) || empty($touser) || empty($list)  ) $this->returnResult(1,'参数缺失');

        $template_id =  !empty( $this->tmplateConf[$modelId] ) ? $this->tmplateConf[$modelId]:$this->returnResult(1,'模板错误');

        //模板消息内容  数组第一个作为标题，最后一个作为备注
        $data = [];
        foreach ($list as $k=>$v){
            $key = $k==0 ? 'first':"keyword".$k;

            if( !isset( $list[$k+1] ) ) $key = 'remark';

            $data[$key] = [
                'value' =>  $v['value'],
                'color' =>  !empty($v['color'])? $v['color']:'#173177',
            ];
        }

        $sends = $this->sendModelMsg($touser,$template_id,$url,$miniAppid,$miniPagepath,$data);

        $this->returnResult(0,'success',$sends);
    }

    /**
     * @param $touser   用户openid
     * @param $template_id
     * @param $url
     * @param $miniAppid
     * @param $miniPagepath     小程序跳转地址
     * @param $data     模板数据
     */
    public function sendModelMsg( $touser,$template_id,$url='',$miniAppid='',$miniPagepath='',$data ){

        $interfaceUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->accessToken;

        $params = [
            'touser'            =>          $touser,
            'template_id'       =>          $template_id,
            'url'               =>          $url,
            'miniprogram'       =>          [ 'appid'=>$miniAppid,'path'=>$miniPagepath ]   ,
            'data'              =>          $data,
        ];

        $sends = $this->httpPost($interfaceUrl,json_encode($params));
        $sends = json_decode($sends,1);

        if( $sends&&$sends['errmsg']!='ok' ){
             $this->returnResult(1,'消息发送失败',$sends);
        }

        return $sends;
    }

    /**
     * 获取用户信息
     * @param $openid  openid
     * @return mixed
     */
    public function getUserInfo( $openid='' ){

        $interfaceUrl = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->accessToken.'&openid='.$openid;
        $info = $this->httpGet( $interfaceUrl );
        $result = json_decode($info,1);

        return $result;
    }

    /**
     * @param $touser
     * @param $msgtype
     * @param $msgContent
     */
    public function sendCustomMsg( $touser,$msgtype,$msgContent){
//        $params = [];
//        $params['touser'] = $touser;
//        $params['msgtype'] = $msgtype;
//        $params["$msgtype"] = $msgContent;
//        $params = json_encode($params);
        $params = '{"touser":"'.$touser.'","msgtype":"'.$msgtype.'","text":{'.$msgContent.'}}';

        $interfaceUrl = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$this->accessToken;
        $sends = $this->httpPost($interfaceUrl,$params);//var_dump($params,json_encode($params),$sends);die;
        $sends = json_decode($sends,1);
        return $sends;
    }

    private function httpGet($url) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;die;
        } else {
            return $response;
        }
    }

    private function httpPost($url,$param){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $param,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                'Content-Length:' . strlen($param)
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }

}
```


调用事例：
```php
$tmplateConf = [
     '1'      =>  'mnscOp2RHpQtDCt7OpZBLoDTU2fjJ_W75_Mat4rnfxM',         //订货通知模板
     '2'      =>  'DL4EAD47KT1tggbL2OR8iRAYLORI64V4YEM8mjQfSWU',         //入库通知模板
];
$accessToken = 'o9BuWjkDBvLGV_nch9wPU_-KRp7M';
$OfficialSystem = new OfficialSystem($tmplateConf,$accessToken);

//消息内容
$list = [
        ['value'=>'您好，您有新的订单','color'=>'blue'],
        ['value'=>'P201809010001','color'=>''],
        ['value'=>'服务中心店','color'=>''],
        ['value'=>'2018-06-01 10:30:30','color'=>''],
        ['value'=>'点击进入详情','color'=>''],
    ];
$modelId = 1;
$touser = 'o9BuWjkDBvLGV_nch9wPU_-KRp7M';
$url = 'http://www.cnblogs.com/followyou';
$sends = Sendmsg( $modelId,$touser,$url,$miniPagepath='',$miniAppid='',$list);
var_dump($sends);
```

成功返回：
```
        "errcode": "0",
        "errmsg": "ok",
        "msgid": "325381129559375872"
```
 仅供参考，代码也就这样哈！