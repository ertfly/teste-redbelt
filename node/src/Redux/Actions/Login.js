import { LOGIN_POST } from "../Types/Login"

export const postLogin = (information) => ({
    type: LOGIN_POST,
    information
})