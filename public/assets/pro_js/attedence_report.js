$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


});
    // Hide submenus
$('#body-row .collapse').collapse('hide'); 

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left'); 

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function() {
    SidebarCollapse();
});

function SidebarCollapse () {
    $('.menu-collapsed').toggleClass('d-none');
    $('.sidebar-submenu').toggleClass('d-none');
    $('.submenu-icon').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
    
    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $('.sidebar-separator-title');
    if ( SeparatorTitle.hasClass('d-flex') ) {
        SeparatorTitle.removeClass('d-flex');
    } else {
        SeparatorTitle.addClass('d-flex');
    }
    
    // Collapse/Expand icon
    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
}
$('#home').click(function(){
    $('#home_page').removeClass('d-none');
    $('#checkin_page').addClass('d-none');
    $('#checkout_page').addClass('d-none');
    $('#attedence_report_page').addClass('d-none');



})
$('#check_in').click(function(){
  $.ajax({
        type: "POST",
        url: check_in_check,
        data: {},
        success: function (data) {
          console.log(data.length)
          if(data.length == 0){
            $('#before_check_in').removeClass('d-none');
            $('#after_check_in').addClass('d-none');

          }
          else{
            $('#before_check_in').addClass('d-none');
            $('#after_check_in').removeClass('d-none');

          }
        }
    });
    $('#home_page').addClass('d-none');
    $('#checkin_page').removeClass('d-none');
    $('#checkout_page').addClass('d-none');
    $('#attedence_report_page').addClass('d-none');



})
$('#check_out').click(function(){
  $.ajax({
        type: "POST",
        url: check_out_check,
        data: {},
        success: function (data) {
          console.log(data.length)
          if(data.length != 0){
            $('#before_check_out').removeClass('d-none');
            $('#after_check_out').addClass('d-none');

          }
          else{
            $('#before_check_out').addClass('d-none');
            $('#after_check_out').removeClass('d-none');

          }
        }
    });
    $('#home_page').addClass('d-none');
    $('#checkin_page').addClass('d-none');
    $('#checkout_page').removeClass('d-none');
    $('#attedence_report_page').addClass('d-none');



})
$('#attedence_report').click(function(){
    $('#attedence_report_page').removeClass('d-none');
    $('#home_page').addClass('d-none');
    $('#checkin_page').addClass('d-none');
    $('#checkout_page').addClass('d-none');


})
$('#attedence_report_1').click(function(){
    $('#attedence_report_page').removeClass('d-none');
    $('#home_page').addClass('d-none');
    $('#checkin_page').addClass('d-none');
    $('#checkout_page').addClass('d-none');


})


$('#check_in_btn').click(function(){
    $.ajax({
        type: "POST",
        url: check_in_process,
        data: {},
        success: function (data) {
          if(data==1){
            $('#after_check_in').removeClass('d-none');
            $('#before_check_in').addClass('d-none');
            location.reload();
          }
          else{
            alert('failed');
          }
        }
    });
})
$('#check_out_btn').click(function(){
    $.ajax({
        type: "POST",
        url: check_out_process,
        data: {},
        success: function (data) {
          if(data==1){
            location.reload();

          }
          else{
            alert('failed');
          }
        }
    });
})
$('#check_out_restore_btn').click(function(){
    $.ajax({
        type: "POST",
        url: restore_process,
        data: {},
        success: function (data) {
          if(data==1){
            location.reload();
          }
          else{
            alert('failed');
          }
        }
    });
})
$(document).ready( function() {
  $('#home_page').removeClass('d-none');

   get_dashboard();
} ); 
$('#date').change(function(){
  get_dashboard_filter()
})
function get_dashboard_filter() {
  table_cot_1 = $('#attedence_table').DataTable({

      dom: 'lBfrtip',
      oLanguage: {
      },
      lengthMenu: [[15, 50, 100, 250, 500, -1], [15, 50, 100, 250, 500, "All"]],
      processing: true,
      serverSide: true,
      serverMethod: 'post',
      bDestroy: true,
      scrollCollapse: true,
      autoWidth: false,
      ajax: {
          url: attedence_report_data,
          type: 'POST',
          data: function (d) {
            var date = $('#date').val();
            d.date=date;
          }
      },
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'date', name: 'date' },
          { data: 'user_id', name: 'user_id' },
          { data: 'name', name: 'name' },
          { data: 'check_in_time', name: 'check_in_time' },
          { data: 'check_out_time', name: 'check_out_time' },
          { data: 'break_time', name: 'break_time' },
          { data: 'logged_time', name: 'logged_time' },
      ],
   
})}
function get_dashboard() {
        table_cot_1 = $('#attedence_table').DataTable({

            dom: 'lBfrtip',
            oLanguage: {
            },
            lengthMenu: [[15, 50, 100, 250, 500, -1], [15, 50, 100, 250, 500, "All"]],
            processing: true,
            serverSide: true,
            serverMethod: 'post',
            bDestroy: true,
            scrollCollapse: true,
            autoWidth: false,
            ajax: {
                url: attedence_report_data,
                type: 'POST',
                data: function (d) {

                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'date', name: 'date' },
                { data: 'user_id', name: 'user_id' },
                { data: 'name', name: 'name' },
                { data: 'check_in_time', name: 'check_in_time' },
                { data: 'check_out_time', name: 'check_out_time' },
                { data: 'break_time', name: 'break_time' },
                { data: 'logged_time', name: 'logged_time' },
            ],
         
    })}
