$(function () {
    $("#contact").validate({
        rules: {
            nom_complet: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            email_contact: {
                required: true,
                email: true,
                minlength: 3,
                maxlength: 100
            },
            message_contact: {
                required: true,
                minlength: 11
            },
        },
        messages: {
            nom_complet: {
                required: "Le nom est requis",
                minlength: "Le nom doit contenir au moins 3 caracteres",
                maxlength: "Le nom est trop long"
            },
            email_contact: {
                required: "L'email est requis",
                email: "L'email est invalide",
                minlength: "L'email doit contenir au moins 3 caracteres",
                maxlength: "L'email est trop long"
            },
            message_contact: {
                required: "Le message est requis",
                minlength: "Le message est trop court"
            },
        }
    });
})

//alert("contact validation");