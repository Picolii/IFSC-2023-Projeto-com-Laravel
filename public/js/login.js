var btnSignin = document.querySelector("#signin");
var btnSignup = document.querySelector("#signup");

var body = document.querySelector("body");

btnSignin.addEventListener("click", function () {
  body.className = "sign-in-js";
});

btnSignup.addEventListener("click", function () {
  body.className = "sign-up-js";
});

const Accounts = JSON.parse(window.localStorage.getItem("@BomLook:users")) ?? [
  {
    id: 1,
    email: "cliente@gmail.com",
    password: "123",
  },
  {
    id: 2,
    email: "admin@gmail.com",
    password: "123",
  },
];

function SignIn(iEmail, iPass) {
  const Login = Accounts.filter((account) => account.email === iEmail).map(
    (account) => (account.password === iPass ? true : false)
  );
  Login.length > 0
    ? Login[0]
      ? iEmail === "admin@gmail.com"
        ? (window.location.href = "indexadm.html")
        : (window.location.href = "indexcliente.html")
      : activeSnackbar("Dados Inválidos")
    : activeSnackbar("Email não Cadastrado");
}

function SignUp(iEmail, iPass) {
  const accounts = Accounts.filter((object) => object.email === iEmail);
  if (accounts.length > 0) {
    activeSnackbar("Email já Cadastrado");
    return;
  }

  const data = {
    id: Accounts.length + 1,
    email: iEmail,
    password: iPass,
  };

  Accounts.push(data);
  console.log(Accounts);
  window.localStorage.setItem("@BomLook:users", JSON.stringify(Accounts));

  SignIn(iEmail, iPass);
}

function handleSubmit(e, type) {
  e.preventDefault();
  const iEmail = document.getElementById(
    type === "signup" ? "signup-email" : "signin-email"
  ).value;
  const iPass = document.getElementById(
    type === "signup" ? "signup-password" : "signin-password"
  ).value;

  if (type == "signup") SignUp(iEmail, iPass);
  if (type == "signin") SignIn(iEmail, iPass);
}
