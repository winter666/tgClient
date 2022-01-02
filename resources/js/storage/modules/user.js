import users from "../../requests/users";

export default {
    state: {
        user: null
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        }
    },
    actions: {
        setUser(ctx) {
            users.getAuthUser().then(response => {
                console.log(response);
                // ctx.commit('SET_USER', payload);
            });
        }
    },
    getters: {
        getUser(state) {
            return state.user;
        }
    }
}
