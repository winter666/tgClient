import axios from 'axios';

const api_requests = {
    headers: {
        Authorization: localStorage.getItem('access_token')
    },

    get: (uri) => {
        let headers = api_requests.headers;
        return axios.get(process.env.MIX_APP_URL + '/api/' + uri, { headers });
    },

    post: (uri, data = {}) => {
        let headers = api_requests.headers;
        return axios.post(process.env.MIX_APP_URL + '/api/' + uri, data, { headers });
    },

    delete: (uri) => {
        let headers = api_requests.headers;
        return axios.delete(process.env.MIX_APP_URL + '/api/' + uri, { headers });
    },

    put: (uri, data = {}) => {
        let headers = api_requests.headers;
        return axios.post(process.env.MIX_APP_URL + '/api/' + uri, data, { headers });
    },

    patch: (uri, data = {}) => {
        let headers = api_requests.headers;
        return axios.post(process.env.MIX_APP_URL + '/api/' + uri, data, { headers });
    }
}

export default api_requests;
