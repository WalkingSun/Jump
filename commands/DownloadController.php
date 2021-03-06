<?php

namespace app\commands;

use function GuzzleHttp\Psr7\parse_query;
use PHPHtmlParser\Dom;
use Yii;
use yii\console\Controller;
use yii\db\Exception;


class DownloadController extends Controller
{

    //下载凡人修仙传 大灰狼 有声听书  哈哈！！！
    public function actionIndex()
    {
        header("Content-type:text/html;charset=utf-8");

        $filepath = \Yii::$app->basePath.'/runtime/fanren/';
        for($i=1;$i<1631;$i++){
            $aim = $i;
            if( $i<100 ) $aim = sprintf('%03d',$i);
            $file="http://tingmp3.meiwenfen.com/%E7%8E%84%E5%B9%BB%E5%A5%87%E5%B9%BB/%E5%87%A1%E4%BA%BA%E4%BF%AE%E4%BB%99%E4%BC%A0/{$aim}.mp3";

            $handle = fopen($file,'r');
            $filepathMp3 = $filepath."/{$aim}.mp3";
            if( !file_exists($filepathMp3) ){
                $handle1 = fopen($filepathMp3, "w");
                fclose($handle1);
            }

            $r = file_put_contents($filepathMp3, $handle);
            fclose($handle);
            var_dump($aim." $r $file \r\n");
            sleep(2);
        }
    }


