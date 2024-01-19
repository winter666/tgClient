import requests from './request';

const api_requests = {
    get: (uri) => {
        return requests.get('api/' + uri);
    },

    post: (uri, data = {}) => {
        return requests.post('api/' + uri, data);
    },

    delete: (uri) => {
        return requests.delete('api/' + uri);
    },

    put: (uri, data = {}) => {
        return requests.post('api/' + uri, data);
    },

    patch: (uri, data = {}) => {
        return requests.post('api/' + uri, data);
    }
}

export default api_requests;
