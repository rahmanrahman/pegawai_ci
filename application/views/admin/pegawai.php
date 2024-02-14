<?php //Loading navbar.php
  $this->load->view('admin/templates/head');
?>


                <div class="container-fluid">

                    <!-- Page Heading -->
                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-2 text-gray-800">Tabel Karyawan</h1>
                    <a href="<?php echo base_url('Admin/Cetak_Laporan_Pegawai')?>" class="d-none d-sm-inline-block btn btn-md btn-danger shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Cetak</a>

                  </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Karyawan</h6><br>
                             <a href="#modalAdd" data-toggle="modal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Tambah Karyawan</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>Kode Pegawai</th>
                                            <th>Nomor Telepon</th>
                                            <th>Posisi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                         <?php
                  $no = 1;
                  foreach($pegawai as $dtl) : ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $dtl->nama_pegawai ?></td>
                    <td><?php echo $dtl->kode_pegawai ?></td>
                    <td><?php echo $dtl->nomor_telepon ?></td>
                    <td><?php echo $dtl->nama_posisi ?></td>
                    <td><?php echo $dtl->nama_kota ?></td>

                    <td>
                      <div class="form-button-action">
                            <a href="#modalEdit<?php echo $dtl->id?>" data-toggle="modal" title="" class="btn btn-link btn-primary text-white" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                              <a href="<?php echo base_url('Admin/Hapus_Pegawai/'.$dtl->id)?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger text-white" data-original-title="Remove" onclick="javascript: return  confirm('Anda  yakin  hapus?')">
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
                    Tambah Pegawai
                </h1>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('Admin/Tambah_Pegawai');?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>nama pegawai</label>
                                <input id="nama_pegawai" type="text" class="form-control" placeholder="nama pegawai" name="nama_pegawai" >                               
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label for="kode_pegawai">kode pegawai</label>
                    <input type="text" class="form-control" id="kode_pegawai" placeholder="kode_pegawai" name="kode_pegawai" value="KP00<?php foreach($total_pegawai as $tb): ?><?php echo $tb->total+1  ?><?php endforeach;?>" readonly>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label for="nomor_telepon">nomor_telepon</label>
                    <input type="text" class="form-control" id="nomor_telepon" placeholder="nomor telepon" name="nomor_telepon">

                            </div>
                        </div>
                         <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" id="kode_posisi" name="kode_posisi">
                      <?php foreach($posisi as $bh): ?>
                        <option value="<?php echo $bh->kode_posisi?>" name=""><?php echo $bh->nama_posisi?></option>
                      <?php endforeach;?>
                    </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" id="kode_kota" name="kode_kota">
                      <?php foreach($kota as $bk): ?>
                        <option value="<?php echo $bk->kode_kota?>" name=""><?php echo $bk->nama_kota?></option>
                      <?php endforeach;?>
                    </select>
                            </div>
                        </div>


                    </div>
            </div>
            <div class="modal-footer no-bd">
                <button type="submit" id="addRowButton" class="btn btn-warning">Kirim</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


                  <?php
                  foreach($pegawai as $e) : ?>
<div class="modal fade" id="modalEdit<?php echo $e->id?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h1 class="modal-title">
                    Edit Pegawai
                </h1>
            </div>
            <div class="modal-body">
             <?php echo form_open_multipart('Admin/Update_Pegawai');?>
      
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>nama pegawai</label>
                                <input type="hidden" name="id" value="<?php echo $e->id ?>">
                                <input id="nama_pegawai" type="text" class="form-control" placeholder="nama_pegawai" name="nama_pegawai" value="<?php echo $e->nama_pegawai?>">
                               
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label for="kode_pegawai">kode pegawai</label>
                    <input type="text" class="form-control" id="kode_pegawai" name="kode_pegawai" value="<?php echo $e->kode_pegawai?>" readonly>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nomor_telepon">nomor telepon</label>
                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?php echo $e->nomor_telepon; ?>" placeholder="<?php echo $e->nomor_telepon; ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" id="kode_posisi" name="kode_posisi">
                      
                        <option value="<?php echo $e->kode_posisi?>" name=""><?php echo $e->nama_posisi?></option>
                        <?php foreach($posisi as $ps) : ?>
                            <?php if($e->kode_posisi != $ps->kode_posisi){ ?>
                            <option value="<?php echo $ps->kode_posisi?>" name=""><?php echo $ps->nama_posisi?></option>
                        <?php } ?>

                        <?php endforeach; ?>
                      
                    </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" id="kode_kota" name="kode_kota">
                      
                        <option value="<?php echo $e->kode_kota?>" name=""><?php echo $e->nama_kota?></option>
                        <?php foreach($kota as $pk) : ?>
                            <?php if($e->kode_kota != $pk->kode_kota){ ?>
                            <option value="<?php echo $pk->kode_kota?>" name=""><?php echo $pk->nama_kota?></option>
                        <?php } ?>
                        
                        <?php endforeach; ?>
                     
                    </select>
                            </div>
                        </div>

                        
                    </div>
            </div>
            <div class="modal-footer no-bd">
                <button type="submit" id="addRowButton" class="btn btn-warning">Edit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
      
    </div>
<?php //Loading navbar.php
  $this->load->view('admin/templates/footer');
?>