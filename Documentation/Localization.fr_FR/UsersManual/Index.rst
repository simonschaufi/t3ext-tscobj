.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _users-manual:

Manuel de l'utilisateur
=======================


.. _users-manual-installation:

Installation
------------

L'installation de l'extension est très simple. Il suffit de se connecter au "repository" des extensions TYPO3 et de
télécharger "Content Element From TypoScript" (tscobj), qui se trouve dans la section "frontend plugin".

Ensuite, créez simplement un nouvel élément de contenu sur une page et choisissez "Objet TypoScript" dans l'assistant.

.. image:: ../../Images/plugins.jpg
	:alt: New content element of type "TypoScript"


.. _users-manual-usage:

Utilisation
-----------

Une fois le plugin créé, vous aurez la possibilité d'indiquer le chemin de l'objet TypoScript que vous voulez afficher.

.. image:: ../../Images/plugin-options.jpg
	:alt: Options du plugin "TypoScript"

Si vous cliquez sur la petite roue à droite du champ, vous déclencherez un assistant qui vous permettra de visualiser
tous les objets du gabarit disponibles. Vous pouvez en sélectionner un en cliquant simplement sur son nom.

.. image:: ../../Images/plugin-wizard.jpg
	:alt: Assistant du plugin "TypoScript"

.. note::
	Seulement les objets pouvant être rendus sont affichés ici.

La case à cocher htmlspecialchars peut être utilisée si vous voulez visualiser le code HTML de l'objet sur la page (il
ne sera donc pas interprété par le navigateur). Cette fonctionnalité peut être utile aux développeurs.
