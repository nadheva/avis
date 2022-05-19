var typebaan = document.getElementsByClassName("typebaan");
var routesbaan = document.getElementsByClassName("routesbaan");
var approvalbaan = document.getElementsByClassName("approvalbaan");
var labelrouteclass = document.getElementsByClassName("labelroute");
var labelapprovalclass = document.getElementsByClassName("labelapproval");
var labelactivityclass = document.getElementsByClassName("labelactivity");
var routes1 = `<div class="form-group"><input type="text" class="form-control" name="route[]" value="1" readonly></div>`;
var routes2 = `<br><div class="form-group"><input type="text" class="form-control" name="route[]" value="2" readonly></div>`;
var routes3 = `<br><div class="form-group"><input type="text" class="form-control" name="route[]" value="3" readonly></div>`;
var routes4 = `<br><div class="form-group"><input type="text" class="form-control" name="route[]" value="4" readonly></div>`;
var routes5 = `<br><div class="form-group"><input type="text" class="form-control" name="route[]" value="5" readonly></div>`;
var routes6 = `<br><div class="form-group"><input type="text" class="form-control" name="route[]" value="6" readonly></div>`;
var routes7 = `<br><div class="form-group"><input type="text" class="form-control" name="route[]" value="7" readonly></div>`;
var routes8 = `<br><div class="form-group"><input type="text" class="form-control" name="route[]" value="8" readonly></div>`;
var routes9 = `<br><div class="form-group"><input type="text" class="form-control" name="route[]" value="9" readonly></div>`;
var labelapproval = `<label>Approval</label>`;
var labelroute= `<label>Route</label>`;
var labelactivity1 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="1. [Requestor] Mengisi Master Data Request & lengkapi Sheet Item Details (Format bisa didownload di system) <br> 1-b [Requestor Head] Cek dan approve Form Master Data <br> 2. [PUR] Input Info Purchase Price di sheet Item Details <br> 3. [PUR Head] Cek data input dan approve Form Master Data <br> 2. [ACC] Input GID, Cek Subentities Data, & input item data by warehouse untuk inventory item <br> 3. [ACC] Input Simulated Purchased Price <br> 4. [ACC] Calculate Standard Cost <br> 5. [ACC] Melampirkan screenshoot perubahan BAAN <br> 6. [ACC Head] Approval Form Master Data <br> 7. [ACC] Upload Form Master Data ke server (atau otomatis dilakukan by sistem)"><i class="material-icons">help</i></div>`;
var labelactivity2 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="1. [R&D] Mengisi Master Data Request, sheet Item Detail, BOM dan Routing <br> 1-b [R&D Head] Cek Form Master Data dan informasi dalam Item detail, BOM dan Routing <br> 2. [ENG] Lengkapi form data Routing <br> 2-b [ENG Head] Cek data routing dan approval Form Master Data
2. [PPC] Lengkapi sheet Item Details (informasi POU & Loc ID) <br> 3. [PPC] Lengkapi sheet Item detail (item ordering, Item purchasing, item sales) <br> 4. [PPC] cek form item data by warehouse <br> 4b.[PPC Head] Cek Item detail dan approval Form Master Data. <br> 5. [R&D] Create dan upload sheet GID ke BAAN <br> 6. [R&D] Create dan upload sheet Item by Warehousing ke BAAN <br> 7. [R&D] Create dan upload BOM_upload sesuai dengan sheet BOM <br> 8. [R&D] Input Item detail dan subentities di BAAN sesuai tabel di item detail
8. [PUR] Melengkapi info purchase price di Item Detail <br> 9. [PUR Head] Memvalidasi informasi purchase price dan approval Form Master Data <br> 10. [ACC] Input Simulated Purchased Price <br> 11. [ACC] Calculate Standard Cost <br> 12. [ACC Head] Approval Form Master Data
13. [PPC] Create PRO testing, cek BOM & routing <br> 14. [PPC] Konfirmasi PRO tidak ada kendala dan menginformasikan team R&D"><i class="material-icons">help</i></div>`;
var labelactivity3 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="1. [R&D] Mengisi Master Data Request dan Sheet item detail <br> 1-b [R&D Head] Cek Form Master Data dan informasi dalam Item detail <br> 2. [PPC] Lengkapi sheet Item Details (informasi POU & Loc ID) <br> 3. [PPC] Lengkapi sheet Item detail (item ordering, Item purchasing, item sales) <br> 4. [PPC] cek form item data by warehouse <br> 4b.[PPC Head] Cek Item detail dan approval Form Master Data. <br> 5. [R&D] Create dan upload sheet GID ke BAAN <br> 6. [R&D] Create dan upload sheet Item by Warehousing ke BAAN <br> 7. [R&D] Input Item detail dan subentities di BAAN sesuai tabel di item detail <br> 8. [PUR] Melengkapi info purchase price di Item Detail <br> 9. [PUR Head] Memvalidasi informasi purchase price dan approval Form Master Data <br> 10. [ACC] Input Simulated Purchased Price <br> 11. [ACC] Calculate Standard Cost <br> 12. [ACC] Approval Form Master Data <br> 13. Uplaod Form full approval ke system"><i class="material-icons">help</i></div>`;
var labelactivity4 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="1. [R&D] Mengisi Master Data Request, sheet Item Detail, BOM dan Routing <br>
1-b [R&D Head] Cek Form Master Data dan informasi dalam Item detail, BOM dan Routing <br>
2. [PPC] Lengkapi sheet Item Details (informasi POU & Loc ID) <br>
3. [PPC] Lengkapi sheet Item detail (item ordering, Item purchasing, item sales) <br>
4. [PPC] cek form item data by warehouse <br>
4b.[PPC Head] Cek Item detail dan approval Form Master Data <br>
5. [R&D] Create dan upload sheet GID ke BAAN <br>
6. [R&D] Create dan upload sheet Item by Warehousing ke BAAN <br>
7. [R&D] Create dan upload BOM_upload sesuai dengan sheet BOM <br>
8. [R&D] Input Item detail dan subentities di BAAN sesuai tabel di item detail <br>
8. [PUR] Melengkapi info purchase price di Item Detail  <br>
9. [PUR Head] Memvalidasi informasi purchase price dan approval Form Master Data <br>
10. [ACC] Input Simulated Purchased Price <br>
11. [ACC] Calculate Standard Cost <br>
12. [ACC] Approval Form Master Data <br>
11. [PPC] Cek PRO open atas BOM yang direvisi, complete PRO lama, create PRO baru <br>
12. [PPC] cek apakah ada cogi gantung, buat memo ke accounting untuk penyelesaian cogi karena penggantian P/N <br>
13. [ACC] Melakukan penyelesaian COGI berdasarkan memo <br>
13. [ACC Head] Mengecek dan approval Memo adjustment. Menginformasikan ke R&D bahwa prosesnya telah selesai. <br>
14. [R&D] Upload Form Master Data full approval ke system"><i class="material-icons">help</i></div>`;
var labelactivity5 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="1. [R&D] Mengisi Master Data Request, sheet BOM dan Routing <br>
1-b [R&D Head] Cek Form Master Data dan informasi dalam  BOM dan Routing <br>
2. [ENG] Lengkapi sheet Routing <br>
2-b [ENG Head] Cek data routing dan approval Form Master Data <br>
3. [R&D] Create dan upload  BOM_upload sesuai dengan sheet BOM <br>
4. [R&D] Input Routing di BAAN <br>
5. [ACC] Input Simulated Purchased Price <br>
6. [ACC] Calculate Standard Cost <br>
12. [ACC Head] Approval Form Master Data <br>
7. [PPC] Create PRO testing, cek BOM & routing <br>
8. [PPC Head] Konfirmasi PRO tidak ada kendala dan menginformasikan team R&D <br>
9. [R&D] Mengupload Form Master Data full approval ke system <br>
"><i class="material-icons">help</i></div>`;
var labelactivity6 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="1. [Requestor] Mengisi Form Master Data Request & sheet Item Detail <br>
2. [ACC] Input GID, cek & update item subentities data untuk P/N baru <br>
3. [ACC] ubah deskripsi P/N lama menjadi [BLOK] P/N baru <br>
4. [ACC] Calculate Standard Cost <br>
5. [PUR] cek PR yang masih open terhadap item lama, jika ada, info ke requestor PR <br>
6. [PUR] Follow up Revisi PR oleh requestor PR (addline item PR menggunakan P/N Baru) <br>
7. [PUR] cek PO yang masih open terhadap P/N lama <br>
8. [PUR] Cancel line PO atas P/N lama dan addline menggunakan P/N Baru <br>
9. [ACC] Blok Item yang sudah tidak digunakan di GID <br>
"><i class="material-icons">help</i></div>`;
var labelactivity7 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="1. [Requestor] Mengisi Master Data Request & lengkapi form GID <br>
2. [ACC] Input GID, cek & update item subentities data, input item data by warehouse untuk P/N baru <br>
3. [ACC] ubah deskripsi P/N lama di GID menjadi [BLOK] P/N baru <br>
4. [ACC] Input Simulated Purchased Price <br>
5. [ACC] Calculate Standard Cost <br>
12. [ACC Head] Approval Form Master Data <br>
6. [PUR] cek PR yang masih open terhadap item lama, jika ada, info ke requestor PR <br>
7. [PUR] Follow up Revisi PR oleh requestor PR (addline item PR menggunakan P/N Baru) <br>
8. [PUR] cek PO yang masih open terhadap P/N lama <br>
9. [PUR] Cancel line PO atas P/N lama dan addline menggunakan P/N Baru <br>
10. [ACC] cek stock P/N lama di seluruh W/H, info ke PIC store apabila masih ada stock <br>
11. [ACC] follow up PIC store untuk membuat memo permohonan adjustment stock <br>
12. [ACC] Melakukan adjustment berdasarkan memo <br>
13. [ACC] Blok Item yang sudah tidak digunakan di GID <br>
"><i class="material-icons">help</i></div>`;
var labelactivity8 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="1. [R&D] Mengisi Form Master Data Request, sheet Item Detail, BOM dan Routing <br>
1-b [R&D Head] Cek Form Master Data dan informasi dalam Item detail, BOM dan Routing <br>
2. [PPC] Lengkapi sheet Item Details (informasi POU & Loc ID) <br>
3. [PPC] Lengkapi sheet Item detail (item ordering, Item purchasing, item sales) <br>
4. [PPC] cek form item data by warehouse <br>
4b.[PPC Head] Cek Item detail dan approval Form Master Data <br>
5. [R&D] Input GID P/N baru <br>
6. [R&D] Input data item ordering, Item purchasing, & cek subentities P/N baru <br>
7. [R&D] ubah deskripsi P/N lama di GID menjadi [BLOK] P/N baru <br>
8. [R&D] Input item data by warehouse  <br>
9. [R&D] update BOM, replace P/N lama dengan P/N baru <br>
12. [PUR] cek PR yang masih open terhadap item lama, jika ada, info ke requestor PR <br>
13. [PUR] Follow up Revisi PR oleh requestor PR (addline item PR menggunakan P/N Baru) <br>
14. [PUR] cek PO yang masih open terhadap P/N lama <br>
15. [PUR] Cancel line PO atas P/N lama dan addline menggunakan P/N Baru <br>
8. [PUR] Melengkapi info purchase price di Item Detail  <br>
9. [PUR Head] Memvalidasi informasi purchase price dan approval Form Master Data <br>
10. [ACC] Input Simulated Purchased Price (Accounting) <br>
11. [ACC] Calculate Standard Cost (Accounting) <br>
12. [ACC Head] Approval Form Master data <br>
16. [PPC] Cek PRO open atas BOM yang direvisi, complete PRO lama, create PRO baru <br>
17. [PPC] cek apakah ada cogi gantung, buat memo ke accounting untuk penyelesaian cogi karena penggantian P/N <br>
18. [PPC] cek stock P/N lama di seluruh W/H, buat memo permohonan adjustment stock ke ACC 
[PPC Head] Approval Memo penyelesaian COGI <br>
19. [ACC] Melakukan adjustment berdasarkan memo <br>
20. [ACC] Melakukan penyelesaian COGI berdasarkan memo <br>
21. [R&D] Blok Item yang sudah tidak digunakan di GID (ambil screenshoot) <br>
22. [R&D] Upload Form Master Data full approval ke system <br>
"><i class="material-icons">help</i></div>`;
var labelactivity9 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="
1. [R&D] Mengisi Master Data Request, sheet Item Detail, BOM, Routing, dan Item warehousing <br>
1-b [R&D Head] Cek Form Master Data dan informasi dalam Item detail, BOM dan Routing <br>
2. [ENG] Lengkapi data dalam sheet Routing <br>
2-b [ENG Head] Cek data routing dan approval Form Master Data <br>
3. [PPC] Lengkapi form data item ordering, Item sales data, Item Warehousing data di sheet Item details <br>
4. [PPC] cek form item data by warehouse <br>
5. [R&D] Create dan upload sheet GID P/N baru ke BAAN <br>
6. [R&D] Input data item ordering, Item warehousing data & cek subentities P/N baru <br>
7. [R&D] ubah deskripsi P/N lama di GID menjadi [BLOK] P/N baru <br>
8. [R&D] Upload sheet Item Warehousing ke BAAN <br>
9. [R&D] Input BOM P/N baru, delete BOM P/N lama <br>
10. [R&D] Input Routing P/N baru, delete routing P/N lama <br>
11. [ACC] Calculate Standard Cost <br>
12. [ACC Head] Approval Form Master Data <br>
12. [PPC] Cek PRO open atas BOM P/N lama, complete PRO P/N lama, create PRO P/N  <br>
13. [PPC] Cek Sales Order Open atas P/N lama <br>
14. [PPC] cancel line Sales Order dengan P/N lama, add line Sales Order dengan P/N baru  <br>
15. [PPC Head] cek stock P/N lama di seluruh W/H, buat memo permohonan adjustment stock ke ACC  <br>
15-b [PPC] Verifikasi dan Approval Memo Permohondan adjustmnet stock <br>
16. [ACC Head] Menerima memo permohonan adjustmnet COGI dan approval <br>
16-b. [ACC] Melakukan adjustment berdasarkan memo <br>
17. [R&D] Blok Item yang sudah tidak digunakan di GID <br>
20. [ACC] Melakukan penyelesaian COGI berdasarkan memo <br>
21. [R&D] Blok Item yang sudah tidak digunakan di GID <br>
22. [R&D] Upload Form Master Data Request full approval ke system
"><i class="material-icons">help</i></div>`;
var labelactivity10 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="
1. [R&D] Mengisi Master Data Request, sheet Item Detail, BOM, Routing, dan Item warehousing <br>
1-b [R&D Head] Cek Form Master Data dan informasi dalam Item detail, BOM dan Routing <br>
2. [ENG] Lengkapi data dalam sheet Routing <br>
2-b [ENG Head] Cek data routing dan approval Form Master Data <br>
3. [PPC] Lengkapi form GID (informasi POU & Loc ID) <br>
4. [PPC] Lengkapi form data item ordering, Item purchasing, item sales data, Item Warehousing data <br>
5. [PPC] cek form item data by warehouse <br>
6. [R&D] Create dan upload sheet GID P/N baru ke BAAN <br>
7. [R&D] Input data item ordering, Item purchasing, & cek subentities P/N baru <br>
8. [R&D] ubah deskripsi P/N lama di GID menjadi [BLOK] P/N baru <br>
9. [R&D] Input sheet item data by warehouse ke BAAN <br>
10. [R&D] Create dan Input sheet BOM dengan P/N baru ke BAAN, delete BOM P/N lama <br>
11. [R&D] Input Routing P/N baru, delete routing P/N lama <br>
12. [PUR] cek PR yang masih open terhadap item lama, jika ada, info ke requestor PR <br>
13. [PUR] Follow up Revisi PR oleh requestor PR (addline item PR menggunakan P/N Baru) <br>
14. [PUR] cek PO yang masih open terhadap P/N lama <br>
15. [PUR] Cancel line PO atas P/N lama dan addline menggunakan P/N Baru <br>
8. [PUR] Melengkapi info purchase price di Item Detail  <br>
9. [PUR Head] Memvalidasi informasi purchase price dan approval Form Master Data <br>
12. [ACC] Input Simulated Purchased Price (Accounting) <br>
13. [ACC] Calculate Standard Cost (Accounting) <br>
12. [ACC Head] Approval Form Master Data <br>
12. [PPC] Cek PRO open atas BOM P/N lama, complete PRO P/N lama, create PRO P/N baru <br>
13. [PPC] Cek Sales Order Open atas P/N lama <br>
14. [PPC] cancel line Sales Order dengan P/N lama, add line Sales Order dengan P/N baru  <br>
15. [PPC Head] cek stock P/N lama di seluruh W/H, buat memo permohonan adjustment stock ke ACC  <br>
15-b [PPC] Verifikasi dan Approval Memo Permohondan adjustmnet stock <br>
16. [ACC Head] Menerima memo permohonan adjustmnet COGI dan approval <br>
16-b. [ACC] Melakukan adjustment berdasarkan memo <br>
17. [R&D] Blok Item yang sudah tidak digunakan di GID <br>
20. [ACC] Melakukan penyelesaian COGI berdasarkan memo <br>
21. [R&D] Blok Item yang sudah tidak digunakan di GID <br>
22. [R&D] Upload Form Master Data Request full approval ke system
"><i class="material-icons">help</i></div>`;

