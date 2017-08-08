<template>
    <div class="col-md-8 col-lg-8 col-xs-12">
        <ol class="breadcrumb">
            <i class="fa fa-map-marker"></i>&nbsp;&nbsp;
            <li class="active">首页</li>
        </ol>
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
                    <li v-if="pages && current > 1" @click="prev" class="previous"><a href="javascript:;"><span aria-hidden="true">&larr;</span> Older</a></li>
                    <li v-if="pages && current < pages" @click="next"  class="next"><a href="javascript:;">Newer <span aria-hidden="true">&rarr;</span></a></li>
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
                var _this = this
                this.$http.get('/api/lists', {
                    params:{
                        category_id:_this.$route.params.id
                    }
                }).then(res => {
                    console.log(res)
                    _this.current = res.data.result.current_page
                    _this.pages = res.data.result.last_page
                    _this.lists = res.data.result.data
                }, error => {

                })
            }
        },
        mounted:function () {
            var _this = this
            this.$http.get('/api/lists', {
                params:{
                    category_id:_this.$route.params.id
                }
            }).then(res => {
                console.log(res)
                _this.current = res.data.result.current_page
                _this.pages = res.data.result.last_page
                _this.lists = res.data.result.data
            }, error => {

            })
        },

        methods:{
            change:function (id) {
                console.log(id)
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
                    console.log(res)
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
                    console.log(res)
                    _this.current = res.data.result.current_page
                    _this.pages = res.data.result.last_page
                    _this.lists = res.data.result.data
                }, error => {

                })
            }
        }
    }
</script>

<style>
    body{
        background: #eee;
    }

    .list-group-item{
        border: none;
        cursor: pointer;
    }

    .article-item{
        padding: 0;
        margin-bottom: 10px;
        background: #ffffff;
        border-radius: 3px;
        border: 2px solid #ffffff;
    }
    .article-item:hover{
        border: 2px solid #bce8f1;
    }
    .article-box {
        padding: 10px 10px 15px 15px;

    }
    .article-title h2{
        margin-top:0;
        cursor: pointer;
    }
    .article-title h2:hover{
        text-decoration: underline;
    }
    .article-title span{
        margin-right: 30px;
    }
    .article-cover,.article-content{
        margin-bottom: 10px;
        padding-left: 1px;
    }
    .article-footer{
        clear: both;
    }
    .loads{
        margin-bottom: 30px;
        margin-top: 30px;
    }
</style>