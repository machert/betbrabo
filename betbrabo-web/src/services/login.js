import http from './config'

export const login = (email, password) => {
    const params = {
        'email' : email,
        'password' : password,
    }
    return http.post('login', params)
}