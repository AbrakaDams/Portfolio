<?php 
$post = [];
$errors = [];
$succes  = false;
$showErrors = false;

if(!empty($_POST)){

	foreach ($_POST as $key => $value) {
		$post[$key] = trim(strip_tags($value));
	}
	if(strlen($post['name']) < 2 || strlen($post['name']) > 12){
		$errors[] = 'le titre doit contenir entre 5 et 50 caracteres';
	}
	if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'Votre email n\'est pas valide';
	}
	if(strlen($post['content']) < 5 || strlen($post['content']) > 140 ){
		$errors[] = ' la description doit comporter entre 10 et 140 caractères';
	}
	if(count($errors) > 0 ){
	 	$showErrors = true;
	}else{

		$requete = $bdd->prepare('INSERT INTO `formulaire` (`id`, `name`, `email`, `content`) VALUES (NULL, :name, :email, :content)');
		$requete->bindValue(':name', $post['name']);
		$requete->bindValue(':email', $post['email']);
		$requete->bindValue(':content', $post['content']);
		if($requete->execute()){
			$succes = true;
		}
	}
}

?>

<section id="services" class="services-section">
    <div class="container" height="900px">
        <div class="row">
            <div class="col-lg-12">
            <br>
                <h1 class="mod2">Formulaire de contact</h1>
                <?php 
	                if($showErrors == true){
						echo '<div class="alert alert-danger"><ul>';
						foreach ($errors as $err) {
							echo '<li><strong>'.$err.'</strong></li>';
						}
						echo '</ul></div>';
					}
					if($succes == true){
						echo '<div class="alert alert-success"><strong>Formulaire envoyé</strong></div>';
					} 
				?>
                <form class="form-vertical-align" action="#services" method="post">
				  <div for="name" class="form-group">
				    <input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom">
				  </div>
				  <div for="email" class="form-group">
				    <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email : jane.doe@example.com">
				  </div>
				  <div for="content" class="form-group">
				  	<textarea placeholder="Entrez votre message ..." id="content"  name="content" class="form-control" cols="30" rows="10"></textarea>
				  </div>
				  <button type="submit" class="btn btn-primary"><strong>Envoyer</strong></button>
				</form>
            </div>
        </div>
    </div>
</section>