    public function actionXianjie()
    {
        header("Content-type:text/html;charset=utf-8");

        $filepath = \Yii::$app->basePath.'/runtime/fanren/';
        $path = 'http://mp3-2e.ting89.com:9090/2020/{date}/%E5%87%A1%E4%BA%BA%E4%BF%AE%E4%BB%99%E4%BC%A0%E4%B9%8B%E4%BB%99%E7%95%8C%E7%AF%87_%E5%A4%A7%E7%81%B0%E7%8B%BC/';//%E7%AC%AC001%E9%9B%86_%E7%8B%90%E5%A5%B3.mp3';
        $content = '<ul><li><a href="/down/?15633-0.html" target="_blank">第001集_狐女</a></li><li><a href="/down/?15633-1.html" target="_blank">第002集_石头哥哥</a></li><li><a href="/down/?15633-2.html" target="_blank">第003集_远去</a></li><li><a href="/down/?15633-3.html" target="_blank">第004集_相依</a></li><li><a href="/down/?15633-4.html" target="_blank">第005集_马兽</a></li><li><a href="/down/?15633-5.html" target="_blank">第006集_白袍少年</a></li><li><a href="/down/?15633-6.html" target="_blank">第007集_余府</a></li><li><a href="/down/?15633-7.html" target="_blank">第008集_白石真人</a></li><li><a href="/down/?15633-8.html" target="_blank">第009集_法阵</a></li><li><a href="/down/?15633-9.html" target="_blank">第010集_危机</a></li><li><a href="/down/?15633-10.html" target="_blank">第011集_苏醒</a></li><li><a href="/down/?15633-11.html" target="_blank">第012集_我是韩立</a></li><li><a href="/down/?15633-12.html" target="_blank">第013集_魔光</a></li><li><a href="/down/?15633-13.html" target="_blank">第014集_遭变</a></li><li><a href="/down/?15633-14.html" target="_blank">第015集_令牌</a></li><li><a href="/down/?15633-15.html" target="_blank">第016集_绝望</a></li><li><a href="/down/?15633-16.html" target="_blank">第017集_灭二修</a></li><li><a href="/down/?15633-17.html" target="_blank">第018集_请求</a></li><li><a href="/down/?15633-18.html" target="_blank">第019集_化神侄孙</a></li><li><a href="/down/?15633-19.html" target="_blank">第020集_邀请</a></li><li><a href="/down/?15633-20.html" target="_blank">第021集_元婴异变</a></li><li><a href="/down/?15633-21.html" target="_blank">第022集_风云双煞</a></li><li><a href="/down/?15633-22.html" target="_blank">第023集_争斗</a></li><li><a href="/down/?15633-23.html" target="_blank">第024集_碾压</a></li><li><a href="/down/?15633-24.html" target="_blank">第025集_陆崖</a></li><li><a href="/down/?15633-25.html" target="_blank">第026集_敌踪再现</a></li><li><a href="/down/?15633-26.html" target="_blank">第027集_担五岳_压五鬼</a></li><li><a href="/down/?15633-27.html" target="_blank">第028集_惊动</a></li><li><a href="/down/?15633-28.html" target="_blank">第029集_灵焰山脉</a></li><li><a href="/down/?15633-29.html" target="_blank">第030集_举田</a></li><li><a href="/down/?15633-30.html" target="_blank">第031集_通易谷</a></li><li><a href="/down/?15633-31.html" target="_blank">第032集_逆丹诀</a></li><li><a href="/down/?15633-32.html" target="_blank">第033集_先天紫气</a></li><li><a href="/down/?15633-33.html" target="_blank">第034集_失窃</a></li><li><a href="/down/?15633-34.html" target="_blank">第035集_瞒天过海</a></li><li><a href="/down/?15633-35.html" target="_blank">第036集_偷梁换柱</a></li><li><a href="/down/?15633-36.html" target="_blank">第037集_脱身</a></li><li><a href="/down/?15633-37.html" target="_blank">第038集_柳暗花明</a></li><li><a href="/down/?15633-38.html" target="_blank">第039集_传谕</a></li><li><a href="/down/?15633-39.html" target="_blank">第040集_不了了之</a></li><li><a href="/down/?15633-40.html" target="_blank">第041集_小瓶掌天</a></li><li><a href="/down/?15633-41.html" target="_blank">第042集_失而复得</a></li><li><a href="/down/?15633-42.html" target="_blank">第043集_大仇得报</a></li><li><a href="/down/?15633-43.html" target="_blank">第044集_隔元法链</a></li><li><a href="/down/?15633-44.html" target="_blank">第045集_这不可能</a></li><li><a href="/down/?15633-45.html" target="_blank">第046集_两个办法</a></li><li><a href="/down/?15633-46.html" target="_blank">第047集_试探</a></li><li><a href="/down/?15633-47.html" target="_blank">第048集_劫持</a></li><li><a href="/down/?15633-48.html" target="_blank">第049集_要挟</a></li><li><a href="/down/?15633-49.html" target="_blank">第050集_破塔而出</a></li><li><a href="/down/?15633-50.html" target="_blank">第051集_小挪移空间术</a></li><li><a href="/down/?15633-51.html" target="_blank">第052集_该我了</a></li><li><a href="/down/?15633-52.html" target="_blank">第053集_魔焰焚身</a></li><li><a href="/down/?15633-53.html" target="_blank">第054集_吞吐魔焰</a></li><li><a href="/down/?15633-54.html" target="_blank">第055集_交代</a></li><li><a href="/down/?15633-55.html" target="_blank">第056集_天鬼出世</a></li><li><a href="/down/?15633-56.html" target="_blank">第057集_惊蛰变</a></li><li><a href="/down/?15633-57.html" target="_blank">第058集_却之不恭</a></li><li><a href="/down/?15633-58.html" target="_blank">第059集_借星台</a></li><li><a href="/down/?15633-59.html" target="_blank">第060集_通缉</a></li><li><a href="/down/?15633-60.html" target="_blank">第061集_暗流</a></li><li><a href="/down/?15633-61.html" target="_blank">第062集_反常</a></li><li><a href="/down/?15633-62.html" target="_blank">第063集_撒豆成兵</a></li><li><a href="/down/?15633-63.html" target="_blank">第064集_同时出手</a></li><li><a href="/down/?15633-64.html" target="_blank">第065集_玄黄之索</a></li><li><a href="/down/?15633-65.html" target="_blank">第066集_灵婴剑符</a></li><li><a href="/down/?15633-66.html" target="_blank">第067集_百目天鬼</a></li><li><a href="/down/?15633-67.html" target="_blank">第068集_追杀</a></li><li><a href="/down/?15633-68.html" target="_blank">第069集_银月之变</a></li><li><a href="/down/?15633-69.html" target="_blank">第070集_天外飞豆</a></li><li><a href="/down/?15633-70.html" target="_blank">第071集_涅槃圣体</a></li><li><a href="/down/?15633-71.html" target="_blank">第072集_收服大乘</a></li><li><a href="/down/?15633-72.html" target="_blank">第073集_灭门</a></li><li><a href="/down/?15633-73.html" target="_blank">第074集_出事了</a></li><li><a href="/down/?15633-74.html" target="_blank">第075集_打听</a></li><li><a href="/down/?15633-75.html" target="_blank">第076集_传奇</a></li><li><a href="/down/?15633-76.html" target="_blank">第077集_两件异宝</a></li><li><a href="/down/?15633-77.html" target="_blank">第078集_北斗异像</a></li><li><a href="/down/?15633-78.html" target="_blank">第079集_破碎虚空</a></li><li><a href="/down/?15633-79.html" target="_blank">第080集_神秘气泡</a></li><li><a href="/down/?15633-80.html" target="_blank">第081集_独目巨人与半人马</a></li><li><a href="/down/?15633-81.html" target="_blank">第082集_交锋</a></li><li><a href="/down/?15633-82.html" target="_blank">第083集_急中生智</a></li><li><a href="/down/?15633-83.html" target="_blank">第084集_雕像</a></li><li><a href="/down/?15633-84.html" target="_blank">第085集_祖神</a></li><li><a href="/down/?15633-85.html" target="_blank">第086集_退敌</a></li><li><a href="/down/?15633-86.html" target="_blank">第087集_地仙</a></li><li><a href="/down/?15633-87.html" target="_blank">第088集_地祇化身</a></li><li><a href="/down/?15633-88.html" target="_blank">第089集_仙器</a></li><li><a href="/down/?15633-89.html" target="_blank">第090集_寻觅</a></li><li><a href="/down/?15633-90.html" target="_blank">第091集_尝试</a></li><li><a href="/down/?15633-91.html" target="_blank">第092集_第九条锁链</a></li><li><a href="/down/?15633-92.html" target="_blank">第093集_前提条件</a></li><li><a href="/down/?15633-93.html" target="_blank">第094集_祖神遗言</a></li><li><a href="/down/?15633-94.html" target="_blank">第095集_小瓶失灵</a></li><li><a href="/down/?15633-95.html" target="_blank">第096集_绿液再现</a></li><li><a href="/down/?15633-96.html" target="_blank">第097集_三名祖神</a></li><li><a href="/down/?15633-97.html" target="_blank">第098集_被困</a></li><li><a href="/down/?15633-98.html" target="_blank">第099集_承认身份</a></li><li><a href="/down/?15633-99.html" target="_blank">第100集_牛头面具</a></li><li><a href="/down/?15633-100.html" target="_blank">第101集_无常盟</a></li><li><a href="/down/?15633-101.html" target="_blank">第102集_迟到</a></li><li><a href="/down/?15633-102.html" target="_blank">第103集_红月岛主</a></li><li><a href="/down/?15633-103.html" target="_blank">第104集_朝圣</a></li><li><a href="/down/?15633-104.html" target="_blank">第105集_接头</a></li><li><a href="/down/?15633-105.html" target="_blank">第106集_血色空间</a></li><li><a href="/down/?15633-106.html" target="_blank">第107集_脱困</a></li><li><a href="/down/?15633-107.html" target="_blank">第108集_诡异</a></li><li><a href="/down/?15633-108.html" target="_blank">第109集_初探红月城</a></li><li><a href="/down/?15633-109.html" target="_blank">第110集_线索</a></li><li><a href="/down/?15633-110.html" target="_blank">第111集_天选</a></li><li><a href="/down/?15633-111.html" target="_blank">第112集_端倪</a></li><li><a href="/down/?15633-112.html" target="_blank">第113集_算计</a></li><li><a href="/down/?15633-113.html" target="_blank">第114集_以命换命</a></li><li><a href="/down/?15633-114.html" target="_blank">第115集_再战仇五</a></li><li><a href="/down/?15633-115.html" target="_blank">第116集_惊退二仙</a></li><li><a href="/down/?15633-116.html" target="_blank">第117集_再陷困境</a></li><li><a href="/down/?15633-117.html" target="_blank">第118集_诱饵</a></li><li><a href="/down/?15633-118.html" target="_blank">第119集_红月</a></li><li><a href="/down/?15633-119.html" target="_blank">第120集_鏖战岛主</a></li><li><a href="/down/?15633-120.html" target="_blank">第121集_举荐</a></li><li><a href="/down/?15633-121.html" target="_blank">第122集_试炼</a></li><li><a href="/down/?15633-122.html" target="_blank">第123集_黑海重水经</a></li><li><a href="/down/?15633-123.html" target="_blank">第124集_土孙果和凝海晶</a></li><li><a href="/down/?15633-124.html" target="_blank">第125集_凝练化身</a></li><li><a href="/down/?15633-125.html" target="_blank">第126集_胁迫</a></li><li><a href="/down/?15633-126.html" target="_blank">第127集_出乎意料</a></li><li><a href="/down/?15633-127.html" target="_blank">第128集_破链(上)</a></li><li><a href="/down/?15633-128.html" target="_blank">第129集_破链(下)</a></li><li><a href="/down/?15633-129.html" target="_blank">第130集_似曾相识</a></li><li><a href="/down/?15633-130.html" target="_blank">第131集_灵液化晶</a></li><li><a href="/down/?15633-131.html" target="_blank">第132集_重水</a></li><li><a href="/down/?15633-132.html" target="_blank">第133集_三大至尊法则</a></li><li><a href="/down/?15633-133.html" target="_blank">第134集_逆天灵物</a></li><li><a href="/down/?15633-134.html" target="_blank">第135集_本命八灵缸</a></li><li><a href="/down/?15633-135.html" target="_blank">第136集_安排</a></li><li><a href="/down/?15633-136.html" target="_blank">第137集_黑风城</a></li><li><a href="/down/?15633-137.html" target="_blank">第138集_仙元石和地丹师</a></li><li><a href="/down/?15633-138.html" target="_blank">第139集_仙界丹师</a></li><li><a href="/down/?15633-139.html" target="_blank">第140集_道丹</a></li><li><a href="/down/?15633-140.html" target="_blank">第141集_炼丹比试</a></li><li><a href="/down/?15633-141.html" target="_blank">第142集_不可兼得</a></li><li><a href="/down/?15633-142.html" target="_blank">第143集_寻人</a></li><li><a href="/down/?15633-143.html" target="_blank">第144集_失踪的岛主之女</a></li><li><a href="/down/?15633-144.html" target="_blank">第145集_寻迹追踪</a></li><li><a href="/down/?15633-145.html" target="_blank">第146集_青羽岛二修</a></li><li><a href="/down/?15633-146.html" target="_blank">第147集_夺功</a></li><li><a href="/down/?15633-147.html" target="_blank">第148集_斗三煞</a></li><li><a href="/down/?15633-148.html" target="_blank">第149集_大拍卖会</a></li><li><a href="/down/?15633-149.html" target="_blank">第150集_竞价</a></li><li><a href="/down/?15633-150.html" target="_blank">第151集_重水雷珠</a></li><li><a href="/down/?15633-151.html" target="_blank">第152集_初见道丹</a></li><li><a href="/down/?15633-152.html" target="_blank">第153集_参悟雷珠</a></li><li><a href="/down/?15633-153.html" target="_blank">第154集_烛龙道</a></li><li><a href="/down/?15633-154.html" target="_blank">第155集_离去</a></li><li><a href="/down/?15633-155.html" target="_blank">第156集_叵测仙途</a></li><li><a href="/down/?15633-156.html" target="_blank">第157集_仙栈</a></li><li><a href="/down/?15633-157.html" target="_blank">第158集_启程</a></li><li><a href="/down/?15633-158.html" target="_blank">第159集_一路往东</a></li><li><a href="/down/?15633-159.html" target="_blank">第160集_甘九真</a></li><li><a href="/down/?15633-160.html" target="_blank">第161集_困斗</a></li><li><a href="/down/?15633-161.html" target="_blank">第162集_赠符</a></li><li><a href="/down/?15633-162.html" target="_blank">第163集_兽潮之殃</a></li><li><a href="/down/?15633-163.html" target="_blank">第164集_隐藏的强者</a></li><li><a href="/down/?15633-164.html" target="_blank">第165集_似曾相识</a></li><li><a href="/down/?15633-165.html" target="_blank">第166集_速之法则</a></li><li><a href="/down/?15633-166.html" target="_blank">第167集_封婴之仇</a></li><li><a href="/down/?15633-167.html" target="_blank">第168集_追逃</a></li><li><a href="/down/?15633-168.html" target="_blank">第169集_反击</a></li><li><a href="/down/?15633-169.html" target="_blank">第170集_迁怒</a></li><li><a href="/down/?15633-170.html" target="_blank">第171集_被逼无奈</a></li><li><a href="/down/?15633-171.html" target="_blank">第172集_做个了结</a></li><li><a href="/down/?15633-172.html" target="_blank">第173集_似真似幻</a></li><li><a href="/down/?15633-173.html" target="_blank">第174集_背后主使</a></li><li><a href="/down/?15633-174.html" target="_blank">第175集_跨海雷舟</a></li><li><a href="/down/?15633-175.html" target="_blank">第176集_雷暴</a></li><li><a href="/down/?15633-176.html" target="_blank">第177集_深海巨蚌</a></li><li><a href="/down/?15633-177.html" target="_blank">第178集_蚌口取珠</a></li><li><a href="/down/?15633-178.html" target="_blank">第179集_踏足新大陆</a></li><li><a href="/down/?15633-179.html" target="_blank">第180集_感应</a></li><li><a href="/down/?15633-180.html" target="_blank">第181集_天魔夺舍</a></li><li><a href="/down/?15633-181.html" target="_blank">第182集_祭天</a></li><li><a href="/down/?15633-182.html" target="_blank">第183集_太峨诛魔</a></li><li><a href="/down/?15633-183.html" target="_blank">第184集_一个请求</a></li><li><a href="/down/?15633-184.html" target="_blank">第185集_初入烛龙</a></li><li><a href="/down/?15633-185.html" target="_blank">第186集_打算</a></li><li><a href="/down/?15633-186.html" target="_blank">第187集_资质低下</a></li><li><a href="/down/?15633-187.html" target="_blank">第188集_金仙收徒</a></li><li><a href="/down/?15633-188.html" target="_blank">第189集_洞府与守山兽</a></li><li><a href="/down/?15633-189.html" target="_blank">第190集_无相真轮经</a></li><li><a href="/down/?15633-190.html" target="_blank">第191集_真仙仆从</a></li><li><a href="/down/?15633-191.html" target="_blank">第192集_选仆</a></li><li><a href="/down/?15633-192.html" target="_blank">第193集_守山灵兽</a></li><li><a href="/down/?15633-193.html" target="_blank">第194集_气息再现</a></li><li><a href="/down/?15633-194.html" target="_blank">第195集_火脉现踪</a></li><li><a href="/down/?15633-195.html" target="_blank">第196集_布置</a></li><li><a href="/down/?15633-196.html" target="_blank">第197集_真言化轮经</a></li><li><a href="/down/?15633-197.html" target="_blank">第198集_狗屎运</a></li><li><a href="/down/?15633-198.html" target="_blank">第199集_北斗天星盘</a></li><li><a href="/down/?15633-199.html" target="_blank">第200集_宝轮初成</a></li><li><a href="/down/?15633-200.html" target="_blank">第201集_出现异常</a></li><li><a href="/down/?15633-201.html" target="_blank">第202集_重水真轮</a></li><li><a href="/down/?15633-202.html" target="_blank">第203集_初入太玄殿</a></li><li><a href="/down/?15633-203.html" target="_blank">第204集_派系之争</a></li><li><a href="/down/?15633-204.html" target="_blank">第205集_逆元石剑</a></li><li><a href="/down/?15633-205.html" target="_blank">第206集_把握分寸</a></li><li><a href="/down/?15633-206.html" target="_blank">第207集_把握分寸</a></li><li><a href="/down/?15633-207.html" target="_blank">第208集_天剑冢</a></li><li><a href="/down/?15633-208.html" target="_blank">第209集_千锋聚灵</a></li><li><a href="/down/?15633-209.html" target="_blank">第210集_群剑乱舞</a></li><li><a href="/down/?15633-210.html" target="_blank">第211集_逆转</a></li><li><a href="/down/?15633-211.html" target="_blank">第212集_破空</a></li><li><a href="/down/?15633-212.html" target="_blank">第213集_回来了</a></li><li><a href="/down/?15633-213.html" target="_blank">第214集_六道</a></li><li><a href="/down/?15633-214.html" target="_blank">第215集_群猴拜仙</a></li><li><a href="/down/?15633-215.html" target="_blank">第216集_钟鸣声起</a></li><li><a href="/down/?15633-216.html" target="_blank">第217集_邋遢老头</a></li><li><a href="/down/?15633-217.html" target="_blank">第218集_一个巧合</a></li><li><a href="/down/?15633-218.html" target="_blank">第219集_小试锋芒</a></li><li><a href="/down/?15633-219.html" target="_blank">第220集_顺道为之</a></li><li><a href="/down/?15633-220.html" target="_blank">第221集_醍醐论道</a></li><li><a href="/down/?15633-221.html" target="_blank">第222集_酒逢知己</a></li><li><a href="/down/?15633-222.html" target="_blank">第223集_印记</a></li><li><a href="/down/?15633-223.html" target="_blank">第224集_移祸江东</a></li><li><a href="/down/?15633-224.html" target="_blank">第225集_又见孙克</a></li><li><a href="/down/?15633-225.html" target="_blank">第226集_仙俗</a></li><li><a href="/down/?15633-226.html" target="_blank">第227集_三路</a></li><li><a href="/down/?15633-227.html" target="_blank">第228集_差距</a></li><li><a href="/down/?15633-228.html" target="_blank">第229集_被困</a></li><li><a href="/down/?15633-229.html" target="_blank">第230集_话多</a></li><li><a href="/down/?15633-230.html" target="_blank">第231集_重水之威</a></li><li><a href="/down/?15633-231.html" target="_blank">第232集_释疑</a></li><li><a href="/down/?15633-232.html" target="_blank">第233集_植豆兵</a></li><li><a href="/down/?15633-233.html" target="_blank">第234集_猴儿酒</a></li><li><a href="/down/?15633-234.html" target="_blank">第235集_猴王献宝</a></li><li><a href="/down/?15633-235.html" target="_blank">第236集_初涉仙丹</a></li><li><a href="/down/?15633-236.html" target="_blank">第237集_法则炼丹</a></li><li><a href="/down/?15633-237.html" target="_blank">第238集_囊中羞涩</a></li><li><a href="/down/?15633-238.html" target="_blank">第239集_狂人</a></li><li><a href="/down/?15633-239.html" target="_blank">第240集_金仙议事</a></li><li><a href="/down/?15633-240.html" target="_blank">第241集_麟九传讯</a></li><li><a href="/down/?15633-241.html" target="_blank">第242集_熔金炼剑</a></li><li><a href="/down/?15633-242.html" target="_blank">第243集_极寒</a></li><li><a href="/down/?15633-243.html" target="_blank">第244集_判断</a></li><li><a href="/down/?15633-244.html" target="_blank">第245集_入谷</a></li><li><a href="/down/?15633-245.html" target="_blank">第246集_燃婴血丹</a></li><li><a href="/down/?15633-246.html" target="_blank">第247集_避其锋芒</a></li><li><a href="/down/?15633-247.html" target="_blank">第248集_临死一击</a></li><li><a href="/down/?15633-248.html" target="_blank">第249集_招惹仙宫</a></li><li><a href="/down/?15633-249.html" target="_blank">第250集_身陷绝境</a></li><li><a href="/down/?15633-250.html" target="_blank">第251集_拖延</a></li><li><a href="/down/?15633-251.html" target="_blank">第252集_金仙的威胁</a></li><li><a href="/down/?15633-252.html" target="_blank">第253集_惹麻烦</a></li><li><a href="/down/?15633-253.html" target="_blank">第254集_争炉</a></li><li><a href="/down/?15633-254.html" target="_blank">第255集_避风头</a></li><li><a href="/down/?15633-255.html" target="_blank">第256集_闲事</a></li><li><a href="/down/?15633-256.html" target="_blank">第257集_还人情</a></li><li><a href="/down/?15633-257.html" target="_blank">第258集_启盒</a></li><li><a href="/down/?15633-258.html" target="_blank">第259集_忙碌</a></li><li><a href="/down/?15633-259.html" target="_blank">第260集_炼剑</a></li><li><a href="/down/?15633-260.html" target="_blank">第261集_浮山异变</a></li><li><a href="/down/?15633-261.html" target="_blank">第262集_出关</a></li><li><a href="/down/?15633-262.html" target="_blank">第263集_试验真轮</a></li><li><a href="/down/?15633-263.html" target="_blank">第264集_托付身后事</a></li><li><a href="/down/?15633-264.html" target="_blank">第265集_极限尝试</a></li><li><a href="/down/?15633-265.html" target="_blank">第266集_五千奖励</a></li><li><a href="/down/?15633-266.html" target="_blank">第267集_白雀</a></li><li><a href="/down/?15633-267.html" target="_blank">第268集_念羽</a></li><li><a href="/down/?15633-268.html" target="_blank">第269集_真实之眼</a></li><li><a href="/down/?15633-269.html" target="_blank">第270集_时空补缺</a></li><li><a href="/down/?15633-270.html" target="_blank">第271集_真眼之实</a></li><li><a href="/down/?15633-271.html" target="_blank">第272集_逆转真轮</a></li><li><a href="/down/?15633-272.html" target="_blank">第273集_惊诧</a></li><li><a href="/down/?15633-273.html" target="_blank">第274集_大耳僧讲道</a></li><li><a href="/down/?15633-274.html" target="_blank">第275集_偷道的代价</a></li><li><a href="/down/?15633-275.html" target="_blank">第276集_闭关百年</a></li><li><a href="/down/?15633-276.html" target="_blank">第277集_法言天地</a></li><li><a href="/down/?15633-277.html" target="_blank">第278集_回溯</a></li><li><a href="/down/?15633-278.html" target="_blank">第279集_母豆发芽</a></li><li><a href="/down/?15633-279.html" target="_blank">第280集_豆兵异变</a></li><li><a href="/down/?15633-280.html" target="_blank">第281集_圣傀门</a></li><li><a href="/down/?15633-281.html" target="_blank">第282集_驻守三年</a></li><li><a href="/down/?15633-282.html" target="_blank">第283集_白家老祖</a></li><li><a href="/down/?15633-283.html" target="_blank">第284集_另一暗势力</a></li><li><a href="/down/?15633-284.html" target="_blank">第285集_破阵进击</a></li><li><a href="/down/?15633-285.html" target="_blank">第286集_一触即发</a></li><li><a href="/down/?15633-286.html" target="_blank">第287集_二对三</a></li><li><a href="/down/?15633-287.html" target="_blank">第288集_援手</a></li><li><a href="/down/?15633-288.html" target="_blank">第289集_谈崩</a></li><li><a href="/down/?15633-289.html" target="_blank">第290集_静观其变</a></li><li><a href="/down/?15633-290.html" target="_blank">第291集_驰援</a></li><li><a href="/down/?15633-291.html" target="_blank">第292集_救援</a></li><li><a href="/down/?15633-292.html" target="_blank">第293集_解惑</a></li><li><a href="/down/?15633-293.html" target="_blank">第294集_禁地与金仙傀儡</a></li><li><a href="/down/?15633-294.html" target="_blank">第295集_大周天星元功</a></li><li><a href="/down/?15633-295.html" target="_blank">第296集_刀剑相逢</a></li><li><a href="/down/?15633-296.html" target="_blank">第297集_冤家路窄</a></li><li><a href="/down/?15633-297.html" target="_blank">第298集_颓势</a></li><li><a href="/down/?15633-298.html" target="_blank">第299集_动一下试试</a></li><li><a href="/down/?15633-299.html" target="_blank">第300集_不详</a></li><li><a href="/down/?15633-300.html" target="_blank">第301集_煞</a></li><li><a href="/down/?15633-301.html" target="_blank">第302集_针锋相对</a></li><li><a href="/down/?15633-302.html" target="_blank">第303集_震惊</a></li><li><a href="/down/?15633-303.html" target="_blank">第304集_灵煞晶丝</a></li><li><a href="/down/?15633-304.html" target="_blank">第305集_手段尽出</a></li><li><a href="/down/?15633-305.html" target="_blank">第306集_不要也罢</a></li><li><a href="/down/?15633-306.html" target="_blank">第307集_仙傀儡</a></li><li><a href="/down/?15633-307.html" target="_blank">第308集_改造</a></li><li><a href="/down/?15633-308.html" target="_blank">第309集_进阶后期</a></li><li><a href="/down/?15633-309.html" target="_blank">第310集_两株花</a></li><li><a href="/down/?15633-310.html" target="_blank">第311集_植豆入傫</a></li><li><a href="/down/?15633-311.html" target="_blank">第312集_雷豆</a></li><li><a href="/down/?15633-312.html" target="_blank">第313集_另辟蹊径</a></li><li><a href="/down/?15633-313.html" target="_blank">第314集_融合</a></li><li><a href="/down/?15633-314.html" target="_blank">第315集_第一道主</a></li><li><a href="/down/?15633-315.html" target="_blank">第316集_祁良之邀主</a></li><li><a href="/down/?15633-316.html" target="_blank">第317集_天蝎令</a></li><li><a href="/down/?15633-317.html" target="_blank">第318集_交换会</a></li><li><a href="/down/?15633-318.html" target="_blank">第319集_消息</a></li><li><a href="/down/?15633-319.html" target="_blank">第320集_地下拍卖会</a></li><li><a href="/down/?15633-320.html" target="_blank">第321集_共生纹</a></li><li><a href="/down/?15633-321.html" target="_blank">第322集_天价争夺</a></li><li><a href="/down/?15633-322.html" target="_blank">第323集_识货人</a></li><li><a href="/down/?15633-323.html" target="_blank">第324集_炼化</a></li><li><a href="/down/?15633-324.html" target="_blank">第325集_一息十块</a></li><li><a href="/down/?15633-325.html" target="_blank">第326集_陆续到场</a></li><li><a href="/down/?15633-326.html" target="_blank">第327集_天人有五衰</a></li><li><a href="/down/?15633-327.html" target="_blank">第328集_蒙在鼓里</a></li><li><a href="/down/?15633-328.html" target="_blank">第329集_轮回殿要犯</a></li><li><a href="/down/?15633-329.html" target="_blank">第330集_混乱</a></li><li><a href="/down/?15633-330.html" target="_blank">第331集_屠鸡宰狗</a></li><li><a href="/down/?15633-331.html" target="_blank">第332集_地底异动</a></li><li><a href="/down/?15633-332.html" target="_blank">第333集_巨首</a></li><li><a href="/down/?15633-333.html" target="_blank">第334集_困龙之斗</a></li><li><a href="/down/?15633-334.html" target="_blank">第335集_业火归身</a></li><li><a href="/down/?15633-335.html" target="_blank">第336集_想起来了</a></li><li><a href="/down/?15633-336.html" target="_blank">第337集_极山再现</a></li><li><a href="/down/?15633-337.html" target="_blank">第338集_宝轮显威</a></li><li><a href="/down/?15633-338.html" target="_blank">第339集_巨瞳</a></li><li><a href="/down/?15633-339.html" target="_blank">第340集_诱敌</a></li><li><a href="/down/?15633-340.html" target="_blank">第341集_炼婴</a></li><li><a href="/down/?15633-341.html" target="_blank">第342集_离宗</a></li><li><a href="/down/?15633-342.html" target="_blank">第343集_打算</a></li><li><a href="/down/?15633-343.html" target="_blank">第344集_收获</a></li><li><a href="/down/?15633-344.html" target="_blank">第345集_避风头</a></li><li><a href="/down/?15633-345.html" target="_blank">第346集_悬赏追杀</a></li><li><a href="/down/?15633-346.html" target="_blank">第347集_名额</a></li><li><a href="/down/?15633-347.html" target="_blank">第348集_旁敲侧击</a></li><li><a href="/down/?15633-348.html" target="_blank">第349集_耐人寻味</a></li><li><a href="/down/?15633-349.html" target="_blank">第350集_封城</a></li><li><a href="/down/?15633-350.html" target="_blank">第351集_路遇纷争</a></li><li><a href="/down/?15633-351.html" target="_blank">第352集_暴露身份</a></li><li><a href="/down/?15633-352.html" target="_blank">第353集_重返乌蒙</a></li><li><a href="/down/?15633-353.html" target="_blank">第354集_选址</a></li><li><a href="/down/?15633-354.html" target="_blank">第355集_封岛</a></li><li><a href="/down/?15633-355.html" target="_blank">第356集_万轮丹</a></li><li><a href="/down/?15633-356.html" target="_blank">第357集_最后一步</a></li><li><a href="/down/?15633-357.html" target="_blank">第358集_豚兽赠石</a></li><li><a href="/down/?15633-358.html" target="_blank">第359集_回复</a></li><li><a href="/down/?15633-359.html" target="_blank">第360集_凑齐</a></li><li><a href="/down/?15633-360.html" target="_blank">第361集_丹劫</a></li><li><a href="/down/?15633-361.html" target="_blank">第362集_迁思回虑</a></li><li><a href="/down/?15633-362.html" target="_blank">第363集_劫至</a></li><li><a href="/down/?15633-363.html" target="_blank">第364集_孤注一掷</a></li></ul>';
        $dom = new Dom();
        $dom->loadStr($content);//var_dump($dom->find('a'));die;
        $list = $dom->find('a');

        foreach($list as $k=>$v){
            switch ($k){
                case 113:
                    $date = 18;
                    break;
            }
            try{
                $this->down($v,$path,$date,$filepath);
                sleep(2);
            }catch (\Exception $e){
                $date++;
                $this->down($v,$path,$date,$filepath);
                var_dump("fail:" . $v->text." \r\n");
                continue;
            }
            http://mp3-2e.ting89.com:9090/2020/18/%E5%87%A1%E4%BA%BA%E4%BF%AE%E4%BB%99%E4%BC%A0%E4%B9%8B%E4%BB%99%E7%95%8C%E7%AF%87_%E5%A4%A7%E7%81%B0%E7%8B%BC/%E7%AC%AC114%E9%9B%86_%E4%BB%A5%E5%91%BD%E6%8D%A2%E5%91%BD.mp3
        }
    }

