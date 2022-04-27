import { SESSION_CREATE, SESSION_DATA } from '../Types/Index'

export const createToken = (information) => ({
    type: SESSION_CREATE,
    information
})

export const sid = (information) => ({
    type: SESSION_DATA,
    information
})