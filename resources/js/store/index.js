import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";

const store = createStore({
  plugins: [
    createPersistedState({
      key: "appdata",
      storage: window.localStorage,
      paths: ["user", "authToken"],
    }),
  ],
  state: {
    user: null,
    authToken: null,
  },
  mutations: {
    SET_USER(state, user) {
      state.user = user;
    },

    SET_AUTH_TOKEN(state, token) {
      state.authToken = token;
    },
  },
  actions: {
    async logout({ commit }, { router }) {
      await axios.post("/api/logout");

      commit("SET_USER", null);
      commit("SET_AUTH_TOKEN", null);

      delete axios.defaults.headers.common["Authorization"];

      router.push({ name: "home" });
    },

    setUser({ commit }, creds) {
      commit("SET_USER", creds);
    },

    setAuthToken({ commit }, creds) {
      commit("SET_AUTH_TOKEN", creds);
      console.log(creds);
      axios.defaults.headers.common["Authorization"] = `Bearer ${creds}`;
    },
  },
  getters: {
    user: (state) => state.user,
  },
});

export default store;
