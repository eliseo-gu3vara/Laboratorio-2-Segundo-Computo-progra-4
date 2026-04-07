const loginForm = document.getElementById('loginForm');
if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();
        if (!username || !password) {
            e.preventDefault();
            const errorElement = document.getElementById('error');
            if (errorElement) {
                errorElement.textContent = 'Por favor, complete todos los campos.';
            }
        }
    });
}

const dataForm = document.getElementById('dataForm');
if (dataForm) {
    dataForm.addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const age = document.getElementById('age').value;
        const email = document.getElementById('email').value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!name || !age || !email || age < 1 || age > 120 || !emailRegex.test(email)) {
            e.preventDefault();
            alert('Por favor, ingrese datos válidos.');
        }
    });
}

const addUserForm = document.getElementById('addUserForm');
if (addUserForm) {
    addUserForm.addEventListener('submit', function(e) {
        const username = document.getElementById('new_username').value.trim();
        const password = document.getElementById('new_password').value.trim();
        if (!username || !password) {
            e.preventDefault();
            alert('Por favor, complete usuario y contraseña.');
        } else if (password.length < 6) {
            e.preventDefault();
            alert('La contraseña debe tener al menos 6 caracteres.');
        }
    });
}

function sortTable(n) {
    const table = document.getElementById('dataTable');
    if (!table) return;
    let rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    switching = true;
    dir = 'asc';
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName('TD')[n];
            y = rows[i + 1].getElementsByTagName('TD')[n];
            if (dir == 'asc') {
                if (n === 1) {
                    if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                } else {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            } else if (dir == 'desc') {
                if (n === 1) {
                    if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                } else {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == 'asc') {
                dir = 'desc';
                switching = true;
            }
        }
    }
}