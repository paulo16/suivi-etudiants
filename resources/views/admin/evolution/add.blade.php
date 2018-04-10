<div class="modal fade" id="modal-add-evo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title">
                    Evolution étudiant
                </h4>
            </div>
            <div class="modal-body">
                <form id="form-add-evo">
                    <input id="id-etudiant-add-evo" type="hidden" value=""/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="annee-add-evo">
                                    Année
                                </label>
                                <input class="form-control" id="annee-add-evo" name="annee-add-evo" type="number" value=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="situation-add-evo">
                                    Situation
                                </label>

                                <select name="situation-evo" id="situation-add-evo" required class="form-control">
                                  <option disabled>-- Choisir un status --</option>
                                  <option value="BOURSIER(MINESUP)" >BOURSIER(MINESUP)</option>
                                  <option value="BOURSIER(MINEFOP)">BOURSIER(MINEFOP)</option>
                                  <option value="STAGAIRE" >STAGAIRE</option>
                                  <option value="NON-BOURSIER" >NON-BOURSIER</option>
                                  <option value="AUTRES" >AUTRES</option>
                              </select>

                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div id="villes-div" class="input-group">
                            <label class="control-label" for="villes-add-evo">
                                Villes
                            </label>
                            <select class="form-control" name="villes-add-evo" id="villes-add-evo">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div id="filieres-div" class="input-group">
                            <label class="control-label" for="filieres-add-evo">
                                Filières
                            </label>
                            <select class="form-control" name="filieres-add-evo" id="filieres-add-evo">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div id="etablissement-div" class="input-group">
                            <label class="control-label" for="etablissements-add-evo">
                                Etablissements
                            </label>
                            <select class="form-control" name="etablissements-add-evo" id="etablissements-add-evo">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="niveau">Niveau*</label>
                        <input type="number" name="niveau" parsley-trigger="change"  placeholder="Entrer la niveau" class="form-control" id="niveau" value="">
                    </div>
                </div>
            </div>
            <br>
            <button class="btn btn-primary" id="sousmettre-add-evo" type="submit">
                Ajouter
            </button>
            <br>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" type="button">
            Fermer
        </button>
    </div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
