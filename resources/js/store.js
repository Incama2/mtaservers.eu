export default {
    state: {
        servers: [],
    },
    mutations: {
        updateServers(state, payload) {
            state.servers = payload;
        }
    },
    getters: {
        servers(state) {
            return state.servers;
        }
    },
    actions: {
        getServers(context) {
            axios.get('api/index')
            .then((res) => {
                $.each(res.data.response, function(index, value) {
                    var modified_players = [];
                    value.players.forEach(row => {
                        modified_players.push([row.date, row.count])
                        // modified_players[row.date] = row.count;
                    });
                    value.players = modified_players;
                });
                context.commit('updateServers', res.data.response);
            });
        }
    },
};