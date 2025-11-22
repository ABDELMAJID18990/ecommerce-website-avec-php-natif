<?php
    
    $idUtilisateur = $_SESSION['utilisateur']['id'];
    $qte = $_SESSION['panier'][$idUtilisateur][$idProduit] ?? 0;
    $btnLibelle = $qte == 0 ? '<i class="fa-solid fa-cart-shopping"></i>': '<i class="fa-solid fa-pen"></i>'  ;
                       
?>

                            <div>
                                <form action="ajouter_panier.php" method="post" class="counter d-flex">
                                        <input type="hidden" name="id" value="<?= $idProduit ?>" >
                                        <button onclick="return false;" class="btn btn-primary mx-2 counter-moins">-</button>
                                        <input type="number" class="form-control" name="qte" id="qte" min="0" value="<?= $qte ?>" max="99">
                                        <button onclick="return false;" class="btn btn-primary mx-2 counter-plus">+</button> 
                                        
                                        <button type="submit" name="ajouter" class="btn btn-success mx-1">
                                            <?= $btnLibelle ?>
                                        </button>  
                                        <?php if($qte > 0): ?>
                                            <button type="submit" name="ajouter" formaction="supprimer_article.php" class="btn btn-danger mx-1">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                           <!-- <input class="btn btn-danger mx-2" formaction="supprimer_article.php" type="submit" value="Supprimer" name="supprimer">-->
                                        <?php endif; ?>

                                </form>
                                
                            </div>
                            