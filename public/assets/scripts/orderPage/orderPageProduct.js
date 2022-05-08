$(function() {
    $(document).ready( () => {

        console.log("testOrder");        

        let activeUrl = window.location.href;
        let newUrl = new URL(activeUrl);
        let productId = newUrl.searchParams.get("productId");
        let servId = newUrl.searchParams.get("serviceId");

        autoComplete();

        function autoComplete() {

            if (servId != null) {
                $("#orders_orderService").val(servId);
                productList();
            }

        }

        function updateProduct(){
            $("#orders_orderProducts").val(productId);
        }

        $("#orders_orderService").change( () => {
            productList();
            updateRecap();
            verifDispo();
        });

        $("#orders_orderProducts").change( () => {
            updateRecap();
            updateDispo();
            verifDispo();
        });

        $("#orders_orderStartDate").change( () => {
            updateRecap();
            verifDispo();
        });

        $("#orders_orderEndDate").change( () => {
            updateRecap();
            verifDispo();
        });

        $(":reset").click( () => {
            $("#recap").html('');
        })

        function productList () {
            let idServ = $("#orders_orderService>option:selected").val();
            $.ajax({
                url: '/member/order/listproductsofservices',
                type: "GET",
                dataType: "json",
                data:{
                    serviceId: idServ
                },
                success: (products) => {
                    let productSelect = $("#orders_orderProducts");

                    // Suppression de l'option
                    productSelect.html('');

                    // Valeur par défaut
                    productSelect.append('<option value> sélectionnez un produit du service ' + $("#orders_orderService>option:selected").text() + ' </option>');

                    $.each(products, function (key, product) {
                        if(product.status === 'Available') {
                            if(product.id == productId) {
                                productSelect.append('<option value="' + product.id + '" selected>' + product.name + '</option>');
                            } else {
                                productSelect.append('<option value="' + product.id + '">' + product.name + '</option>');
                            }
                        }
                    });

                    updateDispo();

                },
                error: function (err) {
                    alert("Une erreur s'est produite lors du chargement des données");
                }
            });
        }

        function updateRecap() {
            let startDate = new Date($("#orders_orderStartDate").val());
            let endDate = new Date($("#orders_orderEndDate").val());
            let nbDays = dateDiff(startDate, endDate);
            let idServ = $("#orders_orderService>option:selected").val();
            $.ajax({
                url: "/member/order/serviceprice",
                type: "GET",
                dataType: "json",
                data:{
                    serviceId: idServ
                },
                success: (services) => {
                    let recap = $('#recap');

                    // Suppression de l'option
                    recap.html('');

                    // Valeur par défaut
                    recap.append(
                        '<tbody>' +
                        '   <tr>' +
                        '       <th> Service: </th><td>' + $("#orders_orderService>option:selected").text() + '<td>' +
                        '   </tr>' +
                        '   <tr/>' +
                        '       <th> Produit: </th><td>' + $("#orders_orderProducts>option:selected").text() + ' </td>' +
                        '   <tr/>'
                    );

                    $.each(services, function (key, service) {
                        recap.append(
                            '<tr>' +
                            '   <th>Prix: </th><td>' + service.price + '€/par jour</td>' +
                            '</tr>' +
                            '<tr>');
                        if(nbDays > 0){
                            recap.append(
                                '   <th>Total:</th>' +
                                '   <td>' + service.price*nbDays + '€</td>' +
                                '</tr>');
                        }
                    });

                    recap.append('</tbody>');

                },
                error: function (err) {
                    alert("Une erreur c'est produite lors du chargement des données");
                }
            });

        }

        function updateDispo() {
            let idProd = $("#orders_orderProducts>option:selected").val();
            $.ajax({
                url: "/member/order/rentalDates",
                type: "GET",
                dataType: "json",
                data:{
                    prodId: idProd
                },
                success: (rentalDates) => {
                    let recapDates = $('#recapDates');

                    // Suppression de l'option
                    recapDates.html('');

                    recapDates.append(
                        '<tbody>' +
                        '   <tr>' +
                        '       <th>Périodes d\'indisponibilités</th>' +
                        '   </tr>'
                    );

                    $.each(rentalDates, function (key, rentalDate) {
                        recapDates.append(
                            '<tr>' +
                            '   <td>Début : ' + rentalDate.startDate + '</td>' +
                            '   <td>Fin : ' + rentalDate.endDate + '</td>' +
                            '</tr>' +
                            '<tr>');
                    });
                },
                error: function (err) {
                    alert("Une erreur c'est produite lors du chargement des données");
                }
            });
        }

        function verifDispo() {
            let idProd = $("#orders_orderProducts>option:selected").val();
            let startDate = $("#orders_orderStartDate").val();
            let endDate = $("#orders_orderEndDate").val();
            $.ajax({
                url: "/member/order/verifDispo",
                type: "GET",
                dataType: "json",
                data:{
                    prodId: idProd,
                    startDate: startDate,
                    endDate: endDate
                },
                success: (rentalDatesList) => {
                    if(rentalDatesList[0].dispo === false){
                        $("#error").html('Le produit n\'est pas disponible à la periode sélectionnée');
                        $("#orders_orderDispo").val(false)
                    } else {
                        $("#error").html('');
                        $("#orders_orderDispo").val(true);
                    }
                },
                error: function (err) {
                    alert("Une erreur c'est produite lors du chargement des données");
                }
            });
        }

        function dateDiff(date1, date2){
            var diff = {}                           // Initialisation du retour
            var tmp = date2 - date1;

            tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
            diff.sec = tmp % 60;                    // Extraction du nombre de secondes

            tmp = Math.floor((tmp-diff.sec)/60);    // Nombre de minutes (partie entière)
            diff.min = tmp % 60;                    // Extraction du nombre de minutes

            tmp = Math.floor((tmp-diff.min)/60);    // Nombre d'heures (entières)
            diff.hour = tmp % 24;                   // Extraction du nombre d'heures

            tmp = Math.floor((tmp-diff.hour)/24);   // Nombre de jours restants
            diff.day = tmp;

            return diff.day;
        }

    });
})