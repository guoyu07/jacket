<template>
    <div class="col-md-8 col-lg-8 col-xs-12 article">
        <div class="panel panel-default">
            <div class="panel-heading">
                最新发布
            </div>
            <div class="panel-body article-list">
                <div class="article-item" v-for="list in lists">
                    <div class="article-box row">
                        <div class="article-header col-md-12">

                            <h4 class="article-title">
                                <span class="title-cate">{{list.category.name}}</span>
                                <router-link :to="{name:'show', params:{id:list.id}}">{{list.title}}</router-link>
                            </h4>
                            <p class="article-info">
                                <span class="time"><i class="fa fa-calendar"></i> {{list.created_at}}</span>
                                <span class="cate"><i class="fa fa-folder"></i> {{list.category.name}}</span>
                                <span class="user"><i class="fa fa-user"></i> {{list.user.name}}</span>
                            </p>
                        </div>
                        <div class="article-desc col-md-12">
                            <div class="article-content">
                                {{list.desc}}
                            </div>
                        </div>
                    </div>
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