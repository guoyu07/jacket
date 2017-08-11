<template>
    <div class="wrapper">
        <my-nav></my-nav>
        <div class="content">

            <div class="jumbotron">
                <h2>echo "Hello World"</h2>
            </div>

            <div class="container" id="app">


                <router-view ></router-view>
                <my-sidebar></my-sidebar>
            </div>
        </div>
        <my-footer></my-footer>
    </div>
</template>

<script>
    import myNav from './components/comm/nav.vue'
    import myFooter from './components/comm/footer.vue'
    import mySidebar from './components/comm/sidebar.vue'
    export default {
        name: 'app',
        components:{myNav, myFooter,mySidebar},
    }
</script>