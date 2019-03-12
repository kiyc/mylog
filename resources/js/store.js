export default {
  state: {
    user: {},
    form: {},
    errors: [],
    submitLoading: false,
    router: null,
  },

  mutations: {
    setUser (state, user) {
      state.user = user;
    },
    setForm (state, form) {
      state.form = form;
    },
    setErrors (state, errors) {
      state.errors = errors;
    },
    setSubmitLoading (state, submitLoading) {
      state.submitLoading = submitLoading;
    },
    setRouter (state, router) {
      state.router = router;
    },
  },

  actions: {
    initUser ({ commit }) {
      commit('setUser', laravel.user);
    },
    initEdit ({ commit }) {
      commit('setForm', {});
      commit('setErrors', {});
    },
    saveUserLog ({ state, commit }) {
      commit('setSubmitLoading', true);

      const url = '/api/user_logs';
      const data = state.form;

      axios.post(url, data)
        .then( () => {
          commit('setForm', {});
          commit('setErrors', {});
          commit('setSubmitLoading', false);
          state.router.push('/home');
        })
        .catch( error => {
          commit('setErrors', error.response.data.errors);
          commit('setSubmitLoading', false);
          console.log(error);
        });
    },
  },

  getters: {
  },

  modules: {
  }
}