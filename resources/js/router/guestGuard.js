import store from "@/store";

export function guestGuard(to, from, next) {
  const isAuthenticated = !!store.state.user;

  if (isAuthenticated) {
    next("/");
  } else {
    next();
  }
}
