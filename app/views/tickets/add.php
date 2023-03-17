<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajoute</title>
</head>
<body>
<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
  .jumbotron{
  padding: 1rem 1rem;
  }
</style>
<a href="<?php echo URLROOT; ?>/tickets" class="btn btn-light"><i class="fa fa-backward" aria-hidden="true"></i> Back</a><br><br>
<div class="card card-body  jumbotron jumbotron-flu">     
           <h2 class="mb-2 text-center">Ajouter Une Eticket</h2>
               <form action="<?php echo URLROOT; ?>/tickets/add" method="post" enctype="multipart/form-data">
                      <!--Type Radio Box-->
                      <fieldset class="form-group">
                          <div class="row">
                            <legend class="col-form-label col-sm-3 pt-0  ml-0">Type :</legend>
                              <div class="col-sm-9">
                                <div class="form-check custom-control-inline  ">
                                  <input class="form-check-input" type="radio" name="type" id="type" value="Demande" checked>
                                  <label class="form-check-label" for="gridRadios1">Demande</label>
                                </div>
                                <div class="form-check custom-control-inline">
                                  <input class="form-check-input" type="radio" name="type" id="type" value="Incident">
                                  <label class="form-check-label" for="gridRadios2">Incident</label>
                                </div>
                              </div>
                          </div>
                      </fieldset>     
                      <div class="row mb-3">
                     <div class="col">
                        <label for="category">Categorie: <sup>*</sup></label>
                          <select class="form-control <?php echo (!empty($data['category_err']) ? 'is-invalid' : '') ?>"
                          id="category"name="category" value="<?php echo $data['category']; ?>">
                            <option value="">Select...</option>
                                      <option value="Licence d’un logiciel">Licence d’un logiciel</option>
                                      <option value="Un matériel">Un matériel</option>
                                      <option value="Un accès">Un accès </option>
                            </select>
                            <span class="invalid-feedback"><?php echo $data['category_err'] ?></span>
                     </div>
                    <!--Titre input-->
                    <div class="form-group col-md-6">
                            <label for="subject">Titre: <sup>*</sup></label>
                              <input type="text" name="subject" class="form-control form -control-lg 
                              <?php echo (!empty($data['subject_err']) ? 'is-invalid' : '') ?>" value="<?php echo $data['subject']; ?>" placeholder="Titre">
                            <span class="invalid-feedback"><?php echo $data['subject_err'] ?></span>
                          </div>
                        </div>   
                    <!--description input-->
                    <div class="form-group">
                              <label for="description">Description: <sup>*</sup></label>
                              <textarea type="text" rows="3" name="description" class="form-control form -control-lg 
                              <?php echo (!empty($data['description_err']) ? 'is-invalid' : '') ?>" value="<?php echo $data['description']; ?>"></textarea>
                              <span class="invalid-feedback"><?php echo $data['description_err'] ?></span>
                          </div>
                      <!--Piece Jointe-->
                      <label  for="attachment">Piece Jointe: </label>
                            <div class="custom-file mb-3">
                              <input type="file" class="custom-file-input"value="<?php echo $data['attachment']; ?>" id="attachment" name="attachment" >
                              <label class="custom-file-label " for="attachment">Piece Jointe ...</label>
                            </div>
                      <div class="row mb-3">
                      <!--Niveau urgence-->
                      <div class="col">
                        <label for="level">Niveau d’urgence: <sup>*</sup></label>
                          <select class="form-control <?php echo (!empty($data['level_err']) ? 'is-invalid' : '') ?>"
                            id="level"name="level" value="<?php echo $data['level']; ?>">      
                              <option value="0">Choisi le niveau</option>
                              <option value="1">Moyen</option>
                              <option value="2">Urgente</option>
                              <option value="3">Très urgente</option>
                              <option value="4">Bloquante</option>
                            </select>
                          <span class="invalid-feedback"><?php echo $data['level_err'] ?></span>
                        </div>
                      </div>
                      <input type="submit" name="submit" class="btn btn-success btn-block" value="Valider">
              </form>
</div>
<?php require APPROOT . '/views/inc/footer.php' ?>
</body>
</html>