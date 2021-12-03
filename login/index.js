let input = document.getElementsByClassName("input");
let InputWrapper = document.getElementsByClassName("InputWrapper");
let content = document.getElementById("content");
let index = -1;

let student = document.getElementById("student");
let teacher = document.getElementById("teacher");

let FormWrapper = document.querySelector(".FormWrapper");
let TeacherWrapper = document.querySelector(".TeacherWrapper");
let StudentWrapper = document.querySelector(".StudentWrapper");

const Student_TabletListener = function () {
  FormWrapper.style.left = "260px";
  TeacherWrapper.style.marginTop = "-110%";
  StudentWrapper.style.left = "0px";
};

const Student_MobileListener = function () {
  document.querySelector(".TeacherWrapper").style.marginLeft = "200%";
  StudentWrapper.style.left = "0";
  document.querySelector(".StudentSide").style.display = "none";
  document.querySelector(".TeacherSide").style.display = "block";
};

const Teacher_TabletListener = function () {
  FormWrapper.style.left = "35px";
  TeacherWrapper.style.marginTop = "0px";
  StudentWrapper.style.left = "-100%";
};

const Teacher_MobileListener = function () {
  document.querySelector(".TeacherWrapper").style.marginLeft = "0";
  StudentWrapper.style.left = "-100%";
  document.querySelector(".StudentSide").style.display = "block";
  document.querySelector(".TeacherSide").style.display = "none";
};

student.addEventListener("click", () => {
  if (window.innerWidth >= 768) Student_TabletListener();
  else Student_MobileListener();
  content.innerHTML = "STUDENT";
});

teacher.addEventListener("click", () => {
  if (window.innerWidth >= 768) Teacher_TabletListener();
  else Teacher_MobileListener();
  content.innerHTML = "TEACHER";
});

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

window.addEventListener("resize", () => {
  if (window.innerWidth < 768) {
    FormWrapper.style.left = "0";
    TeacherWrapper.style.marginTop = "0";
    TeacherWrapper.style.marginLeft = "0";
    StudentWrapper.style.left = "-100%";
    document.querySelector(".StudentSide").style.display = "block";
    document.querySelector(".TeacherSide").style.display = "none";
  } else {
    FormWrapper.style.left = "35px";
    TeacherWrapper.style.marginTop = "0";
    TeacherWrapper.style.marginLeft = "0";
    StudentWrapper.style.left = "-100%";
    document.querySelector(".StudentSide").style.display = "flex";
    document.querySelector(".TeacherSide").style.display = "flex";
  }
  content.innerHTML = "TEACHER";
});
