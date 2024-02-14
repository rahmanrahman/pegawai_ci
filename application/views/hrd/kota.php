<?php //Loading navbar.php
  $this->load->view('admin/templates/head');
?>


                <div class="container-fluid">

                    <!-- Page Heading -->
                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-2 text-gray-800">Tabel Kota</h1>
                   
                  </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Kota</h6><br>
                             <a href="#modalAdd" data-toggle="modal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Tambah Kota</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kota</th>
                                            <th>Kode Kota</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kota</th>
                                            <th>Kode Kota</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                         <?php
                  $no = 1;
                  foreach($kota as $dtl) : ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $dtl->nama_kota ?></td>
                    <td><?php echo $dtl->kode_kota ?></td>
                   

                    <td>
                      <div class="form-button-action">
                            <a href="#modalEdit<?php echo $dtl->id?>" data-toggle="modal" title="" class="btn btn-link btn-primary text-white" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                              <a href="<?php echo base_url('Admin/Hapus_Kota/'.$dtl->id)?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger text-white" data-original-title="Remove" onclick="javascript: return  confirm('Anda  yakin  hapus?')">
                                <i class="fa fa-times"></i>
                              </a>
                            </div>
                    </td>

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
            <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h1 class="modal-title">
                    Tambah Kota
                </h1>
            </div>
            <div class="modal-body">
               <form action="<?php echo base_url('Admin/Tambah_Kota'); ?>" method="post">
      
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>nama kota</label>
                                <input id="nama_kota" type="text" class="form-control" placeholder="nama kota" name="nama_kota" >                               
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label for="kode_kota">kode kota</label>
                    <input type="text" class="form-control" id="kode_kota" placeholder="kode_kota" name="kode_kota" value="K00<?php foreach($total_kota as $tb): ?><?php echo $tb->total+1  ?><?php endforeach;?>" readonly>

                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer no-bd">
                <button type="submit" id="addRowButton" class="btn btn-warning">Kirim</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>


                  <?php
                  foreach($kota as $e) : ?>
<div class="modal fade" id="modalEdit<?php echo $e->id?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h1 class="modal-title">
                    Edit Kota
                </h1>
            </div>
            <div class="modal-body">
               <form action="<?php echo base_url('Admin/Update_Kota'); ?>" method="post">
      
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>nama kota</label>
                                <input type="hidden" name="id" value="<?php echo $e->id ?>">
                                <input id="nama_kota" type="text" class="form-control" placeholder="nama_kota" name="nama_kota" value="<?php echo $e->nama_kota?>">
                               
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label for="kode_kota">kode_kota</label>
                    <input type="text" class="form-control" id="kode_kota" name="kode_kota" value="<?php echo $e->kode_kota?>" readonly>

                            </div>
                        </div>
                        
                    </div>
            </div>
            <div class="modal-footer no-bd">
                <button type="submit" id="addRowButton" class="btn btn-warning">Edit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
      
    </div>
<?php //Loading navbar.php
  $this->load->view('admin/templates/footer');
?>