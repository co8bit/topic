<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title><?php echo ($title); ?>  - 基于LBS的可视化论坛</title>
<meta name="keywords" content="<?php echo C('web_keywords');?>" />
<meta name="description" content="<?php echo C('web_des');?>" />
<link href="__PUBLIC__/css/bootstrap.css" rel="stylesheet">
<link href="__PUBLIC__/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="__PUBLIC__/css/font-awesome/css/font-awesome.min.css">

<?php
if (!isMobile()) { echo '<link href="__PUBLIC__/bootstrap/css/non-responsive.css" rel="stylesheet">'; } ?>

<!--[if lt IE 9]>
<script src="__PUBLIC__/js/html5.js"></script>
<script src="__PUBLIC__/js/css3.js"></script>
<script src="__PUBLIC__/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle needsclick" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo U('topic/index');?>"><?php echo echoName();?></a>
		</div>
	    <div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="<?php echo U('topic/index');?>">浙大紫金港</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right ">
				<?php if(($mid) > "0"): ?><li>
						<a href="<?php echo U('user/index', array('uid'=>$user['uid']));?>">
							<?php echo ($user["username"]); ?>
						</a>
					</li>
					<li class="notify">
						<a href="<?php echo U('message/notify');?>">
							<i class="fa fa-bell"></i>
								<?php if(($user["at_num"]) > "0"): ?><span class="badge"  id="notify" ><?php echo ($user["at_num"]); ?></span><?php endif; ?>
						</a>
					</li>
					<li class="inbox">
						<a href="<?php echo U('message/index');?>">
							<i class="fa fa-envelope-o"></i>
							<?php if(($user["inbox_num"]) > "0"): ?><span class="badge" id="inbox"><?php echo ($user["inbox_num"]); ?></span><?php endif; ?>
						</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu" role="menu">
			                <li><a href="<?php echo U('account/settings');?>"><i class="fa fa-user"></i>账号设置</a></li>
			                <li class="divider"></li>
            				<?php if(($user["is_admin"]) == "1"): ?><li><a href="<?php echo U('admin/public/login');?>"><i class="fa fa-user"></i>后台管理</a></li>
			               	<li class="divider"></li><?php endif; ?>		
			                <li><a href="<?php echo U('user/logout');?>"><i class="fa fa-power-off"></i>退出</a></li>
			            </ul>
					</li>
				<?php else: ?>
					<li><a href="<?php echo U('user/signup');?>">注册</a></li>
					<li><a href="<?php echo U('user/login');?>">登录</a></li><?php endif; ?>
			</ul>
	    </div>
	</div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel">
                <div class="panel-heading">
                    <h4>与<?php echo ($chat_lists['data'][0]['username']); ?>的对话</h4>
                </div>
                <div class="panel-body">
                    <form id="reply-chat" action="" method="post" class="reply-message">
                        <div class="form-group">
                            <textarea id="reply_content"  class="form-control" name="content" rows="5" cols="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo ($chat_lists['data'][0]['ms_id']); ?>" id="id">
                            <button type="submit" class="btn btn-primary pull-right">发送</button>
                        </div>
                    </form>
                    <script id="chat" type="text/x-jquery-tmpl">
                        <li class="media" id="post-${ms_id}">
                            <a href="" class="pull-left">
                                <img src="${avatar}" alt="" width="50" height="50" class="avatar">
                            </a>
                            <div class="media-body alert alert-success">
                                ${content}
                                <p class="text-right">${create_time}</p>
                            </div>
                        </li>
                    </script>
                    <?php if(!empty($chat_lists["data"])): ?><ul class="media-list  conversion-list" id="chat-list">
                        <?php if(is_array($chat_lists["data"])): foreach($chat_lists["data"] as $key=>$chat): ?><li class="media">
                                <a href="<?php echo U('user/index',array('uid'=>$chat['uid']));?>"  <?php if($chat['uid'] == $mid): ?>class="pull-left"<?php else: ?>class="pull-right"<?php endif; ?> >
                                    <img src="<?php echo uavatar($chat['uid']);?>" alt=""  class="talk-avatar middle">
                                </a>
                                <div class="media-body alert <?php if($chat['uid'] == $mid): ?>alert-success<?php else: ?>alert-warning<?php endif; ?> ">
                                     <?php echo ($chat['content']); ?>
                                    <p class="text-right">
                                     <?php echo friendly_date($chat['create_time']);?>
                                    </p>
                                </div>
                            </li><?php endforeach; endif; ?>
                    </ul><?php endif; ?>
                    <?php if(!empty($chat_lists['page'])): ?><div class="text-center">
                            <?php echo ($chat_lists['page']); ?>
                        </div><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<a href="#" class="scroll-up hidden-xs">回到顶部</a>
