// page1
setTimeout(function(){
	$(".p1-title img").eq(3).addClass("animated rubberBand");
	$(".p1-title img").eq(3).show();
},555);
$(".start-btn").on('touchstart',function(){
	$(".p1-mask").show();
	$(".form").show();
});
var dataArr = {};
$(".form .submit").on("touchend",function(){
	if($(".form input[type=text]").eq(0).val()&&$(".form input[type=text]").eq(1).val()){
		$("#page1").hide();
		$("#page2").show();
		$(".p1-mask").hide();
		$(".form").hide();
		dataArr.username = $(".form input[type=text]").eq(0).val();
		dataArr.tel = $(".form input[type=text]").eq(1).val();
		$(".list").hide();
		$(".time li").html("0");
		$(".time li").last().html("60");
		$(".img").on("touchstart",init);
	}
});
$(".list li").on('touchstart',show);
function show(){
	var index = $(".list li").index(this);
	switch(index){
			case 0:
				$(".p1-mask").show();
				$(".text-bg").hide();
				$(".text-bg").eq(0).show();
				$.ajax({
					type:"get",
					url:"php/bang.php",
					data:{},
					dataType:"json",
					success:function(data){
						for(var i = 0;i < data.length;i++){
							$(".bang li:eq("+i+") span").eq(0).html(data[i].username);
							$(".bang li:eq("+i+") span").eq(1).html(data[i].score);
						}
					},
					error:function(){
						console.log(0);
					}
				})
			break;
			case 1:
				$(".p1-mask").show();
				$(".text-bg").hide();
				$(".text-bg").eq(1).show();
			break;
			case 2:
				$(".p1-mask").show();
				$(".text-bg").hide();
				$(".text-bg").eq(2).show();
			break;
			case 3:
				$(".p1-mask").show();
				$(".text-bg").hide();
				$(".text-bg").eq(3).show();
			break;
	}
}
$(".close").on("touchstart",function(){
	$(".p1-mask").hide();
	$(".form").hide();
	$(".text-bg").hide();
});
// page2
var txtIndex = 0;
var count = 0;
var time = 60;
function init(){
$(".img").off("touchstart");	
txtIndex = 0;
count = 0;
time = 60;
var timeID = setInterval(function(){
	$(".txt-img img").hide();
	$(".txt-img img").eq(parseInt(txtIndex/3)).show();
	txtIndex++;
	if(txtIndex > 6){
		txtIndex = 0;
	}
	time--;
	$(".time li").eq(3).html(time);
	if(time == 0){
		clearInterval(timeID);
		$("#page2").hide();
		$("#page3").show();
		$(".p3-content h1").html(count);
		$(".money-wrap .active").remove();
		$(".list").show();
		dataArr.score = count;
		$.ajax({
			type:"get",
			url:"php/index.php",
			data:dataArr,
			dataType:"text",
			success:function(data){
				console.log(data);
			}
		})
		$(".form input[type=text]").val("");
		$(".huashou").show();
		count = 0;
	}
},1000);
var startPoint = null;
$(".img").on("touchstart",startP);
$(".img").on("touchend",move);
function startP(e){
	var ev = e||event;
	startPoint = ev.touches[0];
}
function move(e){
	var ev = e||event;
	var endPoint = ev.changedTouches[0];
	var Y = endPoint.clientY - startPoint.clientY;
	if(Y<0&&Math.abs(Y)>10){
		count++;
		$(".time li").eq(0).html(parseInt(count/100));
		$(".time li").eq(1).html(parseInt((count%100)/10));
		$(".time li").eq(2).html(count%10);
		if($(".money-wrap .active").length > 2){
			$(".money-wrap .active:gt(0)").remove();
		}
		$(".money-wrap .img").last().addClass("active");
		$(".money-wrap .img").last().removeClass("img");
		$(".huashou").hide();
		var img = $("<img src='img/money.png' alt class='img'></img>");
		img.on("touchstart",startP);
		img.on("touchend",move);
		$(".money-wrap").prepend(img);
		$(this).off('touchstart');
		$(this).off('touchend');
	}
}
}
// page3
$(".p3-btn li").eq(0).on("touchstart",function(){
	$("#page3").hide();
	$("#page1").show();
});
$(".p3-btn li").eq(1).on("touchstart",function(){
	$(".share-mask").show();
});
$(".share-mask").on("touchstart",function(){
	$(".share-mask").hide();
});
