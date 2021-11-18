let createBtn = document.querySelector(".create-btn");
let form = document.querySelector(".form-course");

let toggle = false;
let height = window.innerWidth < 768 ? "180px" : "170px";

// Reset state when resize
window.addEventListener("resize", () => {
  toggle = false;
  form.style.opacity = 0;
  form.style.height = 0;
  form.style.zIndex = -10;
  height = window.innerWidth < 768 ? "180px" : "170px";
});

// Create button event in add course form
createBtn.addEventListener("click", () => {
  toggle = !toggle;
  if (toggle) {
    document.querySelector(".wrong").innerText = "";
    form.style.height = height;
    form.style.opacity = 1;
    form.style.zIndex = 0;
  } else {
    form.style.opacity = 0;
    form.style.height = 0;
    form.style.zIndex = -10;
  }
});

// Cancel event in add course form
form.querySelector(".cancel").addEventListener("click", () => {
  toggle = false;
  form.style.opacity = 0;
  form.style.height = 0;
  form.style.zIndex = -10;
});

let courseName = form.querySelector("input");

// Check empty for form course
form.addEventListener("submit", (e) => {
  if (courseName.value == "") {
    e.preventDefault();
    document.querySelector(".wrong").innerText = "Course name cannot be empty";
  }
});

let formWrapper = document.getElementsByClassName("form-wrapper");
let editInput = formWrapper[0].getElementsByTagName("input");

let card = document.getElementsByClassName("card");
let edit = document.getElementsByClassName("edit");
let remove = document.getElementsByClassName("delete");
const length = edit.length;

// Edit button is clicked
// => pass courseID to input, pass courseNAme to input
for (let i = 0; i < length; i++) {
  edit[i].addEventListener("click", () => {
    formWrapper[0].querySelector(".wrong").innerText = "";
    let input = formWrapper[0].getElementsByTagName("input");
    // pass clicked course name to edit form
    input[0].value = card[i].querySelector(".course-name").innerText;
    // pass clicked courseID to edit form
    input[1].value = card[i].querySelector("input").value;

    formWrapper[0].style.opacity = 1;
    formWrapper[0].style.zIndex = 10;
  });
}

// Remove button is clicked
// => pass courseID to input
for (let i = 0; i < length; i++) {
  remove[i].addEventListener("click", () => {
    let input = formWrapper[1].getElementsByTagName("input");
    input[1].value = card[i].querySelector("input").value;
    formWrapper[1].style.opacity = 1;
    formWrapper[1].style.zIndex = 10;
  });
}

// Add cancel button eventlistener for all popup form
formWrapper[0].querySelector(".cancel").addEventListener("click", () => {
  formWrapper[0].style.opacity = 0;
  formWrapper[0].style.zIndex = -1;
});

formWrapper[1].querySelector(".cancel").addEventListener("click", () => {
  formWrapper[1].style.opacity = 0;
  formWrapper[1].style.zIndex = -1;
});

// Check if input is empty for form-edit
formWrapper[0].addEventListener("submit", (e) => {
  let input = formWrapper[0].querySelector(".input");
  if (input.value == "") {
    e.preventDefault();
    formWrapper[0].querySelector(".wrong").innerText =
      "Course name cannot be empty";
  }
});
