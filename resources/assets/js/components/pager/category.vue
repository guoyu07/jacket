<template>
    <div class="row">
        <my-nav></my-nav>
        <div class="container">
            This is a category page
        </div>
    </div>
</template>
<script>
    import myNav from './../comm/nav'
    export default{
        name:'category',
        components:{myNav}
    }
</script>