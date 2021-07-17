const form = document.querySelector('.form');
let elements = [];

form.addEventListener('submit', (e) => {
    e.preventDefault();
    elements = e.target.elements;
    sendData(buildData(elements))

})

function buildData(elements) {
    const data = {};
    for (let i = 0; i < elements.length - 1; i++) {
        data[elements[i].name] = elements[i].value
    }
    return data;
}

function sendData(data) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST','demodb.php');
    xhr.setRequestHeader('Content-type', 'application/json;charset=UTF-8');
    xhr.send(JSON.stringify(data))


    xhr.onprogress = function () {
        showStatus('Info', 'unlocking demo')
    }
    xhr.onload = function () {
      console.log(this.responseText);
        const res = JSON.parse(this.responseText);
      
        if (res.success) {
     
            window.location.href= res.message;
            /*const link = `<a href="${window.location.origin}/${res.message}">Open Class</a>`;
            const message = `Demo Unlocked\n ${link} \nsave this link`
            console.log(link);
            console.log(message);
            clearFields(elements);
            */
            showStatus('SUCCESS', 'Congratulations, your test is loading. All the best');
        } else {
            showStatus('FAILED', 'Failed to Unlock Demo')
        }
    }
    xhr.onabort = function () {
        showStatus('WARNING', 'Error Occured : abort');
    }
    xhr.onerror = function () {
        showStatus('WARNING', 'Error Occured : Server error or network error');
    }
}

//show status on form
function showStatus(status, message) {
    const alertBox = document.querySelector('.alert-box');
    const color = {
        'INFO': '#2196F3',
        'WARNING': '#f44336',
        'SUCCESS': '#4CAF50'
    }
    alertBox.innerHTML = ` <p class="alert" style="background-color:${color[status]}">
    <span class="closebtn" onclick="closeNotify()">&times;</span>
    ${message}
    </p>`
}

function closeNotify() {
    document.querySelector('.alert-box').innerHTML = "";
}

//
function clearFields(field) {
    for (let i = 0; i < field.length - 1; i++) {
        field[i].value = "";
    } 
}