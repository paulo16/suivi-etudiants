<div class="modal fade" id="modal-etudiant">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title">
                    Mise à jour Etudiant
                </h4>
            </div>
            <div class="modal-body">
                <form id="form-etudiant">
                    <input id="id-etudiant" type="hidden" value=""/>
                    <input id="id-evolution" type="hidden" value=""/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="nom">
                                    Nom
                                </label>
                                <input class="form-control" id="nom" name="nom" type="text" value="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="prenom">
                                    Prenom
                                </label>
                                <input class="form-control" id="prenom" name="prenom" type="text" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <label class="control-label" for="date-naissance">
                                    Date naissance
                                </label>
                                <input class="form-control" id="date-naissance" placeholder="yyyy-mm-dd" type="text"/>
                                <span class="text-white">
                                    <i class="icon-calender">
                                    </i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="promotion">
                                    promotion
                                </label>
                                <input class="form-control" id="promotion" name="promotion" type="text" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="genre">
                                    Genre
                                </label>
                                <input class="form-control" id="genre" name="genre" type="text" value=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="etablissement-div" class="input-group">
                                <label class="control-label" for="etablissement">
                                    Etablissement
                                </label>
                                <select class="form-control" name="etablissements" id="etablissements">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="villes-div" class="input-group">
                                <label class="control-label" for="etablissement">
                                    Villes
                                </label>
                                <select class="form-control" name="villes" id="villes">
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div id="filieres-div" class="input-group">
                                <label class="control-label" for="etablissement">
                                    Filières
                                </label>
                                <select class="form-control" name="filieres" id="filieres">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="email">
                                    Email
                                </label>
                                <input class="form-control" id="email" name="email" type="text" value=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="tel">
                                    Teléphone
                                </label>
                                <input class="form-control" id="tel" name="tel" type="text" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="situation">
                                    Situation
                                </label>
                                <input class="form-control" id="situation" name="situation" type="text" value=""/>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-primary" id="sousmettre" type="submit">
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