var labelactivity11 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="
1. [Requestor] Mengisi Master Data Request & form GID <br>
2. [ACC] Update Informasi GID
"><i class="material-icons">help</i></div>`;

var labelactivity12 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="
1. [Requestor] Mengisi Master Data Request & form Item Ordering Data <br>
2. [R&D] ubah data W/H pada  item ordering data <br>
3. [ACC] Cek & Update IMS <br>
4. [PUR] Cek PO Open, Jika ada PO Open : lakukan juga update WHS Receiving di PO. Apabila ada  PO yang sudah partial receipt tidak perlu dilakukan update W/H di PO <br>
5. [PPC] Cek PR Open, Jika ada PR Open : lakukan juga update WHS Receiving di PR <br>
6. [PPC] Cek PRO Active/Release : Complete dan Close PRO lama, buat PRO baru dengan data WHS yang sudah diperbaiki di item ordering data <br>
7. [PPC] Lakukan Stock transfer dari W/H lama ke W/H baru apabila masih ada stock di W/H lama
"><i class="material-icons">help</i></div>`;

var labelactivity13 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="
1. [Requestor] Mengisi Master Data Request & form GID <br>
2. [R&D] Update Informasi GID
"><i class="material-icons">help</i></div>`;

var labelactivity14 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="
1. [Requestor] Mengisi Master Data Request & form Item Ordering Data <br>
2. [R&D] ubah data W/H pada  item ordering data <br>
3. [ACC] Cek & Update IMS <br>
4. [PUR] Cek PO Open, Jika ada PO Open : lakukan juga update WHS Receiving di PO. Apabila ada  PO yang sudah partial receipt tidak perlu dilakukan update W/H di PO <br>
5. [PPC] Cek PR Open, Jika ada PR Open : lakukan juga update WHS Receiving di PR <br>
6. [PPC] Cek PRO Active/Release : Complete dan Close PRO lama, buat PRO baru dengan data WHS yang sudah diperbaiki di item ordering data <br>
7. [PPC] Lakukan Stock transfer dari W/H lama ke W/H baru apabila masih ada stock di W/H lama
"><i class="material-icons">help</i></div>`;

