$(function () {
    $("#register-offre").validate({
        rules: {
            nom_offre: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            nom_offre_en: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            date_offre_limite: {
                required: true
            },
            description_offre: {
                required: true,
                minlength: 10
            },
            description_offre_en: {
                required: true,
                minlength: 10
            },
            adresse_compagnie: {
                minlength: 3,
                maxlength: 100
            }
        },
        messages: {
            nom_offre: {
                required: "Le nom (en francais) est requis",
                minlength: "Le nom (en francais) est trop court",
                maxlength: "Le nom (en francais) est trop long"
            },
            nom_offre_en: {
                required: "Le nom (en anglais) est requis",
                minlength: "Le nom (en anglais) est trop court",
                maxlength: "Le nom (en anglais) est trop long"
            },
            nom_compagnie: {
                required: "Le nom de la compagnie est requis",
                minlength: "Le nom de la compagnie est trop court",
                maxlength: "Le nom de la compagnie est long"
            },
            date_offre_limite: {
                required: "La date limite de l'offre est requise"
            },
            description_offre: {
                required: "La description (en francais) de l'offre est est requise",
                minlength: "La description (en francais) de l'offre est trop courte"
            },
            description_offre_en: {
                required: "La description (en anglais) de l'offre est est requise",
                minlength: "La description (en anglais) de l'offre est trop courte"
            },
            adresse_compagnie: {
                minlength: "L'adresse de la compagnie est trop court",
                maxlength: "L'adresse de la compagnie est trop long"
            }
        }
    });
})