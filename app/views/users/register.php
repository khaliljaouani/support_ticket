<?php require APPROOT . '/views/inc/header.php'; ?>

 <div class="row">
     <div class="col-md-6 mx-auto">
         <div class="card card-body bg-light mt-5">
             <?php flash('register_error') ?>
             <h2>Créer un compte</h2>
             <p>Veuillez remplir ce formulaire pour vous inscrire</p>
             <form action="<?php echo URLROOT; ?>/users/register" method="post">
                <div class="form-group">
                    <label for="firstname">Prénom :  <sup>*</sup></label>
                    <input type="text" name="firstname" class="form-control form -control-lg <?php echo (!empty($data['firstname_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['firstname']; ?>">
                    <span class="invalid-feedback"><?php echo $data['firstname_err'] ?></span>
                </div>
                <div class="form-group">
                    <label for="lastname">Nom : <sup>*</sup></label>
                    <input type="text" name="lastname" class="form-control form -control-lg <?php echo (!empty($data['lastname_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['lastname']; ?>">
                    <span class="invalid-feedback"><?php echo $data['lastname_err'] ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" class="form-control form -control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err'] ?></span>
                </div>
                 <!--password input-->
                 <div class="form-row">
                    <div class="col">
                    <label for="password">Mot de passe : <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form -control-lg <?php echo (!empty($data['password_err']) ? 'is-invalid' : '') ?>" 
                    value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err'] ?></span>
                    </div>
                    
                
                <!--confi-password input-->
                <div class="col">
                    <label for="confirm_password">Confirm mot de passe : <sup>*</sup></label>
                    <input type="password" name="confirm_password" class="form-control form -control-lg <?php echo (!empty($data['confirm_password_err']) ? 'is-invalid' : '') ?>" 
                    value="<?php echo $data['confirm_password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['confirm_password_err'] ?></span>
                </div>
                </div>
                     <!--Type compte-->
                     <div class="form-group mt-3">
                    <label for="type">Type de compte : <sup>*</sup></label>
                    <select name="type" class="form-control form -control-lg <?php echo (!empty($data['type_err']) ? 'is-invalid' : '') ?>" 
                    value="<?php echo $data['type']; ?>">
                            <option value="0">Sélectionner votre type</option>
                            <option value="support">Support</option>
                            <option value="user">User</option>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['type_err'] ?></span>
                  </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="S'inscrire" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Connexion</a>
                    </div>
                </div>
             </form>
         </div>
     </div>
 </div>

<?php require APPROOT . '/views/inc/footer.php' ?>