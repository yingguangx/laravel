<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <meta name="csrf-token" content="{{csrf_token()}}">

        <link rel="shortcut icon" href="{{URL::asset('img/114923221741479294.png')}}">

        <title>EE员工端</title>

        <!-- Bootstrap core CSS -->
        <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('css/bootstrap-reset.css')}}" rel="stylesheet">
        <link href="{{URL::asset('css/magicsuggest-min.css')}}" rel="stylesheet">

        <!--Animation css-->
        <link href="{{URL::asset('css/animate.css')}}" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="{{URL::asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('assets/ionicon/css/ionicons.min.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('assets/material-design-iconic-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet"/>
        <!-- Plugins css -->
        <link href="{{URL::asset('css/component.css')}}" rel="stylesheet">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{URL::asset('assets/morris/morris.css')}}">

        <!-- sweet alerts -->
        <link href="{{URL::asset('assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('assets/timepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
        <link href="{{URL::asset('css/helper.css')}}" rel="stylesheet">

        <!--Custom style-->
        <link href="{{URL::asset('css/main.css')}}" rel="stylesheet" />
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <link href="{{URL::asset('css/jquery-confirm.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('css/bootstrapValidator.css')}}" rel="stylesheet" />

        <link rel="stylesheet" href="{{URL::asset('css/lightbox.min.css')}}"/>
        @yield('style')
    </head>


    <body>

        <!-- Aside Start-->
