<div id="modal-etudiant" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Mise à jour Etudiant</h4>
            </div>
            <div class="modal-body">
                <form id="form-etudiant">
                    <input id="id-etudiant" value="" type="hidden"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom" class="control-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="prenom" class="control-label">Prenom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom"
                                       value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tel" class="control-label">Teléphone</label>
                                <input type="text" class="form-control" name="tel" id="tel"
                                       value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <label for="date-naissance" class="control-label">Date Naissance</label>
                                <input name="date-naissance" id="date-naissance"
                                       value=""
                                       class="form-control required datetimepicker"
                                       type="text"/>
                                <span class="input-group-addon btn-primary  b-0 text-white"><i class="ti-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <label for="adresse" class="control-label">Adresse</label>
                                <input name="adresse" id="adresse" value="" class="form-control" type="text"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <label for="promotion" class="control-label">promotion</label>
                                <input name="promotion" id="promotion" value="" class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <label for="genre" class="control-label">Genre</label>
                                <input name="genre" id="genre" value="" class="form-control" type="text"/>
                            </div>
                        </div>
                    </div>

                    <br>

                    <button type="submit" id="sousmettre"  class="btn btn-primary">Mettre à jour</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