<!-- 
<footer>
	<div class="container">
		<div class="row">
			<p><?php echo C('web_copyright');?></p>
		</div>
	</div>
</footer>
 -->
<script  src="__PUBLIC__/js/jquery.js"></script>
<script  src="__PUBLIC__/js/jquery-migrate.js"></script>
<script  src="__PUBLIC__/js/jquery.validate.js"></script>
<script  src="__PUBLIC__/js/bootstrap.js"></script>
<script  src="__PUBLIC__/js/bootbox.js"></script>
<script  src="__PUBLIC__/js/jquery.tmpl.js"></script>
<script  src="__PUBLIC__/js/main.js"></script>
<?php if(($mid) > "0"): ?><script>
	$(document).ready(function(){
		tag1 = true;
		tag2 = true;
		where = window.location.search;
		if ( (where[3] == "m")&&(where[4] == "e")&&(where[5] == "s")&&(where[6] == "s")&&(where[7] == "a")&&
				(where[8] == "g")&&(where[9] == "e")&&(where[13] == "n")&&(where[14] == "o")&&(where[15] == "t")
				&&(where[16] == "i")&&(where[17] == "f")&&(where[18] == "y") )
		{
			tag1 = false;
		}
		if ( (where[3] == "m")&&(where[4] == "e")&&(where[5] == "s")&&(where[6] == "s")&&(where[7] == "a")&&
				(where[8] == "g")&&(where[9] == "e")&&(where[13] == "i")&&(where[14] == "n")&&(where[15] == "d")
				&&(where[16] == "e")&&(where[17] == "x") )
		{
			tag2 = false;
		}
		if ( (<?php echo ($user["at_num"]); ?> >0) && (tag1) )
		{
	 		$('#notify').show().text(<?php echo ($user["at_num"]); ?>);
	 	} 
	 	if ( (<?php echo ($user["inbox_num"]); ?> >0) && (tag2) )
	 	{
	 		$('#inbox').show().text(<?php echo ($user["inbox_num"]); ?>);
	 	}
	});
	$(function(){
		var getUnread =  function(){
			$.get("<?php echo U('message/unread');?>", function(data){
			 	if (data.at_num >0) {
			 		$('#notify').show().text(data.at_num);
			 	} 
			 	if (data.inbox_num >0) {
			 		$('#inbox').show().text(data.inbox_num);
			 	}
			},'json');
		};
		setInterval(getUnread, 20000);
	});
</script><?php endif; ?>
<script>
    $(function(){
        $("#reply-chat").on('submit', function(e) {
            e.preventDefault();
            var  id= $('#id').val();
            var content = $.trim($('#reply_content').val());
            if (content == '') {
                bootbox.alert('内容不能为空');
                return false;
            }

            $.ajax({
                url: "<?php echo U('message/reply');?>",
                type: 'POST',
                dataType: 'json',
                data: {id:id, content: content},
                success :function(data) {
                    var html = $( "#chat" ).tmpl( data );
                    $('#chat-list').prepend(html);
                    $('#reply_content').val('');
                }
            });
        });
    });
</script>
</body>
</html>