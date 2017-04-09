window.setTimeout("waktu()",1000);
      function waktu(){
        var tanggal = new Date();
        setTimeout("waktu()",100);
        document.getElementById("jam").innerHTML = tanggal.getHours();
        document.getElementById("menit").innerHTML = tanggal.getMinutes();
        document.getElementById("detik").innerHTML = tanggal.getSeconds();
      }