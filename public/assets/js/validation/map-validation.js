$(function () {
    $("#register-map").validate({
        rules: {
            pays_map: {
                required: true
            },
            ville_map: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            quartier_map: {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            latitude_map: {
                required: true,
                number: true
            },
            longitude_map: {
                required: true,
                number: true
            }
        },
        messages: {
            pays_map: {
                required: "Veuillez selectionnez le pays"
            },
            ville_map: {
                required: "La ville est requise",
                minlength: "La ville est courte",
                maxlength: "La ville est trop longue"
            },
            quartier_map: {
                required: "Le quartier est requis",
                minlength: "Le quartier est court",
                maxlength: "Le quartier est trop long"
            },
            latitude_map: {
                required: "La latitude est requise",
                number: "La latitude est invalide"
            },
            longitude_map: {
                required: "La longitude est requise",
                number: "La longitude est invalide"
            }
        }
    })
})