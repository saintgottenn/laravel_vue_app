<template>
  <FormTemplate>
    <template #title>
      <h2 class="text-center text-2xl font-bold">Регистрация</h2>
    </template>

    <template #fields>
      <input
        type="text"
        v-model="name"
        placeholder="Имя"
        class="border p-2 rounded"
      />
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
      <input
        type="password"
        v-model="passwordConfirmation"
        placeholder="Подтвердите пароль"
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
        @click="submitRegistration"
        class="bg-blue-500 text-white py-2 rounded hover:bg-blue-700"
      >
        Зарегистрироваться
      </button>
    </template>
  </FormTemplate>
</template>

<script>
import FormTemplate from "../../common/FormTemplate.vue";
import { mapActions } from "vuex";

export default {
  name: "Register",
  components: {
    FormTemplate,
  },
  data() {
    return {
      name: "",
      email: "",
      password: "",
      passwordConfirmation: "",
      errors: "",
    };
  },
  methods: {
    ...mapActions(["setUser", "setAuthToken"]),

    async submitRegistration() {
      this.errors = null;

      axios
        .post("/api/register", {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.passwordConfirmation,
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
