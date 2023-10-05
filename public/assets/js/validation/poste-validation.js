$(function () {

    $("#register-poste").validate({
        rules: {
            nom_poste: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            descrip_poste: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            nom_poste: {
                required: "Le nom du poste est requis",
                minlength: "Le nom du poste doit etre superieur a 3 caracteres",
                maxlength: "Le nom du poste doit etre inferieur a 100 caracteres"
            },
            descrip_poste: {
                required: "La description du poste est requis",
                minlength: "La description du poste doit etre superieur a 6 caracteres"
            }
        }
    });
})