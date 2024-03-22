Hello, I've developed this Realtime Chat web application using TALL (TailwindCSS, Alpine.js, LARAVEL, Livewire) stack <br />
*** Technologies Used: ***<br />
LARAVEL: back-end developed in LARAVEL 10<br />
LIVEWIRE: front-end is built using Livewire v3<br />
WebSockets (Pusher)<br />
TailwindCSS & Alpine.js<br />

*** Features: ***<br />
Built with LARAVEL & LIVEWIRE with session based authentication approach<br />
User can search for Users and then start a chat<br />
refreshes components when user sends a message<br />
Pusher Channels used for realtime communication with LARAVEL events<br />

*** HOW TO RUN THIS PROJECT ON LOCAL HOST ***<br />
Clone this project in your local computer by using "git clone (repo url)"
Before Running this project<br />
open terminal run "composer install" & "npm install"
create a .env file copy code from .envexample and paste into .env file
Install and configue XAMPP (run mysql & localhost server)<br />
Install npm via CMD (as administrator)<br />
run php artisan serve<br />
run npm run dev<br />
migrate the database using "php artisan migrate"
make sure to change the database creds in .env file<br />
make sure to create a pusher private channel and change the creds in .env file to enable realtime communication<br />
make sure to migrate the database migrations using (php artisan migrate)<br />
THIS WHOLE PROJECT WAS COMPLETELY DEVELOPED BY ME!<br />
*** THANKS FOR READING ***
