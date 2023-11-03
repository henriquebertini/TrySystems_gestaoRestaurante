$(document).ready(function() {

    $('#estoqueModal').on('show.bs.modal', function() {
        $.ajax({
            type: 'POST',
            url: '../processamento/processamento_estoque.php',
            data: { action: 'get' },
            dataType: 'json',
            success: function(data) {
            }
        });
    });

    $('#estoqueForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../processamento/processamento_estoque.php',
            data: $(this).serialize() + '&action=save',
            success: function(response) {
            }
        });
    });

    $(document).on('click', '.deleteBtn', function() {
        let id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: '../processamento/processamento_estoque.php',
            data: { id: id, action: 'delete' },
            success: function(response) {
            }
        });
    });

});