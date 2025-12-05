function validarCPF(CPF, el) {
	if (!checkIfHasErrors(CPF)) {
		return false;
	}
	const PESOS1 = ["10", "9", "8", "7", "6", "5", "4", "3", "2"];
	const PESOS2 = ["11", "10", "9", "8", "7", "6", "5", "4", "3", "2"];

	const digito1 = arrayCPF(CPF.slice(0, 9));
	const digito2 = arrayCPF(CPF.slice(0, 10));

	const digito1Verificado = calculoDigito(digito1, PESOS1);
	const digito2Verificado = calculoDigito(digito2, PESOS2);

	if (CPF.length == 11) {
		if (comparaDigitos(CPF, digito1Verificado, digito2Verificado)) {
			successStyle(el);
			return true;
		} else {
			jsToastMessage("CPF inválido", "error");
			errorStyle(el);
			return false;
		}
	}

	function arrayCPF(CPF) {
		let arrayCPF = [];
		for (let i = 0; i < CPF.length; i++) {
			arrayCPF.push(CPF[i]);
		}
		return arrayCPF;
	}

	function calculoDigito(CPF, PESOS) {
		const somatoria =
			CPF.map((num, i) => {
				return num * PESOS[i];
			}).reduce((acc, total) => acc + total) % 11;

		const resultado = 11 - somatoria;
		if (resultado > 9) return 0;
		else return resultado;
	}

	function comparaDigitos(Entrada, calculoDigito1, calculoDigito2) {
		if (Entrada[9] === calculoDigito1.toString()) {
			if (Entrada[10] === calculoDigito2.toString()) {
				return true;
			} else return false;
		} else return false;
	}

	function checkIfHasErrors(CPF) {
		// limpar o cpf
		CPF = CPF.replace(/\D/g, "");
		// verificar se o cpf nao e uma string vazia
		if (CPF === "") {
			jsToastMessage("CPF não pode ser vazio", "error");
			return false;
		}
		// verificar se o cpf contem somente numeros
		if (!CPF.match(/^[0-9]+$/)) {
			jsToastMessage("CPF deve conter apenas números", "error");
			return false;
		}

		if (CPF.length != 11) {
			jsToastMessage("CPF deve conter 11 dígitos", "error");
			return false;
		}
		// check if all numbers are the same
		if (CPF.split("").every((val, i, arr) => val === arr[0])) {
			jsToastMessage("CPF inválido", "error");
			return false;
		}
		return true;
	}
}

async function validarCEP(cep) {
	const [cepFIELD] = document.querySelector(".adress").children;
	if (cep.length == 8) {
		await fetch(`https://viacep.com.br/ws/${cep}/json/`, {
			method: "GET",
			mode: "cors",
			headers: {
				"Content-Type": "application/json",
			},
		})
			.then((response) => response.json())
			.then((CEP_FROM_API) => {
				if (CEP_FROM_API.erro) {
					cepFIELD.value = "";
					cepFIELD.focus();
					jsToastMessage("CEP inválido", "error");
				} else {
					const { logradouro, bairro, localidade, uf } = CEP_FROM_API;
					document.getElementsByName("logradouro")[0].value = logradouro;
					document.getElementsByName("bairro")[0].value = bairro;
					document.getElementsByName("cidade")[0].value = localidade;
					document.getElementsByName("estado")[0].value = uf;
				}
			})
			.catch((e) => {
				jsToastMessage("CEP inválido", "error");
				console.error(e);
			});
	}
}

function validarNome(el, minlength = 15, maxlength = 80) {
	if (el.value.length < minlength) {
		jsToastMessage("Nome muito curto, precisa ter no mínimo 15 letras.", "error");
		errorStyle(el);
	} else if (el.value.length > maxlength) {
		jsToastMessage("Nome muito longo, precisa ter no máximo 80 letras.", "error");
		errorStyle(el);
	} else {
		successStyle(el);
	}
}
function validarUsername(username, el, length = 6) {
	if (username.length !== length) {
		jsToastMessage("Username deve conter 6 caracteres", "error");
		errorStyle(el);
		return false;
	} else {
		successStyle(el);
		return true;
	}
}

function validarSenha(senha, el, length = 8) {
	if (senha.length !== length) {
		jsToastMessage(errorMessages.password, "error");
		errorStyle(el);
		return false;
	} else {
		successStyle(el);
		return true;
	}
}
function validarSenhaConfirmacao(confirmacao, el, senha = document.getElementById("password").value, length = 8) {
	if (senha !== confirmacao) {
		jsToastMessage(errorMessages.passwordConfirmation, "error");
		errorStyle(el);
		return false;
	}
	if (confirmacao.length !== length) {
		jsToastMessage(errorMessages.password, "error");
		errorStyle(el);
		return false;
	} else {
		successStyle(el);
		return true;
	}
}
// formatar no seguinte formato (+55)21-965762671
function formatarCelular(telefone, el) {
	// console.log(type);
	let formatted;
	// regex that matches the above string format;
	const regex = /^\(\+\d{2}\)\d{2}-\d{5}\d{4}$/;
	formatted = telefone.replace(/\D/g, "").replace(/^(\d{2})(\d{2})(\d{5})(\d{4})$/, "(+$1)$2-$3$4");
	if (!formatted.match(regex)) {
		return false;
	} else {
		el.value = formatted;
		return true;
	}
}
function formatarFixo(telefone, el) {
	let formatted;
	// regex that matches the above string format;
	const regex = /^\(\+\d{2}\)\d{2}-\d{8}$/;
	formatted = telefone.replace(/\D/g, "").replace(/^(\d{2})(\d{2})(\d{8})$/, "(+$1)$2-$3");
	if (!formatted.match(regex)) {
		return false;
	} else {
		el.value = formatted;
		return true;
	}
}
//validar no seguinte formato (+55)21-965762671
function validarTelefone(telefone, el, fixo = false) {
	if (!fixo) {
		if (!formatarCelular(telefone, el)) {
			jsToastMessage("Celular inválido", "error");
			errorStyle(el);
			return false;
		} else {
			successStyle(el);
			return true;
		}
	} else {
		if (!formatarFixo(telefone, el)) {
			jsToastMessage("Telefone inválido", "error");
			errorStyle(el);
			return false;
		} else {
			successStyle(el);
			return true;
		}
	}
}

function errorStyle(el) {
	el.focus();
	el.style.border = "1px solid red";
}
function successStyle(el) {
	el.style.border = "1px solid green";
}

function send_to_backend(route, data) {
	fetch(route, {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(data),
	});
}
