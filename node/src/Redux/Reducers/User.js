import { USER_LIST } from "../Types/User";

const defaultUser = {
    rows: [],
}

const User = (state = defaultUser, action) => {
    const { type, information = defaultUser } = action
    switch (type) {
        case USER_LIST:
            return information;
        default:
            return state;
    }
}

export default User