<?php
namespace app\modules;

use app\models\Code;
use app\modules\v1\models\Tbapplication;
use Yii;
use app\modules\v1\controllers\LogController;
use PHPExcel;
use PHPExcel_IOFactory;
use app\modules\UpYunForm;
use PHPExcel_Cell;
use app\modules\v1\models\SCMTbParamValue;
use app\modules\v1\models\Tbshop;
use app\modules\v1\models\POSBindData;
use app\modules\v1\models\Tbuser;
use app\modules\v1\models\Tbuserrole;
use app\modules\v1\models\Tbprog;
use app\modules\v1\models\Tbauthoritydtl;

class Common
{
//    public static $PROJECT = 'pFastPos';//'pSupplyChain';//供应链系统项目代码
    public static $PROJECT = 'pSCM';//供应链系统项目代码
    public static $result = '';
    public static $diff_result = '';
    public static $old_result = '';
    public static $user = [];
    public static $controller_action = '';
    public static $add_result = '';
    public static $the_control_action = '';
    public static $the_control_module = '';
    public static $code = "";
    public static $ip = '';
    public static $count = 0;
    public static $data = [];
    public static $data_accuracy ;

    const NOUSABLE_STATUS = 0;   //禁用
    const TRUE_STATUS = 1;   //正常
    const DISABLED_STATUS = 9; //禁用
    const DELETE_STATUS = 13;  //删除
    const TEMPLATE_STATUS = 9;  //餐饮门店模板


    //移动端输出格式调整
    public static function mobileScanf( $data ){
        if( !$data ) $data = [];
        foreach ($data  as $k=>$v){
            if( empty($v)&&!($v===0) ){
                if( in_array($k,['payMoney']) ){
                    $data[$k] = $data[$k]?:0;
                    continue;
                }
                $data[$k] = in_array($k,['list','materialtype'])? []:'';
            }else{
                if( is_array($v) ){
                    foreach ($v as $k1 => $v1){
                        if( !is_array($v1) ) continue;
                        foreach ($v1 as $k2 => $v2){
                            if( is_numeric($v2) ) continue;
                            if( !is_array($v2)&&!$v2&&!($v2===0) )  $data[$k][$k1][$k2] = '';
                        }
                    }
                }
            }
        }
        return $data;
    }

    /**
     * 返回统一的json数据格式
     * @param int $status ：状态码
     * @param string $message : 提示信息
     * @param mixed $data : 对象，数组，字符串等数据
     * @return string
     */
    public static function echoJson($status, $message = '', $data = '',$count=0)
    {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        self::cors();
        $result['status'] = $status;
        $result['message'] = $message;
//        $result['count'] = $count?:(self::$count);
        $result['data'] = self::mobileScanf($data);
        echo self::json_en($result);
        if ( $status == 200 ) {//操作记录  isset(self::$controller_action[self::$the_control_action]) &&
            $fsRemark = 'mobile';
            $fsAction = self::$the_control_action;//self::$controller_action[self::$the_control_action];
//            if (self::$code) {
//                $fsRemark = $fsAction . '数据代码为' . self::$code;
//            }
            $fsRatioData = '';
            if (self::$add_result) {
                $fsRatioData = json_encode(self::$add_result);
            }
            if (self::$old_result && self::$diff_result) {
                $old_result = [];
                foreach (self::$old_result as $k => $v) {
                    if (isset(self::$diff_result[$k])) {
                        $old_result[$k] = $v;
                    }
                }
                $fsRatioData = json_encode(["old" => $old_result, 'new' => self::$diff_result]);
            }
            if (self::$user['fsShopGUID'] == 99999) {
                $fsDataAttribute = 'sys';
            } else {
                $fsDataAttribute = 'user';
            }
            $ip = self::$ip;
            LogController::create($fsRemark, $fsAction, $ip, $fsDataAttribute, self::$user, $fsRatioData);
        }

        exit();
    }

