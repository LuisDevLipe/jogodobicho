function validarCPF(CPF) {
    if(CPF.length != 11) return false
    const mensagem = {
        erro: "CPF inválido",
        sucesso: "CPF válido",
      }
    const PESOS1 = ["10", "9", "8", "7", "6", "5", "4", "3", "2"]
    const PESOS2 = ["11", "10", "9", "8", "7", "6", "5", "4", "3", "2"]

    const digito1 = arrayCPF(CPF.slice(0, 9))
    const digito2 = arrayCPF(CPF.slice(0, 10))

    const digito1Verificado = calculoDigito(digito1, PESOS1)
    const digito2Verificado = calculoDigito(digito2, PESOS2)

    if (CPF.length == 11) {

        if (comparaDigitos(CPF, digito1Verificado, digito2Verificado)) {
            return true
        } else {
            alert(mensagem.erro)
            return false
        }
    }
    

    function arrayCPF(CPF) {
        let arrayCPF = []
        for (let i = 0; i < CPF.length; i++) {
            arrayCPF.push(CPF[i])
        }
        return arrayCPF
    }

    function calculoDigito(CPF, PESOS) {
        const somatoria =
          CPF.map((num, i) => {
            return num * PESOS[i]
          }).reduce((acc, total) => acc + total) % 11
      
        const resultado = 11 - somatoria
        if (resultado > 9) return 0
        else return resultado
      }

      function comparaDigitos(Entrada, calculoDigito1, calculoDigito2) {
        if (Entrada[9] === calculoDigito1.toString()) {
          if (Entrada[10] === calculoDigito2.toString()) {
            return true
          } else return false
        } else return false
      }

      
}

async function validarCEP(cep){
    const [cepFIELD] = document.querySelector('.adress').children
    if(cep.length == 8) {
        await fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(res => res.json())
        .then(CEP_FROM_API => {
            console.log(cepFIELD.value)
        })
        .catch(console.error)
    }
}