var labelactivity15 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="
1. [Requestor] Mengisi Master Data Request & form data item ordering <br>
2. [R&D] Update item ordering data
"><i class="material-icons">help</i></div>`;

var labelactivity16 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="
1. [Requestor] Mengisi Data Request & Form Item Sales Data <br>
2. [R&D] Update item sales data <br>
3. [ACC] Cek & Update IMS <br>
4. [PPC] Cek SO Open. Jika ada SO Open, revisi data WH di sales order detail per item <br>
5. [PPC] Cek SO Open. Jika ada SO Open partial, pastikan ada qty sejumlah sisa SO di whs yang lama <br>
6. [PPC] lakukan transfer stock dari WH lama ke WH baru setelah mempertimbangkan poin no 5 <br>
7. [R&D] Mengupload full approval Form Master Data ke system
"><i class="material-icons">help</i></div>`;

var labelactivity17 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="
1. Mengisi Master Data Request (requestor) <br>
2. Update item purchase data (Accounting) <br>
3. Cek & Update IMS   (Accounting) <br>
4. informasi perubahan ke requestor (Accounting) <br>
5. Jika ada PR Open : lakukan juga update WHS Receiving di PR (PPC) <br>
6. Jika ada PO Open : lakukan juga update WHS Receiving di PO (Purchasing) <br>
7. Jika ada PO open partial , lakukan receiving seperti biasa (Receiving) --> stock akan masuk ke WH lama <br>
8. Lakukan Stock transfer  (requestor) --> misalnya awalnya di WCSP1, dipindah ke WCOM1, maka jika memang fisik barang di WCSP1 dipindah ke WCOM1 maka perlu dilakukan transfer juga secara sistem)
"><i class="material-icons">help</i></div>`;

