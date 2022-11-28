const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");

let formStepsNum = 0;

nextBtns.forEach((btn) => {
btn.addEventListener("click", () => {
        formStepsNum++;
        updateFormSteps();
        updateProgressbar()
        });
});

prevBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        formStepsNum--;
        updateFormSteps();
        updateProgressbar()
        });
    });

function updateFormSteps() { 
    formSteps.forEach((formStep) => {
        formStep.classList.contains("form-step-active")
        formStep.classList.remove("form-step-active");
    });
    formSteps[formStepsNum].classList.add("form-step-active")
}

function updateProgressbar(){
   progressSteps.forEach((progressStep, idx) => {
       if(idx < formStepsNum + 1) {
        progressStep.classList.add("progress-step-active") 
        } else {
            progressStep.classList.remove("progress-step-active");
    }
});

const progressActive = document.querySelectorAll(".progress-step-active");

progress.style.width = ((progressActive.length - 1) / (progressSteps.length -1)) * 100 + "%"

}
/*This is for the show password*/
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
      x.type = "text";
      
    } else {
      x.type = "password";
    }
  }
/* If Passwword and Comfirm Password do not match */
var check = function() {
    if (document.getElementById('password').value ==
      document.getElementById('cpassword').value) {
      document.getElementById('message').style.color = 'green';
      document.getElementById('message').innerHTML = '✔';
    } else {
      document.getElementById('message').style.color = 'red';
      document.getElementById('message').innerHTML = '✕';
    }
  }

  

  