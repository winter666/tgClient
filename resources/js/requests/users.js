import api_requests from "./api_request";

export default {
    getUser(id) {
        return api_requests.get('user/' + id);
    },

    getAuthUser() {
        return api_requests.get('user/auth');
    }
}
