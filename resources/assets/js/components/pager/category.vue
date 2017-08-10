<template>
    <div class="col-md-8 col-lg-8 col-xs-12">
        <!--<ol class="breadcrumb">-->
            <!--<i class="fa fa-map-marker"></i>&nbsp;&nbsp;-->
            <!--<li class="active">首页</li>-->
        <!--</ol>-->
        <div class="article-item" v-for="list in lists">
            <div class="article-box box-shadow row">
                <div class="article-title col-md-12">
                    <h2>{{list.title}}</h2>
                    <p class="article-info">
                        <span class="time"><i class="fa fa-calendar"></i> {{list.created_at}}</span>
                        <span class="cate"><i class="fa fa-folder"></i> {{list.category.name}}</span>
                        <span class="user"><i class="fa fa-user"></i> {{list.user.name}}</span>
                    </p>
                </div>
                <div class="article-desc col-md-12">
                    <div class="article-cover col-md-4 col-xs-12">
                        <a href="">
                            <img class="img-responsive" :src="list.cover" alt="">
                        </a>
                    </div>
                    <div class="article-content col-md-8 col-xs-12">
                        {{list.desc}}
                    </div>
                </div>

                <div class="col-md-12 article-footer">
                    <span class="label label-default"><i class="fa fa-tag"></i> 1111</span>
                    <span class="label label-default"><i class="fa fa-tag"></i> 1111</span>
                    <span class="label label-default"><i class="fa fa-tag"></i> 1111</span>
                    <span class="label label-default"><i class="fa fa-tag"></i> 1111</span>
                    <span class="label label-success" style="float: right;cursor: pointer" @click="change(list.id)">详情 ></span>
                </div>
            </div>
        </div>

        <div class="loads">
            <nav aria-label="...">
                <ul class="pager">
                    <li v-if="pages && current > 1" @click="prev" class="previous"><a href="javascript:;"><span aria-hidden="true">&larr;</span> 上一页</a></li>
                    <li v-if="pages && current < pages" @click="next"  class="next"><a href="javascript:;">下一页 <span aria-hidden="true">&rarr;</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
    import myNav from './../comm/nav'
    import myFooter from './../comm/footer'
    import mySidebar from './../comm/sidebar'
    export default{
        name:'category',
        components:{myNav, myFooter,mySidebar},
        data(){
            return {
                lists:[],
                current:1,
                pages:null,
            }
        },
        watch: {
            '$route' (to, from) {
                this.getList()
            }
        },
        mounted:function () {
            this.getList()
        },

        methods:{
            change:function (id) {
                this.$router.push({name:'show', params:{id:id}})
            },
            prev:function (event) {
                var page = --this.current
                var _this = this
                this.$http.get('/api/lists', {
                    params:{
                        page:page
                    }
                }).then(res => {
                    _this.current = res.data.result.current_page
                    _this.pages = res.data.result.last_page
                    _this.lists = res.data.result.data
                }, error => {

                })
            },
            next:function (event) {
                var page = ++this.current
                var _this = this
                this.$http.get('/api/lists', {
                    params:{
                        page:page
                    }
                }).then(res => {
                    _this.current = res.data.result.current_page
                    _this.pages = res.data.result.last_page
                    _this.lists = res.data.result.data
                }, error => {

                })
            },
            getList:function () {
                var _this = this
                this.$http.get('/api/lists', {
                    params:{
                        category_id:_this.$route.params.id
                    }
                }).then(res => {
                    _this.current = res.data.result.current_page
                    _this.pages = res.data.result.last_page
                    _this.lists = res.data.result.data
                }, error => {

                })
            }
        }
    }
</script>