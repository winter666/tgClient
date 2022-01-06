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
                let user = response.data.attachments.user;
                ctx.commit('SET_USER', user);
            });
        }
    },
    getters: {
        getUser(state) {
            return state.user;
        }
    }
}
