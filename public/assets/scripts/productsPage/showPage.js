$("#orderByProduct").click( () => {
    autoComplete();
});

function autoComplete(){
    let prodId = $("#productName").val();
    $.ajax({
        url: "/member/order/whatService",
        type: "GET",
        dataType: "json",
        data:{
            productId: prodId
        },
        success: (products) => {
            $.each(products, function (key, product) {
                window.location.href = "/member/order/new"+"/?productId="+product.id+"&serviceId="+product.serviceId;
            });

        },
        error: function (err) {
            alert("Une erreur c'est produite lors du chargement des données");
        }
    });
}