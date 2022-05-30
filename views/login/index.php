<?php include_once './views/shared/_head.php'; ?>
<div class="login-container">
    <div class="login">
        <i class="dashicons dashicons-businessman form__avatar"></i>
        <div class="form__content">
            <h2 class="text-white">Iniciar Sesión</h2>
            <div class="form__group field">
                <input type="text" autocomplete="off" class="form__field" placeholder="Email" name="inp_email" id='inp_email'  onkeyup="ingresarEmail(event)" />
                <label for="inp_email" class="form__label">Email</label>
            </div>
            <div class="form__group field">
                <input type="password" autocomplete="off" class="form__field" placeholder="Pasword" name="inp_password" id='inp_password'  onkeydown="ingresarPassword(event)" />
                <label for="inp_password" class="form__label">Password</label>
            </div>
            <div class="alert" id="error_label">
            </div>
            <button type="button" class="btn btn-block bg-blue">INGRESAR</button>
        </div>
    </div>
</div>
<script>
    let inp_email = document.getElementById('inp_email'),
        inp_password = document.getElementById('inp_password'),
        error = false;
    
    function ingresarEmail(e){
        console.log(url);
        let Email = inp_email.value;
        if(!error){
            if(!validateEmail(Email)){
                document.getElementById('error_label').innerHTML = 'Email invalido.';
                document.getElementById('error_label').classList.add('bg-red06');
                inp_email.focus();
            } else {
                document.getElementById('error_label').innerHTML = '';
                document.getElementById('error_label').classList.remove('bg-red06');
            }
        }
        if (e.keyCode === 13) {
            if(!validateEmail(Email)){
                document.getElementById('error_label').innerHTML = 'Email invalido.';
                document.getElementById('error_label').classList.add('bg-red06');
                inp_email.focus();
            } else {
                inp_password.focus();
            }
        }
    }

    function ingresarPassword(e) {
        if (e.keyCode === 13) {
            ingresar();
        }
    }

    function ingresar(){
        let Email = inp_email.value,
            Password = inp_password.value;
        if(!validateEmail(Email)){
            document.getElementById('error_label').innerHTML = 'Email invalido.';
            document.getElementById('error_label').classList.add('bg-red06');
            inp_email.focus();
            return false;
        }
        let xhr = new XMLHttpRequest();

        xhr.open("POST", `${url}controllers/user_controller.php`);

        xhr.setRequestHeader("Accept", "application/json");
        xhr.setRequestHeader("Content-Type", "application/json");
        
        let data = {
            action:`login`,
            email:`${inp_email.value}`,
            password:`${inp_password.value}`
        };
        
        xhr.send(JSON.stringify(data));
        xhr.onload = () => {
            let rta = xhr.responseText;
            rta = JSON.parse(rta);
            let {status,data} = rta;
            if (status === 200) {
                window.location.replace(url);
            } else {
                error = true;
                document.getElementById('error_label').innerHTML = data.Msg;
                document.getElementById('error_label').classList.add('bg-red06');
                inp_password.value = '';
                inp_password.focus();
                return false;
            }
        };
    }

    function validateEmail( email ) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test( String( email ).toLowerCase() );
    }
</script>
<?php include_once './views/shared/_footer.php' ; ?>