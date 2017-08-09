<template>
    <div class="col-md-8 col-lg-8 col-xs-12">
        <!--<ol class="breadcrumb">-->
            <!--<i class="fa fa-map-marker"></i>&nbsp;&nbsp;-->
            <!--<li class="active"> About</li>-->
        <!--</ol>-->
        <div class="article-show">
            <h3 class="about-title"><span>关于</span></h3>
            <div class="about-content">
                <p>Linux是一套免费使用和自由传播的类Unix操作系统，是一个基于POSIX和UNIX的多用户、多任务、支持多线程和多CPU的操作系统。它能运行主要的UNIX工具软件、应用程序和网络协议。它支持32位和64位硬件。Linux继承了Unix以网络为核心的设计思想，是一个性能稳定的多用户网络操作系统。<br>Linux操作系统诞生于1991 年10 月5 日（这是第一次正式向外公布时间）。Linux存在着许多不同的Linux版本，但它们都使用了Linux内核。Linux可安装在各种计算机硬件设备中，比如手机、平板电脑、路由器、视频游戏控制台、台式计算机、大型机和超级计算机。<br>严格来讲，Linux这个词本身只表示Linux内核，但实际上人们已经习惯了用Linux来形容整个基于Linux内核，并且使用GNU 工程各种工具和数据库的操作系统。</p>
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
</template>

<script>
    export default{
        name:'about',
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