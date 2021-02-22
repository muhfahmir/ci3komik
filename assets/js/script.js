$(document).ready(function () {
	let navLink = document.querySelectorAll(".navbar-nav .nav-item .nav-link");
	navLink.forEach((link) => {
		link.addEventListener("click", function () {
			if (link.innerHTML == "All Komik") {
				var xhr = new XMLHttpRequest();
				xhr.onload = function () {
					document.location = "comic";
				};
				xhr.open("GET", "comic/unsetKeyword", true);
				xhr.send();
			}
		});
	});
});
