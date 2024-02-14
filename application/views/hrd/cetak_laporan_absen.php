<?php //Loading navbar.php
  $this->load->view('hrd/templates/head_cetak');
?>


                <div class="container-fluid">

                    <!-- Page Heading -->
                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-2 text-gray-800">Tabel Absen</h1>
                   
                  </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Absen</h6><br>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>Kode Pegawai</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>Kode Pegawai</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         <?php
                  $no = 1;
                  foreach($absen as $dtl) : ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $dtl->nama_pegawai ?></td>
                    <td><?php echo $dtl->kode_pegawai ?></td>
                    <td><?php echo $dtl->tanggal ?></td>
                    <td><?php echo $dtl->jam ?></td>
                    

                  </tr>
                  <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

      
    </div>
<?php //Loading navbar.php
  $this->load->view('hrd/templates/footer');
?>