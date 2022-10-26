import "./../styles/pages/Login.css"
import { toast } from 'react-toast'
import login from "../services/autenticate";

export default function Login() {
  const loginSubmit = async function (event) {
    event.preventDefault();

    const username = event.target.username.value;
    const password = event.target.password.value;

    if (username.trim() === "" || password.trim() === "") {
      toast.warn("Você precisa informar um usuário e senha!")
    }

    await login(username, password);
  }

  return (
    <form id="login-form" className="login-form" onSubmit={loginSubmit}>
      <label for="username">Usuario</label>
      <input id="username" name="username" required type="text" />
      <label for="password">Senha</label>
      <input id="password" name="password" required type="password" />
      <button type="submit">Entrar</button>
    </form>
  );
}