<aside class="left-panel">

    <!-- brand -->
    <div class="logo" style="padding-top:0">
        <a href="{{url('staff/dashboard')}}" class="logo-expanded">
            <img style="width:100%;" src="/img/logo-1.png" alt="" class="img-responsive" id="logo-img">
        </a>
    </div>
    <!-- / brand -->

    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled ul_active">
            <li class="has-submenu {!!(Request::is('staff/dateStatus', 'staff/historyQuery','staff/getHistory')? 'active' : '') !!}">
                <a class="aaa"><i class="zmdi zmdi-format-underlined"></i> <span class="nav-label">经营状况</span><span
                        class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="">
                    <li class="{!!(Request::is('staff/dateStatus')? 'active' : '') !!}"><a href="{{url('staff/dateStatus')}}">当日状况</a></li>
                    <li class="{!!(Request::is('staff/historyQuery','staff/getHistory')? 'active' : '') !!}"><a href="{{url('staff/historyQuery')}}">历史查询</a></li>
                </ul>
            </li>
            <li class="has-submenu {!!(Request::is('staff/order', 'staff/package','staff/polPackage','staff/uploadOverweight','staff/orderDetailByNo/*','staff/orderLog/*','staff/packageDetailByNo/*','staff/packageLog/*','staff/modifyOrderByNo/*','staff/modifyPackageInOrder','staff/searchPackagesInfo',
            'staff/searchOrderInfo','staff/weightLog','staff/searchWeightLog','staff/batchLog','staff/searchBatchLog','staff/searchPolPackagesInfo','staff/batchShow','staff/zhgqPackage')? 'active' : '') !!}">
                <a class="aaa"><i class="zmdi zmdi-album"></i> <span
                    class="nav-label">订单管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="">
                    <li class="{!!(Request::is('staff/order','staff/orderDetailByNo/*','staff/orderLog/*','staff/modifyOrderByNo/*','staff/modifyPackageInOrder','staff/searchOrderInfo')? 'active' : '') !!}"><a href="{{url('staff/order')}}">订单列表</a></li>
                    <li class="{!!(Request::is('staff/package','staff/packageDetailByNo/*','staff/packageLog/*','staff/searchPackagesInfo')? 'active' : '') !!}"><a href="{{url('staff/package')}}">PostNL包裹列表</a></li>
                    <li class="{!!(Request::is('staff/polPackage','staff/searchPolPackagesInfo')? 'active' : '') !!}"><a href="{{url('staff/polPackage')}}">北极星BC包裹列表</a></li>
                    <li class="{!!(Request::is('staff/uploadOverweight')? 'active' : '') !!}"><a href="{{url('staff/uploadOverweight')}}">上传超重文件</a></li>
                    <li class="{!!(Request::is('staff/expressHolland')? 'active' : '') !!}"><a href="{{url('staff/expressHolland')}}">荷兰单号上传</a></li>
                    <li class="{!!(Request::is('staff/weightLog')? 'active' : '') !!}"><a href="{{url('staff/weightLog')}}">称重记录</a>
                    <li class="{!!(Request::is('staff/batchLog')? 'active' : '') !!}"><a href="{{url('staff/batchLog')}}">加批次记录</a>
                    <li class="{!!(Request::is('staff/batchShow')? 'active' : '') !!}"><a href="{{url('staff/batchShow')}}">批次数据</a>
                    <li class="{!!(Request::is('staff/zhgqPackage')? 'active' : '') !!}"><a href="{{url('staff/zhgqPackage')}}">北极星个清包裹列表</a></li>
                </ul>
            </li>
            <li class="has-submenu {!!(Request::is('staff/cardFailed','staff/writeCard','staff/firstExport','staff/repeatExport','staff/getFirstInfo','staff/secondForward','staff/firstForward','staff/customsClearance','staff/clearance_express',
            'staff/flyBatch','staff/newFly','staff/oms_batch/*','staff/newOmsBatch/*','staff/updateFly/*','staff/flyBatchShow','staff/statusSearch','staff/HsCode/index','staff/HsCode/create','staff/HsCode/edit/*')? 'active' : '') !!}">
                <a class="aaa"><i class="zmdi zmdi-album"></i> <span
                    class="nav-label">北极星订单管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="">
                    <li class="{!!(Request::is('staff/statusSearch')? 'active' : '') !!}"><a href="{{url('staff/statusSearch')}}">订单状态查询</a></li>
                    <li class="{!!(Request::is('staff/firstForward')? 'active' : '') !!}"><a href="{{url('staff/firstForward')}}">第一次转单单号写入</a></li>
                    <li class="{!!(Request::is('staff/customsClearance')? 'active' : '') !!}"><a href="{{url('staff/customsClearance')}}">设置清关完成</a></li>
                    <li class="{!!(Request::is('staff/secondForward','staff/clearance_express')? 'active' : '') !!}"><a href="{{url('staff/secondForward')}}">第二次转单</a></li>
                    <li class="{!!(Request::is('staff/flyBatch','staff/newFly','staff/oms_batch/*','staff/newOmsBatch/*','staff/updateFly/*','staff/flyBatchShow')? 'active' : '') !!}"><a href="{{url('staff/flyBatch')}}">航空批次</a></li>
                    <li class="{!!(Request::is('staff/HsCode/index','staff/HsCode/create','staff/HsCode/edit/*')? 'active' : '') !!}"><a href="{{url('staff/HsCode/index')}}">HsCode管理</a></li>
                    <li class="{!!(Request::is('staff/customsFailed')? 'active' : '') !!}"><a href="{{url('staff/customsFailed')}}">海关认证失败</a></li>
                </ul>
            </li>

            <li class="has-submenu {!!(Request::is('staff/applyList','staff/applyNextList','staff/firstGExport','staff/repeatGExport','staff/goodsFailed','staff/goodsPass')? 'active': '') !!}">
                <a  class="aaa"><i class="zmdi zmdi-collection-text"></i> <span
                            class="nav-label">商品申请备案管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="">
                    <li class="{!!(Request::is('staff/applyList','staff/applyNextList','staff/firstGExport','staff/repeatGExport','staff/goodsFailed','staff/goodsPass')? 'active' : '')!!}"><a href="{{url('staff/applyList')}}">客户申请列表</a></li>
                </ul>
            </li>
            <li class="has-submenu {!!(Request::is('staff/showCustomerInfo','staff/addCustomerForm', 'staff/letterQuery','staff/recipientInformation','staff/feedbackInquiries','staff/customerInfoEdit/*'
            ,'staff/sendLetter/*','staff/getLetterInfo','staff/showAfterSaleInfo','staff/afterSaleCommunication/*','staff/newsLetterShow','staff/newsLetterContent/*','staff/letterList/*','staff/lookNewsLetter/*'
            ,'staff/lookSendStatus/*','staff/customerMessage')? 'active' : '') !!}">
               <a class="aaa"><i class="zmdi zmdi-collection-text"></i> <span
                    class="nav-label">客户管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="">
                    <li class="{!!(Request::is('staff/showCustomerInfo','staff/addCustomerForm','staff/sendLetter/*','staff/customerInfoEdit/*')? 'active' : '') !!}"><a href="{{url('staff/showCustomerInfo')}}">客户信息查询</a></li>
                    <li class="{!!(Request::is('staff/letterQuery','staff/getLetterInfo')? 'active' : '') !!}"><a href="{{url('staff/letterQuery')}}">站内信查询</a></li>
                    <li class="{!!(Request::is('staff/recipientInformation')? 'active' : '') !!}"><a href="{{url('staff/recipientInformation')}}">收件人信息查询</a></li>
                    <li class="{!!(Request::is('staff/showAfterSaleInfo')? 'active' : '') !!}"><a href="{{url('staff/showAfterSaleInfo')}}">售后处理</a></li>
                    <li class="{!!(Request::is('staff/afterSaleCommunication/*')? 'active' : '') !!}"><a href="{{url('staff/showAfterSaleInfo')}}">售后处理沟通</a></li>
                    {{--<li class="{!!(Request::is('sendAfterSaleForm.html')? 'active' : '') !!}"><a href="sendAfterSaleForm.html">发售后单</a></li>--}}
                    <li class="{!!(Request::is('staff/feedbackInquiries')? 'active' : '') !!}"><a href="{{url('staff/feedbackInquiries')}}">意见反馈查询</a></li>
                    <li class="{!!(Request::is('staff/newsLetterShow','staff/newsLetterContent/*','staff/letterList/*','staff/lookNewsLetter/*','staff/lookSendStatus/*')? 'active' : '') !!}"><a href="{{url('staff/newsLetterShow')}}">NewsLetter</a></li>
                     <li class="{!!(Request::is('staff/customerMessage')? 'active' : '') !!}"><a href="{{url('staff/customerMessage')}}">顾客沟通</a></li>
                </ul>
            </li>

            <li class="has-submenu {!!(Request::is('staff/takeordersindex','staff/takecondition','staff/takegoodscompany','staff/takegoodscompany/goodsprice','staff/takegoodscompany/goodstaketime','staff/takeordersinfo/*','staff/takeGoodsCompany','staff/takeGoodsCompany/goodsPrice','staff/takeGoodsCompany/goodsTakeTime'
            ,'staff/takeordersinfo/*','staff/searchorders','staff/takeordersindex','staff/takecondition','staff/takeGoodsCompany','staff/company_info_add','staff/companycars/*','staff/companydriver/*','staff/company_info_update/*','staff/companyarea/*','staff/companyprice/*','staff/companyPriceGroup/*','staff/takeGoodsCompany/goodsPrice','staff/takeGoodsCompany/goodsTakeTime','staff/scanRecording','staff/searchPackagesActual')? 'active': '') !!}">
                <a  class="aaa"><i class="zmdi zmdi-collection-text"></i> <span
                    class="nav-label">提货管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="">
                    <li class="{!!(Request::is('staff/searchorders','staff/takeordersinfo/*','staff/takeordersindex')? 'active' : '')!!}"><a href="{{url('staff/takeordersindex')}}">提货订单查询</a></li>
                    <li class="{!! (Request::is('staff/takecondition')? 'active' : '') !!}"><a href="{{url('staff/takecondition')}}">提货情况查询</a></li>
                    <li class="{!! (Request::is('staff/takeGoodsCompany','staff/company_info_add','staff/companycars/*','staff/companydriver/*','staff/company_info_update/*','staff/companyarea/*','staff/companyprice/*','staff/companyPriceGroup/*')? 'active' : '') !!}"><a href="{{url('staff/takeGoodsCompany')}}">提货公司查询</a></li>
                    <li class="{!! (Request::is('staff/takeGoodsCompany/goodsPrice')? 'active' : '') !!}"><a href="{{url('staff/takeGoodsCompany/goodsPrice')}}">提货包裹售价</a></li>
                    <li class="{!! (Request::is('staff/takeGoodsCompany/goodsTakeTime')? 'active': '')!!}"><a href="{{url('staff/takeGoodsCompany/goodsTakeTime')}}">提货时间段设置</a></li>
                    <li class="{!! (Request::is('staff/scanRecording','staff/searchPackagesActual')? 'active' : '') !!}"><a href="{{url('staff/scanRecording')}}">扫描记录</a></li>
                </ul>
            </li>

            <li class="has-submenu {!!(Request::is('staff/packaging','staff/packagingorders','staff/meals','staff/packagingMaterial','staff/packageMaterialAdd','staff/packageMaterialUpdate/*','staff/logisiticPrice','staff/packageproduct_add','staff/package_product_update/*','staff/searchPackingOrders','staff/mealsAdd','staff/mealUpdate/*','staff/packageMaterialAdd','staff/packageMaterialUpdate/*','staff/searchMaterial','staff/wrapperAdjustmentOfBalance','staff/searchMeals','staff/searchpackagecompany','staff/mealBlance','staff/searchMealBlance','staff/mealBlancePay','staff/searchBlancePay','staff/mealCategory','staff/packingOrderTurnOver','staff/searchPackingOrderTurnOver')? 'active': '') !!}">
                <a  class="aaa"><i class="zmdi zmdi-collection-text"></i> <span
                            class="nav-label">包材管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="">
                    <li class="{!!(Request::is('staff/searchpackagecompany','staff/packaging','staff/packageproduct_add','staff/package_product_update/*')? 'active' : '')!!}"><a href="{{url('staff/packaging')}}">包装材料公司管理</a></li>
                    <li class="{!!(Request::is('staff/searchorders','staff/packagingorders','staff/searchPackingOrders')? 'active' : '')!!}"><a href="{{url('staff/packagingorders')}}">包装材料订单查询</a></li>
                    <li class="{!!(Request::is('staff/packingOrderTurnOver','staff/searchPackingOrderTurnOver')? 'active' : '')!!}"><a href="{{url('staff/packingOrderTurnOver')}}">包材库存流水</a></li>

                    <li class="{!!(Request::is('staff/mealBlance','staff/searchMealBlance')? 'active' : '')!!}"><a href="{{url('staff/mealBlance')}}">套餐订单结算</a></li>
                    <li class="{!!(Request::is('staff/mealBlancePay','staff/searchBlancePay')? 'active' : '')!!}"><a href="{{url('staff/mealBlancePay')}}">套餐结算支付</a></li>
                    <li class="{!!(Request::is('staff/mealCategory')? 'active' : '')!!}"><a href="{{url('staff/mealCategory')}}">套餐分类管理</a></li>
                    <li class="{!!(Request::is('staff/meals','staff/mealsAdd','staff/mealUpdate/*','staff/searchMeals')? 'active' : '')!!}"><a href="{{url('staff/meals')}}">包装材料套餐管理</a></li>
                    <li class="{!!(Request::is('staff/packagingMaterial','staff/packageMaterialAdd','staff/packageMaterialUpdate/*','staff/packageMaterialAdd','staff/packageMaterialUpdate/*','staff/searchMaterial')? 'active' : '')!!}"><a href="{{url('staff/packagingMaterial')}}">包装材料管理</a></li>
                    <li class="{!!(Request::is('staff/logisiticPrice')? 'active' : '')!!}"><a href="{{url('staff/logisiticPrice')}}">物流价格设置</a></li>
                    <li class="{!!(Request::is('staff/wrapperAdjustmentOfBalance')? 'active' : '')!!}"><a href="{{url('staff/wrapperAdjustmentOfBalance')}}">包材库存调整原因</a></li>
                </ul>
            </li>

            <li class="has-submenu {!!(Request::is('staff/depositVerification','staff/customerAccountQueries','staff/waterCustomerInquiries','staff/customerQuery','staff/accountBalanceInquiry',
            'staff/cashAudits','staff/waterDetailBySerial/*','staff/getBillInfo','staff/getAccountInfo','staff/getCostInfo',
             'staff/depositDetailByNo/*','staff/searchVerificationInfo','staff/searchCashVerificationInfo','staff/refund','staff/searchRefundInfo','staff/showToInvoiceInfo','staff/showToPrintInfo',
             'staff/polRefund','staff/searchPolRefundInfo','staff/euroReturn','staff/takeRecharge','staff/rechargeDetailByNo/*'
             )? 'active' : '') !!}">
            <a class="aaa"><i class="zmdi zmdi-format-list-bulleted"></i> <span class="nav-label">财务管理</span><span
                    class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="">
                    <li class="{!!(Request::is('staff/depositVerification','staff/depositDetailByNo/*','staff/searchVerificationInfo')? 'active' : '') !!}"><a href="{{url('staff/depositVerification')}}">预存款审核</a></li>
                    <li class="{!!(Request::is('staff/takeRecharge','staff/rechargeDetailByNo/*')? 'active' : '') !!}"><a href="{{url('staff/takeRecharge')}}">提货充值审核</a></li>
                    <li class="{!!(Request::is('staff/customerAccountQueries','staff/getAccountInfo')? 'active' : '') !!}"><a href="{{url('staff/customerAccountQueries')}}">客户账户查询</a></li>
                    <li class="{!!(Request::is('staff/waterCustomerInquiries','staff/waterDetailBySerial/*','staff/getBillInfo')? 'active' : '') !!}"><a href="{{url('staff/waterCustomerInquiries')}}">客户流水查询</a></li>
                    <li class="{!!(Request::is('staff/customerQuery','staff/getCostInfo')? 'active' : '') !!}"><a href="{{url('staff/customerQuery')}}">客户消费查询</a></li>
                    <li class="{!!(Request::is('staff/accountBalanceInquiry')? 'active' : '') !!}"><a href="{{url('staff/accountBalanceInquiry')}}">客户余额调整</a></li>
                    <li class="{!!(Request::is('staff/cashAudits','staff/searchCashVerificationInfo')? 'active' : '') !!}"><a href="{{url('staff/cashAudits')}}">提现审核</a></li>
                    <li class="{!!(Request::is('staff/refund','staff/searchRefundInfo')? 'active' : '') !!}"><a href="{{url('staff/refund')}}">退款审核</a></li>
                    <li class="{!!(Request::is('staff/polRefund','staff/searchPolRefundInfo')? 'active' : '') !!}"><a href="{{url('staff/polRefund')}}">北极星退款审核</a></li>
                    <li class="{!!(Request::is('staff/euroReturn')? 'active' : '') !!}"><a href="{{url('staff/euroReturn')}}">批量返现</a></li>
                    @if(Session::get('staff_name')=='admin')
                    <li class="{!!(Request::is('staff/showToInvoiceInfo','staff/showToPrintInfo')? 'active' : '') !!}"><a href="{{url('staff/showToInvoiceInfo')}}">发票管理</a></li>
                    @endif
                </ul>
            </li>
            <li class="has-submenu {!!(Request::is('staff/showStaffInfo', 'staff/modifyPassword','staff/newStaff')? 'active' : '') !!}">
                <a class="aaa"><i class="zmdi zmdi-chart"></i> <span class="nav-label">员工管理</span><span
                    class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="">
                    <li class="{!!(Request::is('staff/showStaffInfo')? 'active' : '') !!}"><a href="{{url('staff/showStaffInfo')}}">员工信息查询</a></li>
                    <li class="{!!(Request::is('staff/modifyPassword')? 'active' : '') !!}"><a href="{{url('staff/modifyPassword')}}">修改密码</a></li>
                    <li class="{!!(Request::is('staff/newStaff')? 'active' : '') !!}"><a href="{{url('staff/newStaff')}}">新建员工</a></li>
                    <li class="{!!(Request::is('staff/distributionCompetences')? 'active' : '') !!}"><a href="{{url('staff/distributionCompetences')}}">权限分配</a></li>
                </ul>
            </li>

            <li class="has-submenu {!!(Request::is('staff/newPermissionSet', 'staff/permissionSettings','staff/exchangeRate','staff/VIP','staff/CustomerFreightView','staff/PolCustomerFreightView','staff/CorreosCustomerFreightView','staff/contentNotification','staff/stationLetter/*','staff/productLibrary','staff/systemParameterSetting','staff/productLibrarySetting','staff/productBrandIndex',
            'staff/productTypeIndex','staff/productChildTypeIndex','staff/coupon','staff/getCoupon/*','staff/cartons','staff/newsLetter','staff/invoiceItemSet',
            'staff/addLetterGroup','staff/checkIsEmailLetter/*','staff/addNewsLetter/*','staff/CorreosCustomerFreight/*','staff/CorreosCustomerFreight','staff/takeGoodsCompany/takeGoodsNotice','staff/takeGoodsCompany/takeGoodsNoticeEdit','staff/groceryshopping','staff/shoppingindex', 'staff/packageNumberSetting','staff/packageNumberSetting/*')? 'active' : '') !!}">
              <a class="aaa"><i class="zmdi zmdi-map"></i> <span class="nav-label">系统管理</span><span
                    class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="">
                    <li class="{!!(Request::is('staff/newPermissionSet')? 'active' : '') !!}"><a href="{{url('staff/newPermissionSet')}}">新建权限组</a></li>
                    <li class="{!!(Request::is('staff/permissionSettings')? 'active' : '') !!}"><a href="{{url('staff/permissionSettings')}}">权限设置</a></li>
                    <li class="{!!(Request::is('staff/exchangeRate')? 'active' : '') !!}"><a href="{{url('staff/exchangeRate')}}">汇率设置</a></li>
                    <li class="{!!(Request::is('staff/VIP')? 'active' : '') !!}"><a href="{{url('staff/VIP')}}">VIP优惠设置</a></li>
                    <li class="{!!(Request::is('staff/coupon','staff/getCoupon/*')? 'active' : '') !!}"><a href="{{url('staff/coupon')}}">优惠劵设置</a></li>
                    <li class="{!!(Request::is('staff/setAfterSaleType')? 'active' : '') !!}"><a href="{{url('staff/setAfterSaleType')}}">售后管理</a></li>
                    <li class="{!!(Request::is('staff/CustomerFreightView')? 'active' : '') !!}"><a href="{{url('staff/CustomerFreightView')}}">客户组运费设置</a></li>
                    <li class="{!!(Request::is('staff/packageNumberSetting')? 'active' : '') !!}"><a href="{{url('staff/packageNumberSetting')}}">客户组包裹数量价格设置</a></li>
                    <li class="{!!(Request::is('staff/PolCustomerFreightView')? 'active' : '') !!}"><a href="{{url('staff/PolCustomerFreightView')}}">北极星客户组运费设置</a></li>
                    {{--<li class="{!!(Request::is('staff/CorreosCustomerFreight', 'staff/CorreosCustomerFreight/*', '/CorreosCustomerFreight/weightSetting')? 'active' : '') !!}"><a href="{{url('staff/CorreosCustomerFreight')}}">西班牙客户组运费设置</a></li>--}}
                    {{--<li class="{!!(Request::is('staff/BcPrice')? 'active' : '') !!}"><a href="{{url('staff/BcPrice')}}">BC专线价格档设置</a></li>--}}
                    <li class="{!!(Request::is('staff/smallBcPrice')? 'active' : '') !!}"><a href="{{url('staff/smallBcPrice')}}">奶粉个清专线价格档设置</a></li>
                    <li class="{!!(Request::is('staff/contentNotification','staff/stationLetter/*')? 'active' : '') !!}"><a href="{{url('staff/contentNotification')}}">通知内容设置</a></li>
                    <li class="{!!(Request::is('staff/newsLetter','staff/addLetterGroup','staff/checkIsEmailLetter/*','staff/addNewsLetter/*')? 'active' : '') !!}"><a href="{{url('staff/newsLetter')}}">NewsLetter设置</a></li>
                    <li class="{!!(Request::is('staff/productLibrary')? 'active' : '') !!}"><a href="{{url('staff/productLibrary')}}">商品库</a></li>
                    <li class="{!!(Request::is('staff/productLibrarySetting')? 'active' : '') !!}"><a href="{{url('staff/productLibrarySetting')}}">商品库设置</a></li>
                    <li class="{!! (Request::is('staff/takeGoodsCompany/takeGoodsNotice','staff/takeGoodsCompany/takeGoodsNoticeEdit')? 'active': '')!!}"><a href="{{url('staff/takeGoodsCompany/takeGoodsNotice')}}">下单公告设置</a></li>

                    <li class="{!!(Request::is('staff/systemParameterSetting')? 'active' : '') !!}"><a href="{{url('staff/systemParameterSetting')}}">系统参数设置</a></li>
                    <li class="{!!(Request::is('staff/cartons')? 'active' : '') !!}"><a href="{{url('staff/cartons')}}">纸箱信息设置</a></li>
                    <li class="{!!(Request::is('staff/invoiceItemSet')? 'active' : '') !!}"><a href="{{url('staff/invoiceItemSet')}}">发票代码设置</a></li>
                    <li class="{!!(Request::is('staff/groceryshopping')? 'active' : '') !!}"><a href="{{url('staff/groceryshopping')}}">杂货个清商品库设置</a></li>
                    <li class="{!!(Request::is('staff/shoppingindex')? 'active' : '') !!}"><a href="{{url('staff/shoppingindex')}}">杂货个清商品库</a></li>
                    <li class="{!!(Request::is('staff/weightindex')? 'active' : '') !!}"><a href="{{url('staff/weightindex')}}">杂货个清重量档运费设置</a></li>
                </ul>
            </li>
            <li class="has-submenu {!!(Request::is('staff/emergency')? 'active' : '') !!}">
                <a class="aaa"><i class="zmdi zmdi-chart"></i> <span class="nav-label">应急管理</span><span
                            class="menu-arrow"></span></a>
                <ul class="list-unstyled" style="">
                    <li class="{!!(Request::is('staff/emergency')? 'active' : '') !!}"><a href="{{url('staff/emergency')}}">DPD应急处理</a></li>
                </ul>
            </li>
        </ul>
    </nav>

