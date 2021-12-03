let createBtn = document.querySelector(".create-btn");
let form = document.querySelector(".form-quiz");

let toggle = false;
let height = 0;

let count = 1;
let initWrapper = form.querySelector(".question-wrapper");
let wrapperHeight = initWrapper.clientHeight;

// Calculating add quiz form height
if (window.innerWidth < 768) {
  height = 860;
} else {
  height = 580;
}

if (window.innerWidth < 417) {
  height += 60;
} else if (window.innerWidth < 672) {
  height += 110;
} else if (window.innerWidth < 768) {
} else if (window.innerWidth < 780) {
  height += 60;
}

// Reset state when resize
window.addEventListener("resize", () => {
  toggle = false;
  form.style.opacity = 0;
  form.style.height = 0;
  form.style.zIndex = -10;
  form.style.marginTop = 0;
  initWrapper = form.querySelector(".question-wrapper");
  initRemove = initWrapper.getElementsByClassName("fa-close");

  // Calculating add quiz form height
  wrapperHeight = initWrapper.clientHeight;
  if (window.innerWidth < 768) {
    height = 860 + wrapperHeight * (count - 1);
  } else {
    height = 580 + wrapperHeight * (count - 1);
  }

  if (window.innerWidth < 417) {
    height += 60;
  } else if (window.innerWidth < 672) {
    height += 110;
  } else if (window.innerWidth < 768) {
  } else if (window.innerWidth < 780) {
    height += 60;
  }
});

// Create button event in add quiz form
createBtn.addEventListener("click", () => {
  toggle = !toggle;
  if (toggle) {
    form.style.height = `${height}px`;
    form.style.opacity = 1;
    form.style.zIndex = 0;
    form.style.marginTop = "20px";
  } else {
    form.style.opacity = 0;
    form.style.height = 0;
    form.style.zIndex = -10;
    form.style.marginTop = 0;
  }
});

// Cancel event in add quiz form
form.querySelector(".cancel").addEventListener("click", () => {
  toggle = false;
  form.style.opacity = 0;
  form.style.height = 0;
  form.style.zIndex = -10;
});

let addBtn = document.querySelector(".add-btn");
let ipCount = document.querySelector(".ipCount");

// Add more question
addBtn.addEventListener("click", () => {
  ipCount.value = ++count;
  let wrapper = document.createElement("div");
  wrapper.className = "question-wrapper";
  wrapper.innerHTML = `
    <div class='line'></div>
    <div class="form-header">
      <div class="form-title">
        <p class="title">Question <span class="count">${count}</span><span class="wrong"></span></p>
        <i class="fa fa-minus-circle"></i>
      </div>
      <div class="form-input">
        <textarea name="description-${count}" rows="2" placeholder="Question Description" required></textarea>
        <div class="form-select">
          <select name="lvlOption-${count}" required>
            <option value="1">Easy</option>
            <option value="2">Medium</option>
            <option value="3">Hard</option>
          </select>
        </div>
      </div>
    </div>
    <div class="form-bottom">
      <div class="form-option">
        <p>Option A<span style="color: red">*</span><span class="wrong"></span></p>
        <textarea name="option1-${count}" rows="2" placeholder="Option A (correct answer)" required></textarea>
      </div>
      <div class="form-option">
        <p>Option B <span class="wrong"></span></p>
        <textarea name="option2-${count}" rows="2" placeholder="Option B" required></textarea>
      </div>
      <div class="form-option">
        <p>Option C <span class="wrong"></span></p>
        <textarea name="option3-${count}" rows="2" placeholder="Option C" required></textarea>
      </div>
      <div class="form-option">
        <p>Option D <span class="wrong"></span></p>
        <textarea name="option4-${count}" rows="2" placeholder="Option D" required></textarea>
      </div>
    </div>
  `;

  // Calculating height for the form
  height += wrapperHeight;
  form.style.height = `${height}px`;
  form.insertBefore(wrapper, addBtn);

  wrapper = form.getElementsByClassName("question-wrapper");
  wrapper = wrapper[wrapper.length - 1];

  // Add remove icon event
  wrapper.querySelector(".fa-minus-circle").addEventListener("click", () => {
    wrapper.remove();
    ipCount.value = --count;
    height -= wrapperHeight;
    form.style.height = `${height}px`;
    let counting = document.getElementsByClassName("count");
    for (let i = 0; i < counting.length; i++) {
      counting[i].innerText = i + 2;
    }
  });
});

let selectDate = document.getElementsByClassName("select-date");
let dateChange = 0;
let wrong = true;

// Validate date function
// Compare start date vs due date
const validateDate = () => {
  if (
    new Date(selectDate[0].value).getTime() >
    new Date(selectDate[1].value).getTime()
  ) {
    wrong = true;
  } else wrong = false;
};

// When user change the date, datechange++.
// when datechange > 1, validate the date
selectDate[0].addEventListener("change", () => {
  dateChange++;
  dateChange > 1 ? validateDate() : null;
});

selectDate[1].addEventListener("change", () => {
  dateChange++;
  dateChange > 1 ? validateDate() : null;
});

// If wrong == true -> due date > start date
form.addEventListener("submit", (e) => {
  if (wrong) {
    e.preventDefault();
    document.querySelector(".wrong").innerHTML =
      "Start date cannot be less than due date";
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
    input[0].value = card[i].querySelector(".quiz-name").innerText;

    // pass clicked start date and due date to edit form
    let date = card[i].getElementsByClassName("date");
    input[1].value = date[0].innerText.replaceAll("/", "-");
    input[2].value = date[1].innerText.replaceAll("/", "-");

    // pass quizId to edit form
    input[3].value = card[i].querySelector("input").value;

    formWrapper[0].style.opacity = 1;
    formWrapper[0].style.zIndex = 10;
  });
}

// Remove button is clicked
// => pass courseID to input
for (let i = 0; i < length; i++) {
  remove[i].addEventListener("click", () => {
    // pass quizId to delete form
    formWrapper[1].getElementsByTagName("input")[0].value =
      card[i].querySelector("input").value;

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
  let selected = formWrapper[0].getElementsByClassName("select-date");
  if (
    new Date(selected[0].value).getTime() >
    new Date(selected[1].value).getTime()
  ) {
    formWrapper[0].querySelector(".wrong").innerText =
      "Start date cannot be less than due date";
    e.preventDefault();
  }
});
