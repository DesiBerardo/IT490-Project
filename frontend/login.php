<?php
?>
<form onsubmit="return validate(this)" method="POST">
    <div>
        <label for="email">Email Address</label>
        <input type="text" name="email" required />
    </div>
    <div>
        <label for="pw">Password</label>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    <input type="submit" value="Login" />
</form>
<script>
    function validate(form) {
       
        let isValid = true ;
        if((form.email.value).length > 0){ 

            var emailConditions = /\S+@\S+\.\S+/ ;
            if (!emailConditions.test(form.email.value)){

                isValid = false; flash("Sorry, that is an invalid email address. Please try again!");

            }
        
        } else { isValid = false; flash("Please fill out a valid email address. Please try again!");}

        if((form.password.value).length < 8){ 
            isValid = false; flash("Password is too short. Please enter more characters.");
        }
        
        return isValid;
        
    }
</script>