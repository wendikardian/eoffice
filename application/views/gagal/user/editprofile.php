 <div class="breadcome-area">
     <div class="container-fluid">
         <div class="row">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="breadcome-list single-page-breadcome">
                     <div class="row">
                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         </div>
                     </div>
                 </div>
             </div>

             <div class="container">
                 <div class="row">
                     <div class="col-lg-12">
                         <h1><?= $title; ?></h1>
                         <hr>
                     </div>
                 </div>
             </div>
             <!-- Single pro tab review Start-->
             <div class="row">
                 <div class="col-lg-12">
                     <?php echo form_open_multipart('user/editprofile'); ?>

                     <div class="form-group row">
                         <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                         <div class="col-sm-10">
                             <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="inputEmail3" class="col-sm-2 col-form-label">Full Name</label>
                         <div class="col-sm-10">
                             <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                             <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="inputEmail3" class="col-sm-2 col-form-label">Telp</label>
                         <div class="col-sm-10">
                             <input type="text" class="form-control" id="telp" name="telp" value="<?= $user['telp']; ?>">
                             <?= form_error('telp', '<small class="text-danger pl-3">', '</small>'); ?>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="inputEmail3" class="col-sm-2 col-form-label">Picture</label>
                         <div class="col-sm-10">
                             <div class="row">
                                 <div class="col-sm-3">
                                     <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                                     <div class="col-sm-9">
                                         <div class="custom-file">
                                             <input type="file" class="custom-file-input" id="image" name="image">
                                         </div>
                                     </div>
                                 </div>

                             </div>
                         </div>
                         <br>
                         <div class="col-sm-5 justify-content-end">
                             <div class="pt-4">
                                 <button type="submit" class="btn btn-primary"> Edit</button>
                             </div>
                         </div>
                     </div>

                     <div class="form-group row">



                     </div>
                     </form>
                 </div>
             </div>