var labelactivity18 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="
1. [Requestor] Mengisi Data Request & form Item Purchase Data <br>
2. [R&D] Update item purchase data <br>
3. [R&D] cek data unit konversi, jika belum terdaftar, input konversi unitnya
"><i class="material-icons">help</i></div>`;

var labelactivity19 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="
1. [Requestor] Mengisi Data Request & form Item data By Warehouse <br>
2. [R&D] Update item data by Warehouse <br>
3. [ACC] Cek & Update IMS 
"><i class="material-icons">help</i></div>`;

var labelactivity20 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="
1. [Requestor] Mengisi Master Data Request & form Routing <br>
2. [PCE] verifikasi form data routing <br>
3. [R&D] update data Routing <br>
4. [ACC] Calculate Standard Cost (Accounting) <br>
5. [PPC] Check PRO dengan data routing lama <br>
6. [PPC] Complete PRO dengan data routing lama, create PRO dengan data routing baru
"><i class="material-icons">help</i></div>`;

var labelactivity21 = `<div class="tt1" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="
1. [Requestor] Mengisi Master Data Request & form BOM <br>
2. [R&D] verifikasi form data BOM <br>
3. [R&D] update data BOM <br>
X. [PCE] input data Routing & cycle time <br>
4. [ACC] Calculate Standard Cost (Accounting) <br>
5. [PPC] Check PRO dengan data BOM lama <br>
6. [PPC] Complete PRO dengan data BOM lama, create PRO dengan data BOM baru <br>
7. [PPC] cek apakah ada cogi gantung, buat memo ke accounting untuk penyelesaian cogi karena update BOM <br>
8. [ACC] penyelesaian COGI berdasarkan memo
"><i class="material-icons">help</i></div>`;




