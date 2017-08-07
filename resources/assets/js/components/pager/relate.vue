<template>
    <div class="wrapper">
        <my-nav></my-nav>
        <div class="content">
            <div class="container">
                <ol class="breadcrumb" style="margin-top: 70px">
                    <i class="fa fa-map-marker"></i>&nbsp;&nbsp;
                    <li class="active">首页</li>
                </ol>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="article-show">
                        <h3 class="about-title"><span>关于</span></h3>
                        <div class="about-content">
                            未接入口为入口为客人问客人口味而文科人口为客人可谓
                            未接入口为入口为客人问客人口味而文科人口为客人可谓
                            未接入口为入口为客人问客人口味而文科人口为客人可谓
                            未接入口为入口为客人问客人口味而文科人口为客人可谓
                            未接入口为入口为客人问客人口味而文科人口为客人可谓
                            未接入口为入口为客人问客人口味而文科人口为客人可谓
                            未接入口为入口为客人问客人口味而文科人口为客人可谓
                            未接入口为入口为客人问客人口味而文科人口为客人可谓
                            未接入口为入口为客人问客人口味而文科人口为客人可谓
                        </div>

                        <h3 class="about-title"><span>关于</span></h3>
                        <div class="about-img row">
                            <div class="img-item col-md-6 col-xs-12">
                                <img style="max-width: 100%" src="http://img4q.duitang.com/uploads/item/201411/23/20141123072535_28aMM.jpeg" alt="img" class="img-rounded">
                            </div>
                            <div class="img-item col-md-6 col-xs-12">
                                <img style="max-width: 100%" src="http://img4q.duitang.com/uploads/item/201411/23/20141123072535_28aMM.jpeg" alt="img" class="img-rounded">
                            </div>
                            <div class="img-item col-md-6 col-xs-12">
                                <img style="max-width: 100%" src="http://img4q.duitang.com/uploads/item/201411/23/20141123072535_28aMM.jpeg" alt="img" class="img-rounded">
                            </div>

                        </div>
                    </div>
                </div>
                <my-sidebar></my-sidebar>
            </div>

        </div>
        <my-footer></my-footer>
    </div>
</template>

<script>
    import myNav from './../comm/nav'
    import myFooter from './../comm/footer'
    import mySidebar from './../comm/sidebar'
    export default{
        name:'about',
        components:{myNav, myFooter, mySidebar}
    }
</script>

<style>
    .about-title span{
        border-bottom: 2px solid #333333;
    }
    .about-content{
        font-size: 20px;
        text-indent: 40px
    }
    .about-img .img-item{
        padding: 10px;
    }
</style>