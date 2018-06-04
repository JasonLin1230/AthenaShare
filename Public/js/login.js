

//登录按钮控制
		var usr_valid = function (_username) {
			if (_username == '') return false;
			return true;
		}
		var pwd_valid = function (_password) {
			if (_password == '') return false;
			return true;
		}
		$(document).ready (function () {
				$('#username').blur (function () {
					reg = /^[a-zA-Z][0-9a-zA-Z_]{5,15}$/;
					if (!reg.test ($(this).val ())) {
						$(this).css ('border','1px solid #ce491e'); 
					}
				}).focus (function () {
					$(this).css ('border', '1px solid #c8c8c8');
				});

				$('#password').blur (function () {
					var Pval = $(this).val();
					reg1=/^.*[\d]+.*$/;
					reg2=/^.*[A-Za-z]+.*$/;
					reg3=/^.*[_@#%&^+-/*\/\\]+.*$/;//验证密码
					if (!((reg1.test(Pval) && reg2.test(Pval)) || (reg1.test(Pval) && reg3.test(Pval)) || (reg2.test(Pval) && reg3.test(Pval)) )) {
						$(this).css ('border','1px solid #ce491e'); 
					}
				}).focus (function () {
					$(this).css ('border', '1px solid #c8c8c8');
				})
				$('#js-btn-login').click (function () {
					if (usr_valid ($('#username').val ()) && 
							pwd_valid ($('#password').val ())) return true;
					else return false;
				});
		});


//找回密码控制
	$(function ($) {
		//弹出登录
		$("#forget").on('click', function () {
			$("body").append("<div id='mask'></div>");
			$("#mask").addClass("mask").fadeIn("slow");
			$("#ForgetBox").fadeIn("slow");
		});
		//按钮的透明度
		$("#forgetbtn").hover(function () {
			$(this).stop().animate({
				opacity: '1'
			}, 600);
		}, function () {
			$(this).stop().animate({
				opacity: '0.4'
			}, 1000);
		});
		//关闭
		$(".close_btn").hover(function () { $(this).css({ color: 'black' }) }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
			$("#ForgetBox").fadeOut("fast");
			$("#mask").css({ display: 'none' });
		});
	});
//输入用户名响应事件
var can_send1 = false;
$(document).ready (function () {
	$('#txtName').focusout (function () {
		var i = $('#acc_warn');
		var acc = $(this).val ().trim ();
		if (acc.length == 0) {
			i.css ('color', 'red').text ('* 必填!!!');
			can_send1 = false;
			return;
		}
		$.get (_get_entry_url ('User', 'is_account', 
					[{opt:'account',val:acc}]), 
				function (_dt) {
					if (_dt == -1) {
						i.css ('color', 'red').text ('* 未找到!');
						can_send1 = false;
					} else {
						can_send1 = true;
					}
				});
	}).focusin (function () {
		$('#acc_warn').empty ();
	});
});

//输入邮箱响应事件
var can_send2 = false;
$(document).ready (function () {
	$('#txtEmail').focusout (function () {
		var i = $('#ema_warn');
		var acc = $(this).val ().trim ();
		var acc1 = $('#txtName').val ().trim ();
		if (acc.length == 0) {
			i.css ('color', 'red').text ('* 必填!!!');
			can_send2 = false;
			return;
		}
		$.get (_get_entry_url ('User', 'is_email', 
					[{opt:'email',val:acc},{opt:'account',val:acc1}]), 
				function (_dt) {
					if (_dt == -1) {
						i.css ('color', 'red').text ('* 未找到!');
						can_send2 = false;
					} else {
						can_send2 = true;
					}
				});
	}).focusin (function () {
		$('#ema_warn').empty ();
	});
});
function send_email () {
	if(can_send1 && can_send2){
		form1.submit();
	}
	else{
		return false;
	}
}
