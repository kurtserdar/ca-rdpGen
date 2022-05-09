<?php
if (isset($_POST['fName'])){
$handle = fopen($_POST['fName'] . ".rdp", "w");
fwrite($handle, "alternate shell:s:psm /u " . $_POST['pUser'] . "@domain-name.local /a " . $_POST['dIP'] . " /c PSM-RDP\nconnection type:i:7\nfull address:s:".$_POST['psmControl']."\nusername:s:" . $_POST['cUser'] . "\nauthentication level:i:2\nenablecredsspsupport:i:1\nnegotiate security layer:i:1") or die ("Unable to open file!");
fclose($handle);

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($_POST['fName'] . ".rdp"));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($_POST['fName'] . ".rdp"));
flush();
readfile($_POST['fName'] . ".rdp");
fpassthru($_POST['fName'] . ".rdp");
unlink($_POST['fName'] . ".rdp");

exit;
}

 ?>

<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Serdar KURT">
    <meta name="generator" content="CyberArk RDP Generator">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>RDPGen</title>




<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <link href="cover.css" rel="stylesheet">
  </head>


  <body class="d-flex h-100 text-center text-white bg-dark">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">RDPGen</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
      <a class="nav-link active" aria-current="page" href="index.php">Ana Sayfa</a>
      </nav>
    </div>
  </header>
  <hr>

  <main class="px-3">
    <h2></h2>
    <form action="" method="POST">
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
        <label class="form-label">CyberArk Hesabı</label>
        <input type="text" required maxlength="41" name="cUser" class="form-control" autocomplete="off" oninvalid="this.setCustomValidity('Doldurulması zorunlu alan')" oninput="setCustomValidity('')"/>

        <div class="form-text">
    CyberArk hesabınız sahibinden.com.local domain hesabı olmak ile birlikte genelde format "ad.soyad" şeklindedir.
        </div>
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
        <label class="form-label">Sunucu Hesabı</label>
        <input type="text" required maxlength="41" name="pUser" class="form-control" autocomplete="off" oninvalid="this.setCustomValidity('Doldurulması zorunlu alan')" oninput="setCustomValidity('')"/>
      </div>
      <div class="form-text">
  Hedef sunucuya bağlanırken kullandığınız ayrıcalıklı hedef hesabıdır. CyberArk kasasında saklanmaktadır.
      </div>
    </div>
  </div>

  <!-- Text input -->
  <div class="form-outline mb-4">
    <label class="form-label">Hedef Sunucu IP</label>
    <input type="text" required maxlength="41" name="dIP" class="form-control" autocomplete="off" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$" oninvalid="this.setCustomValidity('Doldurulması zorunlu alan / IP formatına uygun mu?')" oninput="setCustomValidity('')"/>
    <div class="form-text">
RDP yapmak istediğiniz sunucu IP adresi.
    </div>
  </div>


<div class="form-outline mb-4">
  <label class="form-label">Bağlantı Tipi</label>
  <select name="componentControl" class="form-control">
  <option value="PSM-RDP">RDP</option>
  </select>
  <div class="form-text">
  Hedef sunucuya bağlantı tipi?
  </div>
</div>



<div class="form-outline mb-4">
  <label class="form-label">PSM Sunucuları</label>
  <select name="psmControl" class="form-control">
  <option value="1.1.1.1">Istanbul PSM</option>
  <option value="2.2.2.2">Ankara PSM</option>
  <option value="3.3.3.3">Izmir PSM</option>
  <option value="4.4.4.4">Adana PSM</option>
  </select>
  <div class="form-text">
  Hangi CyberArk proxy sunucusu üzerinden bağlantı sağlanacak?
  </div>
</div>

  <!-- Submit button -->
  <div class="form-outline mb-4">
    <label class="form-label">Dosya Adı</label>
    <input type="text" required maxlength="41" name="fName" value="CA-RDP" class="form-control" autocomplete="off" oninvalid="this.setCustomValidity('Doldurulması zorunlu alan')" oninput="setCustomValidity('')"/>
    <div class="form-text">
    RDP dosyasını hangi isimle oluşturmak istersin?
    </div>
  </div>
  <button type="submit" class="btn btn-primary btn-block mb-4">RDP Dosyası Oluştur</button>
</form>
  </main>
  <footer class="mt-auto text-white-50">
    <hr>
    <div class="form-text">
      v1
    </div>
  </footer>
</div>
  </body>
</html>