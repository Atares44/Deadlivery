$(function() {
    $(document).ready( () => {
        
        let productListOrigine = document.getElementById('zombiesCards').children;
        const cards = Array.from(productListOrigine);

        $("#selectServUser").change( () => {
            updateProducts();
        })

        $("#selectServ").change( () => {
            updateProductsAdmin();
        })

        function updateProducts() {
            let idServ = $("#selectServUser>option:selected").val();
            console.log("idServ:",idServ);
            $.ajax({
                url: "/updateProductListAvailable",
                type: "GET",
                dataType: "json",
                data: {
                    serviceId: idServ
                },
                success: (products) => {
                    let productList = $(".products");
                    productList.html('');
                    if(idServ != "Choisissez un service") {
                        $.each(products, function (key, product) {

                                productList.append(
                                    '<li class="customItem card product">\n' +
                                    '<img src="/assets/images/products/' + product.productImg + '" class="product-img mx-auto" alt="' + product.productName + '" height="300" width="200">\n' +
                                    '\n' +
                                    '<div class="card-body">\n' +
                                    '   <div class="icones">\n' +
                                    '       <img class="float-left ml-n4" src="/assets/images/icones/ddlvry-grphcs-' + product.productNature + '.svg" alt="' + product.productNature + '" width="150" height="150">\n' +
                                    '       \n' +
                                    '       <div class="float-right mr-n4 text-white">\n' +
                                    '           <img src="/assets/images/icones/ddlvry-grphcs-averageNote.svg" alt="note" width="150" height="150">\n' +
                                    '           <h3 class="card-text">' + product.averageNote + '</h3>\n' +
                                    '       </div>\n' +
                                    '   </div>\n' +
                                    '       \n' +
                                    '       <div class="text">\n' +
                                    '           <h2 class="card-title">' + product.productName + '</h2>\n' +
                                    '           <h6 class="card-text h6">Zombie ' + product.productNature + '</h6>\n' +
                                    '           <a href="https://127.0.0.1:8000/products/' + product.id + '" class="details btn">\n' +
                                    '               <img src="/assets/images/icones/ddlvry-grphcs-show.svg" alt="details" width="50" height="50">\n' +
                                    '           </a>\n' +
                                    '       </div>\n' +
                                    '</div>\n' +
                                    '</li>'
                                )
                            }
                        );
                    }
                    else {
                        cards.forEach(element => 
                            productList.append(
                                element
                            ) 
                        );                                          
                    }
                },
                error: function (err) {
                    alert("Une erreur s'est produite lors du chargement des données");
                }
            });
        }

        function updateProductsAdmin() {
            let idServ = $("#selectServ>option:selected").val();
            $.ajax({
                url: "/updateProductListAvailable",
                type: "GET",
                dataType: "json",
                data: {
                    serviceId: idServ
                },
                success: (products) => {
                    let produtList = $("table > tbody");

                    produtList.html('');

                    $.each(products, function (key, product) {

                            produtList.append(
                                '<tr>\n'+
                                '   <th scope="row">'+product.id+'</th>\n'+
                                '   <td>'+product.productName+'</td>\n'+
                                '   <td>'+product.productService+'</td>\n'+
                                '   <td>'+product.productNature+'</td>\n'+
                                '   <td>'+product.averageNote+'</td>\n'+
                                '   <td>'+product.productStatus+'</td>\n'+
                                '   <td>\n'+
                                '       <a href="/admin/products/delete/'+product.id+'" class="btn btn-danger btn-sm delete">Supprimer'+
                                '           <img class="delete-img" src="/assets/images/icones/ddlvry-grphcs-delete.svg" alt="delete" width="41" height="41">'+
                                '       </a>'+
                                '   </td>\n'+
                                '</tr>'
                            )
                        }
                    );
                },
                error: function (err) {
                    alert("Une erreur s'est produite lors du chargement des données");
                }
            });
        }

        $('#deleteModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let product = button.data('whatever');
            let url = "/admin/products/delete/";
            let modal = $(this)
            modal.find('.modal-title').text('Supprimer produit n°' + product + ' ?')
            modal.find('.modal-body').text('Êtes-vous sûr de vouloir supprimer le produit n°' + product + ' ?')
            modal.find('.modal-footer a').attr('href', url + product)
        })
    })
})
