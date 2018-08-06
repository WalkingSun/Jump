<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
//$result = $this->result;
?>
<style type="text/css">
    <!--
    @import url();
    <?php $this->registerCssFile("@web/css/style.css");?>
    <?php $this->registerJsFile("@web/js/jquery-3.3.1.min.js");?>
    <?php $this->registerJsFile("@web/js/layer/layer.js");?>
    -->

    table
    {
        table-layout: fixed;
        word-wrap: break-word;
        width: 100% !important;
    }

    table td,table th{
        text-align: center;
    }
    .paginationDiv{
        /*width:200px;*/
        text-align: center;
        /*margin: 0 auto;*/
    }
</style>


<h4>博客自动化发布</h4>
</br>

<div class="site-index">

    <div>
        <a style="margin-right: 15px;" href="<?=\yii\helpers\Url::to(['metaweblog/init'])?>"> 自动化配置 </a>

        <a href="<?=\yii\helpers\Url::to(['metaweblog/add'])?>"> 添加 </a>

    </div>

    <table id="hor-zebra" summary="Employee Pay Sheet" border="1">
        <thead>
        <tr>
            <th  scope="col">Id</th>
            <th scope="col" style="">标题</th>
            <th  scope="col">内容</th>
            <th  scope="col">mark文件</th>
            <th scope="col">cnblogs博客id</th>
            <th scope="col">cnblogs博客分类</th>
            <th scope="col" >创建时间</th>
            <th  scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if( $result ){
            foreach ($result as $v){ ?>
        <tr>
            <td ><?=$v['id'];?></td>
            <td ><?=$v['title'];?></td>
            <td ><?=$v['content']?:'--';?></td>
            <td ><?=$v['fileurl'];?></td>
            <td ><?=$v['cnblogsId'];?></td>
            <td ><?=$v['cnblogsType'];?></td>
            <td ><?=$v['createtime'];?></td>
            <td >
                <a href="javascript:checkQueue('<?=$v['id'];?>')"> 查看队列</a>
                <a style="cursor:pointer;" onclick="action('<?=$v['id'];?>','<?=$v['cnblogsId']?2:1;?>')" ><?=$v['cnblogsId']?'发送队列':'发送队列';?></a>
                <a style="cursor:pointer;" onclick="action('<?=$v['id'];?>',4)">修改</a>
                <a style="cursor:pointer;" onclick="action('<?=$v['id'];?>',3)">删除</a>
            </td>
        </tr>
        <?php    }
        }
        ?>

     </tbody>
    </table>
    <div class="paginationDiv">
        <?php
        echo \yii\widgets\LinkPager::widget([
            'pagination'=>$pagination,//分页类
//            'options'=>['class'=>'page'],  //设置分页组件样式
            'firstPageLabel' => '首页',
            'prevPageLabel' => '《',
            'nextPageLabel' => '》',
            'lastPageLabel' => '尾页',
            'maxButtonCount' => 5
        ]);
        ?>

    </div>

</div>
<script>
    function action(blogId, type ){
        if( type==3 ){
            var url = '<?php echo \yii\helpers\Url::to(['metaweblog/del'])?>';
            $.post(url,{blogId:blogId},function (r) {
                if(r.code==200){
                    // alert(r.msg);
                    location.href='<?php echo \yii\helpers\Url::to(['metaweblog/index'])?>';
                }  else{
                    alert(r.msg);
                }
            },'json');
            return false;
        }
        if( type==4 ){
            var url = '<?php echo \yii\helpers\Url::to(['metaweblog/edit'])?>'+'&blogId='+blogId;
            location.href = url;
            return false;
        }
        var url = '<?php echo \yii\helpers\Url::to(['metaweblog/queue'])?>&type='+type;
       $.post(url,{blogId:blogId,action:type},function (r) {
             if(r.code==200){
                 alert(r.msg);
             }  else{
                 alert(r.msg);
             }
       },'json');
    }

    function checkQueue( blogid ){
        //iframe层

        layer.open({
            type: 2,
            title: '队列记录',
            shadeClose: true,
            shade: 0.8,
            area: ['600px', '90%'],
            content: '<?=\yii\helpers\Url::to(['metaweblog/checkqueue'])?>'+'&blogid='+blogid
        });
    }

    UpdateQueue = function updateQueue( queueid ){
        var url = '<?=\yii\helpers\Url::to(['metaweblog/updatequeue'])?>&queueid='+queueid;
        $.post(url,{queueid:queueid},function (r) {
            if(r.code==200){
                alert(r.msg);
                var index = parent.layer.getFrameIndex(window.name);
                setTimeout(function(){parent.layer.close(index)}, 1000);
            }  else{
                alert(r.msg);
            }
        },'json');
    }
</script>