const slider = document.querySelector(".slider");
const sliderValue = document.querySelector("#slider-value");

slider.addEventListener("change", (e) => {
  const percent = parseFloat(e.target.value);
  const value = (percent / 100) * 329;

  sliderValue.innerHTML = `R$ ${value.toFixed(2)}`
});