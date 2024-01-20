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
                    .then(({data: response}) => {
                        let list = response.data;
                        ctx.commit('SET_BOT_LIST', list);
                        resolve(list);
                    })
                    .catch((e) => {
                        reject(e);
                    });
            });
        },
        createBot(ctx, data) {
            return bot.create(data);
        },

        updateBot(ctx, data) {
            return bot.update(data.id, data.payload);
        }
    },
    getters: {
        getBotList(state) {
            return state.bots;
        }
    }
}
