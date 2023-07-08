
$(function() {
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    // $(function () {
    //     $('#tanggal_awal').datetimepicker();
    //     $('#tanggal_akhir').datetimepicker();
    // });

    // function setDatePicker(input){
    //     $(input).datetimepicker({
    //       format: "YYYY-MM-DD",
    //       useCurrent: false
    //     })
    //   }

    // $(document).ready(function(){
    //     $('#tanggal_awal').datetimepicker();
    // })

    $(document).ready(function(){
        $('.datepicker').datepicker({
            language: "es",
            autoclose: true,
            format: "yyyy/mm/dd",
            // format: "dd/mm/yyyy",
            // startDate: '-2m',
            endDate: '0d'
          });
    })

});