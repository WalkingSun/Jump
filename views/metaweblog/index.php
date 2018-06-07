<?php

/* @var $this yii\web\View */
//$result = $this->result;
?>
<style>
  #newspaper-c thead tr th {
      padding:20px;font-weight:normal;font-size:13px;color:rgb(0,51,153);text-transform:uppercase;border-width:1px;border-style:solid;border-color:rgb(8,101,194) rgb(8,101,194) rgb(255,255,255);
  }

  #newspaper-c tbody tr td {
      padding:10px 20px;color:rgb(102,102,153);border-right-width:1px;border-right-style:dashed;border-right-color:rgb(102,204,255);
  }

</style>

<div class="site-index">

    <div> 添加 </div>

    <table id="newspaper-c" summary="Personal Movie Rating">
        <thead>
        <tr>
            <th scope="col" >Id</th>
            <th scope="col" >标题</th>
            <th scope="col" >内容</th>
            <th scope="col" >文件</th>
            <th scope="col" >cnblog博客id</th>
            <th scope="col" >创建时间</th>
            <th scope="col" >操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if( $result ){
            foreach ($result as $v){ ?>
        <tr>
            <td ><?=$v['id'];?></td>
            <td ><?=$v['title'];?></td>
            <td ><?=$v['content'];?></td>
            <td ><?=$v['fileurl'];?></td>
            <td ><?=$v['cnblogId'];?></td>
            <td ><?=$v['createtime'];?></td>
            <td ><a onclick="action('<?=$v['id'];?>','<?=$v['cnblogId']?2:1;?>')" ><?=$v['cnblogId']?'发送修改':'发送新增';?></>  <a onclick="action('<?=$v['id'];?>',3)">删除</a></td>
        </tr>
        <?php    }
        }
        ?>

     </tbody>
    </table>



</div>
<script>
    function action(blogId, type ){
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