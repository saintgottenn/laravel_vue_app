<template>
  <FormTemplate>
    <template #title>
      <h2 class="text-center text-2xl font-bold">Вход</h2>
    </template>

    <template #fields>
      <input
        type="email"
        v-model="email"
        placeholder="Email"
        class="border p-2 rounded"
      />
      <input
        type="password"
        v-model="password"
        placeholder="Пароль"
        class="border p-2 rounded"
      />
    </template>
    <template #errors>
      <div v-if="errors" class="mt-3 text-red-600">
        <ul>
          <li v-for="(errorMessages, field) in errors" :key="field">
            <ul>
              <li v-for="message in errorMessages" :key="message">
                {{ message }}
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </template>

    <template #actions>
      <button
        @click="submitLogin"
        class="bg-blue-500 text-white py-2 rounded hover:bg-blue-700"
      >
        Войти
      </button>
    </template>
  </FormTemplate>
</template>

<script>
import FormTemplate from "../common/FormTemplate.vue";
import { mapActions } from "vuex";

export default {
  name: "LoginForm",
  components: {
    FormTemplate,
  },
  data() {
    return {
      email: "",
      password: "",
      errors: "",
    };
  },
  methods: {
    ...mapActions(["setUser", "setAuthToken"]),

    async submitLogin() {
      this.errors = null;

      axios
        .post("/api/login", {
          email: this.email,
          password: this.password,
        })
        .then((resp) => {
          this.setUser(resp.data.user);
          this.setAuthToken(resp.data.token);

          this.$router.push({ name: "home" });
        })

        .catch((error) => {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
  },
};
</script>
<style scoped></style>
