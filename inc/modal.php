<div class="modal fade bd-example-modal-sm" id="modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Annotation commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $note = selectNote($_GET['note']);
            ?>
            <form method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col"> Note
                            <textarea class="form-control" placeholder="Votre note" name="note"><?php if ($note->idOrder == $_GET['note']) echo $note->Note; ?></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="editID" name="editID" value="<?php if ($note->idOrder == $_GET['note']) echo $note->idOrder; ?>"/>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary float-right" name="edit">Annoter</button>
                </div>
            </form>
        </div>
    </div>
</div>