var finance = `<div class="form-group"><input type="text" class="form-control" name="app[]" value="${typeof nameAfin !== 'undefined' ? nameAfin : ''}" readonly><div class="text-right pt-0"><small>*Finance</small></div></div><input type="hidden" name="uap[]" value="${typeof idAfin !== 'undefined' ? idAfin : ''}">`;
var rnd = `<div class="form-group"><input type="text" class="form-control" name="app[]" value="${typeof nameArnd !== 'undefined' ? nameArnd : ''}" readonly><div class="text-right pt-0"><small>*RnD</small></div></div><input type="hidden" name="uap[]" value="${typeof idArnd !== 'undefined' ? idArnd : ''}">`;
var purchasing = `<div class="form-group"><input type="text" class="form-control" name="app[]" value="${typeof nameApurchasing !== 'undefined' ? nameApurchasing : ''}" readonly><div class="text-right pt-0"><small>*Purchasing</small></div></div><input type="hidden" name="uap[]" value="${typeof idApurchasing !== 'undefined' ? idApurchasing : ''}">`;
var ppic = `<div class="form-group"><input type="text" class="form-control" name="app[]" value="${typeof nameAppic !== 'undefined' ? nameAppic : ''}" readonly><div class="text-right pt-0"><small>*PPIC</small></div></div><input type="hidden" name="uap[]" value="${typeof idAppic !== 'undefined' ? idAppic : ''}">`;
var eng = `<div class="form-group"><input type="text" class="form-control" name="app[]" value="${typeof nameAeng !== 'undefined' ? nameAeng : ''}" readonly><div class="text-right pt-0"><small>*Engineering</small></div></div><input type="hidden" name="uap[]" value="${typeof idAeng !== 'undefined' ? idAeng : ''}">`;
var mkt = `<div class="form-group"><input type="text" class="form-control" name="app[]" value="${typeof nameAmarketing !== 'undefined' ? nameAmarketing : ''}" readonly><div class="text-right pt-0"><small>*Marketing</small></div></div><input type="hidden" name="uap[]" value="${typeof idAmarketing !== 'undefined' ? idAmarketing : ''}">`;
var req = `<div class="form-group"><input type="text" class="form-control" name="app[]" value="${typeof nameAreq !== 'undefined' ? nameAreq : ''}" readonly><div class="text-right pt-0"><small>*Requestor</small></div></div><input type="hidden" name="uap[]" value="${typeof idAreq !== 'undefined' ? idAreq : ''}">`;
var udh = `<div class="form-group"><input type="text" class="form-control" name="app[]" value="${typeof nameAudh !== 'undefined' ? nameAudh : ''}" readonly><div class="text-right pt-0"><small>*Dept Head Requestor</small></div></div><input type="hidden" name="uap[]" value="${typeof idAudh !== 'undefined' ? idAudh : ''}">`;
var sectHeadEng = 
`<select class="js-states form-control" name="lau[]" tabindex="-1" style="display: none; width: 100%">
<option value="--Choose--" selected disabled>--Choose--</option>
<option value="${typeof idAat !== 'undefined' ? idAat : ''}"><?= ${typeof nameAat !== 'undefined' ? nameAat : ''} ?></option>
<option value="${typeof idAsmt !== 'undefined' ? idAsmt : ''}"><?= ${typeof nameAsmt !== 'undefined' ? nameAsmt : ''} ?></option>
<option value="${typeof idAfa !== 'undefined' ? idAfa : ''}"><?= ${typeof nameAfa !== 'undefined' ? nameAfa : ''} ?></option>
</select>
<div class="text-right">
<small>*Engineering section head</small>
</div>
`
$('body').tooltip({
  selector: '.tt1'
});
$(typebaan).change(function () {
    if ($(this).val() == '1') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity1).appendTo(labelactivityclass);
        $(routes1+routes2+routes3).appendTo(routesbaan);
        $(udh+purchasing+finance).appendTo(approvalbaan);
    } else if ($(this).val() == '2') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity2).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4+routes5+routes6+routes7).appendTo(routesbaan);
        $(rnd+eng+ppic+rnd+purchasing+finance+ppic).appendTo(approvalbaan);
    } else if ($(this).val() == '3') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity3).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4+routes5+routes6).appendTo(routesbaan);
        $(udh+ppic+rnd+purchasing+finance+rnd).appendTo(approvalbaan);
    } else if ($(this).val() == '4') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity4).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4+routes5+routes6+routes7+routes8).appendTo(routesbaan);
        $(rnd+ppic+rnd+purchasing+finance+ppic+finance+rnd).appendTo(approvalbaan);
    } else if ($(this).val() == '5') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity5).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4+routes5+routes6).appendTo(routesbaan);
        $(rnd+eng+rnd+finance+ppic+rnd).appendTo(approvalbaan);
    } else if ($(this).val() == '6') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity6).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4).appendTo(routesbaan);
        $(udh+finance+purchasing+finance).appendTo(approvalbaan);
    } else if ($(this).val() == '7') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity7).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4).appendTo(routesbaan);
        $(udh+finance+purchasing+finance).appendTo(approvalbaan);
    } else if ($(this).val() == '8') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity8).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4+routes5+routes6+routes7+routes8).appendTo(routesbaan);
        $(rnd+ppic+rnd+purchasing+finance+ppic+finance+rnd).appendTo(approvalbaan);
    } else if ($(this).val() == '9') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity9).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4+routes5+routes6+routes7+routes8).appendTo(routesbaan);
        $(rnd+eng+ppic+rnd+finance+ppic+finance+rnd).appendTo(approvalbaan);
    } else if ($(this).val() == '10') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity10).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4+routes5+routes6+routes7+routes8+routes9).appendTo(routesbaan);
        $(rnd+eng+ppic+rnd+purchasing+finance+ppic+finance+rnd).appendTo(approvalbaan);
    } else if ($(this).val() == '11') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity11).appendTo(labelactivityclass);
        $(routes1+routes2).appendTo(routesbaan);
        $(udh+finance).appendTo(approvalbaan);
    } 

    else if ($(this).val() == '12') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity12).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4+routes5+routes6).appendTo(routesbaan);
        $(udh+rnd+finance+purchasing+ppic+rnd).appendTo(approvalbaan);
    } 

    else if ($(this).val() == '13') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity13).appendTo(labelactivityclass);
        $(routes1+routes2).appendTo(routesbaan);
        $(udh+rnd).appendTo(approvalbaan);
    } 

     else if ($(this).val() == '14') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity14).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4).appendTo(routesbaan);
        $(udh+finance+purchasing+udh).appendTo(approvalbaan);
    } 

     else if ($(this).val() == '15') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity15).appendTo(labelactivityclass);
        $(routes1+routes2).appendTo(routesbaan);
        $(udh+rnd).appendTo(approvalbaan);
    } 

     else if ($(this).val() == '16') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity16).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4+routes5).appendTo(routesbaan);
        $(udh+rnd+finance+ppic+rnd).appendTo(approvalbaan);
    } 

     else if ($(this).val() == '17') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity17).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4+routes5+routes6).appendTo(routesbaan);
        $(udh+finance+ppic+purchasing+udh+finance).appendTo(approvalbaan);
    } 

    else if ($(this).val() == '18') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity18).appendTo(labelactivityclass);
        $(routes1+routes2).appendTo(routesbaan);
        $(udh+rnd).appendTo(approvalbaan);
    } 

     else if ($(this).val() == '19') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity19).appendTo(labelactivityclass);
        $(routes1+routes2+routes3).appendTo(routesbaan);
        $(udh+rnd+finance).appendTo(approvalbaan);
    }

     else if ($(this).val() == '20') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity20).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4+routes5).appendTo(routesbaan);
        $(udh+eng+rnd+finance+ppic).appendTo(approvalbaan);
    }

     else if ($(this).val() == '21') {
        $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
        $(labelroute).appendTo(labelrouteclass);
        $(labelapproval).appendTo(labelapprovalclass);
        $(labelactivity21).appendTo(labelactivityclass);
        $(routes1+routes2+routes3+routes4+routes5+routes6).appendTo(routesbaan);
        $(udh+rnd+ppic+finance+ppic + finance).appendTo(approvalbaan);
    }

    else {
        $(routesbaan).empty();
        $(approvalbaan).empty();
    }

    // if ($(this).val() == '1' || $(this).val() == '9') {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity1).appendTo(labelactivityclass);
    //     $(routes1+routes2+routes3).appendTo(routesbaan);
    //     $(udh+purchasing+finance).appendTo(approvalbaan);
    // } else if ($(this).val() == '2') {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity2).appendTo(labelactivityclass);
    //     $(routes1+routes2+routes3+routes4+routes5+routes6+routes7).appendTo(routesbaan);
    //     $(rnd+eng+ppic+rnd+purchasing+finance+ppic).appendTo(approvalbaan);
    // } else if ($(this).val() == '3') {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity3).appendTo(labelactivityclass);
    //     $(routes1+routes2+routes3+routes4+routes5+routes6).appendTo(routesbaan);
    //     $(rnd+ppic+rnd+purchasing+finance+rnd).appendTo(approvalbaan);
    // } else if ($(this).val() == '4'|| $(this).val() == '5')  {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity1).appendTo(labelactivityclass);
    //     $(routes1+routes2+routes3).appendTo(routesbaan);
    //     $(finance+purchasing+finance).appendTo(approvalbaan);
    // } else if ($(this).val() == '6') {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity1).appendTo(labelactivityclass);
    //     $(routes1+routes2+routes3+routes4+routes5+routes6+routes7+routes8).appendTo(routesbaan);
    //     $(rnd+ppic+rnd+finance+purchasing+ppic+finance+rnd).appendTo(approvalbaan);
    // } else if ($(this).val() == '7') {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity1).appendTo(labelactivityclass);
    //     $(routes1+routes2+routes3+routes4+routes5+routes6+routes7+routes8).appendTo(routesbaan);
    //     $(rnd+eng+ppic+rnd+finance+ppic+finance+rnd).appendTo(approvalbaan);
    // } else if ($(this).val() == '8') {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity1).appendTo(labelactivityclass);
    //     $(routes1+routes2+routes3+routes4+routes5+routes6+routes7+routes8+routes9).appendTo(routesbaan);
    //     $(rnd+eng+ppic+rnd+finance+purchasing+ppic+finance+rnd).appendTo(approvalbaan);
    // } else if ($(this).val() == '10'|| $(this).val() == '13' || $(this).val() == '15') {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity1).appendTo(labelactivityclass);
    //     $(routes1).appendTo(routesbaan);
    //     $(rnd).appendTo(approvalbaan);
    // } else if ($(this).val() == '11') {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity1).appendTo(labelactivityclass);
    //     $(routes1+routes2+routes3).appendTo(routesbaan);
    //     $(finance+purchasing+req).appendTo(approvalbaan);
    // } else if ($(this).val() == '12') {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity1).appendTo(labelactivityclass);
    //     $(routes1+routes2+routes3+routes4).appendTo(routesbaan);
    //     $(rnd+finance+purchasing+ppic).appendTo(approvalbaan);
    // } else if ($(this).val() == '14') {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity1).appendTo(labelactivityclass);
    //     $(routes1+routes2+routes3).appendTo(routesbaan);
    //     $(rnd+finance+ppic).appendTo(approvalbaan);
    // } else if ($(this).val() == '16') {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity1).appendTo(labelactivityclass);
    //     $(routes1+routes2).appendTo(routesbaan);
    //     $(rnd+finance).appendTo(approvalbaan);
    // } else if ($(this).val() == '17') {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity1).appendTo(labelactivityclass);
    //   $(routes1+routes2+routes3+routes4).appendTo(routesbaan);
    //   $(rnd+finance+ppic+finance).appendTo(approvalbaan);
    // } else if ($(this).val() == '18') {
    //     $(routesbaan).empty(); $(approvalbaan).empty(); $(labelrouteclass).empty(); $(labelapprovalclass).empty(); $(labelactivityclass).empty();
    //     $(labelroute).appendTo(labelrouteclass);
    //     $(labelapproval).appendTo(labelapprovalclass);
    //     $(labelactivity1).appendTo(labelactivityclass);
    //   $(routes1+routes2+routes3).appendTo(routesbaan);
    //   $(rnd+finance+ppic).appendTo(approvalbaan);
    // } else {
    //     $(routesbaan).empty();
    //     $(approvalbaan).empty();
    // }
});
$(document).ready( function () {
  var table = $('#zero-conf100').DataTable();
  $("#searchCluster").click(function() {
    $(".form-control-sm").attr('autofocus', true);
    $(".form-control-sm").focus();
    $(".form-control-sm").val('Cluster');
    table.search("Cluster").draw();
  });
  $("#searchPWBA").click(function() {
    $(".form-control-sm").attr('autofocus', true);
    $(".form-control-sm").focus();
    $(".form-control-sm").val('PWBA');
    table.search("PWBA").draw();
  });
  $("#searchAHU").click(function() {
    $(".form-control-sm").attr('autofocus', true);
    $(".form-control-sm").focus();
    $(".form-control-sm").val('AHU');
    table.search("AHU").draw();
  });
  $("#customer1").click(function() {
    $(".form-control-sm").attr('autofocus', true); $(".form-control-sm").focus(); $(".form-control-sm").val('AVV');
    table.search("AVV").draw();
  });
  $("#customer2").click(function() {
    $(".form-control-sm").attr('autofocus', true); $(".form-control-sm").focus(); $(".form-control-sm").val('VETL');
    table.search("VETL").draw();
  });
  $("#customer3").click(function() {
    $(".form-control-sm").attr('autofocus', true); $(".form-control-sm").focus(); $(".form-control-sm").val('AHM');
    table.search("AHM").draw();
  });
  $("#customer4").click(function() {
    $(".form-control-sm").attr('autofocus', true); $(".form-control-sm").focus(); $(".form-control-sm").val('AJI');
    table.search("AJI").draw();
  });
  $("#customer5").click(function() {
    $(".form-control-sm").attr('autofocus', true); $(".form-control-sm").focus(); $(".form-control-sm").val('DSO');
    table.search("DSO").draw();
  });
});

