document.addEventListener('DOMContentLoaded', () => {
  const cep = document.querySelector("input[name=cep]");

  cep.addEventListener('blur', e => {
      const value = cep.value.replace(/[^0-9]+/g, ''); 
      const url = `https://viacep.com.br/ws/${value}/json/`;

      fetch(url)
          .then(response => {
              if (!response.ok) {
                  throw new Error('Network response was not ok');
              }
              return response.json();
          })
          .then(json => {
              if (!json.erro) {
                  document.querySelector('input[name=endereco]').value = json.logradouro || '';
                  document.querySelector('input[name=bairro]').value = json.bairro || '';
                  document.querySelector('input[name=cidade]').value = json.localidade || '';

                  console.log(json.bairro, json.localidade, json.logradouro)
              } else {
                  console.error('CEP not found');
              }
          })
          .catch(error => {
              console.error('Fetch error:', error);
          });
  });
});
