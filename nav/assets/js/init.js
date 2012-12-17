jQuery(function($){
    //加载服务器端处理ajax请求的文件
     var processFile = 'assets/inc/nav.php';
     $("#fast").live("click",function(event){
     //阻止表单提交
           event.preventDefault();
           var fastinputtext = "<form action='assets/inc/p.php' method='post'>";
           fastinputtext += "名称：<input type='text' style='margin-top:5px; color:black;' name='urlname'/>";
           fastinputtext += "<br/>网址：<input type='text' style=' margin-top:5px;color:black;' name='urllink'>";
          fastinputtext += "<br/><input type='submit' name='fast' value='add' class='admin'/>"; 
          fastinputtext += "</form>";
           $("#fastinput")
                          .html(fastinputtext)
                         .slideToggle("fast");
                     //   .slideDown();
           // var urledit = "<a href='#'>delete</a>";

           $("#navul #del_nav").html("del")
                         .attr("href","del.php")
                      .slideToggle();
           $("#navul #change_nav").html("change")
                         .attr("href","del.php")
                      .slideToggle();
    });
     $("input.admin").live("click",function(event){
     //阻止表单提交
           event.preventDefault();
          ///a alert("input");
          //载入用于ajax请求的action
           var action = $(event.target).attr("name") || "fast";
          //将input元素中的event_id保存到变量id中
           urlname = $(event.target)
                           .siblings("input[name=urlname]")
                              .val();
           urllink = $(event.target)
                           .siblings("input[name=urllink]")
                              .val();

           var newurl = "<li style='list-style-type:none;'><a class='metro-button' href='"+urllink+"'>"+urlname+"</a></li>";



           var  formdata = "action=add&urlname="+urlname+"&urllink="+urllink;
           // 将表单数据送往处理程序
      $.ajax({
            type: "POST",
            url: processFile,
            data: formdata,
            success: function(data) {
                 // alert("www");
                    $("#navul li:last").after(newurl);   
                  //  alert(data);
                }
       });

        
    });
     $("#del_nav").live("click",function(event){
     //阻止表单提交
           event.preventDefault();
          // alert("admin");
          $(this).parent().hide("slow");
          
            var url_name_val =$(this).parent().find("a").html();
            //alert(url_name_val);
        formdata ="action=del&url_name="+url_name_val;
      $.ajax({
            type: "POST",
            url: processFile,
            data: formdata,
            success: function(data) {
                    alert(data);
                }
       });
    });
     $("#change_nav").live("click",function(event){
     //阻止表单提交
           event.preventDefault();
          // alert("admin");
        //  $(this).parent().hide("slow");
           var text = $(this).parent().find("a:first").text();
            var text_url_link = $(this).parent().find("a:first").attr("href");
           // alert(text_url_link);
           input_change = "<input  autofocus style='color:black;' type='text' value='"+text+"' id='url_change' name='"+ text_url_link+"'/>";
          $(this).parent().html(input_change);
    });
    
    $("#url_change").live("blur",function(event){
       
           var urllink = $(this).attr("name");
           var urlname = $(this).val();
           var newurl = "<li style='list-style-type:none;'><a class='metro-button' href='"+urllink+"'>"+urlname+"</a><a id='del_nav'>del</a>&nbsp;<a id='change_nav'>change</a></li>";
          var formdata = "action=edit&url_name=" + urlname +"&url_link=" + urllink;
      $.ajax({
            type: "POST",
            url: processFile,
            data: formdata,
            success: function(data) {
                    $("#url_change").parent().html(newurl);
                }
       });
    });


    //////jquery的模态窗口，或者是弹出层
     $("#admin").live("click",function(event){
     //阻止表单提交
           event.preventDefault();
           alert("admin");
    });



    ////Ajax统计  每个超链接的数目
    $(".metro-button").live("click",function(event){
          event.preventDefault();
//		alert("xx");
       var url_name = $(this).text();
       var url_link = $(this).attr("href");
      //  alert(url_name);
      //
      var formdata = "action=tongji&url_name=" + url_name +"&url_link=" + url_link;
      $.ajax({
            type: "POST",
            url: processFile,
            data: formdata,
            success: function(data) {
                   // alert(data); 
					window.location.href= url_link;
                }
         
    });
    });

        var h = $(document).height();
    $(".overlay").css({"height": h });  
    
    $("#action").click(function(){
    
        $(".overlay").css({'display':'block'}).animate({'opacity':'0.2'});
        
        $(".destroy").stop(true).animate({'margin-top':'40px','opacity':'1'},400);
        
    });
    
    $(".close").click(function(){
    
        $(".destroy").stop(true).animate({'margin-top':'-792px','opacity':'0'},800);

        $(".overlay").css({'display':'none'}).animate({'opacity':'0'});
        
    });
     $("#overlay_url").live("click",function(event){
     //阻止表单提交
          event.preventDefault();
        //  alert("input");
          //载入用于ajax请求的action
     //     var action = $(event.target).attr("name") || "fast";
          //将input元素中的event_id保存到变量id中
          var  urlname = $(this).text();
           var urllink = $(this).attr("href");

           var newurl = "<li style='list-style-type:none;'><a class='metro-button' href='"+urllink+"'>"+urlname+"</a></li>";


     //               $("#navul li:last").after(newurl);   

       var  formdata = "action=add&urlname="+urlname+"&urllink="+urllink;
           // 将表单数据送往处理程序
      $.ajax({
            type: "POST",
            url: processFile,
            data: formdata,
            success: function(data) {
                 // alert("www");
                    $("#navul li:last").after(newurl);   
                  //  alert(data);
                }
       });

       });


    
});
