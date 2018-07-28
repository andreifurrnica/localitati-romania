Scriptul convert.php transforma siruta oferita de data.gov.ro intr-un fisier JSON cu UAT-urile organizate ierarhic.
Campurile din CSV au denumiri diferite in JSON.


| Camp JSON   |      Camp CSV |     
|----------|-------------|
| id | SIRUTA |
| name | DENLOC |
| county_id |  JUD |
| parent_id |  SIRSUP |
| region_id |  REGIUNE |
| area_id |  MED |
| rank |  rang |
| type |  TIP |

Explicatii type:
* 40 - Judeţ, municipiul Bucureşti
* 1 - Municipiu reşedinţă de judeţ, reşedinţă a municipiului Bucureşti
* 2 - Oraş ce aparţine de judeţ, altul decât oraş reşedinţă de judeţ
* 3 - Comună
* 4 - Municipiu, altul decât reşedinţă de judeţ
* 5 - Oraş reşedinţă de judeţ
* 6 - Sector al municipiului Bucureşti
* 9 - Localitate componentă, reşedinţă de municipiu
* 10 - Localitate componentă, a unui municipiu alta decât reşedinţă de municipiu
* 11 - Sat ce aparţine de municipiu
* 17 - Localitate componentă reşedinţă a oraşului
* 18 - Localitate componentă a unui oraş, alta decât reşedinţă de oraş
* 19 - Sat care aparţine unui oraş
* 22 - Sat reşedinţă de comună
* 23 - Sat ce aparţine de comună, altul decât reşedinţă de comună

Explicatii area_id:
* 0 - utilizat doar la judete si mun. Bucuresti
* 1 - urban
* 3 - rural

**Pull request-urile sunt bine venite.**


Sursa SIRUTA: http://data.gov.ro/dataset/siruta
Sursa informatii TIP si MED: http://www.valideaza.ro/pdf/MetodologieSIRUTA.pdf