var dashAppTask = $('#dashAppTask').DataTable();
var table = $('#dashMyTask').DataTable({
  pageLength : 5,
  lengthMenu: [5, 10, 20]
});
$('#dashMyTask_filter input').addClass('searchMyTask'); // <-- add this line
$("#searchTaskWa").click(function() {
  $('#home-tab').click();
  $(".searchMyTask").attr('autofocus', true);
  $(".searchMyTask").focus();
  $(".searchMyTask").val('Waiting Approve');
  table.search("Waiting").draw();
});

$("#showTask").click(function () {
  $("#tasktab").toggle();
});
$("#showAppTask").click(function () {
  $("#tasktabApp").toggle();
});
$("#showCustDev").click(function () {
  $("#custdevvv").toggle();
  $("#addCustDev").toggle();
});
$("#showTaskList").click(function () {
  $("#tasklist").toggle();
  $("#addTask").toggle();
});
$("#showPpfmList").click(function () {
  $("#piclist").toggle();
});
$("#showCustSl").click(function () {
  $("#custsl").toggle();
  $("#addCustSl").toggle();
});
$("#showCustPpap").click(function () {
  $("#custppap").toggle();
  $("#btnAddCustPpap").toggle();
});
$("#showSupPpap").click(function () {
  $("#supppap").toggle();
  $("#btnAddSupPpap").toggle();
});
$("#showPvTest").click(function () {
  $("#pvtest").toggle();
  $("#btnAddPvTest").toggle();
});
$("#showPvTestSum").click(function () {
  $("#pvtestsum").toggle();
  $("#btnAddPvTestSum").toggle();
});
$("#showcas").click(function () {
  $("#cas").toggle();
  $("#btnAddcas").toggle();
});

// console.log(valDept);
var level = document.getElementsByClassName("level");
var depart = document.getElementsByClassName("depart");
var section = document.getElementsByClassName("section");
selectValues = { "1": "--Choose--", "2": "test 1", "3": "test 2" };
// console.log(selectValues)
$(level).change(function () {
if ($(this).val() == '1' || $(this).val() == '2' || $(this).val() == '3' || $(this).val() == '4'){
    $(section).attr("disabled", true).html('--Choose--');
    $(depart).attr("disabled", true).html('--Choose--');
    $.each(valDept, function(key, value) {   
      $(depart).append($("<option></option>").attr("value", key).text(value)); 
    });
    // var valdepart = $(depart).val();
    // var valsection= $(section).val();
    // console.log($(this).val;
    $('#depart').val('0');
    $('#section').val('0');
    $.each(valSec, function(key, value) {   
      $(section).append($("<option></option>").attr("value", key).text(value)); 
    });
} else if ($(this).val() == '5'){
    $(depart).attr("disabled", false);
    $(section).attr("disabled", true).html('--Choose--');
    $.each(valSec, function(key, value) {   
      $(section).append($("<option></option>").attr("value", key).text(value)); 
    });
} else {
  $(depart).attr("disabled", false);
  $(section).attr("disabled", false);
}
});
$(level).trigger('change');
$(depart).change(function () {
  if ($(this).val() != '0') {
  }
  var valdepart = $(depart).val();
  $('#depart').val(valdepart);
});
$(depart).trigger('change');
$(section).change(function () {
  if ($(this).val() != '0') {
  }
  var valsection = $(section).val();
  $('#section').val(valsection);
});
$(section).trigger('change');

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
}

