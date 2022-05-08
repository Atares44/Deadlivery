$(function() {
    $(document).ready( () => {
        $('#deleteModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let service = button.data('whatever');
            let url = "/admin/service-type/delete/";
            let modal = $(this)
            modal.find('.modal-title').text('Supprimer service n°' + service + ' ?')
            modal.find('.modal-body').text('Êtes-vous sûr de vouloir supprimer le service n°' + service + ' ?')
            modal.find('.modal-footer a').attr('href', url + service)
        })
    })
})
