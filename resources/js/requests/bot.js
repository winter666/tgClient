import api_requests from "./api_request";

export default {
    getBots() {
        return api_requests.get('bot/list');
    },

    get(id) {
       return api_requests.get(`bot/${id}`);
    },

    create(data) {
        return api_requests.post('bot/store', data);
    },

    update(id, data) {
        return api_requests.patch(`bot/${id}`, data);
    },

    delete(id) {
        return api_requests.delete(`bot/${id}`);
    }
}
