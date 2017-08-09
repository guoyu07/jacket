<template>
    <div class="col-md-8 col-lg-8 col-xs-12">
        <!--<ol class="breadcrumb">-->
            <!--<i class="fa fa-map-marker"></i>&nbsp;&nbsp;-->
            <!--<li class="active">首页</li>-->
        <!--</ol>-->
        <div class="article-show" v-if="article">
            <div class="article-show-title text-center">
                <h2 style="line-height: 60px">{{article.title}}</h2>
                <p class="article-info">
                    <span class="time"><i class="fa fa-calendar"></i> {{article.created_at}}</span>
                    <span class="cate"><i class="fa fa-folder"></i> {{article.category.name}}</span>
                    <span class="user"><i class="fa fa-user"></i> {{article.user.name}}</span>
                    <span class="user"><i class="fa fa-thumbs-up"></i> {{article.votes}}</span>
                </p>
            </div>
            <hr style="border-top: 1px solid #bce8f1">
            <div class="article-content" v-html="article.content">

            </div>
            <hr style="border-top: 1px solid #bce8f1">
            <p class="article-footer">
                <span class="btn btn-default btn-xs" v-for="tag in article.tags"><i class="fa fa-tag"></i> {{tag.name}}</span>
                <span class="btn btn-success btn-sm" style="float: right" @click="vote(article)">
                    <i class="fa fa-thumbs-up"></i> {{article.votes}}
                </span>
            </p>
        </div>
        <div class="article-relation">
            <ul class="list-group">
                <li class="list-group-item">
                    上一篇：&nbsp;&nbsp;&nbsp;
                    <router-link v-if="prev" :to="{name:'show',params:{id:prev.id}}">{{prev.title}}</router-link>
                    <a href="javascript:;" v-else>没有了</a>
                </li>

                <li class="list-group-item">
                    下一篇：&nbsp;&nbsp;&nbsp;
                    <router-link v-if="next" :to="{name:'show',params:{id:next.id}}">{{next.title}}</router-link>
                    <a href="javascript:;" v-else>没有了</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import myNav from './../comm/nav'
    import myFooter from './../comm/footer'
    import mySidebar from './../comm/sidebar'
    export default{
        name:'show',
        components:{myNav, myFooter, mySidebar},
        data(){
            return {
                article:'',
                prev:'',
                next:'',
            }
        },
        watch: {
            '$route' (to, from) {
                this.getList()
            }
        },
        created:function () {
            this.getList()
        },
        methods: {
            vote:function(article){
                this.$http.post('/api/vote', {
                    id:article.id
                }).then(res => {
                    if (res.status) {
                        article.votes += 1;
                    }

                }, error => {

                })
            },
            getList:function () {
                let _this = this
                this.$http.get('/api/show', {
                    params:{
                        id:_this.$route.params.id
                    }
                }).then(res => {
                    _this.article = res.data.result.article;
                    _this.prev = res.data.result.prev;
                    _this.next = res.data.result.next;
                }, error => {

                })
            }
        }
    }
</script>

<style>
    .article-show{
        border:1px solid #bce8f1;
        border-radius: 3px;
        padding: 15px;
        background:#ffffff;
        margin-bottom: 20px;
    }
    .article-show-title span{
        margin-right: 30px;
    }
    .article-relation{
        border:1px solid #bce8f1;
        border-radius: 3px;
        background:#ffffff;
        padding: 10px;
    }
    .article-relation .list-group{
        margin-bottom: 0;
    }
    .article-relation a {
        color: #333333;
    }

    .article-relation a:hover{
        text-decoration: underline;
    }
    .article-footer .btn{
        margin-right: 3px;
    }
</style>