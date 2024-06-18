var x = false;

function valid (form){
    const namePattern = /^[А-ЯA-Z][а-яa-z]*([ -][А-ЯA-Z][а-яa-z]*)*$/;
    const loginPattern = /^(?=.*[a-zA-Z])(?=.*\d).+$/;
    const emailPattern = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
   
    var name = form.name.value;
    var surname = form.surname.value;
    var otchestvo = form.otchestvo.value;
    var gender = form.gender.value;
    var login = form.login.value;
    var email = form.email.value;
    var password = form.password.value;
    var RePassword = form.RePassword.value;
    if(namePattern.test(name)){
        console.log("Имя: " + name);
    } else{
        console.log("Имя введено неправильно");
        alert ("Имя должно начинаться с заглавной и содержать только буквы");
        return false;
    }
    if(namePattern.test(surname)){
        console.log("Фамилия: " + surname);
    } else{
        console.log("Фамилия введена неправильно");
        alert ("Фамилия должна начинаться с заглавной и содержать только буквы");
        return false;
    }
    if(namePattern.test(otchestvo)){
        console.log("Отчество: " + otchestvo);
    } else{
        console.log("Отчество введено неправильно");
        alert ("Отчество должно начинаться с заглавной и содержать только буквы");
        return false;
    }
    if(gender==""){
        console.log("Не выбран пол");
        alert ("Не выбран пол");
    }  else console.log("Пол: " + gender);
    if (loginPattern.test(login) && login.length >= 7 ){
        console.log("Логин: " + login);
    }   else {
        console.log("Неправильный ввод логина");
        alert ("Логин должен содержать буквы и цифры а также длину не менее 7 символов");
        return false;
    }
    if (emailPattern.test(email)){
        console.log("Email: " + email);
    } else {
        console.log("Email введён неправильно");
        alert ("Email должен содержать символ @, буквы или цифры, доменное имя разделённое точкой");
        return false;
    }
    if(password == RePassword){
        if(loginPattern.test(password) && password.length >= 8){
            console.log("Password: " + password);
        } else{
            console.log("Неправильный пароль");
            alert("Пароль должен быть не менее 8 символов и должен включать как буквы так и цифры");
            return false;
        }

    } else{
        console.log("Пароли не совпадают");
        alert("Пароли не совпадают");
        return false;
    }
    x = confirm('Завершить регистрацию?');
    if (x){
        
        window.location="login.html"
    }
}

function newWindow(){
    var x =prompt("Введите \"да\", если уверены");
    if (x=="да"){
        window.open('info.html', '_blank', 'width=800,height=600');
    } else if(x!=null)
    {
        alert("Ошибка ввода")
    } 
    
}



window.addEventListener("load", function() {

    const buttonDev = document.getElementById('devInfo');
    const originalText = buttonDev.value;

    buttonDev.addEventListener('mouseover', function(){
        buttonDev.value = "Узнать больше";

    })

    buttonDev.addEventListener('mouseout', function(){
        buttonDev.value = originalText;

    })


    const buttonReg = document.getElementById('registration');
    const originalTextReg = buttonReg.value;
    

    buttonReg.addEventListener('mouseover', function(){
        
        if(!x){
            buttonReg.value = "Сначала введите все данные";
        }
    })

    buttonReg.addEventListener('mouseout', function(){
        buttonReg.value = originalTextReg;

    })


})









