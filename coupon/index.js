const form = document.querySelector("#form");
const status = document.querySelector(".status");
const backdrop = document.querySelector('.backdrop');
const coupon = backdrop.children[0].children[1].children[0].children[0]

function showStatus(text, color) {
  status.textContent = text;
  status.style.color = color;
}

function togglePopup() {
  backdrop.classList.toggle("open-popup");
  status.textContent = '';
}
function copyCoupon() {
  window.navigator.clipboard.writeText(coupon.textContent)
    .then(() => alert('Coupon Copied'))
    .catch(err => {
      Swal.fire({
        title: 'Error!',
        text: err.message,
        icon: 'error',
        confirmButtonText: 'ok'
      })
    });
}

class Form {
  inputs = [];
  constructor(inputs){
    this.inputs = inputs;
  }
  getInputData(){
    const data = {};
    this.inputs.forEach(input => input.name && (data[input.name] = input.value));
    return data;
  }
  clearInputData(){
    this.inputs.forEach(input => input.name && (input.value = ""));
  }
}
  
form.addEventListener('submit', (e) => {

  e.preventDefault();
  const formInputs = new Form([...e.target.elements]);
  const data = formInputs.getInputData();

  if(!data.name && !data.contact && !data.email && !data.hrname) {
    Swal.fire({
      title: 'Error!',
      text: "Please fill all fields",
      icon: 'error',
      confirmButtonText: 'ok'
    })
  }

  showStatus("Generating coupon", "blue");

  fetch('/higher/coupon/php/coupon.php', {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
  })
    .then((res) => res.json())
    .then(res => {
      if (res.success === "success") {
        showStatus("Coupon generated", "yellowgreen");
        coupon.textContent = res.message;
        formInputs.clearInputData();
        togglePopup();
        return;
      }
      showStatus("", "white");
      Swal.fire({
        title: 'Error!',
        text: res.message,
        icon: 'error',
        confirmButtonText: 'ok'
      })
    })
    .catch(err => {
      console.log(err);
      Swal.fire({
        title: 'Error!',
        text: "Oops! some error occured",
        icon: 'error',
        confirmButtonText: 'ok'
      })
    })
})
