<template>
    <div class="container">
        <div id="server" class="grey darken-3 z-depth-1" v-for="server in servers" :key="server.id">
            <div class="col s12">

                <h5>{{ server.servername }}</h5>
                <div style="display: flex;">
                    <p style="margin-right: 10px;">MOD: {{ server.gamemode }} |</p>
                    <p style="margin-right: 10px;">MAP: {{ server.mapname }} </p>
                    <template v-if="server.state == 'Online'">
                        <p><i class="fas fa-joint" style="color: green;"></i></p>
                    </template>
                    <template v-else>
                        <p><i class="fas fa-joint" style="color: red;"></i></p>
                    </template>
                </div>

                <line-chart :data='server.players'></line-chart>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'home',
        mounted() {
            if (this.servers.length) {
                return;
            }

            this.$store.dispatch('getServers');
        },
        computed: {
            servers() {
                return this.$store.getters.servers;
            }
        }
    }
</script>

<style scoped>
    #server {
        margin: 10px;
        padding: 10px;
        margin-bottom: 20px;
    }
</style>
