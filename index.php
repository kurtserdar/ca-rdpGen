<?php
if (isset($_POST['fName'])){
$handle = fopen($_POST['fName'] . ".rdp", "w");
if (isset($_POST['flexRadioDefault1'])){
  fwrite($handle, "alternate shell:s:psm /u " . $_POST['pUser'] . $_POST['flexRadioDefault1'] . " /a " . $_POST['dIP'] . " /c " . $_POST['componentControl']."\nconnection type:i:7\nfull address:s:".$_POST['psmControl']."\nusername:s:" . $_POST['cUser'] . "\nauthentication level:i:2\nenablecredsspsupport:i:1\nnegotiate security layer:i:1") or die ("Unable to open file!");
  fclose($handle);
}
else {
  fwrite($handle, "alternate shell:s:psm /u " . $_POST['pUser'] . " /a " . $_POST['dIP'] . " /c " . $_POST['componentControl']."\nconnection type:i:7\nfull address:s:".$_POST['psmControl']."\nusername:s:" . $_POST['cUser'] . "\nauthentication level:i:2\nenablecredsspsupport:i:1\nnegotiate security layer:i:1") or die ("Unable to open file!");
fclose($handle);
}


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
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="pragma" content="no-cache" />

    <!-- Style -->
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <style>
    .hover_img a { position:relative; }
    .hover_img a span { position:absolute; display:none; z-index:99; }
    .hover_img a:hover span { display:block; }
    </style>


    <title>RDPGen</title>
  </head>

  <body>
  <div class="content">
    <div class="container">
      <div class="row align-items-stretch justify-content-center no-gutters">
        <div class="col-md-7">
          <div class="form h-100 contact-wrap p-5">
            <h3 class="text-center">RDPGen</h3>
            <form class="mb-5" method="post" id="rdpGenForm" name="rdpGenForm">
              <div class="row">
                <div class="col-md-12 form-group mb-3">
                  <label for="" class="col-form-label">CyberArk Hesabı</label>
                  <input type="text" class="form-control" name="cUser" id="cUser" placeholder="" required>
                  <div class="hover_img">
                    <small>
                      CyberArk hesabınız acme.local domain hesabı olmak ile birlikte genelde format <b>ad.soyad</b>
                      şeklindedir.
                    <a href="#">Örnek<span><img src="images/CyberArk-1.png" alt="image" height="400" /></span></a></small>
                  </div>
                </div>

                <div class="col-md-12 form-group mb-3">
                  <label for="" class="col-form-label">Sunucu Hesabı</label>
                  <input type="text" class="form-control" name="pUser" id="pUser" placeholder="" required>
                  <br>
                  <div class="col-md-12 form-group mb-3">
                    <div class="form-row">
                      <div class="col">
                        <input class="form-check-input" type="radio" name="flexRadioDefault1" value="@acme.local" id="flexRadioDefault1" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                      <small>Sahibinden</small>
                      </div>
                      <div class="col">
                        <input class="form-check-input" type="radio" name="flexRadioDefault1" value="@acmetest.local" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                      <small>Sahitestbox</small>
                      </div>
                      <div class="col">
                        <input class="form-check-input" type="radio" name="flexRadioDefault1" value="" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                      <small>Lokal</small>
                    </div>
                    </div>
                </div>
                    <div class="hover_img">
                      <small>
                      Hedef sunucuya bağlanırken kullandığınız ayrıcalıklı hedef hesabıdır. CyberArk kasasında saklanmaktadır.
                      Eğer ilgili hesap domain hesabı ise <b>Acme ya da Acmetest</b> işaretli olmalıdır.
                      <a href="#">Örnek<span><img src="images/CyberArk-2.png" alt="image" height="150" /></span></a></small>    
                    </div>
                  </div>
                </div>

              <div class="row">
                <div class="col-md-12 form-group mb-3">
                <label for="" class="col-form-label">Hedef Sunucu / Uygulama</label>
                <input type="text" class="form-control" name="dIP" id="dIP" placeholder="" required>
                <div class="form-text">
                    <small>
                    Bağlantı yapmak istediğiniz sunucu <b>IP/Hostname/FQDN</b> adresi.
                    </small>
                 </div>
                </div>
                <div class="col-md-12 form-group mb-3">
                <label class="col-form-label">Bağlantı Tipi</label>
                <select name="componentControl" class="form-control">
                  <option value="PSM-RDP">RDP</option>
                  <option value="PSM-SSH">SSH</option>
                  <option value="PSM-SQLServerMgmtStudio">MSSQL</option>
                  <option value="PSM-OpenShift">OpenShift - Chrome</option>
                  <option value="PSM-QlikView">QlikView - Chrome</option>
                  <option value="PSM-Fortigate">Fortigate - Chrome</option>
                  <option value="PSM-F5">F5 - Chrome</option>
                  <option value="PSM-Exchange">Exchange Admin - Chrome</option>
                  <option value="PSM-MDMAdmin">MDM Admin - Chrome</option>
                  <option value="PSM-Proofpoint">Proofpoint - Chrome</option>
                  <option value="PSM-Proofpoint-IE">Proofpoint - IE</option>
                  <option value="PSM-SEP">Symantec Endpoint Protection Manager - Client</option>
                  <option value="PSM-PVWA-v10">CyberArk PVWA - Chrome</option>
                  <option value="PSM-PTA-Chrome">CyberArk PTA - Chrome</option>
                  <option value="PSM-VMware-vSphere">VMWare vSPhere - Chrome</option>
                  <option value="PSM-UiPath">UiPath Orchestrator - Chrome</option>
                  <option value="PSM-Nessus">Nessus - Chrome</option>
                </select>
                <div class="form-text">
                    <small>
                    Hedef sunucuya bağlantı tipi?
                    </small>
                 </div>
                </div>
              </div>

              <div class="row mb-5">
                <div class="col-md-12 form-group mb-3">
                  <label class="col-form-label">PSM Sunucuları</label>
                  <select name="psmControl" class="form-control">
                    <option value="1.1.1.1">A PSM</option>
                    <option value="2.2.2.2">B PSM</option>
                    <option value="3.3.3.3">C PSM</option>
                    <option value="4.4.4.4">D PSM</option>
                  </select>
                  <div class="form-text">
                    <small>
                    Hangi CyberArk proxy sunucusu üzerinden bağlantı sağlanacak?
                    </small>
                 </div>
                </div>
                <div class="col-md-12 form-group mb-3">
                  <label for="" class="col-form-label">Dosya Adı</label>
                    <input type="text" class="form-control" name="fName" id="fName" placeholder="" value="" required>
                    <div class="form-text">
                    <small>
                    RDP dosyasını hangi isimle oluşturmak istersin?
                    </small>
                 </div>
                  </div>
              </div>
              <div class="row justify-content-center">
                <div class="col-md-5 form-group text-center">
                  <input type="submit" value="RDP Dosyası Oluştur" class="btn btn-block btn-primary rounded-0 py-2 px-10">
                </div>

              </div>
            </form>
          </div>
          <p><center><small>infosec@acme.com</small></center></p>
        </div>
        
      </div>
    </div>
  </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/main.js"></script>

  </body>
</html>