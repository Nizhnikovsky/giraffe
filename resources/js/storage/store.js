const store = {
    state: {
        logined:false,
        username:''
    },

    mutations: {
        SET_LOGIN_STATUS: (state, atr) => {
            state.logined = atr
        },
        SET_USERNAME: (state, atr) => {
            state.username = atr
        },
    },
    actions: {
        set_login_status({commit}, state) {
            commit('SET_LOGIN_STATUS', state)
        },
        set_username({commit}, state) {
            commit('SET_USERNAME', state)
        },
    }
};

export default store
