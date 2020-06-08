# act4.2_Api_Rest

Activitat ACT 4.1: Creació i consum d'un servei web REST
L'objectiu final d'aquesta aplicació web és oferir als nostres clients conèixer en un cop d'ull les ofertes d'oci disponibles al seu abast.
A grans trets:
- Un usuari no autenticat podrà introduir la ubicació física i les seves preferències d'oci (cinema, excursions, ...). L'aplicació respondrà amb les ofertes d'oci que compleixin els desitjos de l'usuari.
- Per un usuari autenticat, l'aplicació guardarà les seves preferències i li oferirà la possibilitat d'adquirir les entrades corresponents.

Per muntar aquesta aplicació, utilitzarem APIs REST ja desenvolupades i no podria ser d'una altra manera, desenvoluparem algunes pròpies.

PAS 1:
Centrant-nos en aquesta activitat, seguint el tutorial " Primeros pasos con Symfony 5 como API REST ", es demana la creació d'un servei web tipus REST, que permeti, amb els mètodes http GET, POST, PUT i DELETE: visualitzar, afegir, modificar i esborrar pel·lícules de la taula peliculas (id, nombre, genero, descripcion) de la BD cinema

Nota: fixa't què per la creació del projecte no utilitza pas l'opció --full. Totes les passes les coneixes.

Prova els diferents mètodes amb un client http com ara Postman o Insomnia.

PAS 2:

Crea l'aplicació oci que consumirà el servei REST.

Lliura aquesta activitat utilitzant git.
