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
  if (event.target.className != "input" && index != -1) {
    InputWrapper[index].style.borderColor = "rgba(200,200,200,1)";
    index = -1;
  }
});

const inputUsername = input[1];
const inputPassword = input[2];
const inputCPassword = input[3];
const btnSubmit = document.querySelector(".RegisterButton");

const validateUsername = (username) => {
  const emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (!emailFormat.test(username)) {
    console.log("no");
    return "Invalid e-mail address";
  }
  return true;
};

const validatePassword = (password) => {
  const passwordFormat = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
  if (!passwordFormat.test(password)) {
    return "Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters!";
  }
  return true;
};

const FormValidate = () => {
  const isValidPassword = validatePassword(inputPassword.value);
  const isValidUsername = validateUsername(inputUsername.value);
  if (isValidUsername !== true) {
    alert(isValidUsername);
    return false;
  }
  if (isValidPassword !== true) {
    alert(isValidPassword);
    return false;
  }
  return true;
};

btnSubmit.addEventListener("click", (event) => {
  if (!FormValidate()) {
    event.preventDefault();
  }
});
