<div class="modal fade" id="modal-evolution">
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
                <form id="form-evolution">
                    <input id="id-evolution" type="hidden" value=""/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="annee-evo">
                                    Année
                                </label>
                                <input class="form-control" id="annee-evo" name="annee-evo" type="text" value=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="situation-evo">
                                    Situation
                                </label>

                                <select name="situation-evo" id="situation-evo" required class="form-control">
                                  <option disabled>-- Choisir un status --</option>
                                  <option value="BOURSIER(MINESUP)" 
                                  @if($etudiant->status == "BOURSIER(MINESUP)") selected="selected" @endif >BOURSIER(MINESUP)</option>
                                  <option value="BOURSIER(MINEFOP)" 
                                  @if($etudiant->status == "BOURSIER(MINEFOP)") selected="selected" @endif>BOURSIER(MINEFOP)</option>
                                  <option value="STAGAIRE" 
                                  @if($etudiant->status == "STAGAIRE") selected="selected" @endif >STAGAIRE</option>
                                  <option value="NON-BOURSIER"  
                                  @if($etudiant->status == "NON-BOURSIER") selected="selected" @endif>NON-BOURSIER</option>
                                  <option value="non boursier"  
                                  @if($etudiant->status == "AUTRES") selected="selected" @endif>AUTRES</option>
                              </select>

                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div id="villes-div" class="input-group">
                            <label class="control-label" for="villes-evo">
                                Villes
                            </label>
                            <select class="form-control" name="villes-evo" id="villes-evo">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div id="filieres-div" class="input-group">
                            <label class="control-label" for="filieres-evo">
                                Filières
                            </label>
                            <select class="form-control" name="filieres-evo" id="filieres-evo">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div id="etablissement-div" class="input-group">
                            <label class="control-label" for="etablissements-evo">
                                Etablissements
                            </label>
                            <select class="form-control" name="etablissements-evo" id="etablissements-evo">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="niveau">Niveau*</label>
                        <input type="number" name="niveau" parsley-trigger="change" required placeholder="Entrer la niveau" class="form-control" id="niveau" value="">
                    </div>

                </div>
            </div>
            <br>
            <button class="btn btn-primary" id="sousmettre-evo" type="submit">
                Mettre à jour
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
