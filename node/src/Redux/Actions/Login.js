import { LOGIN_POST } from "../Types/Login"

export const login = (information) => ({
    type: LOGIN_POST,
    information
})