import axios from 'axios'

axios.default.baseURL = 'http://localhost:80/api/'
axios.default.headers.commom['Authorization'] = 'Bearer ' + localStorage.getItem('token')