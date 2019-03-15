export default {
  state: {
    userLogs: [],
    user: {},
    form: {},
    icon: {},
    messages: null,
    errors: [],
    submitLoading: false,
    router: null,
  },

  mutations: {
    setUserLogs(state, userLogs) {
      state.userLogs = userLogs;
    },
    setUser(state, user) {
      state.user = user;
    },
    setForm(state, form) {
      state.form = form;
    },
    setIcon(state, icon) {
      state.icon = icon;
    },
    setMessages(state, messages) {
      state.messages = messages;
    },
    setErrors(state, errors) {
      state.errors = errors;
    },
    setSubmitLoading(state, submitLoading) {
      state.submitLoading = submitLoading;
    },
    setRouter(state, router) {
      state.router = router;
    },
  },

  actions: {
    getUserLogs({ commit }) {
      const url = '/api/user_logs';
      axios.get(url)
        .then(response => {
          commit('setUserLogs', response.data.user_logs);
        })
        .catch(error => {
          console.log(error);
        });
    },
    moveNew({ state }) {
      state.router.push('/new');
    },
    initUser({ commit }) {
      commit('setUser', laravel.user);
    },
    initEdit({ commit }) {
      commit('setForm', {});
      commit('setErrors', {});
    },
    saveUserLog({ state, commit }) {
      commit('setSubmitLoading', true);

      const url = '/api/user_logs';
      const data = state.form;

      axios.post(url, data)
        .then(() => {
          commit('setForm', {});
          commit('setErrors', {});
          commit('setSubmitLoading', false);
          state.router.push('/home');
        })
        .catch(error => {
          commit('setErrors', error.response.data.errors);
          commit('setSubmitLoading', false);
          console.log(error);
        });
    },
    initSettings({ state, commit }) {
      commit('setErrors', {});

      const url = '/api/settings';
      axios.get(url)
        .then(response => {
          commit('setUser', response.data.user);
          commit('setForm', response.data.user);
        })
        .catch(error => {
          console.log(error);
        });
    },
    saveSettings({ state, commit }) {
      commit('setSubmitLoading', true);

      const url = '/api/settings';
      let data = state.form;
      if (state.icon) {
        data.new_icon = state.icon.path;
      }

      axios.patch(url, data)
        .then(response => {
          commit('setErrors', {});
          commit('setUser', response.data.user);
          commit('setForm', response.data.user);
          commit('setMessages', ['Updated']);
          setTimeout(() => {
            commit('setMessages', null);
          }, 2000);
          commit('setSubmitLoading', false);
        })
        .catch(error => {
          commit('setErrors', error.response.data.errors);
          commit('setSubmitLoading', false);
          console.log(error);
        });
    },
    uploadIcon({ commit }, file) {
      commit('setSubmitLoading', true);

      const url = '/api/upload_icon';
      let data = new FormData;
      data.append('icon', file);

      axios.post(url, data)
        .then(response => {
          commit('setIcon', response.data.icon);
          commit('setErrors', {});
          commit('setSubmitLoading', false);
        })
        .catch(error => {
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