export default {
    state: {
        isOpen: true
    },
    mutations: {
        TOGGLE(state, isOpen) {
            state.isOpen = isOpen;
        }
    },
    actions: {
        toggleSidebarAction(ctx, val) {
            ctx.commit('TOGGLE', val);
        }
    },
    getters: {
        getSidebarState(state) {
            return state.isOpen
        }
    }
}
