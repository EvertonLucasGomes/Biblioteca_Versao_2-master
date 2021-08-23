function popularCidades() {
    const cidadeSelect = document.querySelector("select[name=cidadeCliente]")

    fetch("https://servicodados.ibge.gov.br/api/v1/localidades/estados/pe/municipios")
    .then(response => response.json())
    .then(cidades => {
        for(cidade of cidades) {
            cidadeSelect.innerHTML += `<option value="${cidade.nome}">${cidade.nome}</option>`
        }
    })
}

popularCidades();

function liberar() {
    const bairro = document.querySelector("input[name=bairroCliente]")

    bairro.disabled = false;
    bairro.style.backgroundColor = "#fff";
}

document
.querySelector("select[name=cidadeCliente]")
.addEventListener("change", liberar)