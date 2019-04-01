<div class="modal fade bd-example-modal-sm" id="Modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Annotation commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col"> Note
                            <input type="email" class="form-control" placeholder="Votre note" name="note"
                                   required>
                        </div>
                    </div>
                    <input type="hidden" id="editID" name="editID" value=""/>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary float-right" name="edit">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>