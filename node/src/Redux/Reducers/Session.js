import { SESSION_CREATE } from "../Types/Session";

const defaultSession = {
    accessIp: '',
    accessBrowser: '',
}

const Session = (state = defaultSession, action) => {
    const { type, information = defaultSession } = action
    switch (type) {
        case SESSION_CREATE:
            console.log(information)
            return information;
        default:
            return state;
    }
}

export default Session