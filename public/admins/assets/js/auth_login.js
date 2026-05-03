 function setRole(role, el) {

            document.getElementById('roleInput').value = role;

            document.querySelectorAll('.role-btn').forEach(btn => btn.classList.remove('active'));
            el.classList.add('active');

            let qalam = document.getElementById('qalamField');

            if (role === 'beneficiary') {
                qalam.classList.add('show');
            } else {
                qalam.classList.remove('show');
            }
        }