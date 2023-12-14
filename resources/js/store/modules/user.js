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
            return new Promise((resolve, reject) => {
                users.getAuthUser()
                    .then(({data}) => {
                        ctx.commit('SET_USER', data);
                        resolve(data);
                    })
                    .catch((e) => {
                        reject(e);
                    });
            });
        }
    },
    getters: {
        getUser(state) {
            return state.user;
        }
    }
}
