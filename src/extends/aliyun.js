$(document).ready(function(){
	/*
	人机验证-滑动验证js模块
	*/
	var appkey = document.getElementById('appkey').value;
	var nc_token = document.getElementById('man_machine_verification_token').value;
	var NC_Opt =
	  {
	    renderTo: "#man_machine_verification_show",
	    appkey: appkey,
	    scene: "nc_login",
	    token: nc_token,
	    customWidth: 270,
	    trans: { "key1": "code0" },
	    elementID: ["usernameID"],
	    is_Opt: 0,
	    language: "cn",
	    isEnabled: true,
	    timeout: 3000,
	    times: 5,
	    apimap: {},
	    callback: function (data) {
	    	document.getElementById("man_machine_verification_sig").value=data.sig;
	    	document.getElementById("man_machine_verification_token").value=nc_token;
	    	document.getElementById("man_machine_verification_sessionid").value=data.csessionid;
	    }
	  }
	
	//若pointman对象不存在，则刷新页面
	if(typeof pointman == "undefined"){
		location.reload();
	}
	
	//若noCaptcha对象不存在，异步加载js文件
	if(typeof noCaptcha == "undefined"){
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "//g.alicdn.com/sd/ncpc/nc.js?t=2015052012";
		script.async = true;
		var firstScript = document.getElementsByTagName('script')[0];
		firstScript.parentNode.insertBefore(script,firstScript);
		script.onload=script.onreadystatechange=function(){  
			 if(!this.readyState||this.readyState=='loaded'||this.readyState=='complete'){
				 var nc = new noCaptcha(NC_Opt);
					nc.upLang('cn', {
						  _startTEXT: "请按住滑块，拖动到最右边",
						  _yesTEXT: "验证通过",
						  _error300: "哎呀，出错了，点击<a href=\"javascript:__nc.reset()\">刷新</a>再来一次",
						  _errorNetwork: "网络不给力，请<a href=\"javascript:__nc.reset()\">点击刷新</a>"//将原有的调用的__nc.reset()改为页面重新加载
					})
			 };
			 script.onload=script.onreadystatechange=null; 
		}
	}else{
		var nc = new noCaptcha(NC_Opt);
		nc.upLang('cn', {
			  _startTEXT: "请按住滑块，拖动到最右边",
			  _yesTEXT: "验证通过",
			  _error300: "哎呀，出错了，点击<a href=\"javascript:__nc.reset()\">刷新</a>再来一次",
			  _errorNetwork: "网络不给力，请<a href=\"javascript:location.reload()\">点击刷新</a>"//将原有的调用的__nc.reset()改为页面重新加载
		})
	}
	


	/*阿里云登陆防控js模块*/
	pointman.use('do', function () {
		var afs = pointman.getConfig();
		document.getElementById('afs_token').value = afs.token;
	});

})
