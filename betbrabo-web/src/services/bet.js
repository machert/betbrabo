import http from '@/services/config'
  
const bet = { 
    
    getByUsersId : () => {
        return http.get('bets/listByUsersId')
    },

    put: (data) => {
        const id = data.id;
        const params = {
            'name' : data.name,
            'users_id': data.users_id,
            'date_start': data.date_start,


        }
        return http.put('bets/'+ id, params)
    }
} 

export default bet