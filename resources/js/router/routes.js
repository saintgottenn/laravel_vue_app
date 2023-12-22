import Home from "../src/components/Home.vue";
import Login from "../src/components/Auth/Login.vue";
import Register from "../src/components/Auth/Register.vue";
import Article from "../src/components/Articles/Article.vue";
import FrontLayout from "../src/components/frontCommon/FrontLayout.vue";

import AdminArticles from "../src/admin/Articles/Articles.vue";
import AdminArticleCreate from "../src/admin/Articles/ArticleCreate.vue";
import AdminArticleEdit from "../src/admin/Articles/ArticleEdit.vue";
import AdminDashboard from "../src/admin/Dashboard.vue";
import AdminLayout from "../src/admin/adminCommon/AdminLayout.vue";

import { guestGuard } from "./guestGuard";
import { adminGuard } from "./adminGuard";

const routes = [
  {
    path: "/",
    component: FrontLayout,
    meta: { currentRoutes: "front" },
    children: [
      {
        path: "",
        component: Home,
        name: "home",
      },
      {
        path: "/articles",
        name: "articles",
        children: [
          {
            path: ":articleId/show",
            name: "articles.show",
            component: Article,
            props: true,
          },
        ],
      },
      {
        path: "login",
        component: Login,
        name: "login",
        beforeEnter: guestGuard,
      },
      {
        path: "register",
        component: Register,
        name: "register",
        beforeEnter: guestGuard,
      },
    ],
  },
  {
    path: "/admin",
    component: AdminLayout,
    meta: { currentRoutes: "admin" },
    beforeEnter: adminGuard,
    children: [
      {
        path: "",
        component: AdminDashboard,
        name: "admin.dashboard",
      },
      {
        path: "articles",
        children: [
          {
            path: "",
            component: AdminArticles,
            name: "admin.articles",
          },
          {
            path: "create",
            component: AdminArticleCreate,
            name: "admin.articles.create",
          },
          {
            path: ":articleId/edit",
            component: AdminArticleEdit,
            name: "admin.articles.edit",
            props: true,
          },
        ],
      },
    ],
  },
];

export default routes;
