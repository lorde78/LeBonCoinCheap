// document.addEventListener("DOMContentLoaded", () => {
//     document.querySelector(".modal-button").addEventListener("click", function() {
//       document.querySelector(".modal-container").classList.add("fade-in");
//     })
//     document.querySelectorAll(".modal-exit").forEach((elem) => {
//       elem.addEventListener("click", () => {
//         document.querySelector(".modal-container").classList.remove("fade-in");
//       })
//     })
//   })

const mainImage = document.getElementById("main-image");
const images = document.querySelectorAll(".product__image");

images.forEach((image) => {
	image.addEventListener("click", (event) => {
		mainImage.src = event.target.src;

		document
			.querySelector(".product__image--active")
			.classList.remove("product__image--active");

		event.target.classList.add("product__image--active");
	});
});
