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
                                <input class="form-control" id="situation-evo" name="situation-evo" type="text" value=""/>
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