    public function actionXianjie2()
    {
        header("Content-type:text/html;charset=utf-8");

        $filepath = \Yii::$app->basePath.'/runtime/fanren/';
        $path = 'http://www.ting89.com/down/?15633-{i}.html';
        for($i=0;$i<365;$i++){
            $aim = $i;
            if( $i<100 ) $aim = sprintf('%03d',$i);
            $file=str_replace("{i}",$aim,$path);
            $content = file_get_contents($file);//var_dump($file,$content);die;
            $findStr1 = "<iframe src=\"//play.ting89.com/down/down.php?url=";
            $start = strpos($content,$findStr1);
            $findStr2 = "\" height=\"41px\" width=\"614px\" frameborder=\"0\"></iframe>";
            $end = strpos($content,$findStr2);
            $text = substr($content,$start+strlen($findStr1),$end-$start-strlen($findStr1));
            $text = iconv("gb2312", "utf-8//IGNORE", $text);
            $text = urldecode($text);
            $title = urldecode(array_pop(explode("/",$text)));

            $text = $this->str2utf8($text);
            $text = str_replace('mp3-2e.ting89.com:9090','mp3-2e.ting89.com:9090',$text);
            $t = explode("http://mp3-2e.ting89.com:9090/2020/",$text);
            $tt = explode('/',array_pop($t));
            $d = array_shift($tt);
            $url = "http://mp3-2e.ting89.com:9090/2020/{$d}/".urlencode(implode('/',$tt));
            if($i==87){
                $url = "http://mp3-2e.ting89.com:9090/2020/17/%E5%87%A1%E4%BA%BA%E4%BF%AE%E4%BB%99%E4%BC%A0%E4%B9%8B%E4%BB%99%E7%95%8C%E7%AF%87_%E5%A4%A7%E7%81%B0%E7%8B%BC/%E7%AC%AC088%E9%9B%86_%E5%9C%B0%E7%A5%87%E5%8C%96%E8%BA%AB.mp3";
            }elseif($i==310){
                $url = "http://mp3-2e.ting89.com:9090/2020/32/%E5%87%A1%E4%BA%BA%E4%BF%AE%E4%BB%99%E4%BC%A0%E4%B9%8B%E4%BB%99%E7%95%8C%E7%AF%87_%E5%A4%A7%E7%81%B0%E7%8B%BC/%E7%AC%AC311%E9%9B%86_%E6%A4%8D%E8%B1%86%E5%85%A5%E5%82%AB.mp3";
            }
            $handle = fopen($url,'rb');
            $filepathMp3 = $filepath."/{$title}";
            if( !file_exists($filepathMp3) ){
                $handle1 = fopen($filepathMp3, "w");
                fclose($handle1);
            }

            $r = file_put_contents($filepathMp3, $handle);
            fclose($handle);
            var_dump("success". $aim." $r $title $url \r\n");
            sleep(1);
        }

    }

