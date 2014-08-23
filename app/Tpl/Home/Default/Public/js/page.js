$(function(){

	  

   /* 导航 */
	   $(".nav").find("li:first").addClass("ace");
   
	 
	 /* 左导航 */
	 var domHeight=$(window).height()-120;
	 $(".sidebar-right").height(domHeight);
	 var  mheight=$(document).height();
	 var domWidth=$(document).width()-805;
	 $(".visualArea").width(domWidth);
 
   /*内容高度*/
	 var conheight=$("#contents").height();
	 if(mheight>conheight){
	   $("#contents").height(mheight);
	 }
	 /* 联系方式隐藏 */
	 if(mheight<510){
	   $(".contact ").hide();
	 }
 
   
   /*图片自适应*/
   $(".visualArea img").width(domWidth);
	 if($(".visualArea img").height()>mheight){
	   $(".visualArea img").height("auto");
   }else{
	   $(".visualArea img").height(mheight);
	 }
	$(".loading").height(mheight);
  $(".loading-cent").height(mheight);

  
   /* 加载页面 */	
	 setTimeout(function (){
	 
	  $(".loading").hide();
		$("#contents").show();
	 
	 },1000)
	 
	 
	 /* 动画 */
	 setTimeout(function (){
	   
	   
	   $(".mainAreaInner").slideDown(800);
		 $(".mainAreaInner").animate({
	     opacity:'1' 
       },100);
		 $(".visu").eq(0).animate({
	    
			 width:'100%'
			  
       },500); 
		  $(".visu").eq(0).find(".visualPict").animate({
	     opacity:'1',
			 width:'100%'
       },800);
      			 

  },1100);
	 
 
 $(".mainAreaInnershang").height(mheight);
 
  
	/* 锚链接滑动 */
	
 
    $(".sidebar-right ul li a").click(function(){
        var hr = $(this).attr("href");
				var hr2=hr.replace("#","")+"l";
        var anh = $(hr).offset().top;
        $("html,body").stop().animate({scrollTop:anh},2000);
				$(".sidebar-right ul li").removeClass("active");
				$(this).parent("li").addClass("active");
				$(".visu").hide();
				var shu=$(".visu").length;
				for(i=0;i<shu;i++){
				
				  if($(".visu").eq(i).attr("id")==hr2){
					
					 $(".visu").eq(i).show();
					 $(".visu").width(0);
					 $(".visualPict").width(0);
						$(".visu").eq(i).animate({
	            width:'100%'
			      },500);
						$(".visu").eq(i).find(".visualPict").animate({
						 opacity:'1',
						 width:'100%'
						 },800);
            						
					} 
        }
		})
 
	/* 滑动变导航 */
    $(window).bind("scroll",function(){  
			 var points = $(".mainContentsArea > h2");

			 for(i=0; i<points.length; i++){
			   var val = $(points[i]).offset().top;
				 if(jQuery(window).scrollTop()>(jQuery(points[i]).offset().top-38)){
				 	 $(".sidebar-right ul li").removeClass("active");
				   $(".sidebar-right ul li").eq(i).addClass("active");
					 
			   }
 
			} 
			 
	});
	$(".content-two ").height($(window).height());
	$(".footer-nav").width($(window).width());
	
/* 	setInterval(function(){
			var points = $(".mainContentsArea > h2");
			 for(i=0; i<points.length; i++){
			   var val = $(points[i]).offset().top;
				 if(val == '1'){
				 	 $(".sidebar-right ul li").removeClass("active");
				   $(".sidebar-right ul li").eq(i).addClass("active");
					 }
			 }
	}, 2000); */
	 
});