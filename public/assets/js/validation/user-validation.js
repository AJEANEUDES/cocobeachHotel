$(function () {
    $("#user").validate({
        rules: {
            nom_utilisateur: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            prenom_utilisateur: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            email_utilisateur: {
                required: true,
                email: true,
                maxlength: 100
            },
            adresse_utilisateur: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            telephone_utilisateur: {
                required: true,
                minlength: 11,
                number: true
            },
            sexe_utilisateur: {
                required: true,
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 100
            },
            level_utilisateur: {
                required: true,
            },
        },
        messages: {
            nom_utilisateur: {
                required: "Le nom est requis",
                minlength: "Le nom doit contenir au moins 3 caractères",
                maxlength: "Le nom doit être inferieur a 100 caractères"
            },
            prenom_utilisateur: {
                required: "Le prenom est requis",
                minlength: "Le prenom doit contenir au moins 3 caractères",
                maxlength: "Le prenom doit être inferieur a 100 caractères"
            },
            email_utilisateur: {
                required: "L'email est requis",
                email: "L'email est invalide",
                maxlength: "L'email est trop long"
            },
            adresse_utilisateur: {
                required: "L'adresse est requis",
                minlength: "L'adresse est doit contenir au moins 3 caractères",
                maxlength: "L'adresse doit être inferieur a 100 caractères"
            },
            telephone_utilisateur: {
                required: "Le numero de telephone est requis",
                minlength: "Le numero de telephone doit contenir au moins 11",
                number: "Le numero de telephone est incorrect"
            },
            sexe_utilisateur: {
                required: "Le sexe est requis",
            },
            password: {
                required: "Le mot de passe est requis",
                minlength: "Le mot de passe doit contenir au moins 8",
                maxlength: "Le mot de passe est trop long"
            },
            level_utilisateur: {
                required: "Le niveau d'accès est requis",
            },
        }
    })
})

//alert("utilisateur")