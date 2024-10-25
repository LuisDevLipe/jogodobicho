const acessibility_toggle = document.querySelector('.icon');
const acessibility_div = document.getElementById('acessibilidade');
acessibility_toggle.addEventListener('click', () => {
    acessibility_div.classList.toggle('opened');
});

const change_font = {
	increase: () => {
		const html = document.querySelector("html");
		const currentFontSize = parseFloat(window.getComputedStyle(html, null).getPropertyValue("font-size"));
		if (currentFontSize >= 32) return;
		const newFontSize = currentFontSize + 1;
		html.style.fontSize = `${newFontSize}px`;
		const lineHeigth = parseFloat(window.getComputedStyle(html, null).getPropertyValue("line-height"));
		const newLineHeight = newFontSize + newFontSize / 2;
		html.style.lineHeight = `${newLineHeight}px`;

		return {
			fontSize: newFontSize,
			lineHeight: newLineHeight,
		};
	},
	decrease: () => {
		const html = document.querySelector("html");
		const currentFontSize = parseFloat(window.getComputedStyle(html, null).getPropertyValue("font-size"));
		if (currentFontSize <= 16) return;
		const newFontSize = currentFontSize - 1;
		html.style.fontSize = `${newFontSize}px`;
		const lineHeigth = parseFloat(window.getComputedStyle(html, null).getPropertyValue("line-height"));
		const newLineHeight = newFontSize + newFontSize / 2;
		html.style.lineHeight = `${newLineHeight}px`;

		return {
			fontSize: newFontSize,
			lineHeight: newLineHeight,
		};
	},
};

function showFontSize(fontSize) {
	if (fontSize == 16) {
		document.getElementById("current-font-size").textContent = "padrão";
	} else {
		document.getElementById("current-font-size").textContent = fontSize + "px";
	}
}
document.getElementById("increase-font").addEventListener("click", (e) => {
	let font = change_font.increase();
	setCookie("font-size", font.fontSize, 24);
	setCookie("line-height", font.lineHeight, 24);
	document.getElementById("current-font-size").textContent = font.fontSize + "px";
	showFontSize(font.fontSize);
});
document.getElementById("decrease-font").addEventListener("click", () => {
	let font = change_font.decrease();
	setCookie("font-size", font.fontSize, 24);
	setCookie("line-height", font.lineHeight, 24);
	showFontSize(font.fontSize);
});

document.addEventListener("DOMContentLoaded", () => {
	const fontSize = getCookie("font-size") || 16;
	const lineHeight = getCookie("line-height") || 24;
	const html = document.querySelector("html");
	html.style.fontSize = `${fontSize}px`;
	html.style.lineHeight = `${lineHeight}px`;
	showFontSize(fontSize);
});

function getCookie(cookie) {
	let name = cookie + "=";
	let decodedCookie = decodeURIComponent(document.cookie);
	let ca = decodedCookie.split(";");
	for (let i = 0; i < ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) === " ") {
			c = c.substring(1);
		}
		if (c.indexOf(name) === 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}
function setCookie(cookie, value, expiresInHours) {
	let d = new Date();
	d.setTime(d.getTime() + expiresInHours * 60 * 60 * 1000);
	let expires = "expires=" + d.toUTCString();
	document.cookie = cookie + "=" + value + ";" + expires + ";path=/";
}

const change_theme = {
	default_dark: () => {
		document.querySelector("body").classList.remove("high-contrast");
		setCookie("theme", "default-dark", 24);
		return "Escuro Padão";
	},
	high_contrast: () => {
		document.querySelector("body").classList.add("high-contrast");
		setCookie("theme", "high-contrast", 24);
		document.querySelector("head").appendChild(high_constrast_stylesheet());
		return "Alto Contraste";
	},
};
document.getElementById("toggle-high-contrast").addEventListener("click", () => {
	let theme = change_theme.high_contrast();
	document.getElementById("current-theme").textContent = theme;
	window.location.reload();
});
document.getElementById("toggle-default-dark-theme").addEventListener("click", () => {
	let theme = change_theme.default_dark();
	document.getElementById("current-theme").textContent = theme;
	window.location.reload();
});

document.addEventListener("DOMContentLoaded", () => {
	let stylesheet = high_constrast_stylesheet();
	const theme = getCookie("theme") || "default-dark";
	if (theme === "high-contrast") {
		change_theme.high_contrast();
		document.getElementById("current-theme").textContent = "Alto Contraste";
		document.querySelector("head").appendChild(stylesheet);
	} else {
		change_theme.default_dark();
		document.getElementById("current-theme").textContent = "Escuro Padrão";
		document.querySelector("head").removeChild(stylesheet);
	}
});

function high_constrast_stylesheet() {
	let link = document.createElement("link");
	link.href = "/jogodobicho/public/css/high-contrast.css";
	link.rel = "stylesheet";
	link.type = "text/css";

	return link;
}