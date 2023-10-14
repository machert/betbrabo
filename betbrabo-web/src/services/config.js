import axios from 'axios'
import cookie from './cookie'

const http = axios.create({
    baseURL: 'http://localhost:8000/api/',
})

http.interceptors.request.use((config) => {
    const token = cookie.get('token');
    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
});

export default http