function details() {
  if ($("#end").val() == "PWBA") {
    if (document.getElementById("end").disabled) {
      $("#end").removeAttr("disabled");
    } else {
      $("#end").attr("disabled", true);
    }
    if (document.getElementById("add").innerHTML == "Cancel") {
      $("#add").html("Add Details");
    } else {
      $("#add").html("Cancel");
    }
    // $("#add").html('Cancel');
    $("#name").val("PWBA");
    $("#cancel").toggle();
    $("#submit").toggle();
    $("#rfq").toggle();
    $("#design_freeze").toggle();
    $("#pp1smt").toggle();
    $("#pp2smt").toggle();
    $("#pp3smt").toggle();
    $("#sop_smt").toggle();
    $("#safe_launch").toggle();
    $("#regular_production").toggle();
    $("#eop").toggle();
    $("#submit2").toggle();
    $("#addtimeline").toggle();
    $("#cancel2").toggle();
  } else if ($("#end").val() == "Cluster") {
    if (document.getElementById("end").disabled) {
      $("#end").removeAttr("disabled");
    } else {
      $("#end").attr("disabled", true);
    }
    if (document.getElementById("add").innerHTML == "Cancel") {
      $("#add").html("Add Details");
    } else {
      $("#add").html("Cancel");
    }
    $("#name").val("Cluster");
    $("#cancel").toggle();
    $("#submit").toggle();
    $("#rfq").toggle();
    $("#design_freeze").toggle();
    $("#pp1smt").toggle();
    $("#pp2smt").toggle();
    $("#pp3smt").toggle();
    $("#pp1fa").toggle();
    $("#pp2fa").toggle();
    $("#pp3fa").toggle();
    $("#sop_fa").toggle();
    $("#sop_smt").toggle();
    $("#safe_launch").toggle();
    $("#regular_production").toggle();
    $("#eop").toggle();
    $("#submit2").toggle();
    $("#addtimeline").toggle();
    $("#cancel2").toggle();
  }
}
$("#timeline").click(function () {
  $("#timedet").toggle();
});
$("#showTab").click(function () {
  $("#tab").toggle();
});
$("#showRio").click(function () {
  $("#rio").toggle();
});
$("#showRioApp").click(function () {
  $("#rioApp").toggle();
});
$("#taskButton").click(function () {
  $("#taskList").show();
  $("#cost").hide();
  $("#eventDetails").hide();
  $("#qualityDetails").hide();
  $("#productivity").hide();
});
$("#costButton").click(function () {
  $("#cost").show();
  $("#taskList").hide();
  $("#eventDetails").hide();
  $("#qualityDetails").hide();
  $("#productivity").hide();
});
$("#eventNear").click(function () {
  $("#eventDetails").show();
  $("#cost").hide();
  $("#taskList").hide();
  $("#qualityDetails").hide();
  $("#productivity").hide();
});
$("#qualityButton").click(function () {
  $("#qualityDetails").show();
  $("#cost").hide();
  $("#taskList").hide();
  $("#eventDetails").hide();
  $("#productivity").hide();
});
$("#productivityButton").click(function () {
  $("#productivity").show();
  $("#qualityDetails").hide();
  $("#cost").hide();
  $("#taskList").hide();
  $("#eventDetails").hide();
});
$("#end").change(function () {
  if ($(this).val() == "PWBA") {
    $("#name").val("PWBA");
  } else {
    $("#name").val("Cluster");
  }
});

