$(function() {
    $(document).ready(() => {
        //Elements de display
        let buttonDisplayForm = document.getElementById("displayFormButton");
        let formulaireDisplay = document.getElementById("formulaireDisplay");
        let formulaireOrderDisplay = document.getElementById("formulaireOrderDisplay");

        //Formulaire commande
        let validAdressButton = document.getElementById("validAdress");
        let validNewAdress = document.getElementById("boutonValidNewAdress");
        let formOrders = document.getElementById("formOrders");
        //Adresse de livraison
        let shippingNumber = document.getElementById("temp_orders_tempShippingANumber");
        let shippingStreet = document.getElementById("temp_orders_tempShippingAStreet");
        let shippingPostCode = document.getElementById("temp_orders_tempShippingAPostCode");
        let shippingTown = document.getElementById("temp_orders_tempShippingATown");
        let shippingCountry = document.getElementById("temp_orders_tempShippingACountry");
        //Adresse de facturation
        let billingNumber = document.getElementById("temp_orders_tempBillingANumber");
        let billingStreet = document.getElementById("temp_orders_tempBillingAStreet");
        let billingPostCode = document.getElementById("temp_orders_tempBillingAPostCode");
        let billingTown = document.getElementById("temp_orders_tempBillingATown");
        let billingCountry = document.getElementById("temp_orders_tempBillingACountry");
        //IDS
        let idAdressShippingElement = document.getElementById("idShippingAdresse");
        let idAdressBillingElement = document.getElementById("idBillingAdresse");

        //Formulaire nouvelle adresse
        let selectTypeAdressShipping = document.getElementById("shippingAdress");
        let selectTypeAdressBilling = document.getElementById("billingAdress");
        let formAdress = document.getElementById("formAdress");

        //Selection d'adresse
        let selectAdressShipping = document.getElementsByName("checkBoxAdressShipping");
        let selectAdressBilling = document.getElementsByName("checkBoxAdressBilling");
        let sameAdressCheckBox = document.getElementsByName("sameAdress");

        let idAdress, idAdressShipping, idAdressBilling;

        buttonDisplayForm.addEventListener("click", () => {
            if(getComputedStyle(formulaireDisplay).display != "none"){
                formulaireDisplay.style.display = "none";
                validAdressButton.style.display = "block";
                buttonDisplayForm.value = "Ajouter une nouvelle adresse";
            }else{
                formulaireDisplay.style.display = "block";
                validAdressButton.style.display = "none";
                buttonDisplayForm.value = "Masquer";
            }

        });

        selectTypeAdressShipping.addEventListener( 'change', function() {
            //Si l'utilisateur selectionne cette option, il ajoute une nouvelle adresse de livraison
            if(this.checked) {
                //On unchecked le bouton radio pour la livraison
                for (i = 0; i < selectAdressShipping.length; i++) {
                    selectAdressShipping[i].checked = false;
                }

            } else {
                //On checked le bouton radio pour la livraison
                for (i = 0; i < selectAdressShipping.length; i++) {
                    selectAdressShipping[i].checked = true;
                }
            }
        });

        selectTypeAdressBilling.addEventListener( 'change', function() {
            //Si l'utilisateur selectionne cette option, il ajoute une nouvelle adresse de livraison
            if(this.checked) {
                //On unchecked le bouton radio pour la livraison
                for (i = 0; i < selectAdressBilling.length; i++) {
                    selectAdressBilling[i].checked = false;
                }

            } else {
                //On checked le bouton radio pour la livraison
                for (i = 0; i < selectAdressBilling.length; i++) {
                    selectAdressBilling[i].checked = true;
                }
            }
        });

        //Si l'utilisateur utilise des adresses déjà rentrées
        validAdressButton.addEventListener("click", function (event){
            event.preventDefault();
            validAdress(false,false);
        });

        validNewAdress.addEventListener("click", function (event){
            event.preventDefault();
            newAdress();
        });

        //Si l'utilisateur ajoute une nouvelle adresse
        function newAdress(){
            let adressNumber = document.getElementById("adress_adressNumber");
            let adressStreet = document.getElementById("adress_adressStreet");
            let adressPostCode = document.getElementById("adress_adressPostCode");
            let adressTown = document.getElementById("adress_adressTown");
            let adressCountry = document.getElementById("adress_adressCountry");

            let shipping, billing = false;

            //Si on choisit une adresse de livraison
            if(selectTypeAdressShipping.checked){
                //On retire l'id de livraison pour signaler que c'est une nouvelle adresse
                idAdressShippingElement.value = "-2";
                //On remplit les données entrées par l'utilisateur dans le formOrder
                shippingNumber.value = adressNumber.value;
                shippingStreet.value = adressStreet.value;
                shippingPostCode.value = adressPostCode.value;
                shippingTown.value = adressTown.value;
                shippingCountry.value = adressCountry.value;
                shipping = true;
            }

            //Si il choisit adresse de facturation
            if(selectTypeAdressBilling.checked){
                idAdressBillingElement.value = "-2";
                //On remplit les données entrées par l'utilisateur dans le formOrder
                billingNumber.value = adressNumber.value;
                billingStreet.value = adressStreet.value;
                billingPostCode.value = adressPostCode.value;
                billingTown.value = adressTown.value;
                billingCountry.value = adressCountry.value;
                billing = true;
            }

            //On appelle validAdress pour que le reste des données soit en ajax si besoin
            validAdress(shipping, billing);
        }

        //Si l'utilisateur choisit une adresse déjà existante
        function validAdress(shipping, billing){
            //Adresse de livraison
            for (i = 0; i < selectAdressShipping.length; i++) {
                if (selectAdressShipping[i].checked) {
                    if(idAdressShippingElement.value != "-2"){
                        idAdress = selectAdressShipping[i].value;
                        idAdressShipping = selectAdressShipping[i].value;
                    }else if(idAdressShippingElement.value == "-2"){
                        idAdressShipping = "-2";
                    }
                }
            }

            //Adresse de facturation
            for (i = 0; i < selectAdressBilling.length; i++) {
                if (selectAdressBilling[i].checked) {
                    if(idAdressBillingElement.value != "-2"){
                        idAdressBilling = selectAdressBilling[i].value;
                    }else if(idAdressBillingElement.value == "-2"){
                        idAdressBilling = "-2";
                    }
                }
            }

            idAdressShippingElement.value = idAdressShipping;
            idAdressBillingElement.value = idAdressBilling;

            //On récupère les éléments de l'adresse choisit via l'ajax
            $.ajax({
                url: "/member/order/recupadress",
                type: "GET",
                dataType: "json",
                data:{
                    adressId: idAdress,
                    adressShippingId: idAdressShipping,
                    adressBillingId: idAdressBilling,
                },
                success: (adresses) => {

                    $.each(adresses, function (key, adress) {
                        //Si l'utilisateur n'ajoute pas d'adresse
                        if(!shipping && !billing){
                            //Si l'utilisateur souhaite utiliser la même adresse pour livraison et facturation
                            if(sameAdressCheckBox.selected){
                                //Insertion des données de l'adresse dans le formulaire
                                shippingNumber.value = adress.adressNumber;
                                shippingStreet.value = adress.adressStreet;
                                shippingPostCode.value = adress.adressPostCode;
                                shippingTown.value = adress.adressTown;
                                shippingCountry.value = adress.adressCountry;

                                billingNumber.value = adress.adressNumber;
                                billingStreet.value = adress.adressStreet;
                                billingPostCode.value = adress.adressPostCode;
                                billingTown.value = adress.adressTown;
                                billingCountry.value = adress.adressCountry;
                            }else{
                                //Insertion des données de l'adresse dans le formulaire
                                shippingNumber.value = adress.adressShippingNumber;
                                shippingStreet.value = adress.adressShippingStreet;
                                shippingPostCode.value = adress.adressShippingPostCode;
                                shippingTown.value = adress.adressShippingTown;
                                shippingCountry.value = adress.adressShippingCountry;

                                billingNumber.value = adress.adressBillingNumber;
                                billingStreet.value = adress.adressBillingStreet;
                                billingPostCode.value = adress.adressBillingPostCode;
                                billingTown.value = adress.adressBillingTown;
                                billingCountry.value = adress.adressBillingCountry;
                            }
                        }
                            //Si l'utilisateur ajoute une adresse de livraison
                        //Cela signifie que l'adresse de facturation doit être remplie
                        else if(shipping){
                            billingNumber.value = adress.adressBillingNumber;
                            billingStreet.value = adress.adressBillingStreet;
                            billingPostCode.value = adress.adressBillingPostCode;
                            billingTown.value = adress.adressBillingTown;
                            billingCountry.value = adress.adressBillingCountry;
                        }
                        //Si l'utilisateur ajoute une adresse de facturation
                        else if(billing){
                            //On insère dans le formulaire les données manquantes
                            shippingNumber.value = adress.adressShippingNumber;
                            shippingStreet.value = adress.adressShippingStreet;
                            shippingPostCode.value = adress.adressShippingPostCode;
                            shippingTown.value = adress.adressShippingTown;
                            shippingCountry.value = adress.adressShippingCountry;
                        }

                    });

                    formOrders.submit();
                },
                error: function (err) {
                    alert("Une erreur s'est produite lors du chargement des données");
                }
            });
        }

    });
});