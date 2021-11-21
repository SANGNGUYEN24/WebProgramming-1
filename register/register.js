let input = document.getElementsByClassName("input");
let index = -1;
let InputWrapper = document.getElementsByClassName("InputWrapper");

for (let i = 0; i < input.length; i++) {
  input[i].addEventListener("focus", () => {
    if (index != -1)
      InputWrapper[index].style.borderColor = "rgba(200,200,200,1)";
    InputWrapper[i].style.borderColor = "#23d9a2";
    index = i;
  });
}

window.addEventListener("click", (event) => {
  console.log(event.target);
  if (event.target.className != "input" && index != -1) {
    InputWrapper[index].style.borderColor = "rgba(200,200,200,1)";
    index = -1;
  }
});
