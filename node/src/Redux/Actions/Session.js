import { SESSION_CREATE } from './../Types/Session'

export const createToken = (information) => ({
    type: SESSION_CREATE,
    information
})