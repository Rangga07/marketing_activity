$(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    // Kita sembunyikan dulu untuk loadingnya
    
    $("#rbb_kredit_all").change(function(){ // Ketika user mengganti atau memilih data provinsi
      $("#rbb_kredit_bul").hide(); // Sembunyikan dulu combobox kota nya
     
      $.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "option_tahun.php", // Isi dengan url/path file php yang dituju
        data: {tahun : $("#rbb_kredit_all").val()}, // data yang akan dikirim ke file yang dituju
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){ // Ketika proses pengiriman berhasil
          $("#loading").hide(); // Sembunyikan loadingnya
          // set isi dari combobox kota
          // lalu munculkan kembali combobox kotanya
          $("#rbb_kredit_bul").html(response.data_rbb_kredit_bul).show();
        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
          alert(thrownError); // Munculkan alert error
        }
      });
      });
  });