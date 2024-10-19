const errorMessages = {
	required: "This field is required",
	email: "Please enter a valid email address",
	password: "Senha deve conter 8 caracteres, e conter apenas letras",
	passwordConfirmation: "Senhas não conferem",
	username: "Nome de usuário deve conter 6 caracteres, e conter apenas letras e números",
  nome: "Nome deve conter pelo menos 15 caracteres, e no máximo 80 caracteres",
	shortname: "Name must be at least 15 characters long",
	longname: "Name must be at most 80 characters long",
	cpf: "Este número de cpf parece inválido.",
	auth: "Usuário ou senha inválidos",
	auth2fa: "Código de autenticação inválido,tente novamente.",
	locked: "Sua conta foi bloqueada por exceder o número máximo de tentativas de login.Volte para a tela de login.",
	userExists: "Este CPF já está sendo utilizado",
	usernameExists: "Este nome de usuário já está sendo utilizado",
	termos: "Você precisa aceitar os termos de uso",
	userNotFound: "Usuário não encontrado",
	emailNoMatch: "Email não confere com usuário",
	passwordReset: "Erro ao redefinir senha",
	deleteSelf: "Você não pode deletar sua própria conta",
	delete: "Erro ao deletar conta",
};

const successMessages = {
  auth: "Login efetuado com sucesso",
  register: "Cadastro efetuado com sucesso",
  logout: "Logout efetuado com sucesso",
  passwordReset: "Senha redefinida com sucesso",
  delete: "Conta deletada com sucesso",
};

// get the query string from the url consisting of the error key
//

let url = new URL(window.location.href);
let errorKey = url.searchParams.get("error");
let successKey = url.searchParams.get("success");

function createToast(errormessage, errorType = "error") {
	const toast = document.createElement("div");
	toast.classList.add("toast");
	const textwrapper = document.createElement("div");
	textwrapper.classList.add("textwrapper");
	textwrapper.classList.add("textwrapper");
	toast.appendChild(textwrapper);
	const message = document.createElement("p");
	message.textContent = errormessage;
	textwrapper.appendChild(message);
	const timer = document.createElement("div");
	timer.classList.add("timer");
	timer.setAttribute("name", "timer");
	toast.appendChild(timer);
	document.body.appendChild(toast);
	if (errorType === "error") {
		toast.classList.add("error");
		timer.classList.add("error");
	} else {
		toast.classList.add("success");
		timer.classList.add("success");
		// if(toast.classList.contains(''))
	}

	return {
		toast,
		timer: toast.querySelector("[name=timer]"),
	};
}
// checar se o erro existe
// se existir, pegar a mensagem de erro
// criar um toast com a mensagem de erro
// se não existir, não fazer nada
// run the code bellow as IIFE
// IIFE - Immediately Invoked Function Expression
(() => {
	document.addEventListener("DOMContentLoaded", () => {
		toastMessage();
	});
})();
const TOAST_DURATION = 7000;
//function to show toast based on the uri query string sent back from the server
function toastMessage() {
	const toast = errorKey
		? createToast(errorMessages[errorKey], "error")
		: createToast(successMessages[successKey], "success");
	if (errorKey || successKey) {
		showToast(toast.toast);
		startTimer(toast.timer);
		setTimeout(() => {
			removeToast(toast.toast);
			// stopTimer(toast.timer);
		}, TOAST_DURATION);
	}
}
// function to show toast based on the error message from the js validation

function jsToastMessage(errormessage, messageType = "error") {
	let toast = {};
	if (messageType === "success") {
		toast = createToast(errormessage, "success");
	} else {
		toast = createToast(errormessage, "error");
	}
	if (errormessage !== "") {
		showToast(toast.toast);
		startTimer(toast.timer);
		setTimeout(() => {
			removeToast(toast.toast);
			// stopTimer(toast.timer); does nothing
		}, TOAST_DURATION);
	}
}

// bring the toast from outssde the screen to the screen
function showToast(toast) {
  if (toast.classList.contains("stop")) {
    toast.classList.replace("stop", "playing");
  } else {
    toast.classList.add("playing");
  }
}
function removeToast(toast) {
  if (toast.classList.contains("playing")) {
    toast.classList.replace("playing", "stop");
  } else {
    toast.classList.add("stop");
  }
}

function startTimer(timer) {
  if (timer.classList.contains("stop")) {
    timer.classList.replace("stop", "playing");
  } else {
    timer.classList.add("playing");
  }
}
function stopTimer(timer) {
  if (timer.classList.contains("stop")) {
    timer.classList.replace("playing", "stop");
  }
  timer.classList.add("stop");
}
