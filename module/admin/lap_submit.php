<table class="table table-hover table-striped ">
                          <tbody>
                              <tr class="table-success">
                                <th style="width: 10px" class="text-center">No.</th>
                                <th class="text-center" width="25%">Nama Pegawai</th>
                                <th class="text-center" width="20%">Bulan</th>
                                <th class="text-center" width="12%">Tahun</th>
                                <th class="text-center" width="13%">Jumlah Output</th>
                                <th class="text-center" width="15%">Status</th>
                                <th class="text-center" width="10%">Aksi</th>
                              </tr>
                              <?php
                              function  getBulan($bln){
                                switch  ($bln){
                                    case  1:
                                    return  "Januari";
                                    break;
                                    case  2:
                                    return  "Februari";
                                    break;
                                    case  3:
                                    return  "Maret";
                                    break;
                                    case  4:
                                    return  "April";
                                    break;
                                    case  5:
                                    return  "Mei";
                                    break;
                                    case  6:
                                    return  "Juni";
                                    break;
                                    case  7:
                                    return  "Juli";
                                    break;
                                    case  8:
                                    return  "Agustus";
                                    break;
                                    case  9:
                                    return  "September";
                                    break;
                                    case  10:
                                    return  "Oktober";
                                    break;
                                    case  11:
                                    return  "November";
                                    break;
                                    case  12:
                                    return  "Desember";
                                    break;
                                }
                            }
                          
                              $no=0;
                                while($lapbul=mysqli_fetch_array($data_lapbul)){    
                              $no+=1;       
                              $bulan = getBulan($lapbul['bulan']);              
                              
                              
                              ?>
                              <tr>             
                                <td class="text-center"><?php echo $no; ?></td>
                                <td><?php echo $lapbul['nama_pegawai']; ?></td>
                                <td class="text-center"><?php echo $bulan; ?></td>
                                <td class="text-center"><?php echo $lapbul['tahun']; ?></td>
                                <td class="text-center"><label><?php echo $lapbul['jumlah_kegiatan']; ?></label></td>
                                  <td class="text-center"><label><?php echo $lapbul['status1']; ?></label></td>
                                <td class="text-center label">
                                <form action="module/admin/aksi.php" method="post">
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                  <div class="btn-group" role="group">
                                  <input type="hidden" class="form-control" id="id" value="<?php echo $lapbul['id_lapbul']; ?>" name="id_lapbul" placeholder="1">
                                    <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                      PROSES
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                      <li>
                                      <button type="submit" name="saveAccLapbul" class="btn btn-sm btn-success" onClick="return confirm('Anda yakin ingin menyetujui Laporan ini?')">Di Setujui</button>
                                      <button type="submit" name="saveTolakLapbul" class="btn btn-sm btn-danger" onClick="return confirm('Anda yakin ingin menolak Laporan ini?')">Di Tolak</button>
                                    </li>
                                    </ul>
                               
                                  <a href="ngadimin.php?module=detail_lap&id=<?php echo $lapbul['id_lapbul']; ?>"><button type="button"  class="btn btn-sm btn-primary"><div class="icon-wrapper">Detail</button></a>
                                    
                                  </div>
                                </div>
                                </form>
                                </td>
                              </tr>
                              <?php } ?>
                          </tbody>
                        </table>