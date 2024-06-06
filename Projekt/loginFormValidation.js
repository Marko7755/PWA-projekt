$(function() {
    $("form[name='loginForm']").validate({
        rules: {
            username: {
                required: true,
                minlength: 5
            },
            password: {
                required:true,
                minlength: 7
            }
        },

        messages: {
            username: {
                required: "Korisničko ime je obavezno!",
                minlength: "Korisničko ime ne smije imati manje od 6 znakova!"
            },
            password: {
                required: "Lozinka je obavezna!",
                minlength: "Lozinka ne smije imati manje od 7 znakova!"
            },
        },
        
        highlight: function(element, errorClass) {
            $(element).addClass("error-border");
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass("error-border");
        },

        submitHandler: function(form) {
            form.submit();
        }

    })
})