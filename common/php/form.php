<?php
$words['URL_FORM'] = [
  'FR' => "/on/demandware.store/Sites-Maje-FR-Site/fr/SuscribeToNewsletter-Suscribe",
  'BE-FR' => "/on/demandware.store/Sites-Maje-BE-Site/fr/SuscribeToNewsletter-Suscribe",
  'BE-EN' => "/on/demandware.store/Sites-Maje-BE-Site/en/SuscribeToNewsletter-Suscribe",
  'UK' => "/on/demandware.store/Sites-Maje-UK-Site/en/SuscribeToNewsletter-Suscribe",
  'IE' => "/on/demandware.store/Sites-Maje-IE-Site/en/SuscribeToNewsletter-Suscribe",
  'DE' => "/on/demandware.store/Sites-Maje-DE-Site/de/SuscribeToNewsletter-Suscribe",
  'ES' => "/on/demandware.store/Sites-Maje-ES-Site/es/SuscribeToNewsletter-Suscribe",
  'IT' => "/on/demandware.store/Sites-Maje-IT-Site/it/SuscribeToNewsletter-Suscribe",
  'NL' => "",
  ];
$words['FORM_O'] = [
  'FR' => "Merci, votre inscription à la newsletter a été prise en compte.",
  'BE-FR' => "Merci, votre inscription à la newsletter a été prise en compte.",
  'BE-EN' => "Your registration has been received, thank you.",
  'UK' => "Your registration has been received, thank you.",
  'IE' => "Your registration has been received, thank you.",
  'DE' => "Danke, ihre Anmeldung wurde gespeichert.",
  'ES' => "Se ha registrado su suscripción a la newsletter, gracias.",
  'IT' => "La sua iscrizione alla newsletter è stata registrata, grazie.",
  'NL' => "",
  ];
$words['FORM_1'] = [
  'FR' => "Une erreur est survenue lors de l'inscription",
  'BE-FR' => "Une erreur est survenue lors de l'inscription",
  'BE-EN' => "An error occurred during registration",
  'UK' => "An error occurred during registration",
  'IE' => "An error occurred during registration",
  'DE' => "",
  'ES' => "",
  'IT' => "",
  'NL' => "",
  ];
$words['FORM_2'] = [
  'FR' => "Une erreur de communication est survenue lors de l'inscription",
  'BE-FR' => "Une erreur de communication est survenue lors de l'inscription",
  'BE-EN' => "A communication error occurred during registration",
  'UK' => "A communication error occurred during registration",
  'IE' => "A communication error occurred during registration",
  'DE' => "",
  'ES' => "",
  'IT' => "",
  'NL' => "",
  ];
$words['FORM_3'] = [
  'FR' => "Vous êtes déjà inscrit à la newsletter.",
  'BE-FR' => "You already subsribed to the newsletter",
  'BE-EN' => "Vous êtes déjà inscrit à la newsletter.",
  'UK' => "You already subsribed to the newsletter",
  'IE' => "You already subsribed to the newsletter",
  'DE' => "Sie sind bereits für den newsletter eingetragen.",
  'ES' => "Usted ya está suscrito a la newsletter",
  'IT' => "",
  'NL' => "",
  ];
?>

<form id="newsletterForm" class="collapsMe newsletterForm ka_maje_form" action="<?= WORD('URL_FORM') ?>">
  <div class="required">
    <input type="submit" id="submitnewsletter" value="OK"
      data-msgdone="<?= WORD('FORM_O') ?>"
      data-msgerror="<?= WORD('FORM_1', 'FR') ?>"
      data-msgcomerror="<?= WORD('FORM_2', 'FR') ?>"
      data-msgalreadydone="<?= WORD('FORM_3', 'FR') ?>"
      />
    <input type="email" placeholder="Saisir votre Email" name="nlemail" id="nlemail" class="input-text email nlemail" required="required"  />
  </div>
</form>
<div class="footerContent"><div class="footerNewsletter text-center center-block"><p></p></div></div>
