<template>
    <div class="col-md-8 col-lg-8 col-xs-12">
        <!--<ol class="breadcrumb">-->
            <!--<i class="fa fa-map-marker"></i>&nbsp;&nbsp;-->
            <!--<li class="active"> Home</li>-->
        <!--</ol>-->
        <div class="article-item" v-for="list in lists">
            <div class="article-box box-shadow row">
                <div class="article-title col-md-12">
                    <h2><router-link :to="{name:'show', params:{id:list.id}}">{{list.title}}</router-link></h2>
                    <p class="article-info">
                        <span class="time"><i class="fa fa-calendar"></i> {{list.created_at}}</span>
                        <span class="cate"><i class="fa fa-folder"></i> {{list.category.name}}</span>
                        <span class="user"><i class="fa fa-user"></i> {{list.user.name}}</span>
                    </p>
                </div>
                <div class="article-desc col-md-12">
                    <div class="article-cover col-md-4 col-xs-12">
                        <router-link :to="{name:'show', params:{id:list.id}}">
                            <img class="img-responsive" :src="list.cover" alt="">
                        </router-link>
                    </div>
                    <div class="article-content col-md-8 col-xs-12">
                        {{list.desc}}
                    </div>
                </div>

                <div class="col-md-12 article-footer">
                    <span class="label label-default" v-for="tag in list.tags"><i class="fa fa-tag"></i> {{tag.name}}</span>

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
    import bus from '../../eventBus'
    export default{
        name:'index',
        data(){
            return {
                lists:[],
                current:1,
                pages:null
            }
        },
        mounted:function () {
            bus.$on('search', function (msg) {
                alert(msg)
            });
            var _this = this
            this.$http.get('/api/lists').then(res => {
                _this.current = res.data.result.current_page
                _this.pages = res.data.result.last_page
                _this.lists = res.data.result.data
            }, error => {

            })
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
            }
        }
    }
</script>

<style>
    body{
        background: #eee;
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
    .article-footer .label {
        margin-right: 3px;
    }
    .loads{
        margin-bottom: 30px;
        margin-top: 30px;
    }
</style>