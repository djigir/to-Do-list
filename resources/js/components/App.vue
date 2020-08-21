<template>
    <transition name="fade">
        <div class="container">
            <router-view></router-view>
        </div>
    </transition>
</template>

<script>

    export default {

        mounted() {
            console.log('component was mounted');
        }
    }

</script>
