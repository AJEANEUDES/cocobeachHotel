$(function () {
    $("#reserver").validate({
        rules: {
            date_arrivee: {
                required: true,
            },
            date_depart: {
                required: true,
            },
            nbre_chambre: {
                required: true,
                number: true
            },
            nbre_adulte: {
                required: true,
                number: true
            },
            nbre_enfant: {
                required: true,
                number: true
            },
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
                email: true,
                minlength: 3,
                maxlength: 100
            },
            telephone_client: {
                required: true,
                number: true,
                minlength: 11,
            },
        },
        messages: {
            date_arrivee: {
                required: "La date d'arrivee est requise",
            },
            date_depart: {
                required: "La date de depart est requise",
            },
            nbre_chambre: {
                required: "Le nombre de chambre est requis",
                number: "Le nombre de chambre est incorrect"
            },
            nbre_adulte: {
                required: "Le nombre de personne est requis",
                number: "Le nombre de personne est incorrect"
            },
            nbre_enfant: {
                required: "Le nombre d'enfant est requis",
                number: "Le nombre d'enfant est incorrect"
            },
            nom_client: {
                required: "Le nom est requis",
                minlength: "Le nom est trop court",
                maxlength: "Le nom est trop long"
            },
            prenom_client: {
                required: "Le prenom est requis",
                minlength: "Le prenom est trop court",
                maxlength: "Le prenom est trop long"
            },
            email_client: {
                email: "L'email est invalide",
                minlength: "L'email doit contenir au moins 3 caracteres",
                maxlength: "L'email est trop long"
            },
            telephone_client: {
                required: "Le numero de telephone est requis",
                number: "Le numero de telephone est invalide",
                minlength: "Le numero de telephone doit contenir au moins 11 chiffres",
            },
        }
    });
})

//alert("contact validation");