    /**
     * 头部文件的调用
     */
    public static function cors()
    {
        // Allow from any origin
        if (YII_ENV == 'dev') {
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
                // you want to allow, and if so:
                header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
                header('Access-Control-Allow-Credentials: true');
                header('Access-Control-Max-Age: 86400');    // cache for 1 day
            }

            // Access-Control headers are received during OPTIONS requests
            if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

                exit(0);
            }
        }
        header("Content-type: application/json;charset=utf-8");
    }

    /**
     * 获取UTF-8字符串的长度
     * @param string $string ： utf-8编码的字符串
     * @return int
     */
    public static function utf8_strlen($string = null)
    {
        // 将字符串分解为单元
        preg_match_all("/./us", $string, $match);
        // 返回单元个数
        return count($match[0]);
    }

    // 数组转json，解除中文转换问题
    public static function json_en($array)
    {
        $_urlencode = function (&$str) {
            if ($str !== true && $str !== false && $str !== null) {
                if (stripos($str, '"') !== false || stripos($str, '\\') !== false || stripos($str, '/') !== false ||
                    stripos($str, '\b') !== false || stripos($str, '\f') !== false || stripos($str, '\n') !== false ||
                    stripos($str, '\r') !== false || stripos($str, '\t') !== false) {
                    $newstr = '';
                    for($i=0;$i<strlen($str);$i++){
                        $c = $str[$i];
                        switch ($c) {
                            case '"':
                                $newstr .="\\\"";
                                break;
                            case '\\':
                                $newstr .="\\\\";
                                break;
                            case '/':
                                $newstr .="\\/";
                                break;
                            case '\b':
                                $newstr .="\\b";
                                break;
                            case '\f':
                                $newstr .="\\f";
                                break;
                            case '\n':
                                $newstr .="\\n";
                                break;
                            case '\r':
                                $newstr .="\\r";
                                break;
                            case '\t':
                                $newstr .="\\t";
                                break;
                            default:
                                $newstr .=$c;
                        }
                    }
                    $str = $newstr;
                }
                $str = urlencode($str);
            }
        };
        array_walk_recursive($array, $_urlencode);
        $json = json_encode($array);
        return urldecode($json);
    }

    /**
     * @DESC 数据导出
     * @notice max column is z OR 26,overiload will be ignored
     * @notice
     * @example
     *  $data = [[1, "小明", "25"]];
     *  $header = ["id", "姓名", "年龄"];
     *  Myhelpers::exportData($data, $header);
     * @return void, Browser direct output
     */
    public static function exportData($data, $header, $title = "test", $filename = "data")
    {
        if (!is_array($data) || !is_array($header)) return false;
        $objPHPExcel = new \PHPExcel();

        // Set properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
        $objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
        $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
        $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
        $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
        // Add some data
        $obj = $objPHPExcel->setActiveSheetIndex(0);
        //添加头部
        $hk = 0;
        foreach ($header as $k => $v) {
            $colum = \PHPExcel_Cell::stringFromColumnIndex($hk);
            $obj->setCellValue($colum . "1", $v);
            $hk += 1;
        }
        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();
        foreach ($data as $key => $rows)  //行写入
        {
            $span = 0;
            foreach ($rows as $keyName => $value) // 列写入
            {
                $j = \PHPExcel_Cell::stringFromColumnIndex($span);
                // 前面加一个空格 会将值变成字符串
                $objActSheet->setCellValue($j . $column, ' '.$value);
                $span++;
            }
            $column++;
        }
        // Rename sheet
        if ($title) {
            $objActSheet->setTitle($title);
        }
        // Save
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Pragma:public");
//        header('Content-type: application/vnd.ms-excel');
        header("Content-Type:application/vnd.ms-excel;name=\"{$filename}.xlsx\"");
//        header("Content-Type:application/x-msexecl;name=\"{$filename}.xls\"");
        header("Content-Disposition:inline;filename=\"{$filename}.xlsx\"");
        $objWriter->save("php://output");
    }

    /**
     * @param $str
     * @param string $code
     * @return bool
     */
    public static function isExists($str)
    {
        $return = false;
        foreach (SYS_PREFIX as $k => $v) {
            if (strstr($str, $v)) {
                return true;
            }
        }
        return $return;
    }

    /**
     * @param $auth
     * @param $user_auth
     * @return array
     */
    public static function getAuth($auth, $user_auth, $user)
    {
        $button = [];
        foreach ($auth as $k => $v) {
            foreach ($v as $key => $val) {
                $action_auth = $val;
                $auth_key = explode('_', $val);
                if ($user['fsShopGUID'] == 99999) {
                    $button[$auth_key[1]] = 'true';
                } else {
                    if (in_array($action_auth, $user_auth)) {
                        $button[$auth_key[1]] = 'true';
                    } else {
                        $button[$auth_key[1]] = 'false';
                    }
                }

            }
        }
        return $button;
    }

    /**
     * @param $type
     * @param $user
     * @param $notify_url
     * @return array
     */
    public static function formUpYun($type, $user, $notify_url, $fsOptionsCode = '')
    {
        $upyun = new UpYunForm();
        $opts = array();
        $opts['save-key'] = '/' . date('Y/m/d') . '/{random32}/{filename}{.suffix}';   // 保存路径
        $opts['notify-url'] = $notify_url;
        $opts['content-length-range'] = '1024,5120000';
        $fsOptionsId = md5(uniqid('scm', true) . mt_rand(10, 999999));
        $ext_param = [
            'fsOptionsId' => $fsOptionsId,
            'userId' => $user['fsUserId'],
            'userName' => $user['fsUserName'],
            'fsShopGUID' => $user['fsShopGUID'],
            'type' => $type,
            'fsOptionsCode' => $fsOptionsCode
        ];
        $opts['ext-param'] = json_encode($ext_param);
        $policy = $upyun->policyCreate($opts);
        $sign = $upyun->signCreate($opts);
        $action = $upyun->action();
        $version = $upyun->version();
        $data = [
            'policy' => $policy,
            'sign' => $sign,
            'action' => $action,
            'version' => $version,
            'fsOptionsId' => $fsOptionsId,
        ];
        return $data;
    }

    /**
     * @param $type
     * @param $user
     * @param $notify_url
     * @return array
     */
    public static function upYunImg($type, $user, $notify_url)
    {
        // TODO 上传多张需要更改的地方
        $upyun = new UpYunForm();
        $opts = array();
        $opts['save-key'] = '/' . date('Y/m/d') . '/{random32}/{filename}{.suffix}';   // 保存路径
        $opts['notify-url'] = $notify_url;
        $opts['content-length-range'] = '1024,5120000';
        $fsImgId = md5(uniqid('scm', true) . mt_rand(10, 999999));
        $ext_param = [
            'fsImgId' => $fsImgId,
            'userId' => $user['fsUserId'],
            'userName' => $user['fsUserName'],
            'fsShopGUID' => $user['fsShopGUID'],
            'type' => $type,
        ];
        $opts['ext-param'] = json_encode($ext_param);
        $policy = $upyun->policyCreate($opts);
        $sign = $upyun->signCreate($opts);
        $action = $upyun->action();
        $version = $upyun->version();
        $data = [
            'policy' => $policy,
            'sign' => $sign,
            'action' => $action,
            'version' => $version,
            'fsImgId' => $fsImgId,
        ];
        return $data;
    }

    /**
     * 判断字段是否为空
     * @param $data
     * @param $field
     * @return bool
     */
    public static function isEmpty($data, $field = '')
    {
        if ($field == '') {
            // 判断是否为数组,如果是数组直接使用empty判断是否为空
            if (is_array($data)) {
                return empty($data);
            } else {
                // 如果为空,但是非0就表示为空
                if(is_string($data)){
                    $data=str_replace(" ","",$data);
                }
                return (empty($data) && !($data!== ''));
            }
        }
        if(isset($data[$field])){
            if(is_string($data[$field])){
                $data[$field] = trim($data[$field]);
            }
        }
        return !(isset($data[$field]) && $data[$field] !== '');
    }

    /**
     * @param $file 文件地址
     * @param $key 所有下标组成的数组
     * @return array
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * 表数据转化为数组 excel 低版本excel，不包括excel2007
     */
    public static  function ExcelToArray($file, $key,$rowStart=2,$needLink=0)
    {
        /*引入PHPExcel.php文件*/
        $inputFileType = PHPExcel_IOFactory::identify($file);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        /*此属性不明，貌似设置为flase也可以*/
        $objReader->setReadDataOnly(true);
        /*加载对象路径*/
        $objPHPExcel = $objReader->load($file);
        /*获取工作表*/
        $objWorksheet = $objPHPExcel->getActiveSheet();
        //获得当前活动的工作表，即打开默认显示的那张表
//        $objWorksheet = $objPHPExcel->getSheet(0);    //也可以这样获取，读取第一个表,参数0
        /*得到总行数*/
        $highestRow = $objWorksheet->getHighestRow();
        /*得到总列数*/
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        /*取单元数据进数组*/
        $excelData = array();
        if (count($key) != $highestColumnIndex) {
            Common::echoJson(400, '文件类型错误，请按照导出excel文件作为导入模板');
        }
        for ($row = $rowStart; $row <= $highestRow; ++$row) {
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                $excelData[$row][$key[$col]] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
        }
        if($needLink==0) {
            unlink($file);
        }
        return array_values($excelData);
    }

    public static function filterExcelColum($file,$key,$filter,$rowStart=2,$colMatche=false){
        /*引入PHPExcel.php文件*/
        $inputFileType = PHPExcel_IOFactory::identify($file);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        /*此属性不明，貌似设置为flase也可以*/
        $objReader->setReadDataOnly(true);
        /*加载对象路径*/
        $objPHPExcel = $objReader->load($file);
        /*获取工作表*/
        $objWorksheet = $objPHPExcel->getActiveSheet(0);
        //获得当前活动的工作表，即打开默认显示的那张表
//        $objWorksheet = $objPHPExcel->getSheet(0);    //也可以这样获取，读取第一个表,参数0
        /*得到总行数*/
        $highestRow = $objWorksheet->getHighestRow();
        /*得到总列数*/
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

        /*取单元数据进数组*/
        $excelData = array();
        foreach ($key as $k=> $v){//标题 => 生成字段
            $array[$filter[$k]]=$v;
        }
        $count=0;
        $rowHead =[];
        for ($col = 0; $col < $highestColumnIndex; ++$col) {//获取excel标题
            $rowHead[$col] ='';
            for ($row=1;$row<=$rowStart-1;++$row) {
                $rowHead[$col].= $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
        }

        for ($row = $rowStart; $row <= $highestRow+$highestRow; ++$row) {
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                //$value=$objWorksheet->getCellByColumnAndRow($col, 1)->getValue();
                $handleHead=self::isExcelColExsits($filter,$rowHead[$col],$col,$colMatche);
                if($handleHead!==false){
                    $excelData[$row][$array[$handleHead]] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                    if($row==$rowStart){
                        $count++;
                    }
                }
            }
        }
        if($count!=count($key)){
            Common::echoJson(400, '文件类型错误，请按照导出excel文件作为导入模板');
        }
        unlink($file);
        return array_values($excelData);
    }

    /**
     * @return string
     */
    public static function isExcelColExsits($arr=[],$str='',$col=0,$colMatche)
    {
        if(!empty($arr)){
            if($colMatche === true) {
                foreach ($arr as $k => $v) {
                    if ($k == $col) {
                        if (stripos($str, $v) !== false) {
                            return $v;
                        }
                    }
                }
            }else{
                foreach ($arr as $k => $v) {
                    if (stripos($str, $v) !== false) {
                        return $v;
                    }
                }
            }
        }
        return false;
    }
    /********************************
     * 格式化打印数据
     ***********************************/
    public static function P($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit;
    }

    /********************************
     * 格式化时间
     ***********************************/

    public static function timeFormat($time)
    {
        $str = date('Y-m-d H:i:s', $time);
        return $str;
    }

    public static function getCommonId($type = '')
    {
        if ($type == 1) {
            return substr(uniqid(rand(1, 9999999999)), 0, 4);
        }
        return substr(uniqid(rand(1, 9999999999)), 0, 10);
    }


    //判断初始年月
    public static function getIntervalTimeInfo($date, $each)
    {
        $last_day_month = date('d', strtotime(date('Y-m-01', strtotime($date)) . ' +1 month -1 day'));//当月最后一天
        $last_day_last_month = date('d', strtotime(date('Y-m-01', strtotime($date)) . '-1 day'));//上月最后一天
        if($each){
            if ($each != 1) {
                if ($each > ($last_day_month)) {
                    $nextTime = date('Y-m-' . $last_day_month, strtotime(date('Y-m-01', strtotime($date))));
                } else {
                    $nextTime = date('Y-m-' . ($each - 1), strtotime(date('Y-m-01', strtotime($date))));
                }

                if ($each > $last_day_last_month) {
                    $preTime = date('Y-m-01', strtotime($date));
                } else {
                    $preTime = date('Y-m-' . $each, strtotime(date('Y-m-01', strtotime($date)) . ' -1 month'));
                }
            } else {
                $preTime = date('Y-m-01', strtotime($date));
                $nextTime = date('Y-m-d', strtotime(date('Y-m-01', strtotime($date)) . ' +1 month -1 day'));
            }
        }else{
            $preTime = date('Y-m-01', strtotime($date));
            $nextTime = date('Y-m-d', strtotime(date('Y-m-01', strtotime($date)) . ' +1 month -1 day'));
        }

        $ret = [
            'pre' => $preTime,
            'next' => $nextTime
        ];
        return $ret;
    }

    public static function isLeapYear($year)
    {
        return (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0));
    }

    public static function getShopType($fiShopKind)
    {
        //0系统商 /1代理商 / 3餐饮公司/ 6供应商 / 7餐饮门店-直营店 /8餐饮门店-加盟店  /9账套模板
        //shopType : 0-A | 1-B | 3-C | 6-F | 78-D | 9-E
        $shopType = '';
        switch ($fiShopKind) {
            case "0":
                $shopType = "A";
                break;
            case "1":
                $shopType = "B";
                break;
            case "3":
                $shopType = "C";
                break;
            case "6":
                $shopType = "F";
                break;
            case "7":
            case "8":
                $shopType = "D";
                break;
            case "9":
                $shopType = "E";
                break;
            case "10":
                $shopType = "G";
                break;
        }

        return $shopType;
    }


    public static function userLoginManage($user, $fsShopGUID)
    {
//        $session = Yii::$app->session;
        // 登录成功 初始化账期数据
        $paymentDays = self::getScmTbParamValue($user);
        // 是否初始化
        $initData = self::getScmTbParamValueInit($user);
        // 获取登录店铺名称
        $shopData = self::getLoginShopName($fsShopGUID);
        // 存在账期数据并且已经启用,才设置到session中
        self::setPaymentInitData($paymentDays, $initData);
        $user['fsShopName'] = $shopData['fsShopName'];
        $user['fiShopMode'] = empty($shopData['fiShopMode'])?0:$shopData['fiShopMode'];
        $user['fiOrderInput'] = empty($shopData['fiOrderInput'])?0:$shopData['fiOrderInput'];
//        $session['user'] = $user;
        Common::$user = array_merge($user,Common::$user);
//        Common::$user = $user;
//        self::getUserAuth($user);
        self::dataAccuracy($user);
        $system = 'false';
        if ($user['fsShopGUID'] == 99999) {
            $system = 'true';
        }
//        $session['system'] = $system;
        Common::$user['system'] = $system;
        $shopType = Common::getShopType($shopData['fiShopKind']);
        Common::$user['shopType'] = $shopType;
        //切到门店时标准化设置，如果fsNotMaintain有说明门店设置了，否则就为空
        if (isset($shopData['fsNotMaintain']) && $shopData['fsNotMaintain']) {
            $standard = $shopData['fsNotMaintain'];
            $standardArr = explode(',', $standard);
        } else {
            $standardArr = [];
        }
        Common::$user['standardArr'] = $standardArr;
    }

    public static function getPayments()
    {
        $session = Yii::$app->session;
        $paymentDays = '';
        if (count($session['paymentDays']) > 0 && isset($session['paymentDays']['year']) && isset($session['paymentDays']['month'])) {
            $paymentDays = $session['paymentDays']['year'] . ' 年 ' . $session['paymentDays']['month'] . ' 期';
        }
        return $paymentDays;
    }


    public static function checkBindData($user){
        $checkDataStatus = POSBindData::find()->select(['fsShopGUID', 'fsDepartmentBind', 'fsDishBomSet', 'updateTime'])->where(['fsShopGUID' => $user['fsShopGUID']])->asArray()->one();
        $return_array=[];
        if(!empty($checkDataStatus)){
            $return_array['fsDepartmentBind']=$checkDataStatus['fsDepartmentBind'];
            $return_array['fsDishBomSet']=$checkDataStatus['fsDishBomSet'];
        }else{
            $return_array['fsDepartmentBind']=1;
            $return_array['fsDishBomSet']=1;
        }
        return $return_array;
    }


    public static function backUserData($data, $paymentDays,$checkDataAuth=[])
    {
        $result = [
            'fsShopGUID' => $data['fsShopGUID'],
            'userId' => $data['fsUserId'],
            'userName' => $data['fsUserName'],
            'system' => $data['system'],
            'shopName' => $data['fsShopName'],
            'fsCompanyGUID'=>$data['fsCompanyGUID'],
            'fiBatchManage'=>$data['shop']['fiBatchManage'],           //是否开启批次管理（0：关闭  1：开启）
            'fiMaterialEdit'=>$data['shop']['fiMaterialEdit'],         //'是否门店可以维护物料？（0：否（缺省）  1：是）
            'fiSupplyEdit'=>$data['shop']['fiSupplyEdit'],             //是否门店可以供应商？（0：否 （缺省） 1：是）
            'fiUnDoMode'=>$data['shop']['fiUnDoMode'],             //是否启用反审核  0 不启用 1 启用【冲销过程相反】
            'fiSupportPay'=>$data['shop']['fiSupportPay'],             //是否支持支付（集团专用   0：不支持  1：支持

            'fdPayRate'=>$data['shop']['fdPayRate'],    //首付押金比率（小数格式 --门店
            'fdWallet'=>$data['shop']['fdWallet'],   //钱包余额
            'fdPayPeriod'=>$data['shop']['fdPayPeriod'],   //完全支付期限（天数）

            'paymentDays' => $paymentDays,
            'checkdataAuth'=>$checkDataAuth,
//            'auth' => $data['front_user_auth'],
            'data_accuracy' => $data['data_accuracy'],
            'shopType' => $data['shopType'],
            'standard' => $data['standardArr'],
            'shopMode' => !(isset($data['shopMode'])&&!empty($data['shopMode']))?0:$data['shopMode'],
            'auditing_model' => !(isset($data['auditing_model'])&&!empty($data['auditing_model']))?1:$data['auditing_model']
        ];
        return $result;
    }

    // 登录成功 初始化账期数据
    public static function getScmTbParamValue($user)
    {
        $paymentDays = SCMTbParamValue::find('fiInt4', 'fiInt5')->where(['fsShopGUID' => $user['fsShopGUID'], 'fsParamId' => 'enable_years'])->asArray()->one();
        if (empty($paymentDays)) {
            return [];
        }
        return $paymentDays;
    }

    // 是否初始化
    public static function getScmTbParamValueInit($user)
    {
        $initData = SCMTbParamValue::find('fsParamValue')->where(['fsShopGUID' => $user['fsShopGUID'], 'fsParamId' => '999'])->asArray()->one();
        if (empty($initData)) {
            return [];
        }
        return $initData;
    }

    public static function getLoginShopName($fsShopGUID)
    {
        // 获取登录店铺名称
        $shopData = Tbshop::find()->select(['fsShopGUID', 'fsShopName', 'fiShopKind', 'fsNotMaintain','fiShopMode','fiOrderInput'])->where(['fsShopGUID' => $fsShopGUID])->asArray()->one();
        if (empty($shopData)) {
            return [];
        }
        return $shopData;
    }

    public static function setPaymentInitData($paymentDays, $initData)
    {
        $session = Yii::$app->session;
        // 存在账期数据并且已经启用,才设置到session中
        if ($paymentDays && isset($initData['fsParamValue']) && $initData['fsParamValue'] == '1') {
            Common::$user['paymentDays'] = [
                'year' => empty($paymentDays['fiInt4']) ? '' : $paymentDays['fiInt4'],
                'month' => empty($paymentDays['fiInt5']) ? '' : $paymentDays['fiInt5']
            ];
        } else {
            Common::$user['paymentDays'] = [];
        }
    }

    public static function getUserAuth($user)
    {
        $session = Yii::$app->session;
        $user_auth = [];
        $roleArr = [];
        $user_role = Tbuserrole::find()->where(['fsShopGUID' => $user['fsShopGUID'], 'fsUserId' => $user['fsUserId'], 'fiStatus' => '1'])->asArray()->All();
        foreach ($user_role as $key => $value) {
            $roleArr[] = $value['fsRoleId'];
        }
        $session ['fsRoleId'] = $roleArr;
        //查出shopkind，店铺级别
        $shopInfo = Tbshop::getshopInfo(['fsShopGUID' => $user['fsShopGUID']]);
        $progList = Tbprog::getProgList(['fsProgId'], ['fiIsUnify' => Common::TRUE_STATUS]);//获取需要连锁标准化设置的ProgId
        $needProgList = array();
        $fiShopKind = self::getShopType($shopInfo['fiShopKind']);
        if (!empty($shopInfo["fsCompanyGUID"])) {//是否包含父公司的guid
            $parentCompayInfo = Tbshop::getshopInfo(['fsShopGUID' => $shopInfo["fsCompanyGUID"]]);//获取当前shop总店的连锁化设置
            $tainArr = empty($parentCompayInfo['fsNotMaintain']) ? [] : $parentCompayInfo['fsNotMaintain'];//获取当前门店对应得总店连锁化设置
            if ($tainArr) {
                $tainList = explode(',', $tainArr);
                foreach ($progList as $item => $row) {
                    if (in_array($row['fsProgId'], $tainList)&&$fiShopKind!='E' ) {
                        $needProgList[] = $row['fsProgId'];
                    }
                }
            }
        }
        $front_user_auth = [];
        if (in_array('888', $roleArr)) {
            $role_auth = Tbapplication::getApplationList($fiShopKind);
            foreach ($role_auth as $k => $v) {
                $user_auth[] = $v['fsProgId'] . '_' . $v['fsProgDtlId'];
            }
        } else {
            //明细
            $role_auth = Tbapplication::getApplationAllList($roleArr, $user['fsShopGUID']);
            //全部
            $role_list = Tbapplication::getTbprogdtlList();
//            Common::echoJson(200,$role_auth,$role_list);
            $role_auth_list = [];
            $role_has_progsId = array();
            foreach ($role_auth as $k => $v) {
                $role_auth_list[$v['fsProgId']]['fsProgDtlId'][] = $v['fsProgDtlId'];
                $role_auth_list[$v['fsProgId']]['fsProjId'] = $v['fsProjId'];
                $role_has_progsId[$v['fsProgId']] = $v['fsProgId'];//用户已有的权限
            }
            foreach ($role_auth_list as $key => $value) {
                foreach ($role_list as $item => $row) {
                    if ($key == $row['fsProgId']) {
                        if (in_array($row['fsProgDtlId'], $value['fsProgDtlId'])) {
                            //权限true是服务端使用
                            $user_auth[] = $row['fsProgId'] . '_' . $row['fsProgDtlId'];
                        } else {
                            //权限false是客户端使用
                            $front_user_auth[$row['fsProgId']][] = $row['fsProgDtlId'];
                        }
                    } else if (!in_array($row['fsProgId'], $role_has_progsId)) {
                        if (empty($front_user_auth[$row['fsProgId']]) || !in_array($row['fsProgDtlId'], $front_user_auth[$row['fsProgId']])) {
                            //如果当前数据为空或者当前数据不在返回的前端数据之中
                            $front_user_auth[$row['fsProgId']][] = $row['fsProgDtlId'];
                        }
                    }
                }
            }
        }
        foreach ($needProgList as $key => $row) {
            $front_user_auth[$row][] = "edit";
            $front_user_auth[$row][] = "export";
            $front_user_auth[$row][] = "delete";
            $front_user_auth[$row][] = "use";
            $front_user_auth[$row][] = "commit";
            $front_user_auth[$row][] = "print";
        }

        $session['user_auth'] = $user_auth;
        $session['front_user_auth'] = $front_user_auth;
    }

    /**
     * 获取设置的数据精度
     */
    public static function dataAccuracy($user)
    {
        $code = 'data_accuracy';
        $query = SCMTbParamValue::find()->where(['fsShopGUID' => $user['fsCompanyGUID'], 'fsParamId' => $code])->andWhere(['!=', 'fiStatus', 13])->asArray()->one();
        $data = [
            'int' => 2,
            'price' => 2,
            'rate' => 2
        ];
        if ($query) {
            $data['int'] = $query['fsParamValue'];
            $data['price'] = $query['fiInt1'];
            $data['rate'] = $query['fiInt2'];
        }
        Common::$user['data_accuracy'] =   $data;
//        $session = Yii::$app->session;
//        $session ['data_accuracy'] = $data;
    }

    public static function setFiStatus()
    {
        $arr = [
            self::TRUE_STATUS,   //正常
            self::DISABLED_STATUS, //禁用
            self::DELETE_STATUS  //删除
        ];
        return $arr;
    }

    public static function getStatusInfo($status)
    {
        if ($status == '正常') {
            $str = 1;
        } elseif ($status == '禁用') {
            $str = 9;
        } else {
            $str = 13;
        }
        return $str;
    }

    /**
     * 建公司初始化数据方法
     */
    public static function buildCompany($shopGuid,$storageType=0)
    {
        $connection = \Yii::$app->db;
        if(!$storageType){
            $path = Yii::$app->basePath . '/modules/v1/Files/BuildCompanyInitialData.txt';
        }else{
            $path = Yii::$app->basePath . '/modules/v1/Files/BuildSingleCompanyInitialData.txt';
        }
        $text = file_get_contents($path);
        $content = [];
        preg_match_all('/INSERT.*?;/s', $text, $content);
        foreach ($content[0] as $k => $v) {
            $sql = str_replace('@shopguid', $shopGuid, $v);
            $connection->createCommand($sql)->execute();
        }
        return true;
    }

    /**
     * 建店初始化数据方法
     */
    public static function buildStore($shopGuid,$storageType=0)
    {
        $connection = \Yii::$app->db;
        if(!$storageType){
            $path = Yii::$app->basePath . '/modules/v1/Files/BuildStoreInitialData.txt';
        }else{
            $path = Yii::$app->basePath . '/modules/v1/Files/BuildSingleStoreInitialData.txt';
        }
        $text = file_get_contents($path);
        $content = [];
        preg_match_all('/INSERT.*?;/s', $text, $content);
        foreach ($content[0] as $k => $v) {
            $sql = str_replace('@shopguid', $shopGuid, $v);
            $connection->createCommand($sql)->execute();
        }
        return true;
    }

    /**
     * 建集采中心初始化数据方法
     */
    public static function buildJcStore($shopGuid)
    {
        $connection = \Yii::$app->db;
        $path = Yii::$app->basePath . '/modules/v1/Files/BuildJcStoreInitialData.txt';
        $text = file_get_contents($path);
        $content = [];
        preg_match_all('/INSERT.*?;/s', $text, $content);
        foreach ($content[0] as $k => $v) {
            $sql = str_replace('@shopguid', $shopGuid, $v);
            $connection->createCommand($sql)->execute();
        }
        return true;
    }

    public static function buildTemplate($shopGuid)
    {
        $connection = \Yii::$app->db;
        $path = Yii::$app->basePath . '/modules/v1/Files/BuildTemplateInitialData.txt';
        $text = file_get_contents($path);
        $content = [];
        preg_match_all('/INSERT.*?;/s', $text, $content);
        foreach ($content[0] as $k => $v) {
            $sql = str_replace('@shopguid', $shopGuid, $v);
            $connection->createCommand($sql)->execute();
        }
        return true;
    }

    /**
     * * 数字转换为中文
     * @param $num
     * @param bool $mode 模式[true:金额（默认）,false:普通数字表示]
     *  @param  boolean $sim 使用小写（默认）
     * @return string
     * @param  string|integer|float $num 目标数字
     */
    public function number2chinese($num, $mode = true, $sim = true)
    {
        $prefix = '';
        if ($num < 0) {
            $prefix = '负';
            $num = -$num;
        }
        if (!is_numeric($num)) return '含有非数字非小数点字符！';
        $char = $sim ? array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九')
            : array('零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖');
        $unit = $sim ? array('', '十', '百', '千', '', '万', '亿', '兆')
            : array('', '拾', '佰', '仟', '', '萬', '億', '兆');
        $retval = $mode ? '元' : '点';

        //小数部分
        if (strpos($num, '.')) {
            list($num, $dec) = explode('.', $num);
            $dec = strval(round($dec, 2));
            if ($mode) {
                if($dec != 0) {
                    $retval .= "{$char[$dec['0']]}角{$char[$dec['1']]}分";
                }
            } else {
                for ($i = 0, $c = strlen($dec); $i < $c; $i++) {
                    $retval .= $char[$dec[$i]];
                }
            }
        }
        //整数部分
        $str = $mode ? strrev(intval($num)) : strrev($num);
        for ($i = 0, $c = strlen($str); $i < $c; $i++) {
            $out[$i] = $char[$str[$i]];
            if ($mode) {
                $out[$i] .= $str[$i] != '0' ? $unit[$i % 4] : '';
                if ($i > 1 and $str[$i] + $str[$i - 1] == 0) {
                    $out[$i] = '';
                }
                if ($i % 4 == 0) {
                    $out[$i] .= $unit[4 + floor($i / 4)];
                }
            }
        }
        $retval = join('', array_reverse($out)) . $retval;

        return $prefix . $retval;
    }

    /**
     * @return string
     * 生成唯一ID
     */
    public function uuid() {
        if (function_exists ( 'com_create_guid' )) {
            return com_create_guid ();
        } else {
            mt_srand ( ( double ) microtime () * 10000 ); //optional for php 4.2.0 and up.随便数播种，4.2.0以后不需要了。
            $charid = strtoupper ( md5 ( uniqid ( rand (), true ) ) ); //根据当前时间（微秒计）生成唯一id.
            $hyphen = chr ( 45 ); // "-"
            $uuid = '' . //chr(123)// "{"
                substr ( $charid, 0, 8 ) . $hyphen . substr ( $charid, 8, 4 ) . $hyphen . substr ( $charid, 12, 4 ) . $hyphen . substr ( $charid, 16, 4 ) . $hyphen . substr ( $charid, 20, 12 );
            //.chr(125);// "}"
            return $uuid;
        }
    }

    #获取随机数
    public static  function  randomkeys($length=8)
    {
        $key = time();
        $pattern='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        for($i=0;$i<$length;$i++)
        {
            $key .= $pattern{mt_rand(0,35)};    //生成php随机数
        }
        return md5($key);
    }

    //获取code
    public static function getCode( $type ){
        $code = "";
        switch ( $type ){
            case "PO":
                $code = '204';
                break;
            case "PR":
                $code = '207';
                break;
            case "Stock_I":         //采购入库单
                $code = '206';
                break;
            case "Stock_O":         //采购退货单
                $code = '208';
                break;
            case "Picking_O":       //易耗品领料单
                $code = '210';
                break;
            case "Picking_I":       //易耗品退料单
                $code = '211';
                break;
            case "Gain":            //盘盈单
                $code = '214';
                break;
            case "Loss":            //盘亏单
                $code = '215';
                break;
            case "InvBackup":       //盘点单
                $code = '213';
                break;
            case "TransferOrder":   //调拨单
                $code = '212';
                break;
            default:

        }
        return $code;
    }

    //获取单据类型
    public static function getOrderType( $type='',$fsBRWords='' ){
        $list = [
            'Stock_I' => '采购入库单',
            'Stock_O' => '采购退货单',
            'Picking_O' => '领料单',
            'Picking_I' => '退料单',
            'Transfer_I' => '调入单',
            'Transfer_O' => '调出单',
            'Gain' => '盘盈单',
            'Loss' => '盘亏单',
            'SaleOut_O' => '销售出库单',
            'SaleOut_I' => '销售退货单',
            'Process_I' => '半成品入库单',
            'Process_O' => '半成品出库单',
            'OrgPick_I' => '领料入库单',
            'OrgPick_O' => '领料出库单',
            'OrgRevPick_I' => '领料退货入库单',
            'OrgRevPick_O' => '领料退货出库单',
            'Adjust_IO' => '库存调整单',
            'BOM_O' => '成本卡扣库单',
            'ReportLoss_IO' => '报损单',
            's_adjust_bill' => '调整单',
        ];

        if($type){
            if(!isset( $list[$type])) return false;
            if( $fsBRWords=='R' ){
                $list[$type] = $list[$type].'(冲销)';
            }
            return $list[$type];
        }
        return $list;
    }

    public static function filter($val,$type='',$de=''){
        $val=Common::daddslashes($val);   //使用反斜线引用字符串 (对提交数据的过滤)
        //过滤字符
        $filterList = [ ';',':','#','%','select','from','insert','update','delete'];
        $val = str_replace($filterList,'',$val);
        switch ($type) {

            case 'int':
                return intval($val);
                break;

            case 'float':
                return floatval($val);
                break;

            default:
                return htmlspecialchars($val,ENT_QUOTES);   //把预定义的字符转换为 HTML 实体
                break;
        }

    }

    public static function daddslashes($string, $force = 1) {
        if(is_array($string)) {
            $keys = array_keys($string);
            foreach($keys as $key) {
                $val = $string[$key];
                unset($string[$key]);
                $string[addslashes($key)] = Common::daddslashes($val, $force);
            }
        } else {
            $string = addslashes($string);           //在预定义字符之前添加反斜杠的字符串
        }
        return $string;
    }

    ##curl请求
   public static function apiget($url, $param=array()){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_USERAGENT, '3'); //User-Agent
        curl_setopt($curl, CURLOPT_URL, $url);

       curl_setopt ( $curl, CURLOPT_HEADER, 0 );

