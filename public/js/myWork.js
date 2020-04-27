window.onload=function(){

    //代办事项
    $.ajax({
        type:"post",
        async:true,
        url:"../../controller/index/myworkController.php",
        dataType:"json",
        success:function(result){
            if(result){
                dataForm=""


                for(var i=0;i<result.length;i++){

                    dataForm=dataForm + '<div class="willDo_child">' +
                                        '<p class="caption">' + result[i].name_dbsx + '</p>' + 
                                        '<h3><a href="' + result[i].link_dbsx  + '"target="_blank"' +'>' + result[i].number_dbsx +'</a></h3></div>';
                }

                $("#willDo_ajax").html(dataForm)
            }
        }
    })

    //数据图表（销售）
    var myChart=echarts.init(document.getElementById('data_body'),"light");

    myChart.showLoading();

    var names=[];
    var numbers=[];

    $.ajax({
        type:"post",
        async:true,
        url:"../../controller/index/myworkController2.php",
        dataType:"json",
        success:function(result){
            if(result){
                for(var i=0;i<result.length;i++){
                    names.push(result[i].dateTime_xssj);
                    numbers.push(result[i].number_xssj);
                }
            }

            myChart.hideLoading();
        
            var option={
                title:{
                    text:'',
                    subtext:'',
                    x:'left' 
                },
                tooltip:{
                    trigger:'item',
                },
                legend:{
                    orient:'vertical', 
                    left:'center',  
                    data:['销量']
                },
                
                xAxis:{
                    //data:["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
                    data:names
                },
                yAxis:{},
                series:[{
                    name:'销量',
                    type:'line',
                    //data:[5,20,36,10,10,20]
                    data:numbers
                }]
            }

            myChart.setOption(option);

        }
    })


    //注意进度条依赖 element 模块，否则无法进行正常渲染和功能性操作
    layui.use('element', function(){
        var element = layui.element;
    });

}