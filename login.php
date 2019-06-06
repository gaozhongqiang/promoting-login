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
        $html = <<<EOF
        <!--找回密码样式-->
        <style type="text/css">
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
.jiang03 input{ border:none; background:#f5f5f5; height:65px; line-height:65px; width:250px; outline:none; font-size:18px;}
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
</style>
<!--忘记密码开始-->
<div id="popDiv_hs" class="mydiv_tc_sc01" style="display: block;">
	
		<div class="miyu02">
 		 <div class="jiang02">
			找回密码
            <a href="javascript:closeDiv_hs()" class="close_dla">×</a>
		</div>
        <div class="jiang03">
        	<input name="" type="text" placeholder="请输入手机号码">
        </div>
        <div class="jiang03">
        	<a href="#" class="yzm">获取验证码</a>
        	<input name="" type="text" placeholder="请输入验证码">
        </div>
<a href="javascript:closeDiv_hs()" onclick="javascript:showDiv_hs_mm()" class="close_dla00">提交</a> 
 		</div>
	</div>
<div id="bg_tctc" class="bg" style="display: block;"></div>
<div id="popIframe" class="popIframe" frameborder="0" style="display: block;"></div>
<!--忘记密码结束-->
<!--重置密码开始-->
<div id="popDiv_hs_mm" class="mydiv_tc_sc01" style="display: block;">
	
		<div class="miyu02">
 		 <div class="jiang02">
			重置密码
            <a href="javascript:closeDiv_hs_mm()" class="close_dla">×</a>
		</div>
        <div class="jiang03">
        	<input name="" type="text" placeholder="请输入密码">
        </div>
        <div class="jiang03">
        	<input name="" type="text" placeholder="再次请输入密码">
        </div>
<a href="javascript:closeDiv_hs_mm()" onclick="javascript:showDiv_hs_mm_cg()" class="close_dla00">提交</a> 
 		</div>
	</div>
	<div id="bg_tctc_mm" class="bg" style="display: block;"></div>
	<div id="popIframe" class="popIframe" frameborder="0"></div>
<!--重置密码结束-->
<!--找回密码成功开始-->
<div id="popDiv_hs_mm_cg" class="mydiv_tc_sc01" style="display: block;">
	
		<div class="miyu02">
 		 <div class="jiang04">
         <img src="images/mima.png"><br> 修改成功，以后就用这个密码登录 </div>
<a href="javascript:closeDiv_hs_mm_cg()" class="close_dla00">关闭</a> 
 		</div>
	</div>
	<div id="bg_tctc_mm_cg" class="bg" style="display: block;"></div>
	<div id="popIframe" class="popIframe" frameborder="0"></div>
<!--找回密码成功结束-->
<!--找回密码弹出-->
<script type="text/javascript">
//弹出页面
function showDiv_hs(){
document.getElementById('popDiv_hs').style.display='block';
document.getElementById('popIframe').style.display='block';
document.getElementById('bg_tctc').style.display='block';
}
//关闭页面
function closeDiv_hs(){
document.getElementById('popDiv_hs').style.display='none';
document.getElementById('bg_tctc').style.display='none';
document.getElementById('popIframe').style.display='none';
}
function showDiv_hs_mm(){
document.getElementById('popDiv_hs_mm').style.display='block';
document.getElementById('popIframe').style.display='block';
document.getElementById('bg_tctc_mm').style.display='block';
}
//关闭重置密码
function closeDiv_hs_mm(){
document.getElementById('popDiv_hs_mm').style.display='none';
document.getElementById('bg_tctc_mm').style.display='none';
document.getElementById('popIframe').style.display='none';
}
//找回名密码成功
function showDiv_hs_mm_cg(){
document.getElementById('popDiv_hs_mm_cg').style.display='block';
document.getElementById('popIframe').style.display='block';
document.getElementById('bg_tctc_mm_cg').style.display='block';
}
function closeDiv_hs_mm_cg(){
document.getElementById('popDiv_hs_mm_cg').style.display='none';
document.getElementById('bg_tctc_mm_cg').style.display='none';
document.getElementById('popIframe').style.display='none';
}
</script>
EOF;
        return $html;
    }
}
