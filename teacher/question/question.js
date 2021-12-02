let createBtn = document.querySelector(".create-btn");
let form = document.querySelector(".form-question");

let toggle = false;
let height = window.innerWidth < 768 ? "656px" : "386px";
let padding = window.innerWidth < 768 ? "12px" : "20px";

// Reset state when resize
window.addEventListener("resize", () => {
  toggle = false;
  form.style.opacity = 0;
  form.style.height = 0;
  form.style.zIndex = -10;
  form.style.marginTop = 0;
  form.style.paddingTop = 0;
  form.style.paddingBottom = 0;
  padding = window.innerWidth < 768 ? "12px" : "20px";
  height = window.innerWidth < 768 ? "656px" : "386px";
});

// Create button event in add question form
createBtn.addEventListener("click", () => {
  toggle = !toggle;
  if (toggle) {
    form.style.height = height;
    form.style.opacity = 1;
    form.style.zIndex = 0;
    form.style.marginTop = "20px";
    form.style.paddingTop = padding;
    form.style.paddingBottom = padding;
  } else {
    form.style.opacity = 0;
    form.style.height = 0;
    form.style.zIndex = -10;
    form.style.paddingTop = 0;
    form.style.paddingBottom = 0;
    form.style.marginTop = 0;
  }
});

// Cancel event in add question form
form.querySelector(".cancel").addEventListener("click", () => {
  toggle = false;
  form.style.opacity = 0;
  form.style.height = 0;
  form.style.zIndex = -10;
  form.style.marginTop = 0;
  form.style.paddingTop = 0;
  form.style.paddingBottom = 0;
});

let formWrapper = document.querySelector(".form-wrapper");

// without formEdit cannot run ???????
let formEdit = document.querySelector(".form-edit");
let textarea = formEdit.getElementsByTagName("textarea");
let input = formEdit.getElementsByTagName("input");

// Cancel event in edit form
formWrapper.querySelector(".cancel").addEventListener("click", () => {
  formWrapper.style.zIndex = -1;
  formWrapper.style.opacity = 0;
});

// Edit button
let editBtn = document.getElementsByClassName("fa-edit");
let option = formEdit.getElementsByTagName("option");

// when edit button is click -> pass all the data to edit form textarea and input

for (let i = 0; i < editBtn.length; i++) {
  editBtn[i].addEventListener("click", () => {
    formWrapper.style.zIndex = 10;
    formWrapper.style.opacity = 1;

    let hiddenInput = editBtn[i].getElementsByTagName("input");
    // pass description
    textarea[0].value = hiddenInput[0].value;
    // pass firstchoice
    textarea[1].value = hiddenInput[1].value;
    // pass secondchoice
    textarea[2].value = hiddenInput[2].value;
    // pass thirdchoice
    textarea[3].value = hiddenInput[3].value;
    // pass fourthchoice
    textarea[4].value = hiddenInput[4].value;

    // Pass the level
    if (hiddenInput[5].value == "1") {
      option[0].selected = true;
    } else if (hiddenInput[5].value == "2") {
      option[1].selected = true;
    } else option[2].selected = true;

    // Pass questionID
    input[0].value = hiddenInput[6].value;
  });
}
