const modalwrapper = document.querySelector(".modalwrapper");
const pop = document.querySelector(".pop");

function openPop() {
  pop.classList.add("active");
  modalwrapper.style.display = "block";
  modalwrapper.addEventListener("click", closePop);
}

function closePop() {
  pop.classList.remove("active");
  modalwrapper.style.display = "none";
  modalwrapper.removeEventListener("click", closePop);
}
