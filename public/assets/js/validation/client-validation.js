$(function () {
    $("#create-client").validate({
        rules: {
            nom_client: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            prenom_client: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            email_client: {
                required: true,
                email: true,
                minlength: 3,
                maxlength: 100
            },
            telephone_client: {
                required: true,
                minlength: 11,
                number: true
            },
        },
        messages: {
            nom_client: {
                required: "Le nom du client est requis",
                minlength: "Le nom doit contenir au minimum 3 caracteres",
                maxlength: "Le nom du client est trop long"
            },
            prenom_client: {
                required: "Le prenom du client est requis",
                minlength: "Le prenom doit contenir au minimum 3 caracteres",
                maxlength: "Le prenom du client est trop long"
            },
            email_client: {
                required: "L'email du client est requis",
                email: "L'email du client est invalide",
                minlength: "L'email doit contenir au minimum 3 caracteres",
                maxlength: "L'adresse du client est trop long"
            },
            telephone_client: {
                required: "Le numero de telephone est requis",
                minlength: "Le numero de telephone est invalide",
                number: "Le numero de telephone est invalide"
            },
        }
    });
})

//alert("client validation");