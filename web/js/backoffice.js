function mostrarVista(view) {
    $("#contenido_principal").html(view);
}

function loadTipo(view) {
    $(".loadTipo").html(view);
}

function tipoSelected(){
    var categoriaId = $(".tipoSelected").val();
    $.ajax({
        type: "GET",
        url: "index.php?r=productos%2Fget_tipo&id="+categoriaId,
        datatype: 'html',
        success: function (viewHTML) {
            loadTipo(viewHTML);
            if(categoriaId==1){
                $('#datetimepicker').datetimepicker({
                    viewMode: 'years',
                    format: 'YYYY-MM-DD'
                });
            }
        },
        error: function (errorData) {
            alert("Fail!!");
        }
    })
}

$(document).ready(function () {
    tipoSelected();
    $(document).on("change", ".tipoSelected", function () {
        tipoSelected();
    })
})