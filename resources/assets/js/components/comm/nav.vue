<template>
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">{{ brand }}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li v-for="menu in menus"  v-on:click="change(menu)"><a href="javascript:;">{{menu.name}}</a></li>
                </ul>
                <!--<ul class="nav navbar-nav navbar-right">-->
                    <!--<li><a href="#">登录</a></li>-->
                    <!--<li><a href="#">注册</a></li>-->
                <!--</ul>-->
                <!--<div class="navbar-form navbar-right">-->
                    <!--<div class="form-group">-->
                        <!--<input type="text" class="form-control" placeholder="Search">-->
                    <!--</div>-->
                    <!--<button type="submit" class="btn btn-default" @click="search">搜 索</button>-->
                <!--</div>-->


            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</template>

<script>
    import bus from '../../eventBus'
    export default {
        name: 'nav',
        data () {
            return {
                brand:'Blog',
                menus:''
            }
        },
        mounted:function(){
            var _this = this
            this.$http.get('/api/menu').then(function (response) {
                _this.menus = response.data.result
                var id = this.$route.params.id;
                if (undefined !== id) {
                    for (var i = 0; i < _this.menus.length; i++) {
                        if (id == _this.menus[i].id) {
                            console.log(id)
                            _this.menus[i].active = true
                        } else {
                            _this.menus[i].active = false
                        }
                    }
                }
            })
            .catch(function (error) {

            });

        },
        methods:{
            change:function(evt){
                var _this = this
                for (var i = 0; i < _this.menus.length; i++) {
                    if (evt.id == _this.menus[i].id) {
                        _this.menus[i].active = true
                    } else {
                        _this.menus[i].active = false
                    }
                }
                if (evt.type == 'module') {
                    _this.$router.push({name:evt.path})
                } else {
                    _this.$router.push({name:evt.path, params:{id:evt.param}})
                }

            },
            search:function () {
                bus.$emit('search', 1111);
            }
        }
    }
</script>

