<div class="modal fade bd-example-modal-sm" id="modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">

                <!--Utilisation d'un modal, et création du bouton pour fermer ce dernier.-->

                <h5 class="modal-title">Annotation commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- On récupère la note si il y en a une déjà existante, sinon on ne récupère rien. -->


            <?php
            $note = selectNote($_GET['OrderId']);
            ?>


            <!--Sert à créer le formlaire pour éditer la note et l'enregistrer dans a base de données pour pouvoir la récupérer.-->

            <form method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">Note
                            <textarea class="form-control" placeholder="Votre note" name="note"><?php if ($note != null) echo $note->Note; ?></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="editID" name="editID" value="<?php echo $_GET['OrderId'];?>"/>
                </div>
                <div class="modal-footer">
                    <!--On créé un bouton avec un modal pour permettre de valider l'annotation de la commande.-->
                    <button type="submit" class="btn btn-primary float-right" name="editNote">Annoter</button>
                </div>
            </form>
        </div>
    </div>
</div>