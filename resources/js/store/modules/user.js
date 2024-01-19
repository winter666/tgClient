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
                    .then(({data: response}) => {
                        let user = response.data;

                        ctx.commit('SET_USER', user);
                        resolve(user);
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
