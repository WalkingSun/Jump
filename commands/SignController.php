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
        //app登录  cookie 貌似不填也可以
        $loginUrl = "https://api.ahmobile.cn/eip?eip_serv_id=app.ssoLogin";
        $cookie = [
//            'ZT_PeiZhiFuWu_g'=>'ZT_PeiZhiFuWu_03',
//            'JSESSIONID_ahmobile'=>'e3752e21-07ab-4d39-955d-fe17d71a4e9a',
//            'JSESSIONID'=>'HBZTJMSOprFVVuOw2giExWo7RzqZE4AE8MveR0AyCAI06kDrSoI7!-1250887541',
//            'ZhangTing_g'=>'ZhangTing_04'
        ];
        $header = array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "cookie: ".$this->getCookieStr($cookie)."",
            "postman-token: 75237515-571f-66f1-2675-863b18d1dad0",
            "user-agent: okhttp/3.8.0"
        ); //Common::addLog('sign.log',$header);
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
        $loginInfo = Common::httpPostByCookie($loginUrl,'',$header,$data,$returnHeader=1);//        Common::addLog('sign.log',$loginInfo);print_r($loginInfo);die;
        $loginData = json_decode($loginInfo['response'],1);
        $setcookie = $loginInfo['cookie'];
        $setcookieArray = $this->getSetcookie($setcookie);
        $ssoId = $loginData['sessionId'];
        $setcookieArray['JSESSIONID_ahmobile'] = current(explode(';',$setcookieArray['JSESSIONID_ahmobile']));
