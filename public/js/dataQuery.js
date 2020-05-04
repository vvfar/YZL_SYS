window.onload=function(){
    chooseOne=$("#chooseOne").val()
    chooseTwo=$("#chooseTwo").val()
    chooseThree=$("#chooseThree").val()
    chooseFour=$("#chooseFour").val()
    chooseFive=$("#chooseFive").val()
    chooseSix=$("#chooseSix").val()
    chooseSeven=$("#chooseSeven").val()

    //第一个框
    $.ajax({
        type:"get",
        async:true,
        url:"../../controller/index/dataQueryController1.php",
        dataType:"json",
        success:function(result){
            if(result){
                for(var i=0;i<result.length;i++){
                    $("#title").html(result[0].value)
                    $("#mytime").html(result[1].value)
                    $("#num").html(result[2].value)
                    $("#tb").html(result[3].value)
                    $("#hb").html(result[4].value)
                    
                }
            }
        },

        error:function(XMLHttpRequest, textStatus, errorThrown){
            console.log("数据错误")
        }
    })

    //第二个框
    $.ajax({
        type:"get",
        async:true,
        url:"../../controller/index/dataQueryController2.php",
        dataType:"json",
        success:function(result){
            if(result){
                for(var i=0;i<result.length;i++){
                    $("#title2").html(result[0].value)
                    $("#mytime2").html(result[1].value)
                    $("#num2").html(result[2].value)
                    $("#tb2").html(result[3].value)
                    $("#hb2").html(result[4].value)
                    
                }
            }
        },

        error:function(XMLHttpRequest, textStatus, errorThrown){
            console.log("数据错误")
        }
    })

    //第三个框
    $.ajax({
        type:"get",
        async:true,
        url:"../../controller/index/dataQueryController3.php",
        dataType:"json",
        success:function(result){
            if(result){
                for(var i=0;i<result.length;i++){
                    $("#title3").html(result[0].value)
                    $("#mytime3").html(result[1].value)
                    
                    str=""

                    $("#rank").html(function(){
                        for(var j=0;j<result[2].value.length;j++){
                            if(j==0){
                                str=str + "<li><span style='background-color:red;color:#fff;padding-left:5px;padding-right:5px;border-radius:3px;'>" + (j+1) +"</span><span style='margin-left:10px'>" +result[2].value[j] + "</span></li>"
                            }else if(j==1){
                                str=str + "<li><span style='background-color:brown;color:#fff;padding-left:5px;padding-right:5px;border-radius:3px;'>" + (j+1) +"</span><span style='margin-left:10px'>" +result[2].value[j] + "</span></li>"
                            }else if(j==2){
                                str=str + "<li><span style='background-color:orange;color:#fff;padding-left:5px;padding-right:5px;border-radius:3px;'>" + (j+1) +"</span><span style='margin-left:10px'>" +result[2].value[j] + "</span></li>"
                            }else{
                                str=str + "<li><span style='background-color:grey;color:#fff;padding-left:5px;padding-right:5px;border-radius:3px;'>" + (j+1) +"</span><span style='margin-left:10px'>" +result[2].value[j] + "</span></li>"
                            }  
                        }

                        return str;
                    })
                        
                    
                    
                }
            }
        },

        error:function(XMLHttpRequest, textStatus, errorThrown){
            console.log("数据错误")
        }
    })

    //第四个框
    var myChart=echarts.init(document.getElementById('data_body'),"light");

    myChart.showLoading();

    var names=[];
    var numbers=[];

    $.ajax({
        type:"post",
        async:true,
        url:"../../controller/index/dataQueryController4.php",
        dataType:"json",
        success:function(result){
            if(result){
                for(var i=0;i<result.length;i++){
                    names.push(result[i].dateTime_xssj);
                    numbers.push(result[i].number_xssj);
                    object=result[i].object_xssj;
                }
            }

            myChart.hideLoading();
        
            var option={
                title:{
                    text:'',
                    subtext:object,
                    x:'left' 
                },
                tooltip:{
                    trigger:'item',
                },
                legend:{
                    orient:'vertical', 
                    left:'right',  
                    data:['销量']
                },
                
                xAxis:{
                    data:names
                },
                yAxis:{},
                series:[{
                    name:'销量',
                    type:'line',
                    data:numbers
                }]
            }

            myChart.setOption(option);

        }
    })

    //第五个框
    $.ajax({
        type:"get",
        async:true,
        url:"../../controller/index/dataQueryController5.php",
        dataType:"json",
        success:function(result){
            if(result){
                for(var i=0;i<result.length;i++){
                    $("#title5").html(result[0].value)
                    $("#mytime5").html(result[1].value)
                    $("#num5").html(result[2].value)
                    $("#tb5").html(result[3].value)
                    $("#hb5").html(result[4].value)
                    
                }
            }
        },

        error:function(XMLHttpRequest, textStatus, errorThrown){
            console.log("数据错误")
        }
    })

    //第二个框
    $.ajax({
        type:"get",
        async:true,
        url:"../../controller/index/dataQueryController6.php",
        dataType:"json",
        success:function(result){
            if(result){
                for(var i=0;i<result.length;i++){
                    $("#title6").html(result[0].value)
                    $("#mytime6").html(result[1].value)
                    $("#num6").html(result[2].value)
                    $("#tb6").html(result[3].value)
                    $("#hb6").html(result[4].value)
                    
                }
            }
        },

        error:function(XMLHttpRequest, textStatus, errorThrown){
            console.log("数据错误")
        }
    })
    
}