import api_requests from "./api_request";
import requests from "./request";

export default {
    getUser(id) {
        return api_requests.get('user/' + id);
    },

    getAuthUser() {
        return api_requests.get('user/auth');
    },

    logout() {
        return requests.post('logout');
    },

    update(id, data) {
        return api_requests.patch(`user/${id}/update`, data);
    }
}
