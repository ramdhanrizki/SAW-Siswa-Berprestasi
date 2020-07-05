(function($) {
    'use strict';

    function alert_berhasil(message) {
      swal({
            title: 'Berhasil',
            text: message,
            icon: 'success',
      });
    }

    function alert_gagal(message){
        swal({
            title: 'Terjadi Kesalahan',
            text: message,
            icon: 'error',
      });
    }
});