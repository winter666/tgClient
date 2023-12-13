import api_requests from "./api_request";

export default {
    getBots() {
        return api_requests.get('bot/list');
    },

    create(data) {
        return api_requests.post('bot/store', data);
    }
}