function addtimeliness() {
  if (document.getElementById("addtimeline").innerHTML == "Cancel") {
    $("#addtimeline").html("Add Timeline");
  } else {
    $("#addtimeline").html("Cancel");
  }
  $("#cancel2").toggle();
  $("#submit2").toggle();
  $("#timeline1").toggle();
  $("#timeline2").toggle();
  $("#timeline3").toggle();
  $("#timeline4").toggle();
  $("#timeline5").toggle();
  $("#submit3").toggle();
}
var prodEvent = document.getElementsByClassName("prodEvent");
var valEv;
var textEv;
$(prodEvent).change(function(){
  valEv = $(this).val();
  textEv = $("#prodEvent option:selected").text();
  // console.log(textEv);
})
if (valEv == null){
  valEv = $(prodEvent).val();
}
if (textEv == null){
  textEv = $("#prodEvent option:selected").text();
}
// console.log($(prodEvent).val());
//Add Input Fields
$(document).ready(function () {
  var max_fields = 10; //Maximum allowed input fields
  var wrapper = $(".wrapper"); //Input fields wrapper
  var add_button = $(".add_fields"); //Add button class or ID
  var add_fields_more = $(".add_fields_more"); //Add button class or ID
  var add_station = $(".add_station"); //Add button class or ID
  var x = 1; //Initial input field is set to 1

  //When user click on add input button
  $(add_button).click(function (e) {
    e.preventDefault();
    //Check maximum allowed input fields
    if (x < max_fields) {
      x++; //input field increment
      //add input field
      $(wrapper).append(
        '<div class="col-4 mt-3"><div class="form-group mt-3"><label for="">Event</label><input type="text" class="form-control mb-2" placeholder="Input Event" name="event_name[]"><label for="">Start</label><input type="date" autocomplete="off" class="form-control mb-2"style="padding-left: 15px;" placeholder="dd/mm/yyyy" value="" name="start[]"><label for="">Finish</label><input type="date" autocomplete="off" class="form-control mb-2"style="padding-left: 15px;" placeholder="dd/mm/yyyy" value="" name="end[]"></div></div><div class="col-4 mt-3"><div class="form-group mt-3"><label for="">Event</label><input type="text" class="form-control mb-2" placeholder="Input Event" name="event_name[]"><label for="">Start</label><input type="date" autocomplete="off" class="form-control mb-2"style="padding-left: 15px;" placeholder="dd/mm/yyyy" value="" name="start[]"><label for="">Finish</label><input type="date" autocomplete="off" class="form-control mb-2"style="padding-left: 15px;" placeholder="dd/mm/yyyy" value="" name="end[]"></div></div><div class="col-4 mt-3"><div class="form-group mt-3"><label for="">Event</label><input type="text" class="form-control mb-2" placeholder="Input Event" name="event_name[]"><label for="">Start</label><input type="date" autocomplete="off" class="form-control mb-2"style="padding-left: 15px;" placeholder="dd/mm/yyyy" value="" name="start[]"><label for="">Finish</label><input type="date" autocomplete="off" class="form-control mb-2"style="padding-left: 15px;" placeholder="dd/mm/yyyy" value="" name="end[]"></div></div>'
      );
      // $(wrapper).append('<div><input type="text" name="input_array_name[]" placeholder="Input Text Here" /> <a href="javascript:void(0);" class="remove_field">Remove</a></div>');
    }
  });

  //When user click on add input button
  $(add_fields_more).click(function (e) {
    e.preventDefault();
    //Check maximum allowed input fields
    if (x < 3) {
      x++; //input field increment
      //add input field
      $(wrapper).append(
        '<div class"divider"></div><div class="form-group"> <label>Model</label> <input type="text" class="form-control" placeholder="Model Name" name="model" value="<?= $model->model ?>" readonly> </div> <div class="form-group"> <label>Type</label> <select class="js-states form-control" name="type" tabindex="-1" style="display: none; width: 100%"> <option value="customer">Customer</option> <option value="internal">Internal</option> </select> </div><div class="form-group"> <label>File</label> <div> <div class="input-group"> <input type="file" name="fileapp" class="filestyle"> </div> </div> </div>'
      );
      // $(wrapper).append('<div><input type="text" name="input_array_name[]" placeholder="Input Text Here" /> <a href="javascript:void(0);" class="remove_field">Remove</a></div>');
    }
  });
  
  //When user click on add input button
    var y = 2;
  $(add_station).click(function (e) {
    e.preventDefault();
    //Check maximum allowed input fields
    if (x < max_fields) {
      x++; //input field increment
      var ap = `<div class="col-2"> <div class="form-group">  </div> </div> <div class="col-2"> <div class="form-group"> <label for="">Station</label> <input type="text" class="form-control" placeholder="Input Station" name="station[]"> </div> </div> <div class="col-2"> <div class="form-group"> <label for="">Cycle Time</label> <input type="number" class="form-control mb-2" placeholder="Actual" name="ct_actual[]"> </div> </div> <div class="col-2"> <div class="form-group"> <label for="">FTT</label>  <input type="number" class="form-control mb-2" placeholder="Actual" name="ftt_actual[]"> </div> </div> <div class="col-2"> <div class="form-group"> <label for="">Rejection Rate</label> <input type="number" class="form-control mb-2" placeholder="Actual" name="rr_actual[]"> </div> </div>
      <div class="col-2">
          <div class="form-group">
              <label for="">Available Time</label>
              <input type="number" class="form-control mb-2" placeholder="Actual" name="at_actual[]">
          </div>
      </div>`
      //add input field
      $(wrapper).append(ap);
      // $(wrapper).append('<div><input type="text" name="input_array_name[]" placeholder="Input Text Here" /> <a href="javascript:void(0);" class="remove_field">Remove</a></div>');
    }
  });

  //when user click on remove button
  $(wrapper).on("click", ".remove_field", function (e) {
    e.preventDefault();
    $(this).parent("div").remove(); //remove inout field
    x--; //inout field decrement
  });
});
// var seen = {};
// $('#complex-header td:first-child+td').each(function() 
// {
//     var $this = $(this);
//     var index = $this.index();
//     var txt =  $this.text();
//     if (seen[index] === txt) 
//     {
//         $($this.parent().prev().children()[index]).attr('rowspan', 3).attr('class', 'text-center').attr('style', 'vertical-align : middle;text-align:center;');
//         $this.hide();
//     }
//     else 
//     {
//         seen[index] = txt;
//     }
// });
$(document).ready(function() {
  // console.log(jsonEventName);
  var span = 1;
  var prevTD = "";
  var prevTDVal = "";
  $("#complex-header tr td:first-child").each(function() { //for each first td in every tr
     var $this = $(this);
     if ($this.text() == prevTDVal) { // check value of previous td text
        span++;
        if (prevTD != "") {
           prevTD.attr("rowspan", span); // add attribute to previous td
           $this.remove(); // remove current td
        }
     } else {
        prevTD     = $this; // store current td 
        prevTDVal  = $this.text();
        span       = 1;
     }
  });
  $("#complex-header tr td:last-child").each(function() { //for each first td in every tr
     var $this = $(this);
     var eventss = $this.text().replace(/\s/g, "");
    //  console.log(eventss);
     if ($this.text() == prevTDVal) { // check value of previous td text
        span++;
        if (prevTD != "") {
           prevTD.attr("rowspan", span).html(`<a data-toggle="modal" type="button" style="color: white;" data-target="#viewGraphProd${eventss}"class="badge badge-info mb-2"><span class="material-icons">equalizer</span></a>`); // add attribute to previous td
           $this.remove(); // remove current td
        }
     } else {
        prevTD     = $this; // store current td 
        prevTDVal  = $this.text();
        span       = 1;
     }
  });
});
var up = document.getElementsByClassName("userapp1");
var up2 = document.getElementsByClassName("userapp2");
var up3 = document.getElementsByClassName("userapp3");
var up4 = document.getElementsByClassName("userapp4");
var up5 = document.getElementsByClassName("userapp5");
var route1 = document.getElementsByClassName("route1");
var route2 = document.getElementsByClassName("route2");
var route3 = document.getElementsByClassName("route3");
var route4 = document.getElementsByClassName("route4");
var route5 = document.getElementsByClassName("route5");
$(up).change(function () {
  if ($(this).val() == "--Choose--") {
    $(up).removeAttr("disabled");
    $(route1).removeAttr("disabled");
  } else {
    $(up2).removeAttr("disabled");
    $(route2).removeAttr("disabled");
  }
});
$(up).trigger("change");
$(up2).change(function () {
  if ($(this).val() != "--Choose--") {
    $(up3).removeAttr("disabled");
    $(route3).removeAttr("disabled");
  }
});
$(up3).change(function () {
  if ($(this).val() != "--Choose--") {
    $(up4).removeAttr("disabled");
    $(route4).removeAttr("disabled");
  }
});
$(up4).change(function () {
  if ($(this).val() != "--Choose--") {
    $(up5).removeAttr("disabled");
    $(route5).removeAttr("disabled");
  }
});
$(up).trigger("change");
$(document.getElementsByClassName("raf")).change(function () {
  if ($(this).val() == "Yes") {
    $("#notesfile").show();
  } else {
    $("#notesfile").hide();
  }
});
$(document.getElementsByClassName("raf")).trigger("change");

$("#editenpro").change(function () {
  if ($(this).html() == "Cluster") {
    $("#valendpro").val("PWBA");
    $("#valendpro").html("PWBA");
  } else {
    $("#valendpro").val("Cluster");
    $("#valendpro").html("Cluster");
  }
});
$("#editenpro").trigger("change");


// document.getElementById("e").value = new Date().toISOString().substring(0, 10);

function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function myFunction2() {
  var x = document.getElementById("myInput2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

for (let i = 1; i < 20; i++) {
  document.getElementById("rupiah" + i).addEventListener("keyup", function (e) {
    document.getElementById("rupiah" + i).value = formatRupiah(this.value, "");
  });
}