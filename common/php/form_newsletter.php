<?php
global $words;

if(empty($words['URL_FORM']))
  $words['URL_FORM'] = [
    'ALL' => '',
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
if(empty($words['TXT_FORM_0']))
  $words['TXT_FORM_0'] = [
    'ALL' => '',
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
if(empty($words['TXT_FORM_1']))
  $words['TXT_FORM_1'] = [
    'ALL' => '',
    'FR' => "Une erreur est survenue lors de l'inscription",
    'BE-FR' => "Une erreur est survenue lors de l'inscription",
    'BE-EN' => "An error occurred during registration",
    'UK' => "An error occurred during registration",
    'IE' => "An error occurred during registration",
    'DE' => "An error occurred during registration",
    'ES' => "An error occurred during registration",
    'IT' => "An error occurred during registration",
    'NL' => "An error occurred during registration",
    ];
if(empty($words['TXT_FORM_2']))
  $words['TXT_FORM_2'] = [
    'ALL' => '',
    'FR' => "Une erreur de communication est survenue lors de l'inscription",
    'BE-FR' => "Une erreur de communication est survenue lors de l'inscription",
    'BE-EN' => "A communication error occurred during registration",
    'UK' => "A communication error occurred during registration",
    'IE' => "A communication error occurred during registration",
    'DE' => "A communication error occurred during registration",
    'ES' => "A communication error occurred during registration",
    'IT' => "A communication error occurred during registration",
    'NL' => "A communication error occurred during registration",
    ];
if(empty($words['TXT_FORM_3']))
  $words['TXT_FORM_3'] = [
    'ALL' => '',
    'FR' => "Vous êtes déjà inscrit à la newsletter.",
    'BE-FR' => "You already subsribed to the newsletter",
    'BE-EN' => "Vous êtes déjà inscrit à la newsletter.",
    'UK' => "You already subsribed to the newsletter",
    'IE' => "You already subsribed to the newsletter",
    'DE' => "Sie sind bereits für den newsletter eingetragen.",
    'ES' => "Usted ya está suscrito a la newsletter",
    'IT' => "You already subsribed to the newsletter",
    'NL' => "You already subsribed to the newsletter",
    ];
if(empty($words['TXT_EMAIL_PLACEHOLDER']))
  $words['TXT_EMAIL_PLACEHOLDER'] = [
    'ALL' => "Email",
    ];
if(empty($words["TXT_NEWSLETTER-RGPD"]))
  $words["TXT_NEWSLETTER-RGPD"] = [
    "ALL" => "",
    "FR" => "En vous inscrivant à la newsletter, vous acceptez nos termes et conditions & politique de confidentialité",
    "UK" => "By subscribing to our newsletter, you agree to our terms and conditions & our privacy policy",
    "IE" => "",
    "ES" => "Al inscribirse a la newsletter, acepta nuestros términos y condiciones, y nuestra política de confidencialidad",
    "DE" => "Mit der Anmeldung zu unserem Newsletter akzeptieren Sie unsere Geschäftsbedingungen & unsere Datenschutzpolitik",
    "IT" => "Iscrivendosi alla newsletter, accetta i nostri termini e condizioni e la nostra politica sulla privacy",
    "FL" => "",
    ];
if(empty($words["TXT_CTA_NEWSLETTER"]))
  $words["TXT_CTA_NEWSLETTER"] = [
    "ALL" => "",
    "FR" => "En savoir plus",
    "UK" => "See more",
    "IE" => "",
    "ES" => "Ver todas",
    "DE" => "Mehr einsehen",
    "IT" => "Vedi tutti",
    "FL" => "",
    ];
if(empty($words["URL_CTA_NEWSLETTER"]))
  $words["URL_CTA_NEWSLETTER"] = [
    "ALL" => "",
    "FR" => "https://fr.maje.com/fr/conditions-generales-de-vente/terms.html?#Protectiondesdonneespersonnelles",
    "BE-FR" => "https://be.maje.com/fr/conditions-generales-de-vente/terms.html?#Protectiondesdonneespersonnelles",
    "BE-EN" => "https://be.maje.com/en/general-terms-of-sale/terms.html?#personaldataprotection",
    "UK" => "https://uk.maje.com/en/general-terms-of-sale/terms.html?#Personaldataprotection",
    "IE" => "https://ie.maje.com/en/general-terms-of-sale/terms.html?#protectionofpersonalinformation",
    "DE" => "https://de.maje.com/de/allgemeine-geschaftsbedingungen/terms.html?#Schutzpersonenbezogenerdaten",
    "ES" => "https://es.maje.com/es/condiciones-generales-de-venta/terms.html?#protecciondedatospersonales",
    "IT" => "https://it.maje.com/it/condizioni-generali-di-vendita/terms.html?#protezionedeidatipersonali",
    "EU" => "https://eu.maje.com/en/general-terms-of-sale/terms.html?#Personaldataprotection",
    "CH-EN" => "https://eu.maje.com/en/general-terms-of-sale/terms.html?#Personaldataprotection",
    ];
?>
<div class="footerNewsletter news-letter">
  <p class="msg"></p>
  <form id="newsletterForm" class="collapsMe newsletterForm ka_maje_form" action="<?= word('URL_FORM') ?>">
    <div class="required">
      <input type="submit" id="submitnewsletter" value=""
        data-msgdone="<?= word('TXT_FORM_0') ?>"
        data-msgerror="<?= word('TXT_FORM_1') ?>"
        data-msgcomerror="<?= word('TXT_FORM_2') ?>"
        data-msgalreadydone="<?= word('TXT_FORM_3') ?>"
        />
      <input type="email" placeholder="<?= word('TXT_EMAIL_PLACEHOLDER') ?>" name="nlemail" id="nlemail" class="input-text email nlemail" required="required"  />
    </div>
  </form>
</div>
<p class="footerNewsletter-notice"><?= word('TXT_NEWSLETTER-RGPD') ?> <a href="<?= word('URL_CTA_NEWSLETTER') ?>"><?= word('TXT_CTA_NEWSLETTER') ?></a></p>
