
const formatter = {
    formatValue : (value, type) => {
        let final_value = null;
        if (typeof value === 'string') {
            const timestamp = Date.parse(value);
            if (!isNaN(timestamp)) {
                // Se o valor for uma data válida, retorna a data formatada
                const date = new Date(timestamp);
                final_value = date.toLocaleDateString('pt-BR');
            }
            // Se não for uma data válida, retorna a string em caixa alta
            final_value = value;

        } else if (typeof value === 'number') {
            final_value = value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        } else if (typeof value === 'boolean') {
            final_value =  value ? 'Sim' : 'Não';
        }else{
            final_value = value;
        }

        return final_value;
    }
}

export default formatter;