//       $header = array ();
//       $header [] = 'Host:www.XXXX.co';
//       $header [] = 'Connection: keep-alive';
//       $header [] = 'User-Agent: ozilla/5.0 (X11; Linux i686) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.186 Safari/535.1';
//       $header [] = 'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
//       $header [] = 'Accept-Language: zh-CN,zh;q=0.8';
//       $header [] = 'Accept-Charset: GBK,utf-8;q=0.7,*;q=0.3';
//       $header [] = 'Cache-Control:max-age=0';
//       $header [] = 'Cookie:t_skey=p5gdu1nrke856futitemkld661; t__CkCkey_=29f7d98';
//       $header [] = 'Content-Type:application/json';
//       curl_setopt ( $curl, CURLOPT_HTTPHEADER, $header );

       curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length:' . strlen($param)));

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);

        curl_close($curl);
//    $j = json_decode($return, 1);

        return $return;

    }

    /**
     * @param $file  日志文件名称
     * @param string $msg   消息
     * @param int $end  中断 1 是，0 否
     */
    public static function addLog( $file , $msg='', $end=0 ){

        $msg = is_string($msg) ? $msg : var_export($msg,1);

        error_log(date("Y-m-d H:i:s") . "：{$msg}\r\n\r\n", 3, Yii::$app->basePath . '/runtime/logs/'.$file);

        if( $end ){
            exit();
        }
    }
    /**
     * 获取最新流水号【钱包流水、支付流水】
     * @param $code  支付流水 501，钱包流水 502
     * @param string $billTime
     * @param string $fsShopGUID
     * @return string
     */
    public static function getNewStream($code,$billTime='')
    {
        if( !in_array($code,['501','502']) ) Common::echoJson(400,'code有误');

        //定义前缀
        $fsParamValue = [
            '501' => 'PO',
            '502' => '',
        ];

        $paramModel = 'app\modules\v1\models\SCMTbParamValue';
        $fsShopGUID='99999';   //系统guid

        $query = $paramModel::find()->where(['fsShopGUID' => $fsShopGUID, 'fsParamId' => $code])->andWhere(['!=', 'fiStatus', 13])->asArray()->one();
        $connection = \Yii::$app->db;

        //未找到设置项，创建设置
        if (!$query) {
            $connection->createCommand()->insert($paramModel::tableName(), [
                'fsParamId' => $code,
                'fsParamValue' => $fsParamValue[$code],
                'fsStr1' => 'Y',
                'fsStr2' => 'm',
                'fsStr3' => 'd',
                'fsStr4' => '',
                'fsStr5' => '',
                'fiStatus' => '1',
                'fiInt1' => '8',                 //8位
                'fiInt2' => '',
                'fiInt3' => '',
                'fiInt4' => '',
                'fiInt5' => '',
                'fsUpdateUserId' => '',
                'fsUpdateUserName' => '',
                'fsCreateUserId' => Common::$user?Common::$user['fsUserId']:'',
                'fsCreateUserName' =>  Common::$user?Common::$user['fsUserName']:'',
                'fsCreateTime' => date("Y-m-d H:i:s"),
                'fsShopGUID' => $fsShopGUID
            ])->execute();
            $query = $paramModel::find()->where(['fsShopGUID' => $fsShopGUID, 'fsParamId' => $code])->andWhere(['!=', 'fiStatus', 13])->asArray()->one();
        }
        $str = '';
        $str .= $query['fsParamValue'];
        if(!empty($billTime)){
            $billTimeArray=explode("-",$billTime);
            if(count($billTimeArray)!=3){
                Common::echoJson(400, '单据时间格式错误');
            }
        }
        if ($query['fsStr1'] == "Y") {
            $str .= empty($billTime)?date('Y'):$billTimeArray[0];
        }
        if ($query['fsStr2'] == 'm') {
            $str .= empty($billTime)?date('m'):$billTimeArray[1];
        }
        if ($query['fsStr3'] == 'd') {
            $str .= empty($billTime)?date('d'):$billTimeArray[2];
        }
        $NoModel = 'app\modules\v1\models\SCMTbNo';
        $list = $NoModel::find()->where(['fsCls' => $str, 'fsShopGUID' => $fsShopGUID])->asArray()->one();
        $new_code = 1;
        $transaction = $connection->beginTransaction();
        try {
            if ($list) {
                $connection->createCommand()->update('SCM_tbNo', [
                    'fdNo' => $list['fdNo'] + 1,
                    'fsSysDate' => date("Y-m-d H:i:s"),
                ],
                    '"fsCls"=:fsCls and "fsShopGUID"=:fsShopGUID', [':fsCls' => $str, ':fsShopGUID' => $fsShopGUID])->execute();
                if ($query['fiInt1'] < 1) {
                    $query['fiInt1'] = 1;
                }
                $new_code = str_pad($list['fdNo'] + 1, $query['fiInt1'], "0", STR_PAD_LEFT);
            } else {
                $connection->createCommand()->insert('SCM_tbNo', [
                    'fsCls' => $str,
                    'fdNo' => $new_code,
                    'fsUse' => 'y',
                    'fsSysDate' => date("Y-m-d H:i:s"),
                    'fsShopGUID' => $fsShopGUID
                ])->execute();
                if ($query['fiInt1'] < 1) {
                    $query['fiInt1'] = 1;
                }
                $new_code = str_pad($new_code, $query['fiInt1'], "0", STR_PAD_LEFT);
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
        return $str . $new_code;
    }

}