</aside>
<!-- Aside Ends-->

        <!--Main Content Start -->
        <section class="content">

            <!-- Header -->
            <header class="top-head container-fluid">
                <button id="logo-button" type="button" class="navbar-toggle pull-left">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


                <!-- Left navbar -->
                <nav class=" navbar-default" role="navigation">

                    <!-- Right navbar -->
                <ul class="nav navbar-nav navbar-right top-menu top-right-menu">
                        <!-- user login dropdown start-->
          <!-- user login dropdown start-->
                <li class="dropdown text-center">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="username">{{Session::get('staff_name')}} </span> <span class="caret"></span></a>
                    <ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003"
                        style="overflow: hidden; outline: none;">

                        <li><a href="/staff/modifyPassword"><i class="fa fa-cog"></i> 设置</a></li>
                        <li><a href="/staff/logout"><i class="fa fa-sign-out"></i>退出登录</a></li><!--退出登录 -->
                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!-- End right navbar -->
        </nav>

    </header>
    <!-- Header Ends -->


            <!-- Page Content Start -->
            <!-- ================== -->


            @yield('content')



            <!-- Page Content Ends -->
            <!-- ================== -->

     <!-- Footer Start -->
    <footer class="footer">
        <div class="footer-top">
            <ul>
                <li><span>Copyright: EE 速递 / EE Express</span></li>
            </ul>
        </div>
    </footer>
    <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="{{URL::asset('js/jquery.js')}}"></script>
        <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
        <script src="{{URL::asset('js/modernizr.min.js')}}"></script>
        <script src="{{URL::asset('js/pace.min.js')}}"></script>
        <script src="{{URL::asset('js/wow.min.js')}}"></script>
        <script src="{{URL::asset('js/jquery.scrollTo.min.js')}}"></script>
        <script src="{{URL::asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>

        <!-- Counter-up -->
        <script src="{{URL::asset('js/waypoints.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('js/jquery.counterup.min.js')}}" type="text/javascript"></script>

        <!-- sparkline -->
        <script src="{{URL::asset('assets/sparkline-chart/jquery.sparkline.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('assets/sparkline-chart/chart-sparkline.js')}}" type="text/javascript"></script>

       <!-- skycons -->
        <script src="{{URL::asset('js/skycons.min.js')}}" type="text/javascript"></script>

        <!-- Modal-Effect -->
        <script src="{{URL::asset('js/classie.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('js/modalEffects.js')}}" type="text/javascript"></script>

      <!--Morris Chart-->
      <script src="{{URL::asset('assets/morris/morris.min.js')}}"></script>
      <script src="{{URL::asset('assets/morris/raphael.min.js')}}"></script>

     <script src="{{URL::asset('js/jquery.app.js')}}"></script>

        <!-- Dashboard -->
        <script src="{{URL::asset('/js/jquery.dashboard.js')}}"></script>
        <script src="{{URL::asset('/assets/timepicker/bootstrap-datepicker.js')}}"></script>
        <script src="{{URL::asset('/js/systemParameterSetting.js')}}"></script>
        <!-- bootstrapValidator -->
        <script src="{{URL::asset('js/bootstrapValidator.js')}}"></script>
        <script src="{{URL::asset('assets/jquery.validate/jquery.validate.min.js')}}"></script>
        <!-- Jquery-Confirm -->
        <script src="{{URL::asset('js/jquery-confirm.js')}}"></script>
        <!-- ueditor -->
        <script type="text/javascript" charset="utf-8" src="{{URL::asset('js/ueditor.config.js')}}"></script>
        <script type="text/javascript" charset="utf-8" src="{{URL::asset('js/ueditor.all.min.js')}}"> </script>
        <script type="text/javascript" charset="utf-8" src="{{URL::asset('js/lang/zh-cn/zh-cn.js')}}"></script>
        <script type="text/javascript" charset="utf-8" src="{{URL::asset('js/bootstrap-datepicker.js')}}"></script>
        <script type="text/javascript" charset="utf-8" src="{{URL::asset('js/locales/bootstrap-datepicker.zh-CN.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('js/lightbox.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('js/magicsuggest-min.js')}}"></script>
        <script>
