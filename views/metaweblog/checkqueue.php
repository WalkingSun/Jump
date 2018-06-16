<?php

?>
<?php //$this->registerJsFile("@web/js/jquery-3.3.1.min.js");?>
<style type="text/css">
    <!--
    @import url();
    <?php $this->registerCssFile("@web/css/style.css");?>
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
</style>

<div class="site-index">

    <table id="hor-zebra" summary="Employee Pay Sheet" border="1">
        <thead>
        <tr>
            <th  scope="col">队列</th>
            <th scope="col" style="">发布状态</th>
            <th  scope="col">response内容</th>
            <th scope="col" >创建时间</th>
            <th  scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if( $result ){
            foreach ($result as $v){ ?>
                <tr>
                    <td ><?=$v['queueId'];?></td>
                    <td ><?=$v['publishStatus']==0||$v['publishStatus']==1?'发布中':($v['publishStatus']==2?'发布完成':'发布失败');?></td>
                    <td ><?=$v['response']?:'--';?></td>
                    <td ><?=$v['createtime'];?></td>
                    <td >
                        <?php if( $v['publishStatus']==1 || $v['publishStatus']==3 ){ ?>
                            <a href="javascript:parent.UpdateQueue('<?=$v['queueId'];?>')"> 点击重试</a>
                        <?php }?>
                    </td>
                </tr>
            <?php    }
        }
        ?>

        </tbody>
    </table>



</div>
<script>


</script>


