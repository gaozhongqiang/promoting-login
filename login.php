<?php
/**
 * Created by PhpStorm.
 * User: gzq
 * Date: 2019/6/6
 * Time: 9:43
 */
namespace Promoting\Login;
class Login{
    //找回密码弹出页
    public static function getForgetPassHtml(){
        $css = self::commonCss();
        $js = self::commonJs();
        $mobile_js = self::mobile();
        $url = UrlRecombination("login/get_check_code",array());//发送验证码地址
        $find_pass_url = UrlRecombination("login/find_pass",array());//短信找回地址
        $check_code_url = UrlRecombination("login/check_code",array());//短信找回地址
        $mmv_token = str_shuffle(ALIYUN_MMV_APP_KEY.time().ReturnRandomString(16));
        $wait_time = PhoneWarningTime;//验证码等待时间
        $ALIYUN_MMV_APP_KEY = ALIYUN_MMV_APP_KEY;
        $ALIYUN_DATA_APP_JS = ALIYUN_DATA_APP_JS;
        $random = mt_rand();
        $dir_name = WebSite.'/vendor/promoting/login';
        $html = <<<EOF
        {$css}
        <script data-app="{$ALIYUN_DATA_APP_JS}" src="//g.alicdn.com/sd/pointman/js/pt.js"></script>
	<script type="text/javascript" charset="utf-8" src="//g.alicdn.com/sd/ncpc/nc.js?t={$random}"></script>
	<script src="{$dir_name}/src/extends/aliyun.js?t={$random}" type="text/javascript"></script>
	<link href="{$dir_name}/src/extends/aliyun_mmv.css?t={$random}" rel="stylesheet" type="text/javascript" />

<input type='hidden' id='afs_token' name='afs_token'/>
			<input name="man_machine_verification_sig" value="" id="man_machine_verification_sig" type="hidden">
			<input name="man_machine_verification_sessionid" value="" id="man_machine_verification_sessionid" type="hidden">
			<input value="{$ALIYUN_MMV_APP_KEY}" id="appkey" type="hidden">
			<input name="man_machine_verification_token" value="{$mmv_token}" id="man_machine_verification_token" type="hidden">
			
			<input name="code" value="" id="code" type="hidden">
			<input name="phone" value="" id="phone" type="hidden">
			<input name="promuser_id" value="" id="promuser_id" type="hidden">
			<input name="encryString" value="" id="encryString" type="hidden">
			<input id="find_pass_url" value="{$find_pass_url}" type="hidden">
			<input id="check_code_url" value="{$check_code_url}" type="hidden">
<!--忘记密码开始-->
<div id="popDiv_hs" class="mydiv_tc_sc01" style="display: none">
		<div class="miyu02">
 		 <div class="jiang02">
			找回密码
            <a href="javascript:closeDiv_hs()" class="close_dla">×</a>
		</div>
        <div class="jiang03">
        	<input name="mobile" type="text" id="mobile" placeholder="请输入手机号码">
        </div>
        <div class="jiang03">
        	<a href="javascript:;" class="yzm" dourl={$url} onclick = GetMobileCode(this,$wait_time,'return_profit_wait','return_profit_time_desc') actionType="check" codeType='find_password'>获取验证码</a>
        	<div class="check_code_wait" id="return_profit_wait">等待(<span class="fontred" id="return_profit_time_desc">{$wait_time}</span>)</div> 
        	<input name="temp_code" id="temp_code" type="text" placeholder="请输入验证码">
        </div>
        <div class="jiang0000" style="height: 30px">
		    <label style="float: left;margin-top: 10px">人机验证：</label>
		    <div id="man_machine_verification_show" class="nc-container" style="float: right;"></div>
	   </div>
<a href="javascript:;" onclick="javascript:showDiv_hs_mm()" class="close_dla00">提交</a> 
 		</div>
	</div>
<div id="bg_tctc" class="bg" style="display: none;"></div>
<div id="popIframe" class="popIframe" frameborder="0" style="display: none;"></div>
<!--忘记密码结束-->


<!--找回密码弹出-->
{$js}{$mobile_js}
EOF;
        return $html;
    }
    //推广联系人
    public static function getPromuserQQHtml(){
        $html = '';
        if(defined('TgQQManage')){
            $html .= '<div class="tgr">推广联系人<a href="http://wpa.qq.com/msgrd?v=3&uin='.TgQQManage.'&site=qq&menu=yes" target="_blank"><span><img src="'.WebSite.'/vendor/promoting/login/src/qq.png">'.TgQQManage.'</span></a></div>';
        }
        $html .=<<<EOF
        <style type='text/css'>
.tgr {
	color: #fff;
	font-size: 16px;
	text-align: center;
	height: 40px;
	margin: 120px 0 0 0;
}
.tgr span {
	background: #fff;
	padding: 6px 10px;
	border-radius: 10px;
	margin: 0 0 0 10px;
	color: #666;
}
.tgr span img {
	width: 20px;
	height: 22px;
	vertical-align: middle;
	padding: 0 0 4px 0;
}
.footer {padding-top:10px;line-height: 28px;text-align: center;height: 100px;color: #fff;width: 100%;margin: 0;}
</style>
EOF;
    return $html;
    }
    //获取变动的css
    public static function commonCss(){
        $css = <<<EOF
<!--找回密码样式-->
        <style type="text/css">
        .check_code_wait {
    width: 80px;
    height: 32px;
    line-height: 32px;
    display: inline-block;
    background: #000;
    border-radius: 10px;
    opacity: 0.7;
    color: #fff;
    text-align: center;
    filter: alpha(opacity=70);
    position: absolute;
    right: 20px;
    top: 19px;
    display: none;
}
        .zh {
    float: left;
    text-align: right;
    color: #fff;
    font-size: 18px;
    padding: 20px 20px 0 30px;
}
.mydiv_tc_sc01 {
	z-index: 9999999;
	height: auto;
	margin:auto;
     left:50%;
     top:40%;
  transform:translate(-50%,-50%);
	position: fixed!important;/* FF IE7*/
	position: absolute;/*IE6*/

    _top:  expression(eval(document.compatMode &&
           document.compatMode=='CSS1Compat') ?
           documentElement.scrollTop + (document.documentElement.clientHeight-this.offsetHeight)/2 :/*IE6*/
           document.body.scrollTop + (document.body.clientHeight - this.clientHeight)/2);
	padding-bottom: 30px;
	overflow: hidden;
}
.miyu02{
	width: 500px;
	margin: 20% 0 0 0;
	border-radius: 20px;
	padding: 0px 0 40px 0;
	height: auto;
	overflow: hidden;
	font-family: Arial;
	background:#fff;
}
.miyu02 a {  color:#fff; }
.miyu02 p{ line-height:1.6em; color:#333;}

.jiang02 span{ color:#333; font-size:1.3em; line-height:2em; color:#f90;}
.jiang02 strong{ font-weight:bold; font-size:1.2em; color:#f90;}
.jiang02{color:#555; font-size:26px; padding:30px 0 30px 0; text-align:center; position:relative;}

.jiang03 span{ color:#333; font-size:1.3em; line-height:2em; color:#f90;}
.jiang03 strong{ font-weight:bold; font-size:1.2em; color:#f90;}
.jiang03{padding:0px 20px 0 30px; width:350px; margin:0 auto 15px auto; position:relative; background:#f5f5f5; border-radius:100px;}
.jiang03 input{ border:none; background:#f5f5f5; height:65px; line-height:65px; width:338px; outline:none; font-size:13px;}
.jiang04{ margin:0px 0 50px 0; color:#999; font-size:18px; text-align:center;}
.jiang04 img{ width:80px; height:auto; padding:50px 0 20px 0;}


.yzm{ display:block; background:#12cdb0; color:#fff; font-size:14px; text-align:center; height:30px; width:100px; line-height:30px; border-radius:6px; position:absolute; right:20px; top:19px;}
.yzm:hover{background:#11ddaa;}

.jiang05 span{ color:#f05; font-size:1.3em; line-height:2em; color:#f90;}
.jiang05 strong{ font-weight:bold; font-size:1.6em; color:#f90; padding:0 3px;}
.jiang05{ margin:30px 0 10px 0; color:#999; font-size:1.6em; line-height:1.8em; padding:70px 30px 0 30px;}


.jiang_ts{ color:#999; font-size:1.3em;}

.ld_list_ts{ text-align:center; color:#666; padding:35px 0 30px 0; font-size:1.3em;}
.close_dla00 {
	font-size: 26px;
	color: #FFF;
	text-decoration: none;
	font-weight: normal;
	background-color:#12cdb0;
	display:block; 
	width:200px; 
	margin:30px auto 0 auto; 
	 height:70px;
	  line-height:70px; 
	   border-radius:70px;
	   text-align:center;
}
.close_dla00:hover {
	background-color:#1da;
}
.close_dla{ position:absolute; right:10px; top:10px; border-radius:100px; color:#fff; font-size:20px; background:#555; text-align:center; width:30px; height:30px; line-height:30px;}
.close_dla:hover{ background:#333;}      
.bg {
	display: none;
	width: 100%;
	height: 100%;
	left: 0;
	top: 0;/*FF IE7*/
	background:rgba(0,0,0,0.6);
	z-index: 999999;
	position: fixed!important;/*FF IE7*/
	position: absolute;/*IE6*/

_top:       expression(eval(document.compatMode &&
            document.compatMode=='CSS1Compat') ?
            documentElement.scrollTop + (document.documentElement.clientHeight-this.offsetHeight)/2 :/*IE6*/
            document.body.scrollTop + (document.body.clientHeight - this.clientHeight)/2);
			
}  
.jiang0000 {
    padding: 0px 20px 0 30px;
    width: 350px;
    margin: 0 auto 15px auto;
    position: relative;
}
</style>
EOF;

        return $css;
    }
    //获取变动的js
    public static function commonJs(){
        $js = <<<EOF
<script type="text/javascript">
//弹出页面
function showDiv_hs(){
document.getElementById('popDiv_hs').style.display='block';
document.getElementById('popIframe').style.display='block';
document.getElementById('bg_tctc').style.display='block';
}
//关闭页面
function closeDiv_hs(){
    window.location.href = window.location.href;
}
//
function showDiv_hs_mm(){
    var check_code=$("#temp_code").val(),url = $("#check_code_url").val();
	if(!/^[0-9]{4,8}$/.test(check_code)){
		alert('验证码格式错误！');
		return false;
	}
	$("#code").val(check_code);
	var phone = $("#mobile").val();
	phone = phone.replace('\s+|\s+','')
	if(phone == ''){
	    alert('手机号错误')
	    return false;
	}
	$.ajax({
		'url':url,
		'type':"POST",
		'dataType':"JSON",
		'data':"code="+$("#code").val()+"&phone="+$("#mobile").val(),
		'success':function (returnData){
			if(returnData.errorno==-1){
				alert(returnData.data1);
				return;
			}
		   $("#phone").val(phone);
			$("#encryString").val(returnData.data1)
	
	var rewrite_pass = '<div class="miyu02"><div class="jiang02">重置密码<a href="javascript:closeDiv_hs();" class="close_dla">×</a></div>' +
	 '<div class="jiang03"><input name="pass1" type="password" id="pass1" placeholder="请输入密码（长度6~16位，支持数字、字母、特殊符号）"></div>' +
	 '<div class="jiang03"><input name="pass2" type="password" id="pass2" placeholder="再次请输入密码"></div>' +
	 '<a href="javascript:;" onclick="javascript:find_pass()" class="close_dla00">提交</a> </div>'
	$("#popDiv_hs").html(rewrite_pass);
		}
	});
	
}

</script>
EOF;
    return $js;
    }
    //密码找回
    public static function mobile(){
        $html = <<<EOF
       <script type="text/javascript"> 
       //发送短信验证码
function GetMobileCode(_this,waitTime,wait_dom,time_desc){
	var codeType=$(_this).attr("codeType"),actionType=$(_this).attr("actionType"),dourl=$(_this).attr("dourl"),
	mobile = $("input[name='mobile']").val();
	mobile = mobile.replace('\s+|\s+','')
	
	if(mobile == ''){
	    alert('请输入手机号！')
	    return;
	}
	var nowindex=0;
	$.ajax({
		'url':dourl,
		'type':"POST",
		'dataType':"JSON",
		'data':"actionType="+actionType+"&codeType="+codeType+"&mobile="+mobile+
		"&man_machine_verification_sig="+$("input[name='man_machine_verification_sig']").val()+
		"&man_machine_verification_sessionid="+$("input[name='man_machine_verification_sessionid']").val()+
		"&man_machine_verification_token="+$("input[name='man_machine_verification_token']").val(),
		'success':function (returnData){
			if(returnData.errorno==-1){
				alert(returnData.data1);
				return false;
			}
			layer.msg('获取成功');
			$("#mobile").attr("readonly","true");
			$("#promuser_id").val(returnData.data1)
			$(_this).hide();
			$("#"+wait_dom).css("display","inline-block");
			_this.timer=setInterval(function (){
				nowindex++;
				if(nowindex>waitTime){
					clearInterval(_this.timer);
					$("#"+wait_dom).hide();
					$(_this).show();
					return false;
				}
				$("#"+time_desc).html(waitTime-nowindex);
			},1000);
		}
	});
}
//重置密码
function find_pass() {
  var url = $("#find_pass_url").val(),pass1 = $("input[name='pass1']").val(),pass2 = $("input[name='pass2']").val();
  pass1 = pass1.replace('\s+|\s+','');
  pass2 = pass2.replace('\s+|\s+','');
  if(pass1 == '' || pass2 == ''){
      alert('请输入密码或确认密码！');
      return false;
  }
  if(!/^.{6,16}$/.test(pass1)){
      alert('密码格式有误，请重新输入!');
      return false;
  }
  
  if(pass1 != pass2){
      alert('两次输入的密码不一致，请检查！');
      return false;
  }
  
  $.ajax({
		'url':url,
		'type':"POST",
		'dataType':"JSON",
		'data':"code="+$("#code").val()+"&phone="+$("#phone").val()+"&pass1="+$("#pass1").val()+
		"&pass2="+$("#pass2").val()+"&promuser_id="+$("#promuser_id").val()+"&encryString="+$("#encryString").val(),
		'success':function (returnData){
			if(returnData.errorno!=0){
				alert(returnData.data1);
				if(returnData.errorno == -2){
				     window.location.href = window.location.href;
				     return false;
				} 
				return false;
			}
			var server_name = window.location.protocol+'//'+window.location.hostname;
		    var success_html = '<div class="miyu02"><div class="jiang04">' +
		     '<img src="'+server_name+'/vendor/promoting/login/src/mima.png"><br>'+returnData.data1+'</div>' +
		     '<a href="javascript:closeDiv_hs()" class="close_dla00">关闭</a> </div>';
			$('#popDiv_hs').html(success_html);
		}
	});
}
</script>
EOF;
    return $html;
    }
    public static function findPass($_this){
        $code = $_this->method_post_value("code",1);
        $phone = $_this->method_post_value("phone",1);
        $pass1 = $_this->method_post_value("pass1");
        $pass2 = $_this->method_post_value("pass2");
        $promuser_id = $_this->method_post_value("promuser_id",1);
        $encryString = $_this->method_post_value("encryString");
        if(empty($code) || empty($phone) || empty($promuser_id) || empty($encryString)){
            return array(-1,'请正常操作！');
        }
        if(empty($pass1) || empty($pass2)){
            return array(-1,'密码不能为空！');
        }
        if(!preg_match("/^.{6,16}$/",$pass1)){
            return array(-1,'密码格式有误，请重新输入！');
        }
        if($pass1 != $pass2){
            return array(-1,'两次输入的密码不一致，请检查！');
        }

        

        $_this->getmodel("Promuser_model");
        $promuserData=$_this->Promuser_model->get_have_data_relation(array_merge(Mobile::get_search_arr(),array("p.promuser_id='{$promuser_id}'")));
        if(empty($promuserData)){
            return array(-1,"账号信息不存在！");
        }
        if($promuserData['promuser_state'] == -1){
            return array(-1,"很抱歉，此账号已被封禁！");
        }
        if($promuserData['promuser_phone'] != $phone){
            return array(-1,'手机号信息错误！');
        }

        if(!FormatTokenVerify(array("phone"=>$promuserData["promuser_phone"],"promuser_id"=>$promuser_id),$encryString)){
            return array(-2,"提交出错，不要进行非法提交工作！","no");
        }
        
        $update_arr = array(
            'lastupdatepwdtime' => time(),
            'promuser_pwd' => PwdEncryption($pass1)
        );
        $ret=$_this->Promuser_model->update($update_arr,$promuser_id);
        if($ret < 0){
            return array(-1,'密码修改失败');
        }
        return array(0,$promuserData);
    }
}
