<html>
	<head>
		<title>上传测试</title>
		<script src="<?=jQuery?>" type="text/javascript" ></script>
		<script src="<?=UPLOAD_JS?>" type="text/javascript" ></script>
	</head>
	<body>
		<input type="file" id="file1" mutiple="true" name="file1" value="" />
		<br/><br/>
		<input type="file" id="file2" mutiple="true" name="file2" value="" />
		<br/><br/>
		<input type="file" id="file3" mutiple="true" name="file3" value="" />
		<br/><br/>
		<input type="button" id="submit" value="submit" />
	</body>
<script type="text/javascript">
$(document).ready(function(){
	$("#submit").click(function(){
		var ajaxfile = new uploadFile({
			"url":"/index/upload",
			"timeout":5000,
			"async":true,
			"data":{
					"name":"lanyue",
					"age":100,
					"sex":"男",
					//多文件
					"files":{
						//file为name字段 后台可以通过$_FILES["file"]获得
						"file1":document.getElementById("file1").files,//文件数组
						"file2":document.getElementById("file2").files,//文件数组
						"file3":document.getElementById("file3").files,//文件数组
					}
					//单文件
					// "file":{
					// 	"test":document.getElementById("file").files[0],
					// },
				},

			// onloadstart:function(){
			// 	console.log("开始上传");
			// },
			// onload:function(data){
			// 	console.log(data);
			// 	console.log(data.name);
			// },
			// onerror:function(er){
			// 	console.log(er);
			// },
			// onabort:function(){
			// 	//alert("取消上传");
			// },
			// ontimeout:function(){
			// 	alert("上传时间到");
			// },
			onloadend:function(data){
				console.log(data);
			},
			// onprogress:function(e){
			// 	console.log(e);
			// }
		})
	})
})
</script>
</html>