var dates = $("#fromDate,#endDate");
dates.datepicker({
    language: 'zh-CN',
    autoclose: true
}).on("changeDate", function () {
    //console.log(this.value);
    var selectedDate = this.value;
    var option = this.id == "fromDate" ? "setStartDate" : "setEndDate";
    dates.not(this).datepicker(option, selectedDate);
});
dates.keyup(function(e) {
   // alert(e.keyCode);
    if(e.keyCode == 8 || e.keyCode == 46) {
        this.value="";
        dates.datepicker('destroy');
        dates.datepicker('enable');
        dates.datepicker({
            language: 'zh-CN',
            autoclose: true
        }).on("changeDate", function () {
            //console.log(this.value);
            var selectedDate = this.value;
            var option = this.id == "fromDate" ? "setStartDate" : "setEndDate";
            dates.not(this).datepicker(option, selectedDate);
        });
    }
});
    </script>
    <script type="text/javascript">
        $('.ul_active').on('click','li',function (event) {
            event.target = this;
            $('.active').not($(this)).removeClass('active');
            $(this).toggleClass('active');
            event.stopPropagation();
        });
        $('.list-unstyled').find('li').click(function(){
            $(this).parent().css('display','block');
        })
//缩放logo
        $('#logo-button').on('click',function(){
            var attr =  $('#logo-img').attr('src');
            var ScreenWidth = $(window).width();
            if(ScreenWidth>768){
                if (attr == '/img/logo-1.png') {
                    $('#logo-img').attr('src','/img/small.png');
                    $('.logo').css('padding-top','5px')
                }else{
                    $('#logo-img').attr('src','/img/logo-1.png');
                    $('.logo').css('padding-top','0');
                }
            }
        });
    jQuery(document).ready(function ($) {
        /* Counter Up */
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });
    });
    /* BEGIN SVG WEATHER ICON */
    if (typeof Skycons !== 'undefined') {
        var icons = new Skycons(
                        {"color": "#fff"},
                        {"resizeClear": true}
                ),
                list = [
                    "clear-day", "clear-night", "partly-cloudy-day",
                    "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                    "fog"
                ],
                i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);
        icons.play();
    }
    ;

        var isusing = false;
        var newMessageRemind={
            _step: 0,
            _title: document.title,
            _timer: null,
            //显示新消息提示
            show:function(){
                var temps = newMessageRemind._title.replace("【　　　】", "").replace("【新消息】", "");
                newMessageRemind._timer = setTimeout(function() {
                    newMessageRemind.show();
                    newMessageRemind._step++;
                    if (newMessageRemind._step == 3) { newMessageRemind._step = 1 };
                    if (newMessageRemind._step == 1) { document.title = "【　　　】" + temps };
                    if (newMessageRemind._step == 2) { document.title = "【新消息】" + temps };
                }, 800);
                return [newMessageRemind._timer, newMessageRemind._title];
            },
            //取消新消息提示
            clear: function(){
                clearTimeout(newMessageRemind._timer );
                document.title = newMessageRemind._title;
            }
        };

        //消息通知
        $(document).ready(function(){
            var url = '{{url('staff/messages')}}';
            function startRequest()
            {
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        //alert(data);
                        //console.log(data.messages_info);
                        if(data.messages_info!=0){
                            if(!isusing){
                                isusing = true;
                                newMessageRemind.show();
                            }else{
                                isusing = false;
                                newMessageRemind.clear();
                            }
                        }

                    }
                })
            }

            setInterval(startRequest,10000);
        });

</script>
        @yield('jquery')

    </body>
</html>
