//Máscara CEP | 00000-000

const mascaraCep = (event) => {
    let input = event.target;
    input.value = cepMask(input.value);
}

const cepMask = (value) => {
    if (!value) return "";
    value = value.replace(/\D/g, '');
    value = value.replace(/(\d{5})(\d)/, '$1-$2');
    return value;
}


//Máscara pro telefone | +55 (00) 00000-000
const mascaraTelefone = (event) => {
    let input = event.target;
    input.value = telMask(input.value);
};

const telMask = (value) => {
    if (!value) return "+55 ";
    value = value.replace(/\D/g, ''); 
    value = value.replace(/^55/, ''); 
    value = value.replace(/(\d{2})(\d)/, "($1) $2"); 
    value = value.replace(/(\d{5})(\d)/, "$1-$2"); 
    return "+55 " + value; 
}


