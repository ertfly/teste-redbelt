import { createToken } from "../Actions/Session";

export const postToken = () => {
    dispatch(createToken({ accessIp: '', accessBrowser: '' }))
}