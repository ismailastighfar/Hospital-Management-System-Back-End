
we make a laravel crud rest api with sanctum-auth 

test using postman


database My Sql :

tables : 

-> users , patients , doctors , appointments , prescriptions , departments , medicines , questions , answers



models : 

users hasOne patient , doctor 

doctor belongTo department

appointment belongTo patient , doctor 

appointment hasOne prescription 

patient hasMany questions 

doctor hasMany answers 

question hasMany answers



Controllers : 

-> crud for all modeles
-> authentication (login, logout) for the users(patient,doctor,admin)


factories : 

-> users , patient , doctor , department 



next steps : 

-> send email after storing appointment 

-> email verification








