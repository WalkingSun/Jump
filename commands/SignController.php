<?php
/**
 * Created by PhpStorm.
 * User: MW
 * Date: 2018/6/25
 * Time: 16:16
 */

namespace app\commands;


use app\models\Common;
use yii\console\Controller;

class SignController extends Controller
{

    public function actionIndex(){

        $token = '38ba5ce88b090f4a00672f02026989a6';

        $loginUrl = "https://api.ahmobile.cn/eip?eip_serv_id=app.ssoLogin";
        $header = array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "cookie: ZT_PeiZhiFuWu_g=ZT_PeiZhiFuWu_03; JSESSIONID_ahmobile=e3752e21-07ab-4d39-955d-fe17d71a4e9a; JSESSIONID=HoUxlwSmryn_7T7zji3p8t8bUGa0zmIEkYSIBy1XuXhyT_89FP1Z!-1980067697; ZhangTing_g=ZhangTing_04",
            "postman-token: 75237515-571f-66f1-2675-863b18d1dad0",
            "user-agent: okhttp/3.8.0"
        );
        $data = [
            'ytnb'  => 'true',
            'userIn.userPasswd'=> 'kJb479t/iRY7gkdgdF9tMsyxKkPwsbzFgoRqhI3VlcfyQKwPIs9eIT4SGkS94wcNCNvmqd3ky8z2nPNFaYqd6f98CEs3s3FpTPe+Yg28qpgEx6tPA4MBcoygmT7EDzeGy2OMqTebeweVrpoX8Lqr8hAX31H3d7G08bgbJobAf/E=',
            'imei'  =>  'nbNj5ZcDziH3IhrMd7tZAdygUP7SnOLl2rRXMidGlUB70yd9ga0/6Fhp46s1boCRBj1Vp2H/AAfyRQhUdb9fGAQxiKC5FRhj/TyjHd7C3kNbyQyVAlg32hmwPYdm+Cdkcy56HFwGhR1vnGovFbJ+OrGYVoUgiR4wcpK+1DzC3vE=',
            'token' => '8370d4cd5f3cbc80bc1a64d75f7630ee',
            'userIn.phone_no'   =>  '15256587052',
            'clientVersion'   =>  '5.1.4',
            'paramType'   =>  '1',
            'type'   =>  '0',
            'imsi'   =>  'DXPhHanFLe/CrvgmvvQkDJqxwKyZr4Rns3ruxbfly7u48ysUVxGxYmmtM7GYfZz+phsKKOmZAGBUP9Evk09sWyaCoOejs3rg5upfJBNM+fffJMslRs85XPF8n/SQ4xyHj3sfuv/x8wkBU6a//+RbFvk5dmeXBW6ZEH4bfN/Tubc=',
            'msgFlag'   =>  0,
            'loginClass'   =>  4,
        ];
        $loginInfo = Common::httpPost($loginUrl,'',$header,$data,1);
        Common::addLog('sign.log',$loginInfo);
//        print_r($loginInfo);die;
        $loginInfo = '{"activitiesId":"A_WODECHOUJIANG,A_WODEYOUHUIQUAN,A_QIANDAONEW,A_QIANDAO343,A_YAOQINGHAOYOU","areaCode":"11","checkFlag":null,"checkTips":null,"date":"2018-06-25 16:46:55","errorMsg":null,"hasError":null,"idNo":"HIzMZCLEPmTvjKzJ7dnWEUMyY\/bFvELDGAjjOw8ivCuKIg++xIVZ9ovZhM0EZFUs3b6fHqgYqeBHVSq5LNMDxdoj9Mm52wipt2V6haUq0RrOA0sSDNlMCA8N2LkhK9foBdAGK4AB0iWWemSURfBg6ceQU\/r9b\/VYyocswmxiihw=","message":null,"name":"＊＊伟","phoneNo":"15256587052","result":"o","sessionId":"sso_backup_92!!5WE2H9z4O6mYdKQuYQtlsYlaY8DO0DrefOkg1r0HZBUx4XirKUb5!-1686366390","url":null}';
        $loginData = json_decode($loginInfo['response'],1);
        $sessionId = $loginData['sessionId'];
        $idNo = $loginData['idNo'];


        $signUrl = 'http://api.ahmobile.cn:8081/eip?eip_serv_id=app.checkInIm';
        $port = 8081;
        $header = [
            "accept: */*",
            "accept-encoding: gzip, deflate",
            "accept-language: zh-CN,en-US;q=0.9",
            "cache-control: no-cache",
            "content-length: 49",
            "content-type: application/x-www-form-urlencoded; charset=UTF-8",
//            "cookie: ssoId=sso_backup_03!!PVg0tMx4aXMEu3Axy4YjAhlAn7xAdr5iRkKxCKjo3O4DqqeJb6QZ!1493546641; ZT_PeiZhiFuWu_g=ZT_PeiZhiFuWu_12; JSESSIONID_ahmobile=7c75b266-4e5c-4d8e-a02e-e6cc8f7c67d8; JSESSIONID=HoUxlwSmryn_7T7zji3p8t8bUGa0zmIEkYSIBy1XuXhyT_89FP1Z!-1980067697; ZhangTing_g=ZhangTing_04; ZhangTing_H5_g=ZhangTing_H5_07; ZhangTing_http=ZhangTing_http_04; JSESSIONID=HoUxlwSmryn_7T7zji3p8t8bUGa0zmIEkYSIBy1XuXhyT_89FP1Z!-1980067697; WT_FPC=id=26be15e69d7a0f866f31529892632731:lv=1529892640582:ss=1529892632731",
            "host: api.ahmobile.cn:8081",
            "origin: http://api.ahmobile.cn:8081",
            "postman-token: e3093fe5-7aa5-e6a8-e6e7-87979e9ce3cc",
            "referer: http://api.ahmobile.cn:8081/eip?eip_serv_id=app.h5_newSign&requesttype=app&WT.cid=779691F8973B8D220216923718D4F4D1",
            "user-agent: Mozilla/5.0 (Linux; Android 7.0; FRD-AL10 Build/HUAWEIFRD-AL10; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/62.0.3202.84 Mobile Safari/537.36",
            "x-requested-with: XMLHttpRequest"
        ];
//        ZT_PeiZhiFuWu_g=ZT_PeiZhiFuWu_12; JSESSIONID_ahmobile=107ebf8e-7337-49b8-89aa-33d5fed3d998; JSESSIONID=bBQ2NIPsIfaO1akP806rJBAfFhwBjvHKTsUZX8Rxwa7bRgt2Rs1v!-1801414589; ZhangTing_g=ZhangTing_04
        $data = [ 'newCheck'=>1,'token'=>$token ];
        $signInfo = Common::httpPost($signUrl,$port,$header,$data,1,$loginInfo['cookie']);

//        print_r($signInfo);
        //die;


        Common::addLog('sign.log',$signInfo);
    }


}