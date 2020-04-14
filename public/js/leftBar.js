window.onload=function(){
//$(document).ready(function(){
    var leftBar_path=window.location.pathname;

    leftBar_path=leftBar_path.split("/");
    leftBar_path=leftBar_path.pop()

    if(leftBar_path == "" || leftBar_path == "index.php"){

        $(".leftbarAll li").css("background-color","#160509");
        $(".leftbar0").css("background-color","darkslateblue");
        $(".leftbar0 a").css("color","#ffffff");
        $(".leftbar1Z").toggle();
        $(".leftbar2Z").toggle();
        $(".leftbar5Z").toggle();
        $(".leftbar6Z").toggle();
        $(".leftbar7Z").toggle();
        $(".leftbar8Z").toggle();
        $(".leftbar10Z").toggle();
        $(".leftbar11Z").toggle();

    }else if(leftBar_path ==  "writeSX.php" || leftBar_path ==  "companyManger2.php" || leftBar_path ==  "zhangmu.php"  || leftBar_path ==  "zhangmu2.php" || leftBar_path ==  "zhangmu3.php" || leftBar_path ==  "sx_line.php" || leftBar_path ==  "sxmb.php"  || leftBar_path ==  "companyManger1_edit.php" || leftBar_path == "expireSX.php"    || leftBar_path == "timeSX.php"|| leftBar_path == "sx_cw.php" || leftBar_path == "ZFSX.php"){

        $(".leftbarAll li").css("background-color","#160509");
        $(".leftbar1").css("background-color","darkslateblue");
        $(".leftbar1 a").css("color","#ffffff");
        $(".leftbar2Z").toggle();
        $(".leftbar5Z").toggle();
        $(".leftbar6Z").toggle();
        $(".leftbar7Z").toggle();
        $(".leftbar8Z").toggle();
        $(".leftbar10Z").toggle();
        $(".leftbar11Z").toggle();

        if(leftBar_path ==  "zhangmu.php"){
            $(".leftbar1Z1 a").css("color","#fff")
        }else if(leftBar_path == "writeSX.php"){
            $(".leftbar1Z2 a").css("color","#fff")
        }else if(leftBar_path == "companyManger2.php"){
            $(".leftbar1Z3 a").css("color","#fff")
        }else if(leftBar_path ==  "zhangmu2.php"){
            $(".leftbar1Z4 a").css("color","#fff")
        }else if(leftBar_path ==  "zhangmu3.php"){
            $(".leftbar1Z5 a").css("color","#fff")
        }else if(leftBar_path ==  "expireSX.php" || leftBar_path ==  "timeSX.php"){
            $(".leftbar1Z6 a").css("color","#fff")
        }else if(leftBar_path ==  "ZFSX.php"){
            $(".leftbar1Z7 a").css("color","#fff")
        }
        
    }else if(leftBar_path == "data.php" || leftBar_path == "form.php" || leftBar_path == "uploadInfo.php" || leftBar_path == "addDayData.php" || leftBar_path == "sumDayData.php" || leftBar_path == "powerPage.php"){
        
        $(".leftbarAll li").css("background-color","#160509");
        $(".leftbar2").css("background-color","darkslateblue");
        $(".leftbar2 a").css("color","#ffffff");
        $(".leftbar1Z").toggle();
        $(".leftbar5Z").toggle();
        $(".leftbar6Z").toggle();
        $(".leftbar7Z").toggle();
        $(".leftbar8Z").toggle();
        $(".leftbar10Z").toggle();
        $(".leftbar11Z").toggle();

        if(leftBar_path ==  "data.php"){
            $(".leftbar2Z1 a").css("color","#fff")
        }else if(leftBar_path == "form.php"){
            $(".leftbar2Z2 a").css("color","#fff")
        }else if(leftBar_path == "sumDayData.php"){
            $(".leftbar2Z3 a").css("color","#fff")
        }else if(leftBar_path == "powerPage.php"){
            $(".leftbar2Z4 a").css("color","#fff")
        }

    }else if(leftBar_path == "form.php"){
        $(".leftbarAll li").css("background-color","#160509");
        $(".leftbar3").css("background-color","darkslateblue");
        $(".leftbar3 a").css("color","#ffffff");
    }else if(leftBar_path == "uploadInfo.php"){
        $(".leftbarAll li").css("background-color","#160509");
        $(".leftbar4").css("background-color","darkslateblue");
        $(".leftbar4 a").css("color","#ffffff");
    }else if(leftBar_path == "center.php"){
        $(".leftbarAll li").css("background-color","#160509");
        $(".leftbar5").css("background-color","darkslateblue");
        $(".leftbar5 a").css("color","#ffffff");
        $(".leftbar1Z").toggle();
        $(".leftbar2Z").toggle();
        $(".leftbar6Z").toggle();
        $(".leftbar7Z").toggle();
        $(".leftbar8Z").toggle();
        $(".leftbar10Z").toggle();
        $(".leftbar11Z").toggle();

        if(leftBar_path ==  "center.php"){
            $(".leftbar5Z1 a").css("color","#fff")
        }
    }else if(leftBar_path == "flsq.php" || leftBar_path == "flList.php" ||  leftBar_path == "flLine.php" ||  leftBar_path == "flDone.php" ||  leftBar_path == "flListQuery.php" || leftBar_path == "oldflDone.php" || leftBar_path == "oldflLine.php" || leftBar_path == "oldflListQuery.php"){
        $(".leftbarAll li").css("background-color","#160509");
        $(".leftbar6").css("background-color","darkslateblue");
        $(".leftbar6 a").css("color","#ffffff");
        $(".leftbar1Z").toggle();
        $(".leftbar2Z").toggle();
        $(".leftbar5Z").toggle();
        $(".leftbar7Z").toggle();
        $(".leftbar8Z").toggle();
        $(".leftbar10Z").toggle();
        $(".leftbar11Z").toggle();

        if(leftBar_path ==  "flsq.php"){
            $(".leftbar6Z1 a").css("color","#fff")
        }else if(leftBar_path == "flList.php"){
            $(".leftbar6Z2 a").css("color","#fff")
        }else if(leftBar_path == "flDone.php"){
            $(".leftbar6Z3 a").css("color","#fff")
        }else if(leftBar_path == "oldflDone.php"){
            $(".leftbar6Z4 a").css("color","#fff")
        }

    }else if(leftBar_path == "contract.php" || leftBar_path == "w_contract.php" || leftBar_path == "contractList.php" || leftBar_path == "contract_line.php" || leftBar_path == "contract_query.php" || leftBar_path == "newSQ.php" || leftBar_path == "sq_line.php"  || leftBar_path == "w_sq.php"  || leftBar_path ==  "sqList.php"){
        $(".leftbarAll li").css("background-color","#160509");
        $(".leftbar7").css("background-color","darkslateblue");
        $(".leftbar7 a").css("color","#ffffff");
        $(".leftbar1Z").toggle();
        $(".leftbar2Z").toggle();
        $(".leftbar5Z").toggle();
        $(".leftbar6Z").toggle();
        $(".leftbar8Z").toggle();
        $(".leftbar10Z").toggle();
        $(".leftbar11Z").toggle();

        if(leftBar_path ==  "contractList.php" || leftBar_path ==  "sqList.php"){
            $(".leftbar7Z1 a").css("color","#fff")
        }else if(leftBar_path == "contract.php" || leftBar_path == "newSQ.php"){
            $(".leftbar7Z2 a").css("color","#fff")
        }else if(leftBar_path == "w_contract.php" || leftBar_path == "w_sq.php"){
            $(".leftbar7Z3 a").css("color","#fff")
        }

    }else if(leftBar_path == "it.php" || leftBar_path == "itList.php"){
        $(".leftbarAll li").css("background-color","#160509");
        $(".leftbar8").css("background-color","darkslateblue");
        $(".leftbar8 a").css("color","#ffffff");
        $(".leftbar1Z").toggle();
        $(".leftbar2Z").toggle();
        $(".leftbar5Z").toggle();
        $(".leftbar6Z").toggle();
        $(".leftbar7Z").toggle();
        $(".leftbar10Z").toggle();
        $(".leftbar11Z").toggle();

        if(leftBar_path ==  "itList.php"){
            $(".leftbar8Z1 a").css("color","#fff")
        }else if(leftBar_path == "it.php"){
            $(".leftbar8Z2 a").css("color","#fff")
        }
    }else if(leftBar_path == "document.php"){
        $(".leftbarAll li").css("background-color","#160509");
        $(".leftbar9").css("background-color","darkslateblue");
        $(".leftbar9 a").css("color","#ffffff");
    
        $(".leftbar1Z").toggle();
        $(".leftbar2Z").toggle();
        $(".leftbar5Z").toggle();
        $(".leftbar6Z").toggle();
        $(".leftbar7Z").toggle();
        $(".leftbar8Z").toggle();
        $(".leftbar10Z").toggle();
        $(".leftbar11Z").toggle();
    
    }else if(leftBar_path ==  "apcMeeting.php" || leftBar_path ==  "viewMeeting.php"  || leftBar_path ==  "willMeeting.php"   || leftBar_path ==  "viewMeetingDetail.php"){
        $(".leftbar1Z").toggle();
        $(".leftbar2Z").toggle();
        $(".leftbar5Z").toggle();
        $(".leftbar6Z").toggle();
        $(".leftbar7Z").toggle();
        $(".leftbar8Z").toggle();
        $(".leftbar11Z").toggle();

        if(leftBar_path ==  "viewMeeting.php"){
            $(".leftbar10Z1 a").css("color","#fff")
        }else if(leftBar_path == "apcMeeting.php"){
            $(".leftbar10Z2 a").css("color","#fff")
        }else if(leftBar_path == "willMeeting.php"){
            $(".leftbar10Z3 a").css("color","#fff")
        }
    }else if(leftBar_path ==  "newStore.php" || leftBar_path ==  "manStore.php"  || leftBar_path ==  "uploadStore.php"   || leftBar_path ==  "dataStore.php" || leftBar_path ==  "dataStoreDetails.php"){
        $(".leftbar1Z").toggle();
        $(".leftbar2Z").toggle();
        $(".leftbar5Z").toggle();
        $(".leftbar6Z").toggle();
        $(".leftbar7Z").toggle();
        $(".leftbar8Z").toggle();
        $(".leftbar10Z").toggle();

        if(leftBar_path == "manStore.php" || leftBar_path ==  "newStore.php" || leftBar_path == "uploadStore.php"){
            $(".leftbar11Z2 a").css("color","#fff")
        }else if(leftBar_path == "dataStore.php"){
            $(".leftbar11Z4 a").css("color","#fff")
        }
    }else{
        $(".leftbar1Z").toggle();
        $(".leftbar2Z").toggle();
        $(".leftbar5Z").toggle();
        $(".leftbar6Z").toggle();
        $(".leftbar7Z").toggle();
        $(".leftbar8Z").toggle();
        $(".leftbar10Z").toggle();
        $(".leftbar11Z").toggle();
    }

    $(".leftbar1").click(function(){
        $(".leftbar1Z").toggle(500);
    })

    $(".leftbar2").click(function(){
        $(".leftbar2Z").toggle(500);
    })

    $(".leftbar5").click(function(){
        $(".leftbar5Z").toggle(500);
    })

    $(".leftbar6").click(function(){
        $(".leftbar6Z").toggle(500);
    })

    $(".leftbar7").click(function(){
        $(".leftbar7Z").toggle(500);
    })

    $(".leftbar8").click(function(){
        $(".leftbar8Z").toggle(500);
    })

    $(".leftbar10").click(function(){
        $(".leftbar10Z").toggle(500);
    })

    $(".leftbar11").click(function(){
        $(".leftbar11Z").toggle(500);
    })


    $("#logout").click(function(){
        window.location.href="formHandle/account/logoutHandle.php"; 
    })

    $("#center").click(function(){
        window.location.href="center.php";
    })
    
    var menu=[{"我的门户":[{"href":"index.php","name":"我的主页"},{"href":"#","name":"数据查询"},{"href":"#","name":"数据录入"}]},{"公司授信":[{"href":"companyManger1.php","name":"填写授信单"},{"href":"zhangmu.php","name":"待审核授信"},{"href":"zhangmu2.php","name":"待回款授信"},{"href":"zhangmu3.php","name":"已完成授信"},{"href":"timeSX.php","name":"到期授信单"},{"href":"ZFSX.php","name":"作废授信单"}]},{"辅料申请单":[{"href":"flsq.php","name":"新增辅料单"},{"href":"flList.php","name":"未完成辅料"},{"href":"flDone.php","name":"已完成辅料"},{"href":"oldflDone.php","name":"旧系统辅料"}]},{"店铺信息":[{"href":"manStore.php","name":"店铺分配"},{"href":"uploadStore.php","name":"数据提交"},{"href":"dataStore.php","name":"店铺数据"}]},{"店铺合同":[{"href":"contract.php","name":"新增合同"},{"href":"w_contract.php","name":"待归档合同"},{"href":"contractList.php","name":"已归档合同"}]},{"电脑设备":[{"href":"itList.php","name":"设备列表"},{"href":"it.php","name":"新增设备"}]},{"数据统计":[{"href":"data.php?month=","name":"当月数据报表"},{"href":"form.php"},{"name":"日数据报表"},{"href":"sumDayData.php","name":"合计数据报表"},{"href":"powerPage.php","name":"BI可视化报表"}]},{"订会议室":[{"href":"viewMeeting.php","name":"查看会议"}]},{"个人中心":[{"href":"center.php","name":"我的资料"}]},{"文件下载":[{"href":"document.php","name":"文件下载"}]}]
    
    for(i=0;i<menu.length;i++){
        for (key in menu[i]){
            //console.log(key)

            for(j=0;j<menu[i][key].length;j++){
                for (key2 in menu[i][key][j]){
                    //console.log(menu[i][key][j][key2])
                }
            }
        }
    }

}


    