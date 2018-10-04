<template>
    <div class="container-sm">
        <router-view></router-view>
    </div>
</template>

<script>
    import { AddNew } from './AddNew.vue';

    export default {
        name: 'main-app',
        components: {
            AddNew
        }
    }
</script>