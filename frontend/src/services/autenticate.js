import "axios";
import axios from "axios";
import { toast } from "react-toast";

export default async function login(username, password) {
  const data = {
    username,
    password
  };

  const returnLogin = await axios.post("http://127.0.0.1:8000/login", data)
    .then(async function (result) {
      return await result.data;
    }).catch(async function (error) {
      return await error.response.data;
    })

  if (returnLogin.success === true) {
    toast.success(returnLogin.message)
  } else {
    toast.warn(returnLogin.message)
    return false;
  }
}
