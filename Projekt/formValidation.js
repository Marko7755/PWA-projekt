$(function(){
    $("form[name='input']").validate({
        rules: {
            articleTitle: {
                required: true,
                minlength: 5,
                maxlength: 30
            },
            briefContent: {
                required: true,
                minlength: 10,
                maxlength: 100
            },
            articlePicture: {
                required: true
            },
            articleCategory: {
                required: true
            }
        },

        messages: {
            articleTitle: {
                required: "Naslov članka je obavezan",
                minlength: "Naslov članka mora sadržavati najmanje 5 slova",
                maxlength: "Naslov članka mora sadržavati najvise 30 slova"
            },
            briefContent: {
                required: "Sažetak članka je obavezan",
                minlength: "Sažetak članka mora sadržavati najmanje 10 slova",
                maxlength: "Sažetak članka mora sadržavati najvise 100 slova"
            },
            articlePicture: {
                required: "Slika članka mora biti odabrana"
            },
            articleCategory: {
                required: "Kategorija članka mora biti odabrana"
            }
        },

        highlight: function(element, errorClass) {
            $(element).addClass("error-border");
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass('error-border');
        },

        submitHandler: function(form) {
            form.submit();
        }

    })
})