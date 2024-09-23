// document.addEventListener('DOMContentLoaded', () => {
//     const formSubmit = document.getElementById('submit');
//     const fullname = document.getElementById('fullname');
//     const username = document.getElementById('username');
//     const email = document.getElementById('email');
//     const password = document.getElementById('password');
//     const repassword = document.getElementById('repassword');
//     const passGuide = document.querySelector('.password-guide');
//     const revealPass = document.querySelectorAll('.password i');
//     const errMsgs = document.querySelectorAll('.errMsg');
//     const specialCharRegex = /[!@#$%^&*(),?":{}|<>]/;
//     const emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;;

//     const showErrMsg = (index, message) => {
//         errMsgs[index].textContent = message;
//         errMsgs[index].classList.remove('hide');
//     };

//     const hideErrMsg = (index) => {
//         errMsgs[index].classList.add('hide');
//         errMsgs[index].textContent = '';
//     };

//     const validateInput = (input, index, rules) => {
//         const value = input.value.trim();

//         if (value === '') {
//             showErrMsg(index, `${input.placeholder || input.id} cannot be empty!`);
//             return false;
//         }

//         for (const [regex, message] of rules) {
//             if (regex.test(value)) {
//                 showErrMsg(index, message);
//                 return false;
//             }
//         }

//         hideErrMsg(index);
//         return true;
//     }

//     const validatePassword = () => {
//         const passGuideList = Array.from(passGuide.children);

//         const checks = [
//             [/.{8,}/, 'Password must be at least 8 characters.'],
//             [specialCharRegex, 'Pasword must contain a special character.'],
//             [/[A-Z]/, 'Password must contain an uppercase letter.'],
//             [/[a-z]/, 'Password must contain a lowercase letter.']
//         ];

//         if (password.value.trim() ==='') {
//             showErrMsg(3, 'Password cannot be empty!');
//             return false;
//         } 
//         else hideErrMsg(3);

//         passGuideList.forEach((el, i) => {
//             el.style.color = checks[i][0].test(password.value) ? 'var(--success)' : 'var(--red)';
//         });

//         return checks.every(([regex]) => regex.test(password.value));
//     };

//     const checkPeriods = (val) => (val.match(/\./g) || []).length > 2 ? 'Only two periods are allowed.' : '';
//     const checkEmpty = (val, fieldname) => val.trim() === '' ? `${fieldname} cannot be empty!` : '';
//     const checkSpecialChars = (val, fieldname) => specialCharRegex.test(val) ? `${fieldname} cannot contain special characters!` : '';

//     fullname?.addEventListener('input', () => {
//         const errorMessage = checkEmpty(fullname.value, 'Fullname') || checkSpecialChars(fullname.value, 'Fullname') || checkPeriods(fullname.value);

//         if (errorMessage) showErrMsg(0, errorMessage);
//         else hideErrMsg(0);
//     });

//     username?.addEventListener('input', () => {
//         const errorMessage = checkEmpty(username.value, 'Username') || checkSpecialChars(username.value, 'Username') || checkPeriods(username.value);

//         if (errorMessage) showErrMsg(1, errorMessage);
//         else hideErrMsg(1);
//     });

//     email?.addEventListener('input', () => {
//         const value = email.value.trim();

//         if (value === '' || !emailRegex.test(value)) showErrMsg(2, value === '' ? 'Email cannot be empty!' : 'Please enter a valid email address!');
//         else hideErrMsg(2);
//     });

//     password?.addEventListener('input', () => {
//         if (validatePassword()) passGuide.classList.add('hide');
//         else passGuide.classList.remove('hide');
//     });

//     repassword?.addEventListener('input', () => {
//         if (password.value !== repassword.value) showErrMsg(4, 'Password does not match');
//         else hideErrMsg(4);
//     });

//     revealPass?.forEach(el => {
//         el.addEventListener('click', () => {
//             const inputField = el.closest('.password').querySelector('input');
//             const isPasswordType = inputField.type === 'password';
//             inputField.type = isPasswordType ? 'text' : 'password';
//             el.classList.toggle('fa-eye', isPasswordType);
//             el.classList.toggle('fa-eye-slash', !isPasswordType);
//         });
//     });

//     formSubmit?.addEventListener('click', (e) => {
//         e.preventDefault();
//         const isFormValid = [
//             validateInput(fullname, 0, [
//                 [specialCharRegex, 'Fullname cannot contain special characters.'],
//                 [/\./g, (val) => (val.match(/\./g) || []).length > 2 ? 'Only two periods are allowed.' : '']
//             ]),
//             validateInput(username, 1, [
//                 [specialCharRegex, 'Username cannot contain special characters.'],
//                 [/\./g, (val) => (val.match(/\./g) || []).length > 0 ? 'Periods are not allowed.' : '']
//             ]),
//             validateInput(email, 2, []),
//             validatePassword(),
//             repassword.value === '' ? (showErrMsg(4, 'Please re-type your password!'), false) : (password.value === repassword.value)
//         ].every(Boolean);

//         if (!isFormValid) showErrMsg(5, 'Form validation failed!');
//         else hideErrMsg(5);

//         const addUserUrl = 'base/App/CrudController.php';

//         fetch(addUserUrl, {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//             },
//             body: JSON.stringify({
//                 fullname : fullname.value,
//                 username : username.value,
//                 email : email.value,
//                 password : password.value
//             })
//         })
//         .then(res => {
//             if (!res.ok) throw new Error('Network response was not ok');
//             return res.text();
//         })
//         .then(text => {
//             console.log(text);
//             JSON.parse(data);
//             console.log(data);
//         })
//         .catch(error => console.error('Error:', error));
//     });
// });