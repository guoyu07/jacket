<template>
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
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
                    <li v-for="menu in menus" :class="{'active':menu.active}" v-on:click="change(menu)"><a href="javascript:;">{{menu.name}}</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">登录</a></li>
                    <li><a href="#">注册</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</template>

<script>

    export default {
        name: 'nav',
        data () {
            return {
                brand: 'Blog',
                menus:[
                    {
                        id:1,
                        name:'html',
                        active:false,
                    },
                    {
                        id:2,
                        name:'css',
                        active:false
                    },
                    {
                        id:3,
                        name:'javascript',
                        active:false
                    }
                ]
            }
        },
        watch: {
            '$route' (to, from) {
                console.log(this.$route.params.id);
            }
        },
        created:function(){
            var id = this.$route.params.id;
            if (undefined !== id) {
                for (var i = 0; i < this.menus.length; i++) {
                    if (id == this.menus[i].id) {
                        console.log(id)
                        this.menus[i].active = true
                    } else {
                        this.menus[i].active = false
                    }
                }
            }
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
                _this.$router.push({name:'category', params:{id:evt.id}})
            }
        }
    }
</script>

<style>
    .navbar{
        margin-bottom: 2px;
    }

</style>