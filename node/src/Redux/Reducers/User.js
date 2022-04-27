import { USER_POST } from "../Types/User";

const defaultUser = {
    name: '',
}

const User = (state = defaultUser, action) => {
    const { type, information = defaultUser } = action
    switch (type) {
        case USER_POST:
            return information;
        default:
            return state;
    }
}

export default User