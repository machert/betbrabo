import http from './config'

export const login = (email, password) => {
    try{
        const params = {
            'email' : email,
            'password' : password,
        }
        return http.post('login', params)
    }catch(error){
        return error
    }
}