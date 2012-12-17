jQuery(function($){
    //加载服务器端处理ajax请求的文件
//    alert("ww");
    var processFile = 'assets/inc/ajax.inc.php',
    //维护模态窗口的功能函数
     fx = {
            "initModal" : function(){
                // 不存在，创建
                if( $(".modal-window").length==0)
                {
                    return $("<div>")
                            .hide()
                            .addClass("modal-window")
                            .appendTo("body");
                }
                else
                {
                    return $(".modal-window");
                }
            },
            // 淡入这个窗口，添加标记
             "boxin" : function(data,modal){
                
                $("<div>")
                    .hide()
                    .addClass("modal-overlay")
                    .click(function(event){
                        fx.boxout(event);
                    })
                    .appendTo("body");

                    // 将数据载入模态窗口并将它追加到body元素
                    modal
                        .hide()
                        .append(data)
                        .appendTo("body");
                    // 淡入模态窗口和覆盖层
                    $(".modal-window,.modal-overlay")
                        .fadeIn("slow");
             },
            
            //淡出这个窗口，并且删除
            "boxout" : function(event){
                if( event!= undefined)
                {
                    event.preventDefault();
                }
                $("a").removeClass("active");
                ///淡出效果并且删除
                $(".modal-window,.modal-overlay")
                    .fadeOut("slow", function(){
                        $(this).remove();
                    });
            },
            //保存之后将新活动添加到日历上
            "addevent" : function(data,formData){
             // alert(data);
       // alert(formData);
              // 将查询字符串转换为一个对象
                var entry = fx.deserialize(formData);

               // alert(entry);
                //为当前月份生成一个Date对象
                cal = new Date(NaN),
                //为新活动生成一个Date对象
                event = new Date(NaN),
                //从h2中提取日历的月份
                cdata = $("h2").attr("id").split('-'),
                //提取事件的日期，年份，和月份
                date = entry.event_start.split(' ')[0],
                //将活动拆分成数组
                edata = date.split('-'),
                //设定cal日期对象的值
                cal.setFullYear(cdata[1],cdata[2],1);
                //设event日期对象的值
                event.setFullYear(edata[0],edata[1],edata[2]);
                //调整时区偏移量来得到正确的本地时间
                event.setMinutes(event.getTimezoneOffset());

                if(cal.getFullYear() == event.getFullYear() && cal.getMonth() == event.getMonth())
                {
                    var day = String(event.getDate()+1);
                    day = day.length==1? "0"+day:day;
                    // bug  这里感觉有bug！！！！
                    // alert(data);
                    //alert("222");
                    $("<a>")
                        .hide()
                        .attr("href","view.php?event_id="+data)
                        .text(entry.event_title)
                        .insertAfter($("strong:contains("+day+")"))
                        .delay(1000)
                        .fadeIn("slow");
                }
            },
            //在活动成功删除后，从标记中删除活动有关的HTML
            "removeevent" : function()
            {
                $(".active")
                    .fadeOut("slow",function(){
                        $(this).remove();
                    });
            },

            //反序列化查询字符串并返回一个event对象
            "deserialize" : function(str){
                var  data = str.split("&"),
                pairs=[], entry={}, key ,val;
                for(x in data)
                {
                    pairs = data[x].split("=");
                    key = pairs[0];
                    val = pairs[1];
                    entry[key] = fx.urldecode(val);
                }
                return entry;
            },
            // 对采用url编码的查询字符串进行编码
            "urldecode" : function(str) {
                //将加号置换回空格
                var converted = str.replace(/\+/g,' ');
                //解码其他任意的编码字符
                return decodeURIComponent(converted);
            } 
        };
    $.fn.dateZoom.defaults.fontsize = "15px";

    //点击标题
    $("li>a").dateZoom()
             .live("click",function(event){
        //1.阻止链接载入view.php
        event.preventDefault();
        //2.给被点击的活动添加标识激活状态class
        $(this).addClass("active");
        //3.从活动的href属性提取查询字符串
        var data = $(this)
                          .attr("href")
                          .replace(/.*?\?(.*)$/,"$1"),
       // alert(data);
       // 检查模态窗口是否存在，存在选中它，否则创建一个新的
       modal = fx.initModal();
        //4.生成一个用来关闭模态窗口的按钮
        $("<a>")
            .attr("href","#")
            .addClass("modal-close-btn")
            .html("&times;")
            .click(function(event){
                //阻止默认行为
                 event.preventDefault();
                //删除窗口
            //     $(".modal-window")
              //      .remove();
                 fx.boxout(event);
            })
            .appendTo(modal);
        //5.生成模态窗口，将关闭按钮放上去
        //6.使用ajax从数据库获取数据，并将其显示在模态窗口上
    $.ajax({
           type:"POST",
           url: processFile,
           data:"action=event_view&" + data,
           success: function(data){
               // modal.append(data);
               fx.boxin(data, modal);
           }
          // error:function(msg){
          //      modal.append(msg);
          // }
        });
    });

    ///在一个模态窗口显示修改表单
    $(".admin-options form,a.admin").live("click",function(event){
   // $(".admin").live("click",function(event){
       //阻止表单提交
       event.preventDefault();
       //载入用于ajax请求的action
       var action = $(event.target).attr("name") || "edit_event";
        
       // alert(action);
       //将input元素中的event_id保存到变量id中
       id = $(event.target)
                .siblings("input[name=event_id]")
                    .val();
       //若ID有效则添加一个额外的参数event_id
       id = (id!=undefined) ? "&event_id="+id : "";

       //载入修改表单并且显示
       $.ajax({
            type : "POST",
            url: processFile,
            data: "action="+action+id,
            success: function(data){
              //  alert(data);
                var form = $(data).hide(),
                //确保模态窗口存在
                modal = fx.initModal()
                            .children(":not(.modal-close-btn)")
                            .remove()
                            .end();

                fx.boxin(null,modal);
                form
                    .appendTo(modal)
                    .addClass("edit-form")
                    .fadeIn("slow");
                    
            }
       });
    });
    //无刷新修改活动
    $(".edit-form input[type=submit]").live("click",function(event){
        event.preventDefault();
        
        //序列化表单以便与使用ajax
        var formData = $(this).parents("form").serialize(),

        //保存提交按钮的值
            submitVal = $(this).val(),
        //romove变量负责确定这个活动是否需要被删除
            remove = false;
        
            start = $(this).siblings("[name=event_start]").val(),
            end   = $(this).siblings("[name=event_end]").val();
        
       // alert(formData);
        //若是删除表单，则追加一个值
        if( $(this).attr("name")=="confirm_delete")
        {
            formData += "&action=confirm_delete" + "&confirm_delete="+submitVal;

            if( submitVal=="Yes, Delete It")
            {
                remove = true;
            }
        }
            // console.log(formData);
            //
       // 如果是创建和修改活动，检查日期是否有效
        if( $(this).siblings("[name=action]").val() == "event_edit")
        {
           // alert( !validDate(start) || !validDate(end))
            if( !$.validDate(start) || !$.validDate(end))
            {
                alert("Valid dates only! (YYYY-MM-DD HH:MM:SS)");
                return false;
            }
           
        }
       // 将表单数据送往处理程序
       $.ajax({
            type: "POST",
            url: processFile,
            data: formData,
            success: function(data) {
                if(remove==true)
                {
                    fx.removeevent();
                }

                fx.boxout();
                //如果是新的活动，将它添加到日历
                if( $("[name=event_id]").val().length==0 && remove===false )
                {
                    //alert(formData);
                   // 这里有个bug！ 多返回一个11
                   // data = String(data);
                  //  data = data.substring(2,4);
                    fx.addevent(data, formData);
                }
            }

       });
    });
    //让cancel按钮的行为与close按钮一致并且淡出模态窗口和覆盖层
    $(".edit-form a:contains(cancel)").live("click", function(event){
        fx.boxout(event);
    });
});
