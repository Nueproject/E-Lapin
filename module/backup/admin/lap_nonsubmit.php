                        <table class="table table-hover table-striped ">
                          <tbody>
                              <tr class="table-success">
                                <th style="width: 10px" class="text-center">No.</th>
                                <th class="text-center" width="25%">Nama Pegawai</th>
                                <th class="text-center" width="25%">NIPPNPN</th>
                                <th class="text-center" width="20%">Jenis Kelamin</th>
                                <th class="text-center" width="15%">Jabatan</th>
                              </tr>
                              <?php                             
                              $no=0;    
                               	
                              while($lb=mysqli_fetch_array($data_nonlb)){ 
                                $no++; 
                              ?>
                              <tr>             
                                <td class="text-center"><?php echo $no; ?></td>
                                <td><?php echo $lb['nama_pegawai']; ?></td>
                                <td class="text-center"><?php echo $lb['nippnpn']; ?></td>
                                <td class="text-center"><?php echo $lb['jenis_kelamin']; ?></td>
                                <td class="text-center"><?php echo $lb['jabatan']; ?></label></td>
                              </tr>
                              <?php } ?>
                          </tbody>
                        </table>