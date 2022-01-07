import bot from "../../requests/bot";

export default {
    state: {
        bots: []
    },
    mutations: {
        SET_BOT_LIST(state, list) {
            state.bots = list;
        }
    },
    actions: {
        setBotList(ctx) {
            return new Promise((resolve, reject) => {
                bot.getBots()
                    .then(response => {
                        let list = response.data.list;
                        ctx.commit('SET_BOT_LIST', list);
                        resolve(list);
                    })
                    .catch((e) => {
                        reject(e);
                    });
            });
        }
    },
    getters: {
        getBotList(state) {
            return state.bots;
        }
    }
}
