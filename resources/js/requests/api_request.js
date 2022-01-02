import axios from 'axios';

const api_requests = {
    headers: {
        Authorization: localStorage.getItem('access_token')
    },

    get: (uri) => {
        let headers = this.headers;
        return axios.get('http://telegram-bot.manager/api/' + uri, { headers });
    },

    post: (uri, data = {}) => {
        let headers = this.headers;
        return axios.post('http://telegram-bot.manager/api/' + uri, data, { headers });
    },

    delete: (uri) => {
        let headers = this.headers;
        return axios.delete('http://telegram-bot.manager/api/' + uri, { headers });
    },

    put: (uri, data = {}) => {
        let headers = this.headers;
        return axios.post('http://telegram-bot.manager/api/' + uri, data, { headers });
    },

    patch: (uri, data = {}) => {
        let headers = this.headers;
        return axios.post('http://telegram-bot.manager/api/' + uri, data, { headers });
    }

}

export default api_requests;
