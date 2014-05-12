<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <title>TalkPiece开源垂直社区 安装程序- Powered by TalkPiece</title>
    <link href="__PUBLIC__/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="__PUBLIC__/css/font-awesome/css/font-awesome.min.css">
    <style type="text/css">
        html, body {
            color: #333;
            background-color: #eee;
        }
        .container{
            max-width: 970px;
            margin-top: 50px;
        }
        .talk-install{
            margin-bottom: 50px;
        }
    </style>
</head>

<body>
    <div class="container wrapper">
        <div class="row">
            <div class="panel">
                <div class="panel-heading">
                    <h3>TalkPiece垂直社区安装向导</h3>
                </div>
                <div class="panel-body">
                    <a class="btn btn-primary pull-right" href="<?php echo U('install/step1');?>">同意协议，并开始安装！</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>