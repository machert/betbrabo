import axios from 'axios'

const http = axios.create({
    baseURL: 'http://localhost:80/api/',
})

// instance.defaults.headers.common['Authorization'] = AUTH_TOKEN;
http.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token')

export default http