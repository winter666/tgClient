import axios from 'axios';

const requests = {
    headers: {
        Authorization: localStorage.getItem('access_token')
    },

    get: (uri) => {
        let headers = requests.headers;
        return axios.get(process.env.MIX_APP_URL + '/' + uri, { headers });
    },

    post: (uri, data = {}) => {
        let headers = requests.headers;
        return axios.post(process.env.MIX_APP_URL + '/' + uri, data, { headers });
    },

    delete: (uri) => {
        let headers = requests.headers;
        return axios.delete(process.env.MIX_APP_URL + '/' + uri, { headers });
    },

    put: (uri, data = {}) => {
        let headers = requests.headers;
        return axios.put(process.env.MIX_APP_URL + '/' + uri, data, { headers });
    },

    patch: (uri, data = {}) => {
        let headers = requests.headers;
        return axios.patch(process.env.MIX_APP_URL + '/' + uri, data, { headers });
    }
};

export default requests;
