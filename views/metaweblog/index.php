<?php

/* @var $this yii\web\View */
//$result = $this->result;
?>
<style type="text/css">
    <!--
    @import url();
    <?php $this->registerCssFile("@web/css/style.css");?>
    -->

    table thead th{
        /*display:inline-block;*/
        border-collapse: collapse;
        border-spacing: 0;
        margin: 0 auto;
    }
</style>


<h4>博客自动化发布</h4>
</br>

<div class="site-index">

    <div>
        <a href="<?=\yii\helpers\Url::to(['metaweblog/init'])?>"> 自动化配置 </a>

        <a href="<?=\yii\helpers\Url::to(['metaweblog/add'])?>"> 添加 </a>

    </div>

    <table id="hor-zebra" summary="Employee Pay Sheet">
        <thead>
        <tr>
            <th  scope="col">Id</th>
            <th scope="col" style="">标题</th>
            <th  scope="col">内容</th>
            <th  scope="col">文件</th>
            <th scope="col">cnblogs博客id</th>
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
            <td ><?=$v['createtime'];?></td>
            <td ><a style="cursor:pointer;" onclick="action('<?=$v['id'];?>','<?=$v['cnblogsId']?2:1;?>')" ><?=$v['cnblogsId']?'发送队列':'发送队列';?></a>  <a onclick="action('<?=$v['id'];?>',3)">删除</a></td>
        </tr>
        <?php    }
        }
        ?>

     </tbody>
    </table>



</div>
<script>
    function action(blogId, type ){
        if( type==3 ){
            var url = '<?php echo \yii\helpers\Url::to(['metaweblog/del'])?>';
            $.post(url,{blogId:blogId},function (r) {
                if(r.code==200){
                    alert(r.msg);
                    location.href='<?php echo \yii\helpers\Url::to(['metaweblog/index'])?>';
                }  else{
                    alert(r.msg);
                }
            },'json');
            return false;
        }
        var url = '<?php echo \yii\helpers\Url::to(['metaweblog/queue'])?>&type='+type;
       $.post(url,{blogId:blogId,action:type},function (r) {
             if(r.code==200){
                 alert('success');
             }  else{
                 alert(r.msg);
             }
       },'json');
    }
</script>