    protected function down($v,$path,$date,$filepath){
        $t = urlencode($v->text) . ".mp3";
        $file = $path . $t;
        $file = str_replace("{date}",$date,$file);
        $handle = fopen($file,'r');
        $filepathMp3 = $filepath."/{$v->text}.mp3";
//        if(file_exists($filepathMp3)){
//            continue;
//        }
        if( !file_exists($filepathMp3) ){
            $handle1 = fopen($filepathMp3, "w");
            fclose($handle1);
        }

        $r = file_put_contents($filepathMp3, $handle);
        fclose($handle);
        var_dump($v->text." $r $file \r\n");

    }

    function str2utf8 ($str = '')
    {
        $current_encode = mb_detect_encoding($str, array("ASCII", "GB2312", "GBK", 'BIG5', 'UTF-8'));
        $encoded_str = mb_convert_encoding($str, 'UTF-8', $current_encode);
        return $encoded_str;
    }


    public function actionXianjie3()
    {
        header("Content-type:text/html;charset=utf-8");

        $filepath = \Yii::$app->basePath.'/runtime/fanren/';
        $path = "https://m.tingshubao.com/player/tingchina.php?url=yousheng%2F30773%2Fplay_30773_{i}.htm";
        for($i=365;$i<546;$i++){
            $file=str_replace("{i}",$i,$path);
            $content = file_get_contents($file);//var_dump($file,$content);die;
            $url = json_decode($content,true)['url'];
            $urls = parse_url($url);
            $title = trim($urls['path'],'/');
            $handle = fopen($url,'rb');
            $filepathMp3 = $filepath."/{$title}";
            if( !file_exists($filepathMp3) ){
                $handle1 = fopen($filepathMp3, "w");
                fclose($handle1);
            }

            $r = file_put_contents($filepathMp3, $handle);
            fclose($handle);
            var_dump("success". $i." $r $title $url \r\n");
            sleep(1);
        }

    }
}
