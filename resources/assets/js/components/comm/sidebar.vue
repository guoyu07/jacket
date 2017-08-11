<template>
    <div class="col-md-4 col-lg-4 col-xs-12 sidebar">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-thumbs-up"></i> 推荐
            </div>
            <div class="panel-body">
                <div class="list-group" style="margin-bottom: 0">
                    <router-link class="list-group-item" v-for="item in recommend" :to="{name:'show', params:{id:item.id}}">
                        <span style="float: right;" class="badge">{{item.votes}}</span>
                        <p style="margin: 0">
                            <span class="fa fa-book"></span>
                            {{item.title}}　
                        </p>
                        <span class="clearfix"></span>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-fire"></i> 人气
            </div>
            <div class="panel-body">
                <div class="list-group" style="margin-bottom: 0">
                    <router-link class="list-group-item" v-for="item in popularity" :to="{name:'show',params:{id:item.id}}">
                        <span style="float: right;" class="badge">{{item.votes}}</span>
                        <p style="margin: 0">
                            <span class="fa fa-book"></span>
                            {{item.title}}
                        </p>
                        <span class="clearfix"></span>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-tags"></i> 标签
            </div>
            <div class="panel-body">
                <div class="tags-list">
                    <span class="btn btn-info tag" v-for="tag in tags">{{tag.name}} <span class="badge">{{tag.count}}</span></span>
                </div>
            </div>
        </div>
        <div class="panel panel-default friend-link">
            <div class="panel-heading">
                <i class="fa fa-link"></i> 友情链接
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item" v-for="link in links">
                        <i class="fa fa-angle-right"></i>&nbsp;&nbsp;&nbsp;
                        <a target="_blank" :href="link.url">{{link.name}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import bus from '../../eventBus'
    export default{
        name: 'sidebar',
        data(){
            return{
                recommend:[],
                popularity:[],
                tags:[],
                links:[]
            }
        },
        created:function(){
            bus.$on('search', function (msg) {
                alert(msg)
            });
            let _this = this;
            this.$http.get('/api/recommend').then(res => {
                _this.recommend = res.data.result
            }, error => {

            })

            this.$http.get('/api/popularity').then(res => {
                _this.popularity = res.data.result
            }, error => {

            })

            this.$http.get('/api/tags').then(res => {
                _this.tags = res.data.result
            }, error => {

            })

            this.$http.get('/api/links').then(res => {
                _this.links = res.data.result
            }, error => {

            })
        },
        methods:{

        }
    }
</script>