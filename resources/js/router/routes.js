import Home from "../src/components/Home.vue";
import Article from "../src/components/Articles/Article.vue";
import Admin from "../src/components/Admin/Admin.vue";
import Login from "../src/components/Auth/Login.vue";
import Register from "../src/components/Auth/Register.vue";

import { guestGuard } from "./guestGuard";

const routes = [
  { path: "/", component: Home, name: "home" },
  { path: "/article", component: Article, name: "article" },
  { path: "/admin", component: Admin, name: "admin" },
  { path: "/login", component: Login, name: "login", beforeEnter: guestGuard },
  {
    path: "/register",
    component: Register,
    name: "register",
    beforeEnter: guestGuard,
  },
];

export default routes;
