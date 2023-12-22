export async function adminGuard(to, from, next) {
  let isAuthenticated = false;

  await axios
    .get("/api/user-roles")
    .then((resp) => {
      console.log(resp.data.includes("admin"));
      isAuthenticated = resp.data.includes("admin");
    })
    .catch((error) => console.error(error));

  if (isAuthenticated) {
    next();
  } else {
    next("/");
  }
}
