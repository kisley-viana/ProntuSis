//excluir
$("#tbProntuario tbody").on('click','tr button[name=prontuarioDelete]',function()
{
    var id = $(this).attr('prontuario');

    $("#id_prontuario_excluir").val(id);
    
    $("#mdlProntuarioDeletar").modal({backdrop: "static"}).show();
});
