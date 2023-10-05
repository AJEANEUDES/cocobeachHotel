$(function () {
    $("#create-reservation").validate({
        rules: {
            chambre: {
                required: true,
            },
            client: {
                required: true,
            },
            date_debut: {
                required: true,
            },
            date_fin: {
                required: true,
            },
        },
        messages: {
            chambre: {
                required: "La chambre est requise",
            },
            client: {
                required: "Le client est requis",
            },
            date_debut: {
                required: "La date d'arrivée est requise",
            },
            date_fin: {
                required: "La date de depart est requise",
            },
        }
    })
})