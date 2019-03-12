export default {
  state: {
    user: {},
  },

  mutations: {
    setUser (state, user) {
      state.user = user;
    },
  },

  actions: {
    initUser ({ commit }) {
      commit('setUser', laravel.user);
    },
  },

  getters: {
  },

  modules: {
  }
}