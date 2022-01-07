import api_requests from "./api_request";

export default {
    getBots() {
        return api_requests.get('bot/get');
    },

    create(data) {
        return api_requests.post('bot/create', data);
    }
}
