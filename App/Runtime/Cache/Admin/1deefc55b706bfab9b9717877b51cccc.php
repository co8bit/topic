<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?php echo echoName();?>后台登录</title>
		<link href="__PUBLIC__/css/bootstrap.css" rel="stylesheet">
		<link href="__PUBLIC__/css/admin.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="panel talk-login">
    	 		<form id="admin-login"  method="post" class="form-horizontal" action="<?php echo U('admin/public/login');?>">
    				<div class="panel-heading">
					 	<h3><?php echo echoName();?>后台登录</h3>
				    </div>
    				<div class="form-group">
    					<label for="email" class="col-md-2 control-label">邮箱：</label>
    					<div class="col-md-8">
    						<input type="text" class="form-control" id="email" name="email" value="">						
    					</div>
    				</div>
    				<div class="form-group">
    			        <label for="password" class="col-md-2 control-label">密码：</label>
    			        <div class="col-md-8">
    			        	<input type="password" class="form-control" id="password" name="password">
    			        </div>
    				</div>
					<div class="form-group">
				        <label for="password2" class="col-md-2 control-label">验证码：</label>
				        <div class="col-md-3">
				        	<input type="text" class="form-control" name="verify" id="captcha">
				        </div>
				        <div class="col-md-3">
				        	<img src="<?php echo U('home/user/verify');?>" alt="" id="verify">
				        </div>
				        <div class="col-md-2">
				        	<a href="javascript:;" id="reloadVerify" title="换一张">换一张？</a>
				        </div>
					</div>
    				<div class="form-group">
    					<div class="col-md-offset-2 col-md-2">
    						<button type="submit" class="btn btn-primary">登录</button>
    					</div>
    				</div>
    			</form>
			 </div>
		</div>
<script  src="__PUBLIC__/js/jquery.js"></script>
<script  src="__PUBLIC__/js/jquery.validate.js"></script>
<script  src="__PUBLIC__/js/bootstrap.js"></script>
<script  src="__PUBLIC__/js/bootbox.js"></script>
<script>
	$("#admin-login").validate({
	    rules: {
	        email: {
	            required: true,
	            email: true
	        },
	        password: "required",
	        verify: {
	        	required: true,
	        	remote: {
	        		url : "<?php echo U('home/user/checkVerify');?>",
	        		type: 'post',
	        		dataType: "json",
	        		data: {
	        			captcha: function(){return $('#captcha').val();}
	        		},
	        		dataFilter: function(data, type){
	        			if (data) {
	        			 	return true;
	        			} else {
	        				return false;
	        			}

	        		}
	        	}
	        }
	    },
	    messages: {
	        email: {
	            required: "邮箱不能为空",
	            email: "邮箱格式不正确"
	        },
	        password: {
	            required: "密码不能为空"
	        },
	        verify: {
	        	required: "验证码不能为空",
	        	remote: "验证码错误"
	        }
	    },
	    submitHandler: function(e) {
	        $.ajax({
	            type: "POST",
	            dataType: "json",
	            url: "<?php echo U('public/login');?>",
	            data: $("#admin-login").serialize(),
	            success: function(data){
	            	if (data.status == 0) {
	            		bootbox.alert(data.info);
		            	return  false;
	            	} else {
	            		window.location.href = data.url;
	            	}

	            }
	        })
	    }
	});
	$('#reloadVerify').click(function(){
	    var captchaUrl = "<?php echo U('home/user/verify');?>&t=";
	    $('#verify').attr('src', captchaUrl + Math.random());
	});

</script>
</body>
</html>