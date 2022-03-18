import {createStore} from "vuex";
import axiosClient from "../axios";

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem("TOKEN")
        },
        eth_info: {}
    },
    getters: {},
    actions: {
        async register({ commit }, user) {
            const res = await axiosClient.post('/register', user);
            commit('setUser', res.data);
        },
        async login({ commit }, user) {
            const res = await axiosClient.post('/login', user);
            commit('setUser', res.data);
        },
        async logout({ commit }) {
            const res = await axiosClient.post('/logout');
            commit('logout');
        },
        async eth_wallet_info({ commit }, wallet) {
            const res = await axiosClient.post('/ethereum/wallet/data', wallet);
            console.log(res.data.response);
            commit('setEthWalletInfo', res.data.response);
        }
    },
    mutations: {
        logout: (state) => {
            state.user.data = {};
            state.user.token = null;
            sessionStorage.clear();
        },
        setUser: (state, userData) => {
            state.user.token = userData.token;
            state.user.data = userData.user;
            sessionStorage.setItem('TOKEN', userData.token);
        },
        setEthWalletInfo: (state, data) => {
            state.eth_info = data;
        }
    },
    modules: {}
});

export default store;