@作者		徐斌洋
@版本信息		Version 1.0.0
@框架名称		Scra

一、环境信息
	1、PHP版本	5.4以上
	2、Apache版本	2.4
	3、MySQL版本	5.6

二、入口文件
	index.php
	在入口文件中：
	1、可以自定义修改应用目录名：application/，不建议修改系统目录system/
	2、入口文件中，加载配置文件和路由文件
	3、我们建议您，在入口文件中，无需做修改
	
三、路由信息
	url访问方式：http://www.example.com/controller/foo?param1=val1&param2=val2
	同时，我们在通过GET方式传递参数时，做了简单的sql关键词过滤，防止sql注入
	V1.0.0不支持自定义路由

四、配置文件
	1、系统配置文件
		位于：application/config/config.php
		为了简化开发者加载一些常用静态文件库
	
		我们为您提供了：
		1、Javascript：jQuery、AngularJs，以及用户自定义的Js文件
		2、CSS：Bootstrap模板，Font Awesome WEB字体库
		3、Image：Image文件
		您只需要查看配置文件，即可调用。
		
		在配置文件中，您几乎可以修改配置文件中的所有内容。
		
		同时，您还可以修改系统默认的控制器及方法
		默认控制器：Index.php	
		默认方法：home()
		
	2、数据库配置文件
		位于：application/config/database.php
		详细配置信息请参看该文件
		
	3、smarty配置文件
		位于：application/config/smarty.php
		Scra采用Smarty模板引擎，详细配置信息请参看该文件
		
五、缓存文件
	位于application/cache下，用于存储smarty引擎产生的缓存文件以及验证码图片
	
六、控制器文件
	位于application/controller文件，控制器类必须扩展自Controller类
	
	您可以在Example控制器中，定义foo方法：
	class Example extends Controller{
		function __construct{
			parent::__construct();
		}
		
		public function foo(){
			echo 'Hello World';
		}
	}
	
	然后，您可以在地址栏中访问：http://www.example.com/example/foo
	就可以在页面中显示“Hello World”
	
六、模型读取
	模型文件位于application/model，模型类必须扩展自Model类
	
	控制器中加载模型方式：DI::set('model',Factory::model($modelname));
	使用方式：$model = DI::get('model');
	
	系统为您提供了简单的AR模型
	
七、模板加载
	位于application/view文件
	Scra使用Smarty进行模板加载，使用方式参见smarty使用方式
	
八、第三方类
	在V1.0.0中，我们为您提供了两种常见类
	
	1、邮件类：
		在控制器中，您可以直接使用$this->mail()，来实例化邮件类。
		配置信息：
	    $this->mail()->IsSMTP(); 								//选择SMTP服务
	    $this->mail()->CharSet='UTF-8'; 						//设置邮件的字符编码，这很重要，不然中文乱码 
	    $this->mail()->SMTPAuth = true; 						//开启认证 
	    $this->mail()->Port = 25; 								//服务端口，smtp服务一般为25
	    $this->mail()->Host = "smtp.163.com"; 					//smtp服务器名，以163为例
	    $this->mail()->Username = "Domain@Url.com"; 			//发件人邮箱用户名
	    $this->mail()->Password = "Password";	 				//发件人邮箱密码
	    $this->mail()->AddReplyTo("Domain@Url.com","Name");		//回复地址 
	    $this->mail()->From = "Domain@Url.com"; 				//来自于
	    $this->mail()->FromName = "Admin"; 						//显示名称
	    $to = "Domain1@Url1.com"; 								//收件人地址
	    $this->mail()->AddAddress($to); 						//设置收件人地址
	    $this->mail()->Subject = "邮件发送测试"; 					//发送标题
	    $this->mail()->Body = "如收到本邮件，则表示发送成功"; 			//邮件具体内容
	    $this->mail()->AltBody = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略 
	    $this->mail()->WordWrap = 80; 							//设置每行字符串的长度 
	    $this->mail()->AddAttachment("f:/test.png"); 			//可以添加附件 
	    $this->mail()->IsHTML(true); 							//经由html
	    $this->mail()->Send(); 									//发送邮件
	          
	          异常类:
		//phpmailerException $e 
	
	2、分页类：
		在控制器中，您可以使用$pagination = DI::set('pagination',Factory::pagination($page_size))进行加载
		分页总数：$pagination->total($total)
		偏移量：$pagination->offset($total,$page)
		
		其中:
		$page_size:每页数
		$total:总数
		$page:当前页数
		
	3、验证码类
	使用Scra的验证码类，需开启GD2扩展
	在控制器中，您可以使用scra提供的验证码类
	配置信息，四项配置信息是必填的：
		$config = array(
			'codelen' => 4,		//生成验证码位数
			'width'	  => 100,	//验证码图片长度
			'height'  => 50,	//验证码图片宽度
			'fontsize'=> 20		//验证码文字大小
		);
	注册验证码类：
		DI::set('captcha',Factory::captcha($config));
	实例化验证码类：
		$captcha = DI::get('captcha');
	调用doimg()方法，生成验证码；
	调用getCode()方法，获取生成验证码的路径和对应验证码
