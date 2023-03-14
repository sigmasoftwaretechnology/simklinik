$(document).ready(function(){$("input").attr("autocomplete", "off");});
// flash data untuk notifikasi
const success = $('.flash-sukses').data('flashdata');
const error = $('.flash-error').data('flashdata');
const warning = $('.flash-warning').data('flashdata');
const info = $('.flash-info').data('flashdata');
var baseurl = $('.base-url').data('url');

if(success){
  toastr.options = {
    "closeButton": true,
    "newestOnTop": true,
    "positionClass": "toast-bottom-right",
  };
  toastr.success(success);
  console.log(success);
} else if (error) {
  toastr.options = {
    "closeButton": true,
    "newestOnTop": true,
    "positionClass": "toast-bottom-right",
  };
  toastr.error(error);
  console.log(error);
} else if (warning) {
  toastr.options = {
    "closeButton": true,
    "newestOnTop": true,
    "positionClass": "toast-bottom-right",
  };
  toastr.warning(warning);
} else if (info) {
  toastr.options = {
    "closeButton": true,
    "newestOnTop": true,
    "positionClass": "toast-bottom-right",
  };
  toastr.info(info);
}
var warna = 'navy';
  $(document).ready(function () {
    $('polygon').attr('stroke', warna);
    $('text').attr('stroke', warna);
    $('text').attr('fill', warna);
    $('polygon').mouseover(function (evt) {
      var sector = $(evt.target);
      var gigi = sector.attr('id');
      var warna = sector.attr('fill');
      var nomor = sector.parent().attr('id');
      $.ajax({
          type : "POST",
          url  : baseurl+"/medis/getnamasimbol",
          dataType : "JSON",
          data : {warna: warna},
          cache:false,
        success: function(data){
          $('#kondisi-gigi').html(data.nama+' ('+data.singkatan+')');
        },
        error: function(jqXHR, textStatus, errorThrown){
          $('#kondisi-gigi').html('Data tidak ditemukan');
        }

      })
      $('#nomorgigi').html(nomor);
      $('#posisigigi').html(gigi);
      $('#kposisi').html(nomor+'-'+gigi);
    });
    $('polygon').mouseout(function (evt) {
      $('#nomorgigi').html('XX');
      $('#posisigigi').html('X');
      $('#kondisi-gigi').html('--');
      $('#kposisi').html('');
    });
    $('polygon').click(function (evt) {
      const idpasien = $('.id-pasien').data('id');
      var sector = $(evt.target);
      var posisigigi = sector.parent().attr('id') + '-' + sector.attr('id');
      window.location.href = baseurl+'medis/addrekammedis/'+idpasien+'/'+posisigigi+'.html';
    });
});