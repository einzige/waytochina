function reorder() 
{
    if ($.tableDnD.currentTable == null) { return; }

    var model = $('#sortable').attr('rel');
    var post_data = $.tableDnD.serialize() + "&model=" + model;

    //$.post("/admin/ajax/order", post_data, function(msg){ alert(msg); });
    $.post("/admin/ajax/order", post_data, function(done){alert(done);});
}

$(document).ready(function()
{
    $('#sortable table').tableDnD({ onDragClass : "selected_row", 
                                    onDrop: function()
                                    {
                                        $.tableDnd.fix(); // FIXME hardcore fix
                                    }});
    $('#sortable button').click( function(){ reorder(); } );

    $('.confirmative').confirm({
        msg:'Хотите удалить?',
        timeout:7000,
        eventType:'mouseover',
        buttons: {
            ok:'Да',
            cancel:'Нет'
        }
    });
});
