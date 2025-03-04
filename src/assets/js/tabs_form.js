var currentTab = 0;

const dateInput = document.querySelector('input[type="date"]');
const today = new Date().toISOString().split('T')[0];
dateInput.max = today;

document.querySelectorAll("input[name='first-name__input'], input[name='last-name__input']")
    .forEach(input => {
        input.addEventListener("input", function () {
            this.value = this.value.replace(/[^\p{L}\s-]/gu, ""); 
        });
    });
    


if (localStorage.getItem("currentTab")) {
    currentTab = parseInt(localStorage.getItem("currentTab"));
}
showTab(currentTab);

function showTab(n) {
    var x = document.getElementsByClassName("tab");
    for (var i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }

    if (localStorage.getItem("formSubmitted") === "true") {
        document.getElementById('nextBtn').style.display = 'none';
        document.querySelector('.form__title').style.display = 'none';
        document.querySelector('form').style.display = 'none';
    }
    x[n].style.display = "block";

    if (n == 1) { 
        var nextBtn = document.getElementById('nextBtn');
        nextBtn.onclick = function() { 
            if (validateForm()) {
                submitForm(); 
            }
        };
    }
}

function nextPrev(n) {
    var x = document.getElementsByClassName("tab");

    if (n == 1 && !validateForm()) {
        return;
    }

    x[currentTab].style.display = "none";
    currentTab = currentTab + n;

    localStorage.setItem("currentTab", currentTab);

    showTab(currentTab);
}


document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".form");

    form.querySelectorAll("input, select, textarea").forEach(field => {
        const savedValue = localStorage.getItem(field.name);
        if (savedValue) {
            if (field.type === "checkbox" || field.type === "radio") {
                field.checked = savedValue === "true";
            } else {
                field.value = savedValue;
            }
        }
    });

    form.addEventListener("input", function (event) {
        const field = event.target;
        if (field.name) {
            if (field.type === "checkbox" || field.type === "radio") {
                localStorage.setItem(field.name, field.checked);
            } else {
                localStorage.setItem(field.name, field.value);
            }
        }
    });

    form.addEventListener("submit", function () {
        form.querySelectorAll("input, select, textarea").forEach(field => {
            localStorage.removeItem(field.name);
        });
    });
});

function submitForm() {
    var form = document.querySelector("form");
    var formData = new FormData(form);

    fetch('index.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'error') {
            alert(data.message);
            resetForm();
            currentTab = 0;
            localStorage.setItem("currentTab", currentTab);
            showTab(currentTab);
        } else {
            currentTab = 2;
            localStorage.setItem("currentTab", currentTab);
            localStorage.setItem("formSubmitted", "true");
            showTab(currentTab);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function resetForm() {
    var form = document.querySelector("form");
    form.reset();
    localStorage.removeItem("formSubmitted");
}


function validateForm() {
    var firstTabFields = document.querySelectorAll("#general__section input[required], #general__section textarea[required]");

    for (var i = 0; i < firstTabFields.length; i++) {
        if (firstTabFields[i].value.trim() === "") {
            alert("Please fill all required fields before moving to the next tab.");
            return false;
        }
    }

    return true;
}