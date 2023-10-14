const cookie = {
    set : (name, value, expireMinutes = 60) => {
        const date = new Date();
        date.setTime(date.getTime() + (expireMinutes * 60 * 1000));
    
        const expires = `expires=${date.toUTCString()}`;
        // const cookieString = `${name}=${value}; ${expires}; path=/; HttpOnly`;
        const cookieString = `${name}=${value}; ${expires}; path=/`;
        document.cookie = cookieString;
    },
    
    get : (name) => {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            if (cookie.startsWith(`${name}=`)) {
                return cookie.substring(name.length + 1);
            }
        }
        return null; // Retorna null se o cookie não for encontrado
    },
    
    validateToken : () => {
        return cookie.get('token') ? true : false;
    },
    
    validateCookie : (name) => {
        return cookie.get(name) ? true : false;
    },

    reset : () => {
        document.cookie = '';
    },
}

export default cookie