<?php
/**
 * Created by PhpStorm.
 * User: walkingSun
 * Date: 2018/8/19
 * Time: 21:03
 */
$blogConfig = \yii\helpers\ArrayHelper::index($blogConfig,'blogType');
?>
<style>
    .checkboxs{
        margin: 20px 15px 0px 0px;
    }
</style>
<body ng-app="App" ng-controller="mainController" class="ng-scope">
<div class="cat_add">
    <div class="cat_add_header">
        <div class="icon"></div>
        <div class="title">博客配置</div>
    </div>
    <div class="cat_add_form">
        <label class="">博客园</label>
        <form  class="form-horizontal ng-pristine ng-valid" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="blogType" value="6">
            <div class="form-group form-group-sm">
                <label class="control-label col-md-1">用户名</label>
                <div class="col-md-3">
                    <input class="form-control input-lg" type="text" name="username" value="<?=!empty($blogConfig[6]['username'])?$blogConfig[6]['username']:''?>" placeholder="请输入用户名">
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="control-label col-md-1">密码</label>
                <div class="col-md-3">
                    <input class="form-control input-lg" type="password" name="password" value="<?=!empty($blogConfig[6]['password'])?$blogConfig[6]['password']:''?>" placeholder="请输入密码">
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="control-label col-md-1">博客地址Id</label>
                <div class="col-md-3">
                    <input class="form-control input-lg" type="text" name="blogid" value="<?=!empty($blogConfig[6]['blogid'])?$blogConfig[6]['blogid']:''?>" placeholder="请输入地址id">
                </div>
                <span class="glyphicon glyphicon-asterisk star"></span>
                <label class="explain">如 https://www.cnblogs.com/followyou/，地址Id为followyou</label>
            </div>
            <div class="form-group form-group-sm" style="margin-top: 30px;">
                <div class="col-md-3 col-md-offset-2">
                    <div class="btn-group">
                        <button type="submit" onclick1111111="submit()" class="btn btn-danger btn-sm" title="设置"><i class="glyphicon glyphicon-floppy-save"></i> 设置</button>
                    </div>
                </div>
            </div>
        </form>


    </div>

</div>

<script>
    function submit(){
        var form = $("form").serialize();
        var url = '<?php echo \yii\helpers\Url::to(['metaweblog/add'])?>';
        $.post(url,form,function (r) {
            if(r.code==200){
                if( confirm("是否继续添加？") ){
                    location.href='<?php echo \yii\helpers\Url::to(['metaweblog/add'])?>';
                }else{
                    location.href='<?php echo \yii\helpers\Url::to(['metaweblog/index'])?>';
                }
                // layer.msg('success');
            }  else{
                layer.msg(r.msg);
            }
        },'json');
    }
</script>


</body>
