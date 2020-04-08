I induviduell uppgiften har jag 4 tabeller

1. "users" 
    -   id
    -   user
    -   password
    -   token_id

kommer att ta hand om användare, om man logar in eller om man registrerar användare kommer dem att hamna här

2.  "produkts"
    -   id
    -   produkt
    -   price
    -   storlek

alla produkter som finns och skapas är i denna tabel

3.  "orders"
    -   id
    -   user_id
    -   produkt_id
    -   date

om en användare lägger en beställning på en produkt kommer den att hamna här

4.  "tokens"
    -   id
    -   users_id
    -   token/data
    -   date

här kommer alla ny tokens att hamna och delas ut till enskilda användre.


Updelning av map struktur:
map = +
file = -

+individuell_uppgift

    +config
    -   database_handler.php

    +objects
    -   posts.php
    -   users.php

    +v1(version 1)
       +posts
        -   addProduct.php
        -   getProduct.php
    
        +users
        -   addUser.php
        -   getUser.php
    
Databas för att spara data
    -   individuell_uppgift.sql

HTML fil för framsida
    -   product.html

README fil för att läsa projektets gång
    -   README.md


endpoints som kommer att användas i detta projekt är...

Användarhantering:
    registrera användare
    logga in användare 

Produkthantering:
    lägga till produkter
    ta bort produkter
    uppdatera produkter
    lista produkter

Varukorg:
    lägga till produkter i varukorg
    ta bort produkter från varukorg
    checka ut varukorgen
