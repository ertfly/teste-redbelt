import { USER_LIST } from "../Types/User"

export const listUser = (information) => ({
    type: USER_LIST,
    information
})