//        print_r($loginInfo);die;
        //进入H5签到页面，获取信息
        $signH5 = 'http://api.ahmobile.cn:8081/eip?eip_serv_id=app.h5_newSign&requesttype=app&WT.cid=779691F8973B8D220216923718D4F4D1';
        $cookieH5 = array_merge($cookie,['ssoId'=>$ssoId,'JSESSIONID_ahmobile'=>$setcookieArray['JSESSIONID_ahmobile']]);
        $header = [
            "Host: api.ahmobile.cn:8081",
            "Upgrade-Insecure-Requests: 1",
            "User-Agent: Mozilla/5.0 (Linux; Android 7.0; FRD-AL10 Build/HUAWEIFRD-AL10; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/62.0.3202.84 Mobile Safari/537.36",
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
            "Accept-Encoding: gzip, deflate",
            "Accept-Language: zh-CN,en-US;q=0.9",
            "cookie: ".$this->getCookieStr($cookieH5)."",
        ];
        $H5info = Common::httpGetByCookie($signH5,8081,$header,1);
        $setcookie = $H5info['cookie'];
        $setcookieArray = $this->getSetcookie($setcookie);

        //H5logininfo
        $cookieSign = $cookieH5;
        $setcookieArray['JSESSIONID'] = current(explode(';',$setcookieArray['JSESSIONID']));
        if( !empty($setcookieArray['ZhangTing_H5_g']) ) $cookieSign['ZhangTing_H5_g'] = trim(current(explode(';',$setcookieArray['ZhangTing_H5_g'])));
        if( !empty($setcookieArray['ZhangTing_http']) ) $cookieSign['ZhangTing_http'] = trim(current(explode(';',$setcookieArray['ZhangTing_http'])));
        $cookieSignStr = $this->getCookieStr($cookieSign).';JSESSIONID='.$setcookieArray['JSESSIONID'];
        $cookieSignStr .=';WT_FPC=id=23110e6cb435604383c1529984277593:lv=1529984277896:ss=1529984277593';
        $loginInfoUrl = 'http://api.ahmobile.cn:8081/eip?eip_serv_id=app.getLoginInfo';
        $header = [
            "Host: api.ahmobile.cn:8081",
            "Accept: application/json, text/javascript, */*; q=0.01",
            "Origin: http://api.ahmobile.cn:8081",
            "X-Requested-With: XMLHttpRequest",
            "User-Agent: Mozilla/5.0 (Linux; Android 7.0; FRD-AL10 Build/HUAWEIFRD-AL10; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/62.0.3202.84 Mobile Safari/537.36",
            "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
            "Referer: http://api.ahmobile.cn:8081/eip?eip_serv_id=app.h5_newSign&requesttype=app&WT.cid=779691F8973B8D220216923718D4F4D1",
            "Accept-Encoding: gzip, deflate",
            "Accept-Language: zh-CN,en-US;q=0.9",
            "cookie: ".$cookieSignStr."",
        ];
        $data = [ 'clientType'=>'android','token'=>'f9decb14d4a0aef3b1229eaa3f554e72' ];
        $loginInfoH5 = Common::httpPostByCookie($loginInfoUrl,8081,$header,$data,1);//        print_r($loginInfoH5);die;

        //获取签到信息
        $signDateUrl = 'http://api.ahmobile.cn:8081/eip?eip_serv_id=app.getCheckInDate';
        $header = [
            "Host: api.ahmobile.cn:8081",
            "Accept: application/json, text/javascript, */*; q=0.01",
            "Origin: http://api.ahmobile.cn:8081",
            "X-Requested-With: XMLHttpRequest",
            "User-Agent: Mozilla/5.0 (Linux; Android 7.0; FRD-AL10 Build/HUAWEIFRD-AL10; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/62.0.3202.84 Mobile Safari/537.36",
            "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
            "Referer: http://api.ahmobile.cn:8081/eip?eip_serv_id=app.h5_newSign&requesttype=app&WT.cid=779691F8973B8D220216923718D4F4D1",
            "Accept-Encoding: gzip, deflate",
            "Accept-Language: zh-CN,en-US;q=0.9",
            "cookie: ".$cookieSignStr."",
        ];
        $data = [ 'token'=>'ffc6179a49cf4ddc411c7f93c28b56c6' ];
        $signDateInfo = Common::httpPostByCookie($signDateUrl,8081,$header,$data,1);

        //签到
        $cookieSignStr=$cookieSignStr;
        $header = [
            "Host: api.ahmobile.cn:8081",
            "Accept: */*",
            "Origin: http://api.ahmobile.cn:8081",
            "X-Requested-With: XMLHttpRequest",
            "User-Agent: Mozilla/5.0 (Linux; Android 7.0; FRD-AL10 Build/HUAWEIFRD-AL10; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/62.0.3202.84 Mobile Safari/537.36",
            "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
            "Referer: http://api.ahmobile.cn:8081/eip?eip_serv_id=app.h5_newSign&requesttype=app&WT.cid=779691F8973B8D220216923718D4F4D1",
            "Accept-Encoding: gzip, deflate",
            "Accept-Language: zh-CN,en-US;q=0.9",
            "cookie: ".$cookieSignStr."",
        ];//Common::addLog('sign.log',$cookieSignStr); //print_r($cookieSignStr);//die;
        $signUrl = 'http://api.ahmobile.cn:8081/eip?eip_serv_id=app.checkInIm';
        $data = [ 'newCheck'=>1,'token'=>'30ca7bbd399e5aaee9e734300f528a8a' ];
        $signInfo = Common::httpPostByCookie($signUrl,8081,$header,$data,1);

        Common::addLog('sign.log',$signInfo);
        if( !empty($signInfo['response']) ){
            $info = json_decode($signInfo['response'],1);
            if( $info['code']==0 ){
                print_r($signInfo);

                //todo 判断可领取奖励

                //todo 签到成功发送用户邮件

            }else{
                //todo 失败，重新计入队列并计数，超过三次不重复处理


            }

        }

        //todo  统计成功用户，失败用户

    }

    public function getCookieStr( $cookie = array()){
        $result = '';
        if( $cookie ){
            foreach ($cookie as $k=>$v){
                $a[] = $k.'='.$v;
            }
            $result = implode(';',$a);
        }
        return $result;
    }

    public function getSetcookie( $setcookie=[]){
        $result = [];
        if( $setcookie ){
            foreach ($setcookie as $v){
                $st = explode('=',$v);
                $result[trim($st[0])] = $st[1];
            }
        }
        return $result;
    }
}