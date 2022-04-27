import { USER_LIST } from '../Types/Index'

export const listUser = () => ({
    type: USER_LIST
})

export const setListUser = (information) => ({
    type: USER_LIST,
    information
})