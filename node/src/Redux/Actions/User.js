import { USER_POST } from "../Types/User"

export const createUser = (information) => ({
    type: USER_POST,
    information
})