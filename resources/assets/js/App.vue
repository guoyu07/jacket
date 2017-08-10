<template>
    <div class="wrapper">
        <my-nav></my-nav>
        <div class="content">

            <div class="jumbotron">
                <h1>Hello, world!</h1>
                <p>...</p>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
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